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
     * @param string|null $search Termo pesquisado
     * @param string|null $limit Limite de resultados por página
     * @return Categoria|Categoria[]|boolean Retorna Categoria|Categoria[] ou false em caso de erro
     */
    static public function consultarCategoria(int $id = null, string $search = null, string $limit = null): Categoria|array|bool
    {
        if ($id !== null) {
            // Busca no banco o objeto especificado e faz as atribuições
            $query = "SELECT id_categoria, nome_categoria 
                        FROM categoria WHERE (id_categoria = ? AND id_usuario = ?)";
            $sql = Conexao::getConexao()->prepare($query);
            $sql->bindValue(1, $id, PDO::PARAM_INT);
            $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
            $sql->setFetchMode(PDO::FETCH_CLASS, 'Categoria');
            $sql->execute();
            return $sql->fetch();
        } else {
            // Busca todos os elementos e retorna o array
            $query = "SELECT id_categoria, nome_categoria 
                        FROM categoria WHERE (id_usuario = ?) ";
            if (trim($search) != '') {
                // Busca conforme o search e retorna o array respectivo à busca  
                $query .= 'AND nome_categoria LIKE ?';
            }
            if($limit)
            {
                $query .= $limit;
            }
            $sql = Conexao::getConexao()->prepare($query);
            $sql->bindValue(1, Util::codigoLogado(), PDO::PARAM_INT);
            if (trim($search) != '') {
                $sql->bindValue(2, "%$search%", PDO::PARAM_STR);
            }
            $sql->execute();
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
        $query = "UPDATE categoria SET nome_categoria = ? WHERE (id_categoria = ? AND id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $nome, PDO::PARAM_STR);
        $sql->bindValue(2, $this->id_categoria, PDO::PARAM_INT);
        $sql->bindValue(3, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            $this->nome_categoria = $nome;
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
        $query = "DELETE FROM categoria WHERE (id_categoria = ? AND id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $this->id_categoria, PDO::PARAM_INT);
        $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            return 1;
        } catch (PDOException  $e) {
            if ($e->errorInfo[1] == 1451) {
                // Registro em uso
                return -4;
            } else {
                // Erro inesperado
                echo $e->getMessage();
                return -1;
            }
        } catch (Exception  $e) {
            // Erro inesperado
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * Retorna o total de categorias cadastradas pelo usuário
     *
     * @return integer Total de categorias
     */
    static public function totalCategorias() : int
    {
        $query = "SELECT COUNT(*) AS total 
                      FROM categoria WHERE id_usuario = ?";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, Util::codigoLogado(), PDO::PARAM_INT);
        $sql->execute();
        $total = $sql->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }
}
