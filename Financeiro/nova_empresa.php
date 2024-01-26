<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Empresa.php';
if (isset($_POST['btn'])) {
    $ret = Empresa::cadastrarEmpresa($_POST['nome'], $_POST['telefone'], $_POST['endereco']);
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
                        <h2>Nova Empresa</h2>
                        <h5>Aqui você poderá cadastrar todas as suas empresas!</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <?php
                include_once '_msg.php';
                ?>
                <hr />
                <form action="nova_empresa.php" method="post">
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
                    <button onclick="return ValidarCampos('empresa')" type="submit" name="btn" class="btn btn-success">Adicionar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>