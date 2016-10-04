<?php
namespace DropBox_backUp\models;

class DB
{
    private static $pdo;

    /**
     * Функция производит подключение в mySql базе данных
     *
     * @param array $dbOptions массив с опциями для подключения
     *
     * @return \PDO объект
     */
    public static function connectToDB($dbOptions)
    {
        if (self::$pdo) {
            return self::$pdo;
        }

        $host    = $dbOptions['host'];
        $db      = $dbOptions['db'];
        $charset = $dbOptions['charset'];
        $user    = $dbOptions['user'];
        $pass    = $dbOptions['pass'];

        $dsn = "mysql:host = $host; dbname = $db; charset=$charset";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        return self::$pdo = new \PDO($dsn, $user, $pass, $options);
    }
}