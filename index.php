<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/create_example_data.php';

use App\Mankind;
use App\ParseLargeFile;
use App\Person;
use App\ParseFile;

$file = __DIR__ . '/randomPersons.csv';

try {

    $start = microtime(true);

    $filesize = filesize($file);

    if ($filesize <= pow(10000, 2)) {
        $mankind = Mankind::getInstance(new ParseFile());
        echo 'Small size file' . PHP_EOL;
    } else {
        $mankind = Mankind::getInstance(new ParseLargeFile());
        echo 'Large size file' . PHP_EOL;
    }

    $data = $mankind->getPersons($file);

    foreach ($data as $item) {
        /* @var Person $item */
        $person = $mankind->getPersonById($item->getId());
        echo 'Get person age in days - ' . $person->getPersonAgeDays() . PHP_EOL;
        echo 'Get the Person based on ID: ' . $person->getName() . '; name - ' . $person->getName() . '; surname - ' . $person->getSurname() . '; gender - ' . $person->getSex() . PHP_EOL;
    }

    echo 'Get the percentage of Men in Mankind - ' . $mankind->getPercentageOfMenInMankind() . PHP_EOL;

    echo 'Time usage ' . round(microtime(true) - $start, 2) . ' s' . PHP_EOL;
    echo 'Memory usage ' . round(memory_get_usage() / (1024 * 1024)) . ' Mb' . PHP_EOL;
    echo 'Max memory usage ' . round(memory_get_peak_usage() / (1024 * 1024)) . ' Mb' . PHP_EOL;

    echo 'File size - ' . round($filesize / (1024 * 1024)) . ' Mb' . PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
