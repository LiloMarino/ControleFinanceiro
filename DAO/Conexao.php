<?php
// Configurações do Site
define('HOST', 'localhost'); //IP
define('USER', 'root'); //usuario
define('PASS', 'root'); //senha
define('DB', 'db_financeiro'); //banco

/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 * @copyright (c) year, Wladimir M. Barros
 */

class Conexao
{

    /** @var PDO */
    private static $Connect;

    private static function Conectar()
    {
        try {

            //Verifica se a conexão não existe
            if (self::$Connect == null) {

                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                self::$Connect = new PDO($dsn, USER, PASS, null);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        //Seta os atributos para que seja retornado as excessões do banco
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        return self::$Connect;
    }

    public static function retornaConexao()
    {
        return self::Conectar();
    }
}