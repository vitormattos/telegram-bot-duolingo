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
        $dbopts = parse_url(getenv('DATABASE_URL'));
        $db = new ExtendedPdo(
            "pgsql:host={$dbopts["host"]};port={$dbopts["port"]};dbname=".ltrim($dbopts["path"],'/'),
            $dbopts['user'],
            $dbopts['pass']
        );
        $db->exec(
            "CREATE TABLE IF NOT EXISTS users
(
  id serial NOT NULL,
  username character varying(150) NOT NULL,
  registered_by integer NOT NULL,
  chat_id bigint NOT NULL,
  created timestamp without time zone NOT NULL DEFAULT now(),
  CONSTRAINT user_pk PRIMARY KEY (id)
);"
        );
        return $db;
    }
}