<?php
namespace DropBox_backUp;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use DropBox_backUp\exceptions\WriteException;
use DropBox_backUp\models\Archive;
use DropBox_backUp\models\DBoxClient;

require 'vendor\autoload.php';

if ($argv[1]) {
    $pathToConfig = $argv[1];
} else {
    $pathToConfig = 'config.php';
}

$config = require $pathToConfig;

ini_set('max_execution_time', 0);

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

$log = new Logger('Log');
$log->pushHandler(new StreamHandler($config['errorLog'], Logger::DEBUG));

try {
    $archive = new Archive(
        $config['archive']['pathToSource'],
        $config['archive']['pathToArchive']
    );
} catch (WriteException $e) {
    $log->error('Error: ' . $e->getMessage());
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
    }
} catch (\Exception $e) {
    $log->error('Error: ' . $e->getMessage());
}

echo "\nI'm done!";