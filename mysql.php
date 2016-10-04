<?php
namespace DropBox_backUp;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use DropBox_backUp\models\MySqlDump;

require 'vendor\autoload.php';
$config = require 'config.php';

ini_set('max_execution_time', 0);

$log = new Logger('Log');
$log->pushHandler(new StreamHandler($config['errorLog'], Logger::DEBUG));

$mySql = new MySqlDump($config['sqlOpt']);
$mySql->getDump($config['sqlOpt']['dump'], $config['sqlOpt']['db']);

echo "\nI'm done!";