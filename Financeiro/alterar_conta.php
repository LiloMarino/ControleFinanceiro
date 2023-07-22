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
                <hr />
                <div class="form-group">
                    <strong>Nome Atual do Banco</strong>
                    <h5>(Nome)</h5>
                </div>
                <div class="form-group">
                    <label>Novo Nome do Banco</label>
                    <input class="form-control" placeholder="Digite o nome do banco. Exemplo: NuBank">
                </div>
                <div class="form-group">
                    <strong>Agência Atual</strong>
                    <h5>(Agência)</h5>
                </div>
                <div class="form-group">
                    <label>Nova Agência</label>
                    <input class="form-control" placeholder="Digite a agência.">
                </div>
                <div class="form-group">
                    <strong>Número da conta Atual</strong>
                    <h5>(Número)</h5>
                </div>
                <div class="form-group">
                    <label>Novo Número da conta</label>
                    <input class="form-control" placeholder="Digite o número da conta.">
                </div>
                <div class="form-group">
                    <strong>Saldo Atual</strong>
                    <h5>(Saldo)</h5>
                </div>
                <div class="form-group">
                    <label>Novo Saldo</label>
                    <input class="form-control" placeholder="Digite o saldo da conta.">
                </div>
                <button type="submit" class="btn btn-warning">Alterar</button>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>