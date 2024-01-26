<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Empresa.php';
$id = isset($_POST['id']) ? $_POST['id'] : null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else if ($id === null) {
    header('location: consultar_empresa.php');
    exit;
}
$empresa = Empresa::consultarEmpresa($id);
if ($empresa === false) {
    header('location: consultar_empresa.php');
    exit;
}
if (isset($_POST['btn'])) {
    $ret = $empresa->atualizarEmpresa($_POST['nome'], $_POST['telefone'], $_POST['endereco']);
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
                        <h2>Alterar Empresa</h2>
                        <h5>Aqui você poderá alterar sua empresa!</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <?php
                include_once '_msg.php';
                ?>
                <hr />
                <form action="alterar_empresa.php" method="post">
                    <div class="form-group" id="divEmpresa">
                        <label>Nome da Empresa</label><span class="red-text">*</span>
                        <input id="empresa" onblur="isCampoPreenchido(empresa,divEmpresa,false)" class="form-control"
                            name="nome" value="<?= $empresa->nome_empresa ?>" placeholder="Digite o nome da empresa. Exemplo: Burger King">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" name="telefone" value="<?= $empresa->telefone_empresa ?>" 
                            placeholder="Digite o telefone da empresa. (Opcional)">
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" name="endereco" value="<?= $empresa->endereco_empresa ?>"
                            placeholder="Digite o endereço da empresa. (Opcional)">
                    </div>
                    <input hidden name="id" value="<?= $empresa->id_empresa ?>">
                    <button onclick="return ValidarCampos('empresa')" type="submit" name="btn" class="btn btn-warning">Alterar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>