<?php
namespace DropBox_backUp;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use DropBox_backUp\models\Dump;

require 'vendor\autoload.php';
$config = require 'config.php';

ini_set('max_execution_time', 0);

$log = new Logger('Log');
$log->pushHandler(new StreamHandler($config['errorLog'], Logger::DEBUG));

$mySql = new Dump($config['sqlOpt']);

$mySql->getDump($config['sqlOpt']['dump']);

echo "\nI'm done!";