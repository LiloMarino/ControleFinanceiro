<?php
require_once 'Util.php';
require_once 'Conexao.php';
/**
 * Categoria dos movimentos do sistema financeiro
 */
class Categoria
{
    /**
     * Id da categoria
     * @var integer
     */
    public int $id_categoria;

    /**
     * Nome da categoria
     * @var string
     */
    public string $nome_categoria;

    /**
     * Cadastra a categoria no sistema
     * 
     * @param string $nome Nome da categoria
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    static public function cadastrarCategoria(string $nome): int
    {
        if (Util::isEmpty($nome)) {
            return 0;
        }

        $query = "INSERT INTO categoria (nome_categoria, id_usuario) VALUES (?, ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $nome, PDO::PARAM_STR);
        $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * Realiza a consulta das categorias cadastradas
     *
     * @param integer|null $id Id da Categoria
     * @return Categoria|array Retorna Categoria|Categorias[] 
     */
    static public function consultarCategoria(int $id = null): Categoria|array
    {
        if ($id != null) {
            // Busca no banco o objeto especificado e faz as atribuições
            $query = "SELECT id_categoria, nome_categoria FROM categoria WHERE (id_categoria = ? AND id_usuario = ?)";
            $sql = Conexao::getConexao()->prepare($query);
            $sql->bindValue(1, $id, PDO::PARAM_INT);
            $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
            return $sql->fetch(PDO::FETCH_CLASS, 'Categoria');;
        } else {
            // Busca todos os elementos e retorna o array
            $query = "SELECT id_categoria, nome_categoria FROM categoria WHERE (id_usuario = ?)";
            $sql = Conexao::getConexao()->prepare($query);
            $sql->bindValue(1, Util::codigoLogado(), PDO::PARAM_INT);
            return $sql->fetchAll(PDO::FETCH_CLASS, 'Categoria');
        }
    }

    /**
     * Atualiza as informações da categoria
     * 
     * @param string $nome Nome da categoria
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarCategoria(string $nome): int
    {
        if (Util::isEmpty($nome)) {
            return 0;
        }
        $query = "UPDATE categoria SET (nome_categoria = ?) WHERE (id_categoria = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $nome, PDO::PARAM_STR);
        $sql->bindValue(1, $this->id_categoria, PDO::PARAM_INT);
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * Realiza a exclusão da categoria
     * 
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function excluirCategoria(): int
    {
        $query = "DELETE FROM categoria WHERE (id_categoria = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }
}
