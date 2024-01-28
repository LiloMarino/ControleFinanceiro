<?php
require_once 'Util.php';
require_once 'Conexao.php';
/**
 * Empresa presente no movimento do sistema financeiro
 */
class Empresa
{
    /**
     * Id da empresa
     * @var integer
     */
    public int $id_empresa;

    /**
     * Nome da empresa
     * @var string 
     */
    public string $nome_empresa;

    /**
     * Telefone da empresa
     * @var string
     */
    public ?string $telefone_empresa;

    /**
     * Endereço da empresa
     * @var string
     */
    public ?string $endereco_empresa;

    /**
     * Cadastra a empresa no sistema
     * 
     * @param string $nome Nome da empresa
     * @param string $telefone Telefone da empresa
     * @param string $endereco Endereço da empresa
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    static public function cadastrarEmpresa(string $nome, string $telefone, string $endereco): int
    {
        if (Util::isEmpty($nome)) {
            return 0;
        }
        $query = "INSERT INTO empresa (nome_empresa, telefone_empresa, endereco_empresa, id_usuario) VALUES (?, ?, ?, ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $nome);
        if (trim($telefone) != '') {
            $sql->bindValue(2, $telefone);
        } else {
            $sql->bindValue(2, null);
        }
        if (trim($endereco) != '') {
            $sql->bindValue(3, $endereco);
        } else {
            $sql->bindValue(3, null);
        }
        $sql->bindValue(4, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * Realiza a consulta das empresas cadastradas
     *
     * @param integer|null $id Id da Empresa
     * @param string|null $search Termo pesquisado
     * @param string|null $limit Limite de resultados por página
     * @return Empresa|Empresa[]|boolean Retorna Empresas|Empresas[] ou false caso erro
     */
    static public function consultarEmpresa(int $id = null, string $search = null, string $limit = null): Empresa|array|bool
    {
        if ($id !== null) {
            // Busca no banco o objeto especificado e faz as atribuições
            $query = "SELECT id_empresa, nome_empresa, telefone_empresa, endereco_empresa FROM empresa WHERE (id_empresa = ? AND id_usuario = ?)";
            $sql = Conexao::getConexao()->prepare($query);
            $sql->bindValue(1, $id, PDO::PARAM_INT);
            $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
            $sql->setFetchMode(PDO::FETCH_CLASS, 'Empresa');
            $sql->execute();
            return $sql->fetch();
        } else {
            // Busca todos os elementos e retorna o array
            $query = "SELECT id_empresa, nome_empresa, telefone_empresa, endereco_empresa FROM empresa WHERE (id_usuario = ?)";
            if (!is_null($search)) {
                // Busca conforme o search e retorna o array respectivo à busca  
                $query .= 'AND nome_empresa LIKE ?';
            }
            if ($limit) {
                $query .= $limit;
            }
            $sql = Conexao::getConexao()->prepare($query);
            $sql->bindValue(1, Util::codigoLogado(), PDO::PARAM_INT);
            if (!is_null($search)) {
                $sql->bindValue(2, "%$search%");
            }
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_CLASS, 'Empresa');
        }
    }

    /**
     * Atualiza as informações da empresa
     * 
     * @param string $nome Nome da empresa
     * @param string $telefone Telefone da empresa
     * @param string $endereco Endereço da empresa
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarEmpresa(string $nome, string $telefone, string $endereco): int
    {
        if (Util::isEmpty($nome)) {
            return 0;
        }

        $query = "UPDATE empresa SET nome_empresa = ?, telefone_empresa = ?, endereco_empresa = ?  WHERE (id_empresa = ? AND id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $nome);
        if (trim($telefone) != '') {
            $sql->bindValue(2, $telefone);
        } else {
            $sql->bindValue(2, null);
        }
        if (trim($endereco) != '') {
            $sql->bindValue(3, $endereco);
        } else {
            $sql->bindValue(3, null);
        }
        $sql->bindValue(4, $this->id_empresa, PDO::PARAM_INT);
        $sql->bindValue(5, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            $this->nome_empresa = $nome;
            $this->telefone_empresa = (trim($telefone) != '') ? $telefone : null;
            $this->endereco_empresa = (trim($endereco) != '') ? $endereco : null;
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * Realiza a exclusão da empresa
     * 
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function excluirEmpresa(): int
    {
        $query = "DELETE FROM empresa WHERE (id_empresa = ? AND id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $this->id_empresa, PDO::PARAM_INT);
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
     * Retorna o total de empresas cadastradas pelo usuário
     *
     * @param string $search Termo pesquisado
     * @return integer Total de empresas
     */
    static public function totalEmpresas(string $search = null): int
    {
        $query = "SELECT COUNT(*) AS total 
                      FROM empresa WHERE id_usuario = ? ";
        if (!is_null($search)) {
            $query .= 'AND nome_empresa LIKE ?';
        }
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, Util::codigoLogado(), PDO::PARAM_INT);
        if (!is_null($search)) {
            $sql->bindValue(2, "%$search%");
        }
        $sql->execute();
        $total = $sql->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }
}
