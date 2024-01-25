<?php
require_once '../DAO/Categoria.php';
$id = isset($_POST['id']) ? $_POST['id'] : null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else if ($id === null) {
    header('location: consultar_categoria.php');
    exit;
}
$categoria = Categoria::consultarCategoria($id);
if ($categoria === false) {
    header('location: consultar_categoria.php');
    exit;
}
if (isset($_POST['btn'])) {
    $ret = $categoria->atualizarCategoria($_POST['nome']);
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
                        <h2>Alterar Categoria</h2>
                        <h5>Aqui você poderá alterar sua categoria!</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <?php
                include_once '_msg.php';
                ?>
                <hr />
                <form action="alterar_categoria.php" method="post">
                    <div class="form-group" id="divCategoria">
                        <label for="categoria">Nome da Categoria</label><span class="red-text">*</span>
                        <input id="categoria" onblur="isCampoPreenchido(categoria,divCategoria,false)" name="nome" value="<?= $categoria->nome_categoria ?>" class="form-control" placeholder="Digite o nome da categoria. Exemplo: Luz">
                    </div>
                    <input hidden name="id" value="<?= $categoria->id_categoria ?>">
                    <button onclick="return ValidarCampos('categoria')" name="btn" type="submit" class="btn btn-warning">Alterar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>