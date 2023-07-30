<?php

class DatabaseConnection
{
    private $db;

    public function __construct(string $host, string $dbname, string $username, string $password)
    {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Verbindungsfehler: " . $e->getMessage();
            exit();
        }
    }

    public function getDb(): PDO
    {
        return $this->db;
    }
}


$host = 'localhost';
$dbname = 'Users';
$username = 'root';
$password = '';


$dbConnection = new DatabaseConnection($host, $dbname, $username, $password);
$db = $dbConnection->getDb();
