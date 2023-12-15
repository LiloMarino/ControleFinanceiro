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
     * @var PDO 
     */
    private static ?PDO $conexao = null;

    /**
     * Retorna a conexão com o banco de dados
     * @return PDO Objeto de conexão com o banco de dados
     */
    public static function getConexao(): PDO
    {
        try {
            if (self::$conexao == null) {
                $dsn = 'mysql:host=' . host . ';dbname=' . db_name;
                self::$conexao = new PDO($dsn, username, password, null);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$conexao;
    }
}
