<?php

namespace test_mvc\classes;

final class Config
{
    private static $params = [
        'MYSQL_HOST'          => 'localhost',
        'MYSQL_USERNAME'      => 'php_test_mvc',
        'MYSQL_DATABASE'      => 'php_test_mvc',
        'MYSQL_PASSWORD'      => 'root_mvc',

        'VIEWS_PATH'          => 'app/views/',
    ];

    public static function get($param)
    {
        return self::$params[$param];
    }
}
