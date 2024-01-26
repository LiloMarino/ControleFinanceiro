<?php
require_once 'Util.php';
require_once 'Conexao.php';
require_once 'Conta.php';
require_once 'Empresa.php';
require_once 'Categoria.php';
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
    public ?string $obs_movimento;
    /**
     * Empresa do movimento
     * @var Empresa 
     */
    public Empresa $empresa;
    /**
     * Conta bancária do movimento
     * @var Conta 
     */
    public Conta $conta;
    /**
     * Categoria do movimento
     * @var Categoria 
     */
    public Categoria $categoria;


    public function __construct(
        int $id_movimento,
        int $tipo_movimento,
        string $data_movimento,
        float $valor_movimento,
        string $obs_movimento = null,
        Empresa $empresa,
        Conta $conta,
        Categoria $categoria
    ) {
        $this->id_movimento = $id_movimento;
        $this->tipo_movimento = $tipo_movimento;
        $this->data_movimento = $data_movimento;
        $this->valor_movimento = $valor_movimento;
        $this->obs_movimento = $obs_movimento;
        $this->empresa = $empresa;
        $this->conta = $conta;
        $this->categoria = $categoria;
    }


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
        $conn = Conexao::getConexao();
        $query = "INSERT INTO movimento (tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $sql = $conn->prepare($query);
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
        $conn->beginTransaction();
        try {
            $sql->execute();
            $query = "UPDATE conta SET saldo_conta = saldo_conta + ? WHERE id_conta = ?";
            $sql = $conn->prepare($query);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $idConta);
            $sql->execute();
            $conn->commit();
            return 1;
        } catch (Exception $e) {
            $conn->rollBack();
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
        $query = "SELECT id_movimento, tipo_movimento, data_movimento, valor_movimento, obs_movimento, m.id_conta, em.nome_empresa, co.banco_conta, ca.nome_categoria FROM movimento as m
        INNER JOIN empresa AS em ON m.id_empresa = em.id_empresa 
        INNER JOIN conta AS co  ON  m.id_conta = co.id_conta 
        INNER JOIN categoria AS ca ON m.id_categoria = ca.id_categoria WHERE (id_movimento = ? AND m.id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $id, PDO::PARAM_INT);
        $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
        $sql->execute();
        $linha = $sql->fetch(PDO::FETCH_ASSOC);
        $empresa = new Empresa();
        $empresa->nome_empresa = $linha["nome_empresa"];
        $conta = new Conta();
        $conta->banco_conta = $linha["banco_conta"];
        $conta->id_conta = $linha["id_conta"];
        $categoria = new Categoria();
        $categoria->nome_categoria = $linha["nome_categoria"];
        $movimento = new Movimento($linha['id_movimento'], $linha['tipo_movimento'], $linha['data_movimento'], $linha['valor_movimento'], $linha['obs_movimento'], $empresa, $conta, $categoria);
        return $movimento;
    }

    /**
     * Consulta os movimentos presentes no banco em um dado intervalo de tempo
     * 
     * @param int $tipo Tipo do movimento
     * @param string $dataInicial Data inicial
     * @param string $dataFinal Data final
     * @return Movimento[] Retorna Movimentos[] 
     */
    static public function consultarMovimentos(int $tipo, string $dataInicial, string $dataFinal): array
    {
            $query = "SELECT id_movimento, tipo_movimento, data_movimento, valor_movimento, obs_movimento, em.nome_empresa, co.banco_conta, ca.nome_categoria FROM movimento as m
            INNER JOIN empresa AS em ON m.id_empresa = em.id_empresa 
            INNER JOIN conta AS co  ON  m.id_conta = co.id_conta 
            INNER JOIN categoria AS ca ON m.id_categoria = ca.id_categoria WHERE (data_movimento BETWEEN ? AND ?) AND m.id_usuario = ? ";
        if ($tipo != 0) {
            $query .= "AND tipo_movimento = ?";
        }
        $sql = Conexao::getConexao()->prepare($query);
        if ($tipo != 0) {
            $sql->bindValue(1, $tipo, PDO::PARAM_INT);
            $sql->bindValue(2, $dataInicial, PDO::PARAM_STR);
            $sql->bindValue(3, $dataFinal, PDO::PARAM_STR);
            $sql->bindValue(4, Util::codigoLogado(), PDO::PARAM_INT);
        } else {
            $sql->bindValue(1, $dataInicial, PDO::PARAM_STR);
            $sql->bindValue(2, $dataFinal, PDO::PARAM_STR);
            $sql->bindValue(3, Util::codigoLogado(), PDO::PARAM_INT);
        }
        $sql->execute();
        $movimentos = [];
        while (($linha = $sql->fetch(PDO::FETCH_ASSOC)) !== false) {
            $empresa = new Empresa();
            $empresa->nome_empresa = $linha["nome_empresa"];
            $conta = new Conta();
            $conta->banco_conta = $linha["banco_conta"];
            $categoria = new Categoria();
            $categoria->nome_categoria = $linha["nome_categoria"];
            $movimento = new Movimento($linha['id_movimento'], $linha['tipo_movimento'], $linha['data_movimento'], $linha['valor_movimento'], $linha['obs_movimento'], $empresa, $conta, $categoria);
            $movimentos[] = $movimento;
        }
        return $movimentos;
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
        $conn = Conexao::getConexao();
        $sql = $conn->prepare($query);
        $sql->bindValue(1, $this->id_movimento, PDO::PARAM_INT);
        $sql->bindValue(2, Util::codigoLogado(), PDO::PARAM_INT);
        $conn->beginTransaction();
        try {
            $sql->execute();
            $query = "UPDATE conta SET saldo_conta = saldo_conta - ? WHERE id_conta = ?";
            $sql = $conn->prepare($query);
            $sql->bindValue(1, $this->valor_movimento);
            $sql->bindValue(2, $this->conta->id_conta);
            $sql->execute();
            $conn->commit();
            return 1;
        } catch (Exception $e) {
            $conn->rollBack();
            echo $e->getMessage();
            return -1;
        }
    }

    static public function totalEntrada()
    {
        $conn = Conexao::getConexao();
        $query = "SELECT SUM(valor_movimento) AS total FROM movimento 
                  WHERE tipo_movimento = 1 AND id_usuario = ?"
    }
}
