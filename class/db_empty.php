<?php

class DBConnection
{
    // DB server connection
    private $db_username = 'root';
    private $db_password = 'notSecureChangeMeOrNot';
    private $db = 'mariadb';
    private $db_name = 'disharzz';
    private $db_port = '3306';

    public function connect()
    {
        $con = new PDO("mysql:host=$this->db;dbname=$this->db_name;port=$this->db_port", $this->db_username, $this->db_password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }
}
