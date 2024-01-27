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

    /**
     * Cria a sessão para o usuário do id especificado
     *
     * @param integer $id_usuario  Id do usuário que será criada a sessão.
     */
    public static function criarSessao(int $id_usuario)
    {
        self::IniciarSessao();
        $_SESSION['cod'] = $id_usuario;
    }

    /**
     * Retorna o código  de usuário da sessão atual
     *
     * @return integer  Usuário logado no sistema.
     */
    public static function codigoLogado(): int
    {
        self::IniciarSessao();
        return $_SESSION['cod'];
    }

    /**
     * Desloga o usuário da sessão
     *
     */
    public static function deslogar()
    {
        self::iniciarSessao();
        unset($_SESSION['cod']);
        header("location:login.php");
        exit;
    }

    /**
     * Verifica se existe uma sessão do usuário caso não exista redireciona para tela de login
     *
     */
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
