<?php
namespace DropBox_backUp;

use DropBox_backUp\models\Archive;
use DropBox_backUp\models\MyClient;

require 'vendor\autoload.php';
$config = require 'config.php';

ini_set('max_execution_time', 0);
ini_set('log_errors', 'On');
ini_set('error_log', $config['errorLog']);

/**
 * Задание:
 * Архивация, заданной в config.php, папки
 * Загрузка архива на DropBox
 *
 * Правки:
 * +Передавать параметры явно а не массивом
 * +Писать комментарии перед функциями
 * +Каждый экземпляр класса по сути отдельный массив
 * +Путь для места куда создавать массив
 * +Возможность архивировать папку
 *
 * Проверка на наличие прав на запись
 * +Возможность загружать архив в особенную папку на DropBox
 * +Если файл не загрузился то он не удаляется
 *
 * Изучить библиотеку monolog
 * Ошибки записывать в syslog
 * Добавить лог в конце уровня info о выполненной работе скрипта (monolog)
 *
 * Раздельные процессы архивация - загрузка - удаление
 * Передача скрипту пути к config.php параметром при запуске
 */

$archive = new Archive(
    $config['archive']['pathToFile'],
    $config['archive']['pathToArchive']
);
$client = new MyClient(
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
    error_log('Error: ' . $e->getMessage());
}

echo "\nI'm done!";