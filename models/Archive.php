<?php
namespace DropBox_backUp\models;

class Archive extends \ZipArchive
{
    private static $pathToFile;
    private $archiveName;

    public function __construct($config)
    {
        if (!self::$pathToFile) {
            self::$pathToFile = $config['pathToFile'];
        }
    }

    public function newArchive()
    {
        $this->archiveName = date('d-m-Y_G-i-s') . '.zip';

        $this->open($this->archiveName, \ZipArchive::CREATE);
        $this->addFile(self::$pathToFile);
        $this->close();

        return $this->archiveName;
    }
}