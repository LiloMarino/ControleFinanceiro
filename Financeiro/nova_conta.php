<?php
require_once '../DAO/Conta.php';
if (isset($_POST['btn'])) {
    $ret = Conta::cadastrarConta($_POST['nome'], $_POST['agencia'], $_POST['nconta'], $_POST['saldo']);
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
                <?php
                include_once '_msg.php';
                ?>
                <hr />
                <form action="nova_conta.php" method="post">
                    <div id="divNome" class="form-group">
                        <label for="nome">Nome do Banco</label><span class="red-text">*</span>
                        <input id="nome" onblur="isCampoPreenchido(nome,divNome,false)" class="form-control" name="nome" placeholder="Digite o nome do banco. Exemplo: NuBank">
                    </div>
                    <div id="divAgencia" class="form-group">
                        <label for="agencia">Agência</label><span class="red-text">*</span>
                        <input id="agencia" onblur="isCampoPreenchido(agencia,divAgencia,false)" class="form-control" name="agencia" placeholder="Digite a agência.">
                    </div>
                    <div id="divNconta" class="form-group">
                        <label for="nconta">Número da Conta</label><span class="red-text">*</span>
                        <input id="nconta" onblur="isCampoPreenchido(nconta,divNconta,false)" class="form-control" name="nconta" placeholder="Digite o número da conta.">
                    </div>
                    <div id="divSaldo" class="form-group">
                        <label for="saldo">Saldo</label><span class="red-text">*</span>
                        <input id="saldo" onblur="isCampoPreenchido(saldo,divSaldo,false)" class="form-control" name="saldo" placeholder="Digite o saldo da conta.">
                    </div>
                    <button onclick="return ValidarCampos('nome','agencia','nconta','saldo')" type="submit" name="btn" class="btn btn-success">Adicionar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>