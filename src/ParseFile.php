<?php

declare(strict_types=1);

namespace App;

class ParseFile implements ParserFileInterface
{

    public function parseFiles(string $file)
    {
        $dataPersons = [];

        if (($handle = fopen($file, 'r')) !== false) {
            while (($item = fgetcsv($handle, 100000, ';')) !== false) {
                $dataPersons[] = [
                    $item[0],
                    $item[1],
                    $item[2],
                    $item[3],
                    $item[4]
                ];
            }

            fclose($handle);

            return $dataPersons;
        }

        throw new \Exception('Error open file');
    }
}