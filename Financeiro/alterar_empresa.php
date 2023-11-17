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
                <form action="">
                <div class="form-group" id="divEmpresa">
                        <label>Nome da Empresa</label><span class="red-text">*</span>
                        <input id="empresa" onblur="isCampoPreenchido(empresa,divEmpresa,false)" class="form-control" name="nome"
                            placeholder="Digite o nome da empresa. Exemplo: Burger King">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" name="telefone"
                            placeholder="Digite o telefone da empresa. (Opcional)">
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" name="endereco"
                            placeholder="Digite o endereço da empresa. (Opcional)">
                    </div>
                    <button onclick="return ValidarCampos('empresa')" type="submit" class="btn btn-warning">Alterar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>