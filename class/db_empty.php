<?php

class DBConnection
{
    // DB server connection
    private $db_username = 'user';
    private $db_password = 'password';
    private $db = 'host';
    private $db_name = 'database';
    private $db_port = '3306';

    public function connect()
    {
        $con = new PDO("mysql:host=$this->db;dbname=$this->db_name;port=$this->db_port", $this->db_username, $this->db_password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }
}
