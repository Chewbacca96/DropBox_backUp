<?php
return [
    'dropBox' => [
        'accessToken'      => 'Q7KaXToc6uAAAAAAAAAADtUP3I20fyZaA7qoXxsklN-Mez4l-RwjCFirR73poe3N',
        'clientIdentifier' => 'BackUpScript/1.0',
        'backUpFolder'     => 'backUp_test_folder/'
    ],
    'archive' => [
        'pathToSource'  => 'backUp_test/*',
        'pathToArchive' => 'backUp_test/'
    ],
    'sqlOpt'      => [
        'host'    => 'localhost',
        'db'      => 'motodb2',
        'user'    => 'Chewy',
        'pass'    => '123',
        'dump'    => 'backUp_test/DB.sql'
    ],
    'errorLog' => 'php_errors.log'
];