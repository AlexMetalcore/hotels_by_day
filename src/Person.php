<?php

declare(strict_types=1);

namespace App;

class Person
{
    public CONST MAN = 'M';
    public CONST FEMALE = 'F';

    private int $id;
    private string $name;
    private string $surname;
    private string $sex;
    private string $birthDate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function __construct(int $id, string $name, string $surname, string $sex, string $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->sex = $sex;
        $this->birthDate = $birthDate;
    }

    public function getPersonAgeDays(): string
    {
        $birthDay = new \DateTime(date('Y-m-d', strtotime($this->birthDate)));

        return 'Age in days: ' . $birthDay->diff(new \DateTime())->days;
    }
}