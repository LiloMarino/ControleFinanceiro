<?php
require_once '../DAO/Usuario.php';
if(isset($_POST['btn']))
{
    $ret = (new Usuario)->cadastrarUsuario($_POST['nome'],$_POST['email'],$_POST['senha'],$_POST['rsenha']);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php'; ?>
                <h2> Controle Financeiro : Cadastro</h2>

                <h5>( Faça seu cadastro )</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencher todos os campos </strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="cadastro.php" method="post">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input name="nome" type="text" class="form-control" placeholder="Seu Nome" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input name="email" type="text" class="form-control" placeholder="Seu e-mail" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input name="senha" type="password" class="form-control" placeholder="Crie uma senha (mínimo 6 caracteres)" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input name="rsenha" type="password" class="form-control" placeholder="Repita a senha criada" />
                            </div>
                            <button type="submit" name="btn" class="btn btn-success">Finalizar cadastro</button>
                            <hr />
                            Já possui um cadastro? <a href="login.php">Clique aqui</a>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>

</body>

</html>