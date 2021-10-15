<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/create_example_data.php';

use App\Mankind;
use App\ParseFile;
use App\ParseLargeFile;
use App\Person;

$file = __DIR__ . '/randomPersons.csv';

try {

    $start = microtime(true);

    $filesize = filesize($file);

    if ($filesize <= pow(10000, 2)) {
        $mankind = Mankind::getInstance(new ParseFile());
        echo 'Small size file' . '<br>';
    } else {
        $mankind = Mankind::getInstance(new ParseLargeFile());
        echo 'Large size file' . '<br>';
    }

    $data = $mankind->getPersons($file);

    foreach ($data as $item) {
        /* @var Person $item */
        $person = $mankind->getPersonById($item->getId());
        echo 'Get person age in days - ' . $person->getPersonAgeDays() . '<br>';
        echo 'Get the Person based on ID: id - ' . $person->getId() . '; name - ' . $person->getName() . '; surname - ' . $person->getSurname() . '; gender - ' . $person->getSex() . '<br>';
    }

    echo 'Get the percentage of Men in Mankind - ' . $mankind->getPercentageOfMenInMankind() . '<br>';

    $mem_usage = memory_get_usage();
    $mem_peak = memory_get_peak_usage();
    $time = microtime(true) - $start;

    echo 'Time usage ' . round($time, 2) . ' s' . '<br>';
    echo 'Memory usage ' . round($mem_usage / (1024 * 1024)) . ' Mb' . '<br>';
    echo 'Max memory usage ' . round($mem_peak / (1024 * 1024)) . ' Mb' . '<br>';

    echo 'File size - ' . round($filesize / (1024 * 1024)) . ' Mb' . '<br>';

} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
