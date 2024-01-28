<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Conta.php';
$id = isset($_POST['id']) ? $_POST['id'] : null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else if ($id === null) {
    header('location: consultar_conta.php');
    exit;
}
$conta = Conta::consultarConta($id);
if ($conta === false) {
    header('location: consultar_conta.php');
    exit;
}
if (isset($_POST['btn'])) {
    $ret = $conta->atualizarConta($_POST['nome'], $_POST['agencia'], $_POST['nconta'], $_POST['saldo']);
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
                        <h2>Alterar Conta</h2>
                        <h5>Aqui você poderá alterar sua conta!</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <?php
                include_once '_msg.php';
                ?>
                <hr />
                <form action="alterar_conta.php" method="post">
                    <div id="divNome" class="form-group">
                        <label for="nome">Nome do Banco</label><span class="red-text">*</span>
                        <input id="nome" onblur="isCampoPreenchido(nome,divNome,false)" class="form-control" name="nome" value="<?= $conta->banco_conta ?>" placeholder="Digite o nome do banco. Exemplo: NuBank" maxlength="50" required>
                    </div>
                    <div id="divAgencia" class="form-group">
                        <label for="agencia">Agência</label><span class="red-text">*</span>
                        <input id="agencia" onblur="isCampoPreenchido(agencia,divAgencia,false)" class="form-control" name="agencia" value="<?= $conta->agencia_conta ?>" placeholder="Digite a agência." maxlength="8" required>
                    </div>
                    <div id="divNconta" class="form-group">
                        <label for="nconta">Número da Conta</label><span class="red-text">*</span>
                        <input id="nconta" onblur="isCampoPreenchido(nconta,divNconta,false)" class="form-control" name="nconta" value="<?= $conta->numero_conta ?>" placeholder="Digite o número da conta." maxlength="12" required>
                    </div>
                    <div id="divSaldo" class="form-group">
                        <label for="saldo">Saldo</label><span class="red-text">*</span>
                        <input id="saldo" onblur="isCampoPreenchido(saldo,divSaldo,false)" class="form-control" name="saldo" value="<?= $conta->saldo_conta ?>" placeholder="Digite o saldo da conta." required>
                    </div>
                    <input hidden name="id" value="<?= $conta->id_conta ?>">
                    <button onclick="return ValidarCampos('nome','agencia','nconta','saldo')" type="submit" name="btn" class="btn btn-warning">Alterar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>