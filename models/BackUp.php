<?php
namespace DropBox_backUp\models;

class BackUp extends \Dropbox\Client
{
    public function __construct($config)
    {
        $accessToken = $config['accessToken'];
        $clientIdentifier = $config['clientIdentifier'];

        parent::__construct($accessToken, $clientIdentifier, $userLocale = null);
    }

    public function setToDropBox($archiveName)
    {
        $f = fopen($archiveName, 'rb');
        return $this->uploadFile("/$archiveName", \Dropbox\WriteMode::add(), $f);
    }
}