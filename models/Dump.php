<?php
namespace DropBox_backUp\models;

use Ifsnop\Mysqldump\Mysqldump;

class Dump extends Mysqldump
{
    /**
     * Dump constructor.
     *
     * @param array $dbOptions массив с опциями для подключения
     */
    public function __construct($dbOptions)
    {
        $host    = $dbOptions['host'];
        $db      = $dbOptions['db'];
        $user    = $dbOptions['user'];
        $pass    = $dbOptions['pass'];

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        parent::__construct("mysql:host=$host;dbname=$db", "$user", "$pass", [], $options);
    }

    /**
     * Функция делает дамп базы данных
     *
     * @param string $pathToFile путь к файлу, который создастся и будет хранить дамп
     *
     * @return bool
     * @throws \Exception
     */
    public function getDump($pathToFile)
    {
        $f = fopen($pathToFile, 'w+');
        $this->start($pathToFile);
        return fclose($f);
    }
}