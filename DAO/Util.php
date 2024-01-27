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
        if (!isset($_SESSION['cod']) || $_SESSION['cod'] == '') {
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

    /**
     * Determina o LIMIT de consulta do banco e retorna a string para o SQL
     *
     * @param integer $paginaAtual Página atual do usuário
     * @param integer $itensPorPagina Quantos itens por página serão exibidos
     * @return string String com o LIMIT da consulta
     */
    public static function determinaLimit(int $paginaAtual,  int $itensPorPagina): string
    {
        $limiteInferior = ($paginaAtual - 1) * $itensPorPagina;
        return "LIMIT $limiteInferior, $itensPorPagina";
    }

    /**
     * Cria a paginação da tabela no HTML
     *
     * @param string $paginaPHP  Nome da página PHP que irá carregar os dados
     * @param integer $paginaAtual  Página atual do usuário
     * @param integer $itensPorPagina   Quantos itens por página serão exibidos
     * @param integer $totalItens  Total de itens do banco
     */
    public static function criaPaginacao(string $paginaPHP, int $paginaAtual, int $itensPorPagina, int $totalItens)
    {
        $totalPaginas = ceil($totalItens / $itensPorPagina); ?>
        <ul class="pagination">
            <li class="paginate_button previous <?= ($paginaAtual > 1) ? "" : "disabled" ?>">
                <a href="<?= $paginaPHP ?>?page=<?= $paginaAtual - 1 ?>">Anterior</a>
            </li>
            <?php for ($i = (($paginaAtual - 2 > 1) ? $paginaAtual - 2 : 1); $i <= (($paginaAtual + 2 < $totalPaginas) ? $paginaAtual + 2 : $totalPaginas); $i++) : ?>
                <li class="paginate_button <?= ($paginaAtual == $i) ? 'active' : '' ?>">
                    <a href="<?= $paginaPHP ?>?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="paginate_button next <?= ($paginaAtual < $totalPaginas) ? "" : "disabled" ?>">
                <a href="<?= $paginaPHP ?>?page=<?= $paginaAtual + 1 ?>">Próximo</a>
            </li>
        </ul>
<?php
    }
}
