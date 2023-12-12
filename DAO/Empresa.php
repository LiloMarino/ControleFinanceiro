<?php
require_once 'Util.php';
/**
 * Empresa presente no movimento do sistema financeiro
 */
class Empresa
{
    /**
     * Nome da empresa
     * @var string 
     */
    public string $nome;
    /**
     * Telefone da empresa
     * @var string
     */
    public string $telefone;
    /**
     * Endereço da empresa
     * @var string
     */
    public string $endereco;

    /**
     * @param int $id Id da empresa no banco de dados, caso não passe nada como parâmetro é atribuído null
     */
    public function __construct(int $id = null)
    {
        if ($id != null) {
            // Busca no banco e faz as atribuições
        }
        // Caso contrário interpreta-se que é um objeto que ainda não possui um id no banco
    }

    /**
     * Cadastra a empresa no sistema
     * @param string $nome Nome da empresa
     * @param string $telefone Telefone da empresa
     * @param string $endereco Endereço da empresa
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function cadastrarEmpresa(string $nome, string $telefone, string $endereco) : int
    {
        if(Util::isEmpty($nome))
        {
            return 0;
        }
        return 1;
    }

    /**
     * Realiza a consulta de todas as empresas cadastradas
     * @return array Retorna o array de Empresas[] 
     */
    static public function consultarEmpresa() : array
    {
        return [];
    }

    /**
     * Atualiza as informações da empresa
     * @param string $nome Nome da empresa
     * @param string $telefone Telefone da empresa
     * @param string $endereco Endereço da empresa
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarEmpresa(string $nome, string $telefone, string $endereco) : int
    {
        if(Util::isEmpty($nome))
        {
            return 0;
        }
        return 1;
    }

    /**
     * Realiza a exclusão da empresa
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function excluirEmpresa() : int
    {
        return 1;
    }   
}
