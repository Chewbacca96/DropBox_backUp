<?php
namespace DropBox_backUp;

use Monolog\Logger;
use Monolog\Handler\SyslogHandler;
use DropBox_backUp\exceptions\WriteException;
use DropBox_backUp\models\Archive;
use DropBox_backUp\models\DBoxClient;

require 'vendor/autoload.php';
$config = require (isset($argv[1])) ? $argv[1] : 'config.php';

ini_set('max_execution_time', 0);
date_default_timezone_set('Europe/Moscow');

/**
 * Задание:
 * Архивация, заданной в config.php, папки
 * Загрузка архива на DropBox
 *
 * Правки:
 * Изучить библиотеку monolog
 * Ошибки записывать в syslog
 * Добавить лог в конце уровня info о выполненной работе скрипта (monolog)
 *
 * Передача скрипту пути к config.php параметром при запуске
 */

$start = microtime(true);

$syslog = new Logger('Syslog');
$syslog->pushHandler(new SyslogHandler('backupScript', LOG_USER, Logger::DEBUG));

$syslog->info("The script " . $argv[0] . " started.");

try {
    $archive = new Archive(
        $config['archive']['pathToSource'],
        $config['archive']['pathToArchive']
    );
} catch (WriteException $e) {
    $syslog->error('Error: ' . $e->getMessage());
    exit();
}

$client = new DBoxClient(
    $config['dropBox']['accessToken'],
    $config['dropBox']['clientIdentifier']
);

$archiveName = $config['dropBox']['backUpFolder'] . $archive->getName();
$archivePath = $archive->getPath();

try {
    if ($client->setToDropBox($archivePath, $archiveName)) {
        unlink($archivePath);
        $syslog->info("Archive " . $archiveName . " uploaded to DropBox.");
    }
} catch (\Exception $e) {
    $syslog->error('Error: ' . $e->getMessage());
    $syslog->info("Archive is not loaded on DropBox because of an error.");
}

$syslog->info("Script finished in " . (microtime(true) - $start) . " sec.");

echo "\nI'm done!\n";