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
                        <form role="form">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control" placeholder="Seu e-mail" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" placeholder="Sua senha" />
                            </div>

                            <a href="meus_dados.php" class="btn btn-primary ">Login</a>
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