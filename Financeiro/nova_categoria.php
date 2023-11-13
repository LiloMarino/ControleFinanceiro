<?php
require_once '../DAO/Categoria.php';
if (isset($_POST['btn'])) {
    $ret = (new Categoria)->cadastrarCategoria($_POST['nome']);
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
                        <h2>Nova Categoria</h2>
                        <h5>Aqui você poderá cadastrar todas as suas categorias!</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <?php
                include_once '_msg.php';
                ?>
                <form action="nova_categoria.php"  method="post">
                    <div class="form-group">
                        <label>Nome da Categoria</label>
                        <input name="nome" class="form-control" placeholder="Digite o nome da categoria. Exemplo: Luz">
                    </div>
                    <button name="btn" type="submit" class="btn btn-success">Adicionar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>