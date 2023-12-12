<?php
require_once 'Util.php';
/**
 * Movimento no sistema financeiro
 */
class Movimento
{
    /**
     * Tipo do movimento (Entrada/Saída)
     * @var int 
     */
    public int $tipo;
    /**
     * Id da categoria do movimento
     * @var int 
     */
    public int $idCategoria;
    /**
     * Data do movimento
     * @var string 
     */
    public string $data;
    /**
     * Id da empresa do movimento
     * @var int 
     */
    public int $idEmpresa;
    /**
     * Valor do movimento
     * @var string 
     */
    public float $valor;
    /**
     * Id da conta bancária do movimento
     * @var int 
     */
    public int $idConta;
    /**
     * Observação do movimento
     * @var string 
     */
    public string $observacao;

    /**
     * @param int $id Id do movimento no banco de dados, caso não passe nada como parâmetro é atribuído null
     */
    public function __construct(int $id = null)
    {
        if ($id != null) {
            // Busca no banco e faz as atribuições
        }
        // Caso contrário interpreta-se que é um objeto que ainda não possui um id no banco
    }

    /**
     * Realiza o movimento inserindo-o no banco de dados
     * @param string $tipo Tipo do movimento
     * @param string $idCategoria Id da Categoria
     * @param string $data Data do movimento
     * @param string $idEmpresa Id da Empresa
     * @param string $valor Valor do movimento
     * @param string $idConta Id da conta
     * @param string $observacao Observação do movimento
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function realizarMovimento(string $tipo, string $idCategoria, string $data, string $idEmpresa, string $valor, string $idConta, string $observacao) : int
    {
        if(Util::isEmpty($tipo, $idCategoria, $data, $idEmpresa, $valor, $idConta))
        {
            return 0;
        }
        return 1;
    }

    /**
     * Consulta os movimentos presentes no banco em um dado intervalo de tempo
     * @param int $tipo Tipo do movimento
     * @param string $dataInicial Data inicial
     * @param string $dataFinal Data final
     * @return array Retorna um array de Movimentos[] 
     */
    static public function consultarMovimento(int $tipo, string $dataInicial, string $dataFinal): array
    {
        return [];
    }

    /**
     * Atualiza as informações do movimento
     * @param int $tipo Tipo do movimento
     * @param int $idCategoria Id da Categoria
     * @param string $data Data do movimento
     * @param int $idEmpresa Id da Empresa
     * @param string $valor Valor do movimento
     * @param int $idConta Id da conta
     * @param string $observacao Observação do movimento
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarMovimento(int $tipo, int $idCategoria, string $data, int $idEmpresa, string $valor, int $idConta, string $observacao = ''): int
    {
        if (trim($valor) == '') {
            return 0;
        }
        return 1;
    }

    /**
     * Realiza a exclusão do movimento
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function excluirMovimento() : int
    {
        return 1;
    }
}
