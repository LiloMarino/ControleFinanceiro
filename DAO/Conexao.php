<?php
/* 
 * 
 * Classe de conexão com o banco de dados usando o padrão de projeto Singleton
 * 
 */

const host = 'localhost'; // IP 
const db_name = 'db_financeiro'; // Nome do banco de dados
const username = 'root'; // Username
const password = 'root';  // Senha

abstract class Conexao
{
    private static mysqli $conn = null; // Conexão

    /**
     * Retorna a conexão com o banco de dados
     */
    public static function getConexao() : mysqli
    {
        if (self::$conn == null) {
            self::$conn = new mysqli(host, username, password, db_name);
            if (self::$conn->connect_error) {
                die("Connection failed: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}
?>