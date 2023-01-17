<?php
session_start();
class databaseConnection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "e-lyrics";

    public function connection()
    {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->databaseName", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "connection failed";
        }
        return $pdo;
    }
}
