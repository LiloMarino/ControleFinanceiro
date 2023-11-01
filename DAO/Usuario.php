<?php
/**
 * Usuario do sistema financeiro
 */
class Usuario
{
    /**
     * Nome do usuário
     * @var string 
     */
    private string $nome;
    /**
     * Email do usuário
     * @var string 
     */
    private string $email;

    /**
     * @param int $id Id do usuário no banco de dados, caso não passe nada como parâmetro é atribuído null
     */
    public function __construct(int $id = null)
    {
        if ($id != null) {
            // Busca no banco e faz as atribuições
        }
        // Caso contrário interpreta-se que é um objeto que ainda não possui um id no banco
    }

    /**
     * Realiza o cadastro do usuário
     * @param string $nome Nome do usuário
     * @param string $email Email do usuário
     * @param string $senha Senha do usuário
     * @return void
     */
    public function cadastrarUsuario(string $nome, string $email, string $senha)
    {

    }

    /**
     * Realiza o login do usuário com base no banco de dados
     * @param string $email Email do usuário
     * @param string $senha Senha do usuário
     * @return void
     */
    public function logarUsuario(string $email, string $senha)
    {

    }

    /**
     * Atualiza os dados do usuário
     * @param string $nome Novo nome do usuário
     * @param string $email Novo email do usuário
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarDados(string $nome, string $email): int
    {
        if (trim($nome) == '' || trim($email) == '') {
            return 0;
        }
        return 1; // Para quando der certo
    }

    /**
     * Realiza a exclusão do usuário
     * @return void
     */
    public function excluirUsuario()
    {
    }

    /**
     * @return string Retorna o nome do usuário
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return string Retorna o email do usuário
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
