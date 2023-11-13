<?php

require_once '../DAO/Conta.php';
if (isset($_POST['btn']))
{
    $ret = (new Conta)->cadastrarConta($_POST['nome'],$_POST['agencia'],$_POST['nconta'],$_POST['saldo']);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">

        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Nova Conta</h2>
                        <h5>Aqui você poderá cadastrar todas as suas contas!</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <?php
                include_once '_msg.php';
                ?>
                <form action="nova_conta.php" method="post">
                    <div class="form-group">
                        <label>Nome do Banco</label>
                        <input class="form-control" name="nome" placeholder="Digite o nome do banco. Exemplo: NuBank">
                    </div>
                    <div class="form-group">
                        <label>Agência</label>
                        <input class="form-control" name="agencia" placeholder="Digite a agência.">
                    </div>
                    <div class="form-group">
                        <label>Número da Conta</label>
                        <input class="form-control" name="nconta" placeholder="Digite o número da conta.">
                    </div>
                    <div class="form-group">
                        <label>Saldo</label>
                        <input class="form-control" name="saldo" placeholder="Digite o saldo da conta.">
                    </div>
                    <button type="submit" name="btn" class="btn btn-success">Adicionar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>