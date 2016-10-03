<?php
namespace DropBox_backUp\models;

class Archive extends \ZipArchive
{
    /**
     * Функция создает новый архив
     *
     * @param string $pathToFile путь к файлу или папке, которую необходимо добавить в архив
     * @param string $pathToArchive путь к директории, где будет создан архив
     * 
     * @return string имя созданного архива
     */
    public function setToArchive($pathToFile, $pathToArchive)
    {
        $archiveName = $pathToArchive . date('d-m-Y_G-i-s') . '.zip';

        $this->open($archiveName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $this->addGlob($pathToFile);
        $this->close();

        return $archiveName;
    }
}