<?php

class Util
{
    /**
     * Inicia a sessão caso ela não exista
     */
    private static function iniciarSessao()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function criarSessao($id_usuario)
    {
        self::IniciarSessao();
        $_SESSION['cod'] = $id_usuario;
    }

    public static function codigoLogado(): int
    {
        self::IniciarSessao();
        return $_SESSION['cod'];
    }

    public static function deslogar()
    {
        self::iniciarSessao();
        unset($_SESSION['cod']);
        header("location:login.php");
        exit;
    }

    public static function verificarLogado()
    {
        self::iniciarSessao();
        if(!isset($_SESSION['cod']) || $_SESSION['cod'] == '')
        {
            header("location:login.php");
            exit;
        }
    }

    /**
     * Verifica se as variáveis estão vazias usando trim()
     * @param array $vars Variáveis para verificar se estão vazias
     * @return bool Retorna verdadeiro se estiver vazia e falso caso contrário
     */
    public static function isEmpty(...$vars): bool
    {
        foreach ($vars as $var) {
            if (trim($var) == '') {
                return true;
            }
        }
        return false;
    }
}
