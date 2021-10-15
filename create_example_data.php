<?php

$str = 'abcdefghijklmnopqrstuvwxyz;abcdefghijklmnopqrstuvwxyz';

$data = explode(';', $str);

$rangeData = range(1, 1000);

shuffle($rangeData);

$prepareData = [];

$file = fopen('randomPersons.csv', 'w');

for ($i = 1; $i < count($rangeData); $i++) {
    fputcsv($file, [$rangeData[$i] . ';' . strtoupper(substr(str_shuffle($data[0]), 0, 1)) . substr(str_shuffle($data[0]), 0, 8) . ';' . strtoupper(substr(str_shuffle($data[1]), 0, 1)) . substr(str_shuffle($data[1]), 0, 8) . ';' . substr(str_shuffle('MF'), 0, -1) . ';' . mt_rand(1, 30) . '.' . mt_rand(1, 12) . '.' . mt_rand(1971, 2021)]);
}

fclose($file);
