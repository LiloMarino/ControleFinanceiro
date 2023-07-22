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
                        <h2>Alterar Empresa</h2>
                        <h5>Aqui você poderá alterar sua empresa!</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="form-group">
                    <label>Nome Atual da Empresa</label>
                    <h5>(Nome)</h5>
                </div>
                <div class="form-group">
                    <label>Novo Nome da Empresa</label>
                    <input class="form-control" placeholder="Digite o nome da empresa. Exemplo: Burger King">
                </div>
                <div class="form-group">
                    <label>Telefone Atual da Empresa</label>
                    <h5>(Telefone)</h5>
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input class="form-control" placeholder="Digite o telefone da empresa. (Opcional)">
                </div>
                <div class="form-group">
                    <label>Endereço Atual da Empresa</label>
                    <h5>(Endereço)</h5>
                </div>
                <div class="form-group">
                    <label>Endereço</label>
                    <input class="form-control" placeholder="Digite o endereço da empresa. (Opcional)">
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