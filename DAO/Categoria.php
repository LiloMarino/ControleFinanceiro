<?php
require_once 'Util.php';
require_once 'Conexao.php';
/**
 * Categoria dos movimentos do sistema financeiro
 */
class Categoria
{
    /**
     * Nome da categoria
     * @var string
     */
    public string $nome;

    /**
     * @param int $id Id da categoria no banco de dados, caso não passe nada como parâmetro é atribuído null
     */
    public function __construct(int $id = null)
    {
        if ($id != null) {
            // Busca no banco e faz as atribuições

        }
        // Caso contrário interpreta-se que é um objeto que ainda não possui um id no banco
    }

    /**
     * Cadastra a categoria no sistema
     * @param string $nome Nome da categoria
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function cadastrarCategoria(string $nome): int
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
     * Realiza a consulta de todas as categorias cadastradas
     * @return array Retorna o array de Categorias[] 
     */
    static public function consultarCategoria(): array
    {
        return [];
    }

    /**
     * Atualiza as informações da categoria
     * @param string $nome Nome da categoria
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarCategoria(string $nome): int
    {
        if (Util::isEmpty($nome)) {
            return 0;
        }
        return 1;
    }

    /**
     * Realiza a exclusão da categoria
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function excluirCategoria(): int
    {
        return 1;
    }
}
