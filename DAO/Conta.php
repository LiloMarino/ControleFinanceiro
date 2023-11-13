<?php
require_once 'Funcoes.php';
/**
 * Conta bancária do usuário do sistema financeiro
 */
class Conta
{
    /**
     * Nome do banco
     * @var string
     */
    public string $nomeDoBanco;
    /**
     * Agencia bancária
     * @var string
     */
    public string $agencia;
    /**
     * Número da conta bancária
     * @var string
     */
    public string $numeroDaConta;
    /**
     * Saldo da conta
     * @var string
     */
    public string $saldo;

    /**
     * @param int $id Id da conta no banco de dados, caso não passe nada como parâmetro é atribuído null
     */
    public function __construct(int $id = null)
    {
        if ($id != null) {
            // Busca no banco e faz as atribuições
        }
        // Caso contrário interpreta-se que é um objeto que ainda não possui um id no banco
    }

    /**
     * Cadastra a conta bancária no sistema
     * @param string $nomeDoBanco Nome do banco
     * @param string $agencia Agencia bancária
     * @param string $numeroDaConta Número da conta bancária
     * @param string $saldo Saldo da conta
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function cadastrarConta(string $nomeDoBanco, string $agencia, string $numeroDaConta, string $saldo): int
    {
        if(isEmpty($nomeDoBanco, $agencia, $numeroDaConta, $saldo))
        {
            return 0;   
        }
        return 1;
    }

    /**
     * Realiza a consulta de todas as contas cadastradas
     * @return array Retorna o array de Contas[] 
     */
    static public function consultarConta(): array
    {
        return [];
    }

    /**
     * Atualiza as informações da conta bancária
     * @param string $nomeDoBanco Nome do banco
     * @param string $agencia Agencia bancária
     * @param string $numeroDaConta Número da conta bancária
     * @param string $saldo Saldo da conta
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarConta(string $nomeDoBanco, string $agencia, string $numeroDaConta, string $saldo): int
    {
        return 1;
    }

    /**
     * Realiza a exclusão da conta bancária
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function excluirConta(): int
    {
        return 1;
    }
}
