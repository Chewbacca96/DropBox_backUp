<?php
namespace DropBox_backUp;

use DropBox_backUp\models\Archive;
use DropBox_backUp\models\BackUp;

require 'vendor\autoload.php';
$config = require 'config.php';

ini_set('max_execution_time', 0);
ini_set('log_errors', 'On');
ini_set('error_log', $config['errorLog']);

/*
Задание:
Архивация, заданной в config.php, папки
Загрузка архива на DropBox
*/

$archive = new Archive($config['archive']);
$backUp = new BackUp($config['dropBox']);

$archiveName = $archive->newArchive();

$backUp->setToDropBox($archiveName);

unlink($archiveName);

echo "\nI'm done!";