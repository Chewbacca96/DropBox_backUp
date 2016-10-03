<?php
namespace DropBox_backUp;

use DropBox_backUp\models\Archive;
use DropBox_backUp\models\BackUp;

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
 * Проверка на наличие прав на записи
 * Возможность загружать архив в особенную папку на DropBox
 * Если файл не загрузился то он не удаляется
 *
 * Изучить библиотеку monolog
 * Ошибки записывать в syslog
 * Добавить лог в конце уровня info о выполненной работе скрипта (monolog)
 *
 * Раздельные процессы архивация - загрузка - удаление
 * Передача скрипту пути к config.php параметром при запуске
 */

$archive = new Archive();
/*$backUp = new BackUp(
    $config['dropBox']['accessToken'],
    $config['dropBox']['clientIdentifier']
);*/

$archiveName = $archive->setToArchive(
    $config['archive']['pathToFile'],
    $config['archive']['pathToArchive']
);

//$backUp->setToDropBox($archiveName);

//unlink($archiveName);

echo "\nI'm done!";