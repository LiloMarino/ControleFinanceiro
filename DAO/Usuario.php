<?php
require_once 'Util.php';
require_once 'Conexao.php';
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
            $query = "SELECT nome_usuario,email_usuario FROM usuario WHERE (id_usuario = ?)";
            $sql = Conexao::getConexao()->prepare($query);
            $sql->bindValue(1, $id, PDO::PARAM_INT);
            try {
                $sql->execute();
                $usuario = $sql->fetch(PDO::FETCH_ASSOC);
                $this->nome = $usuario['nome_usuario'];
                $this->email = $usuario['email_usuario'];
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        // Caso contrário interpreta-se que é um objeto que ainda não possui um id no banco
    }

    /**
     * Realiza o cadastro do usuário
     * @param string $nome Nome do usuário
     * @param string $email Email do usuário
     * @param string $senha Senha do usuário
     * @param string $rsenha Repetir senha do usuário
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function cadastrarUsuario(string $nome, string $email, string $senha, string $rsenha) : int
    {
        if (Util::isEmpty($nome,$email,$senha,$rsenha))
        {
            return 0;
        }
        if (strlen($senha) < 6)
        {
            return -2;
        }
        if($senha != $rsenha)
        {
            return -3;
        }
        return 1;
    }

    /**
     * Realiza o login do usuário com base no banco de dados
     * @param string $email Email do usuário
     * @param string $senha Senha do usuário
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function fazerLogin(string $email, string $senha) : int
    {
        if (Util::isEmpty($email,$senha))
        {
            return 0;
        }
        return 1;
    }

    /**
     * Atualiza os dados do usuário
     * @param string $nome Novo nome do usuário
     * @param string $email Novo email do usuário
     * @return int Retorna 1 em caso de sucesso, 0 em caso de campos inválidos e -1 em caso de erros
     */
    public function atualizarDados(string $nome, string $email): int
    {
        if (Util::isEmpty($nome,$email)) {
            return 0;
        }
        $query = "UPDATE usuario SET nome_usuario = ?, email_usuario = ? WHERE (id_usuario = ?)";
        $sql = Conexao::getConexao()->prepare($query);
        $sql->bindValue(1, $nome, PDO::PARAM_STR);
        $sql->bindValue(2, $email, PDO::PARAM_STR);
        $sql->bindValue(3, Util::codigoLogado(), PDO::PARAM_INT);
        try {
            $sql->execute();
            $this->nome = $nome;
            $this->email = $email;
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
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
