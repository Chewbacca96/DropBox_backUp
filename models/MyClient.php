<?php
namespace DropBox_backUp\models;

class MyClient extends \Dropbox\Client
{
    /**
     * Функция загружает указанный файл на DropBox
     *
     * @param string $pathToArchive путь к файлу, который нужно загрузить
     * @param string $folder директория в которую будет загружен файл
     *
     * @return mixed метаданные загруженного файла
     */
    public function setToDropBox($pathToArchive, $folder)
    {
        $f = fopen($pathToArchive, 'rb');
        return $this->uploadFile("/$folder", \Dropbox\WriteMode::add(), $f);
    }
}