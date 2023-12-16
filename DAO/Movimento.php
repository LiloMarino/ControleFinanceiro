<?php
require_once 'Util.php';
require_once 'Conexao.php';
/**
 * Movimento no sistema financeiro
 */
class Movimento
{
    /**
     * Id do movimento
     * @var integer
     */
    public int $id_movimento;
    /**
     * Tipo do movimento (Entrada/Saída)
     * @var int 
     */
    public int $tipo_movimento;
    /**
     * Data do movimento
     * @var string 
     */
    public string $data_movimento;
    /**
     * Valor do movimento
     * @var string 
     */
    public float $valor_movimento;
    /**
     * Observação do movimento
     * @var string 
     */
    public string $obs_movimento;
    /**
     * Id da empresa do movimento
     * @var int 
     */
    public int $id_empresa;
    /**
     * Id da conta bancária do movimento
     * @var int 
     */
    public int $id_conta;
    /**
     * Id da categoria do movimento
     * @var int 
     */
    public int $id_categoria;

    /**
     * Realiza o movimento inserindo-o no banco de dados
     * 
     * @param string $tipo Tipo do movimento
     * @param string $data Data do movimento
     * @param string $valor Valor do movimento
     * @param string $observacao Observação do movimento
     * @param string $idCategoria Id da Categoria
     * @param string $idConta Id da Conta
     * @param string $idEmpresa Id da Empresa
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    static public function realizarMovimento(string $tipo, string $data, string $valor, string $observacao, string $idCategoria, string $idConta, string $idEmpresa): int
    {
        if (Util::isEmpty($tipo, $valor, $data, $idCategoria, $idConta, $idEmpresa)) {
            return 0;
        }
        $query = "INSERT INTO movimento (tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $tipo, PDO::PARAM_INT);
        $sql->bindValue(2, $data, PDO::PARAM_STR);
        $sql->bindValue(3, $valor, PDO::PARAM_STR);
        if (trim($observacao) != '') {
            $sql->bindValue(4, $observacao, PDO::PARAM_STR);
        } else {
            $sql->bindValue(4, null, PDO::PARAM_STR);
        }
        $sql->bindValue(5, $idEmpresa, PDO::PARAM_INT);
        $sql->bindValue(6, $idConta, PDO::PARAM_INT);
        $sql->bindValue(7, $idCategoria, PDO::PARAM_INT);
        $sql->bindValue(8, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * Consulta um único movimento no banco de dados dado um determinado id
     *
     * @param integer $id Id do movimento
     * @return Movimento Retorna Movimento
     */
    static public function consultarMovimento(int $id): Movimento
    {
        // Busca no banco o objeto especificado e faz as atribuições
        $query = "SELECT id_movimento, tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria FROM movimento WHERE (id_movimento = ? AND id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $id, PDO::PARAM_INT);
        $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Movimento');
        $sql->execute();
        return $sql->fetch();
    }

    /**
     * Consulta os movimentos presentes no banco em um dado intervalo de tempo
     * 
     * @param int $tipo Tipo do movimento
     * @param string $dataInicial Data inicial
     * @param string $dataFinal Data final
     * @return array Retorna Movimentos[] 
     */
    static public function consultarMovimentos(int $tipo, string $dataInicial, string $dataFinal): array
    {
        $query = "SELECT id_movimento, tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria FROM movimento WHERE (id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, Util::codigoLogado(), PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_CLASS, 'Movimento');
    }

    /**
     * Atualiza as informações do movimento
     * 
     * @param string $tipo Tipo do movimento
     * @param string $data Data do movimento
     * @param string $valor Valor do movimento
     * @param string $observacao Observação do movimento
     * @param string $idCategoria Id da Categoria
     * @param string $idConta Id da Conta
     * @param string $idEmpresa Id da Empresa
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarMovimento(string $tipo, string $data, string $valor, string $observacao, string $idCategoria, string $idConta, string $idEmpresa): int
    {
        if (Util::isEmpty($tipo, $valor, $data, $idCategoria, $idConta, $idEmpresa)) {
            return 0;
        }
        $query = "UPDATE empresa SET tipo_movimento = ?, data_movimento = ?, valor_movimento = ?, obs_movimento = ?, id_empresa = ?, id_conta = ?, id_categoria = ?  WHERE (id_movimento = ? AND id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $tipo, PDO::PARAM_INT);
        $sql->bindValue(2, $data, PDO::PARAM_STR);
        $sql->bindValue(3, $valor, PDO::PARAM_STR);
        if (trim($observacao) != '') {
            $sql->bindValue(4, $observacao, PDO::PARAM_STR);
        } else {
            $sql->bindValue(4, null, PDO::PARAM_STR);
        }
        $sql->bindValue(5, $idEmpresa, PDO::PARAM_INT);
        $sql->bindValue(6, $idConta, PDO::PARAM_INT);
        $sql->bindValue(7, $idCategoria, PDO::PARAM_INT);
        $sql->bindValue(8, $this->id_movimento, PDO::PARAM_INT);
        $sql->bindValue(9, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            $this->tipo_movimento = $tipo;
            $this->data_movimento = $data;
            $this->valor_movimento = $valor; 
            $this->obs_movimento = (trim($observacao) != '') ? $observacao : null;
            $this->id_categoria = $idCategoria;
            $this->id_conta = $idConta;
            $this->id_empresa = $idEmpresa;
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * Realiza a exclusão do movimento
     * 
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function excluirMovimento(): int
    {
        $query = "DELETE FROM movimento WHERE (id_movimento = ? AND id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $this->id_movimento, PDO::PARAM_INT);
        $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }
}
