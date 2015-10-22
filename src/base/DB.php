<?php
namespace Base;
use Aura\Sql\ExtendedPdo;
class DB
{
    /**
     * @return ExtendedPdo
     */
    public static function getInstance()
    {
        $basepath = realpath(__DIR__ . '/../../');
        $db = new ExtendedPdo('sqlite:' . $basepath . '/duolingo.sqlite');
        $db->exec(
            "CREATE TABLE IF NOT EXISTS users (\n".
            "id INTEGER PRIMARY KEY AUTOINCREMENT,\n".
            "username TEXT NOT NULL,\n".
            "registered_by INT NOT NULL,\n".
            "created datetime default current_timestamp\n".
            ");"
        );
        return $db;
    }
}