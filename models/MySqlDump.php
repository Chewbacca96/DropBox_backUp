<?php
namespace DropBox_backUp\models;

class MySqlDump
{
    static private $pdo;

    /**
     * MySqlDump constructor.
     *
     * @param array $config массив с опциями для подключения
     */
    public function __construct($dbOptions)
    {
        if (!self::$pdo) {
            self::$pdo = DB::connectToDB($dbOptions);
        }
    }

    /**
     * Функция записывает в файл структуру базы данных
     *
     * @param string $pathToSource путь к директории где создастся файл
     * @return bool
     */
    public function getDump($pathToSource, $dbName)
    {
        $f = fopen($pathToSource, 'w+');

        $tables = self::$pdo->query("SHOW TABLES FROM $dbName", \PDO::FETCH_NUM)->fetchAll();

        foreach ($tables as $table) {
            $dump = self::$pdo->query("SHOW CREATE TABLE $dbName.$table[0]")->fetchAll();
            fwrite($f, $dump[0]['Create Table'] . "\n\n");
        }

        return fclose($f);
    }
}