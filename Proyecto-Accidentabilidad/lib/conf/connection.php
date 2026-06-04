<?php

class Connection
{
    private $server;
    private $user;
    private $pass;
    private $db;
    private $port;
    private $link;

    function __construct()
    {
        require 'conf.php';

        $this->server=$server;
        $this->user=$user;
        $this->pass=$pass;
        $this->db=$db;
        $this->port=$port;

        $this->connect();
    }

    private function connect()
    {
        $this->link = pg_connect("host={$this->server} port={$this->port} dbname={$this->db} user={$this->user} password={$this->pass}");

        if (!$this->link) {
            die("Error crítico de conexión: " . pg_last_error(null));
        }
    }

    public function getConnect()
    {
        return $this->link;
    }

    public function close()
    {
        if ($this->link) {
            pg_close($this->link);
        }
    }
}