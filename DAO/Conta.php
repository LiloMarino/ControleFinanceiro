<?php
require_once 'Util.php';
require_once 'Conexao.php';
/**
 * Conta bancária do usuário do sistema financeiro
 */
class Conta
{
    /**
     * Id da conta
     * @var integer
     */
    public int $id_conta;

    /**
     * Nome do banco
     * @var string
     */
    public string $banco_conta;

    /**
     * Agencia bancária
     * @var string
     */
    public string $agencia_conta;

    /**
     * Número da conta bancária
     * @var string
     */
    public string $numero_conta;

    /**
     * Saldo da conta
     * @var string
     */
    public string $saldo_conta;

    /**
     * Cadastra a conta bancária no sistema
     * 
     * @param string $nomeDoBanco Nome do banco
     * @param string $agencia Agencia bancária
     * @param string $numeroDaConta Número da conta bancária
     * @param string $saldo Saldo da conta
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    static public function cadastrarConta(string $nomeDoBanco, string $agencia, string $numeroDaConta, string $saldo): int
    {
        if (Util::isEmpty($nomeDoBanco, $agencia, $numeroDaConta, $saldo)) {
            return 0;
        }

        $query = "INSERT INTO conta (banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario) VALUES (? , ? , ? , ?, ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $nomeDoBanco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numeroDaConta);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * Realiza a consulta das contas cadastradas
     *
     * @param integer|null $id Id da Conta
     * @param string|null $search Termo pesquisado
     * @param string|null $limit Limite de resultados por página
     * @return Conta|Conta[]|boolean Retorna Conta|Contas[] ou false caso erro
     */
    static public function consultarConta(int $id = null, string $search = null, string $limit = null): Conta|array|bool
    {
        if ($id !== null) {
            // Busca no banco o objeto especificado e faz as atribuições
            $query = "SELECT id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta 
                        FROM conta WHERE (id_conta = ? AND id_usuario = ?)";
            $sql = Conexao::getConexao()->prepare($query);
            $sql->bindValue(1, $id, PDO::PARAM_INT);
            $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
            $sql->setFetchMode(PDO::FETCH_CLASS, 'Conta');
            $sql->execute();
            return $sql->fetch();
        } else {
            // Busca todos os elementos e retorna o array
            $query = "SELECT id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta 
                        FROM conta WHERE (id_usuario = ?)";
            if (!is_null($search)) {
                // Busca conforme o search e retorna o array respectivo à busca  
                $query .= 'AND banco_conta LIKE ?';
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
            return $sql->fetchAll(PDO::FETCH_CLASS, 'Conta');
        }
    }

    /**
     * Atualiza as informações da conta bancária
     * 
     * @param string $nomeDoBanco Nome do banco
     * @param string $agencia Agencia bancária
     * @param string $numeroDaConta Número da conta bancária
     * @param string $saldo Saldo da conta
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarConta(string $nomeDoBanco, string $agencia, string $numeroDaConta, string $saldo): int
    {
        if (Util::isEmpty($nomeDoBanco, $agencia, $numeroDaConta, $saldo)) {
            return 0;
        }

        $query = "UPDATE conta SET banco_conta = ?, agencia_conta = ?, numero_conta = ?, saldo_conta = ? WHERE (id_conta = ? AND id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $nomeDoBanco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numeroDaConta);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, $this->id_conta, PDO::PARAM_INT);
        $sql->bindValue(6, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            $this->banco_conta = $nomeDoBanco;
            $this->agencia_conta = $agencia;
            $this->numero_conta = $numeroDaConta;
            $this->saldo_conta = $saldo;
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * Realiza a exclusão da conta bancária
     * 
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function excluirConta(): int
    {
        $query = "DELETE FROM conta WHERE (id_conta = ? AND id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $this->id_conta, PDO::PARAM_INT);
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
     * Retorna o total de contas cadastradas pelo usuário
     *
     * @param string $search Termo pesquisado
     * @return integer Total de contas
     */
    static public function totalContas(string $search = null): int
    {
        $query = "SELECT COUNT(*) AS total 
                      FROM conta WHERE id_usuario = ? ";
        if (!is_null($search)) {
            $query .= 'AND banco_conta LIKE ?';
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
