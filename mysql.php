<?php
namespace DropBox_backUp;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use DropBox_backUp\models\Dump;

require 'vendor\autoload.php';

if ($argv[1]) {
    $pathToConfig = $argv[1];
} else {
    $pathToConfig = 'config.php';
}

$config = require $pathToConfig;

ini_set('max_execution_time', 0);

$log = new Logger('Log');
$log->pushHandler(new StreamHandler($config['errorLog'], Logger::DEBUG));

$log->info('The script started.');

$mySql = new Dump($config['sqlOpt']);

$mySql->getDump($config['sqlOpt']['dump']);

$log->info('Dump the database is made.');

echo "\nI'm done!";