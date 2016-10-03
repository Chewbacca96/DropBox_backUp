<?php
namespace DropBox_backUp\models;

class BackUp extends \Dropbox\Client
{
    /**
     * Функция загружает указанный файл на DropBox
     *
     * @param string $archiveName имя файла который нужно загрузить
     * 
     * @return array массив с информацией
     */
    public function setToDropBox($archiveName)
    {
        $f = fopen($archiveName, 'rb');
        return $this->uploadFile("/$archiveName", \Dropbox\WriteMode::add(), $f);
    }
}