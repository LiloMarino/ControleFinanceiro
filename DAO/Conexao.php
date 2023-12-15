<?php

const host = 'localhost'; // IP 
const db_name = 'db_financeiro'; // Nome do banco de dados
const username = 'root'; // Username
const password = 'root';  // Senha

/* 
 * 
 * Classe de conexão com o banco de dados usando o padrão de projeto Singleton
 * 
 */
abstract class Conexao
{

    /**
     * Objeto de conexão com o banco de dados
     * @var mysqli 
     */
    private static ?mysqli $conexao = null;

    /**
     * Retorna a conexão com o banco de dados
     * @return mysqli Objeto de conexão com o banco de dados
     */
    public static function getConexao(): mysqli
    {
        try {
            if (self::$conexao == null) {
                self::$conexao = new mysqli(host, username, password, db_name);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        return self::$conexao;
    }
}
