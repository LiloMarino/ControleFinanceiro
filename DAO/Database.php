<?php
class Database
{
    private string $host = 'localhost'; //server name
    private string $db_name = 'test'; //database name
    private string $username = 'root'; //username
    private string $password = 'root';  //password
    public mysqli $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Verificar a conexão
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        echo "Connected to database successfully";
    }
}
