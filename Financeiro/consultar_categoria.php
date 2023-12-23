<?php
require_once '../DAO/Categoria.php';
if (isset($_POST['id'])) {
    $categoria = Categoria::consultarCategoria($_POST['id']);
    $ret = $categoria->excluirCategoria();
}
$categorias = Categoria::consultarCategoria();
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
                        <h2>Consultar Categoria</h2>
                        <h5>Aqui você pode consultar suas categorias</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <?php
                include_once '_msg.php';
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Categorias Cadastradas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da Categoria</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($categorias as $categoria) : ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $categoria->nome_categoria ?></td>
                                                    <td>
                                                        <form action="consultar_categoria.php" method="post">
                                                            <a href="alterar_categoria.php?id=<?= $categoria->id_categoria ?>" class="btn btn-warning btn-sm">Alterar</a>
                                                            <button type="submit" name="id" value="<?= $categoria->id_categoria ?>" class="btn btn-danger btn-sm">Excluir</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->


</body>

</html>