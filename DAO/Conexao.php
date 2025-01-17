<?php

const host = 'db'; // Nome do serviço no docker-compose
const db_name = 'db_financeiro'; // Nome do banco de dados
const username = 'user'; // Username
const password = 'password'; // Senha

/* 
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
        if (self::$conexao == null) {
            $retries = 5;
            while ($retries > 0) {
                try {
                    $dsn = 'mysql:host=' . host . ';dbname=' . db_name;
                    self::$conexao = new PDO($dsn, username, password);
                    self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    break;
                } catch (PDOException $e) {
                    if ($retries === 0) {
                        echo "Erro ao conectar ao banco: " . $e->getMessage();
                    }
                    $retries--;
                    sleep(2); // Espera 2 segundos antes de tentar novamente
                }
            }
        }
        return self::$conexao;
    }    
}
