<?php

declare(strict_types=1);

namespace App;

interface ParserFileInterface
{
    public function parseFiles(string $file);
}