<?php
namespace DropBox_backUp\models;

class Archive extends \ZipArchive
{
    private $Name;
    private $Path;

    function __construct($pathToFile, $pathToArchive)
    {
        $this->Name = date('d-m-Y_G-i-s') . '.zip';
        $this->Path = $pathToArchive . $this->Name;

        $this->open($this->Path, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $this->addGlob($pathToFile);
        $this->close();
    }

    public function getName()
    {
        return $this->Name;
    }

    public function getPath()
    {
        return $this->Path;
    }
}