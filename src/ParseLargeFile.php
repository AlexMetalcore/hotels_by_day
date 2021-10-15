<?php

declare(strict_types=1);

namespace App;

class ParseLargeFile implements ParserFileInterface
{
    public function parseFiles(string $file)
    {
        if (($handle = fopen($file, 'r')) !== false) {
            while (($item = fgetcsv($handle, 10000000, ';')) !== false) {
                yield [
                    $item[0],
                    $item[1],
                    $item[2],
                    $item[3],
                    $item[4]
                ];
            }

            fclose($handle);
        }
    }
}