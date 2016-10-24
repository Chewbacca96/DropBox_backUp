<?php
namespace DropBox_backUp;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use DropBox_backUp\models\Dump;

require 'vendor/autoload.php';
$config = require (isset($argv[1])) ? $argv[1] : 'config.php';

ini_set('max_execution_time', 0);
date_default_timezone_set('Europe/Moscow');

$log = new Logger('Log');
$log->pushHandler(new StreamHandler($config['errorLog'], Logger::DEBUG));

$log->info('The script started.');

$dump = new Dump();

try {
	$dump->getDump(
		$config['sqlOpt']['host'],
		$config['sqlOpt']['user'],
		$config['sqlOpt']['pass'],
		$config['sqlOpt']['db'],
		$config['sqlOpt']['dump']
	);
} catch (DumpException $e) {
    $log->error('Error: ' . $e->getMessage());
    exit();
}

$log->info('Dump the database is made.');

echo "\nI'm done!\n";