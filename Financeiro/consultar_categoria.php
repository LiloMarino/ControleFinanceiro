<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Categoria.php';
if (isset($_POST['id'])) {
    $categoria = Categoria::consultarCategoria($_POST['id']);
    $ret = $categoria->excluirCategoria();
}
$paginaAtual = filter_input(
    INPUT_GET,
    'page',
    FILTER_VALIDATE_INT,
    ['options' => ['default' => 1, 'min_range' => 1]]
);
$itensPagina = filter_input(
    INPUT_GET,
    'itensPagina',
    FILTER_VALIDATE_INT,
    ['options' => ['default' => 10, 'min_range' => 1, 'max_range' => 15]]
);
$termoPesquisado = (isset($_GET['search']) && trim($_GET['search']) != '') ? $_GET['search'] : null;
$intervalo = Util::determinaLimit($paginaAtual, $itensPagina);
$totalCategorias = Categoria::totalCategorias($termoPesquisado);
$categorias = Categoria::consultarCategoria(search: $termoPesquisado, limit: $intervalo);
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
                <?php include_once '_msg.php'; ?>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Consultar Categoria</h2>
                        <h5>Aqui você pode consultar suas categorias</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Categorias Cadastradas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <div class="row">
                                            <form action="consultar_categoria.php" method="get">
                                                <div class="col-sm-6">
                                                    <div class="dataTables_length">
                                                        <label>
                                                            <select name="itensPagina" class="form-control input-sm">
                                                                <option value="10" <?= (isset($_GET['itensPagina']) && $_GET['itensPagina'] == 10) ? 'selected' : ''; ?>>10</option>
                                                                <option value="15" <?= (isset($_GET['itensPagina']) && $_GET['itensPagina'] == 15) ? 'selected' : ''; ?>>15</option>
                                                            </select> registros por página
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div id="dataTables-example_filter" class="dataTables_filter">
                                                        <label>
                                                            <input type="search" name="search" class="form-control input-sm" value="<?= isset($_POST['search']) ? $_POST['search'] : ''  ?>">
                                                            <button class="btn btn-info btn-sm">Pesquisar</button>
                                                        </label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover dataTable no-footer">
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
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExcluir<?= $categoria->id_categoria ?>">Excluir</button>
                                                                <div class="modal fade" id="modalExcluir<?= $categoria->id_categoria ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Deseja excluir a categoria</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <strong>Nome da Categoria:</strong> <?= $categoria->nome_categoria ?><br>
                                                                                Você confirma excluir?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                <button type="submit" name="id" value="<?= $categoria->id_categoria ?>" class="btn btn-danger">Excluir</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <?php Util::criaPaginacao("consultar_categoria.php", $paginaAtual, $itensPagina, $totalCategorias); ?>
                                        </div>
                                    </div>
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