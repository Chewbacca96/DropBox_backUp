<?php
namespace DropBox_backUp\models;

use DropBox_backUp\exceptions\DumpException;

class Dump
{
    /**
     * Функция создает дамп базы данных
     *
     * @param string $host имя хоста базы данных
     * @param string $usr логин пользователя базы данных
     * @param string $pass пароль пользователя базы данных
     * @param string $db имя базы данных
     * @param string $pathToDump путь к файлу, в который будет записан дамп базы данных
     *
     * @return int код выполнения внешней программы
     */
    public function getDump($host, $usr, $pass, $db, $pathToDump)
    {
        $f = fopen($pathToDump, 'w+');

        exec("mysqldump --host=$host --user=$usr --password=$pass $db", $dump, $ret);

        if ($ret != 0) {
            throw new DumpException('Cant create dump.'); 
        }

        foreach ($dump as $line) {
            fwrite($f, $line . "\n");
        }

        fclose($f);

        return $ret;
    }
}