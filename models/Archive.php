<?php
namespace DropBox_backUp\models;

use DropBox_backUp\exceptions\WriteException;
use ZipArchive;

class Archive extends ZipArchive
{
    private $name;
    private $path;

    /**
     * Archive constructor
     *
     * @param string $pathToSource путь к данным, которые нужно добавить в архив
     * @param string $pathToArchive путь к директории, в которой будет создан архив
     *
     * @throws WriteException выбрасыватсья при отсутствии прав на запись в директории
     */
    function __construct($pathToSource, $pathToArchive)
    {
        if (!is_writable($pathToArchive)) {
            throw new WriteException('Cant write archive to this folder. Access denied.');
        }

        $this->name = date('d-m-Y_G-i-s') . '.zip';
        $this->path = $pathToArchive . $this->name;

        $this->open($this->path, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $this->addGlob($pathToSource);
        $this->close();
    }

    /**
     * Функция возвращает имя созданного архива
     *
     * @return mixed имя созданного архива
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Функция возвращает путь к созданному архиву
     *
     * @return mixed путь к созданному архиву
     */
    public function getPath()
    {
        return $this->path;
    }
}