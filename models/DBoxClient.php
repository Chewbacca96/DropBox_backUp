<?php
namespace DropBox_backUp\models;

use Dropbox\Client;

class DBoxClient extends Client
{
    /**
     * Функция загружает файл на DropBox
     *
     * @param string $pathToArchive путь к файлу, который нужно загрузить
     * @param string $folder директория в которую будет загружен файл
     *
     * @return mixed метаданные загруженного файла
     */
    public function setToDropBox($pathToArchive, $folder)
    {
        $f = fopen($pathToArchive, 'rb');
        $metaData = $this->uploadFile("/$folder", \Dropbox\WriteMode::add(), $f);
        fclose($f);
        
        return $metaData;
    }
}