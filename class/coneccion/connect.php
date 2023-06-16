<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

class connect
{
    private $host = 'localhost';
    private $db_name = 'campersV2';
    private $username = 'campus';
    private $password = 'campus2023';
    private $conn;
    function __construct()
    {
        $this->conn = null;

        try {
            $dns = "mysql:host=".$this->host.";dbname=".$this->db_name;
            $this->conn = new PDO(
                $dns, $this->username,$this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
    public function query($sql, $params = array())
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $exception) {
            echo "Error en la consulta: " . $exception->getMessage();
            return null;
        }
    }
}
