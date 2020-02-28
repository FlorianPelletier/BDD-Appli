<?php


namespace src\conf;
use Illuminate\Database\Capsule\Manager;

class ConnectionBD
{
    public static function connect()
    {
        if (file_exists('src/Configuration/db.config.ini')) {
            $data = parse_ini_file('src/Configuration/db.config.ini');
        } else {
            echo "erreur de connection .init";
        }

        $db = new Manager();
        $db->addConnection([
            'driver' => $data['driver'],
            'host' => $data['host'],
            'database' => $data['database'],
            'username' => $data['username'],
            'password' => $data['password'],
            'charset' => $data['charset'],
            'prefix' => ''
        ]);
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}