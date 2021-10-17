<?php

declare(strict_types=1);

namespace App;

class Mankind
{
    private static ?Mankind $instance = null;

    private array $persons = [];

    private ParserFileInterface $parserFile;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    private function __sleep()
    {

    }

    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize singleton');
    }

    public static function getInstance(ParserFileInterface $parserFile): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        $mankind = self::$instance;
        $mankind->parserFile = $parserFile;

        return $mankind;
    }

    public function getPersonById(int $id): Person
    {
        if (array_key_exists($id, $this->persons)) {
            return $this->persons[$id];
        }

        throw new \Exception('Person with id - ' . $id . ' not found');
    }

    public function getPersons(string $file): array
    {
        $data = $this->parserFile->parseFiles($file);

        foreach ($data as $item) {
            $person = new Person((int)$item[0], $item[1], $item[2], $item[3], $item[4]);
            $this->persons[$person->getId()] = $person;
        }

        return $this->persons;
    }

    public function getPercentageOfMenInMankind(): string
    {
        $mans = [];

        foreach ($this->persons as $person) {
            /* @var Person $person */
            if ($person->getSex() === 'M') {
                $mans[] = $person;
            }
        }

        return round(100 * count($mans) / count($this->persons), 2) . '%';
    }
}