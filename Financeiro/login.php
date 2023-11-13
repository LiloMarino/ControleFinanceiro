<?php
require_once '../DAO/Usuario.php';
if(isset($_POST['btn']))
{
    $ret = (new Usuario)->fazerLogin($_POST['email'],$_POST['senha']);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php';?>
                <h2> Controle Financeiro : Login</h2>

                <h5>( Faça seu login )</h5>
                <br />
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Entre com seus dados </strong>
                    </div>
                    <div class="panel-body">
                        <form action="login.php" method="post" role="form">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input name="email" type="text" class="form-control" placeholder="Seu e-mail" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input name="senha" type="password" class="form-control" placeholder="Sua senha" />
                            </div>

                            <button name="btn" href="meus_dados.php" class="btn btn-primary ">Login</button>
                            <hr />
                            Não possui conta? <a href="cadastro.php"> Clique aqui </a>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>


</body>

</html>