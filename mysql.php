<?php
namespace DropBox_backUp;

use Monolog\Logger;
use Monolog\Handler\SyslogHandler;
use DropBox_backUp\models\Dump;

require 'vendor/autoload.php';
$config = require (isset($argv[1])) ? $argv[1] : 'config.php';

$start = microtime(true);

ini_set('max_execution_time', 0);
date_default_timezone_set('Europe/Moscow');

$syslog = new Logger('Syslog');
$syslog->pushHandler(new SyslogHandler('backupScript', LOG_USER, Logger::DEBUG));

$syslog->info('The script ' . $argv[0] . ' started.');

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
    $syslog->error('Error: ' . $e->getMessage());
    exit();
}

$syslog->info('Dump ' . $config['sqlOpt']['db'] . ' database is created in ' . $config['sqlOpt']['dump'] . ' for ' . (microtime(true) - $start) . ' sec.');

echo "\nI'm done!\n";