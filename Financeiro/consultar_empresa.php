<?php
require_once '../DAO/Empresa.php';
if (isset($_POST['id'])) {
    $empresa = Empresa::consultarEmpresa($_POST['id']);
    $ret = $empresa->excluirEmpresa();
}
$empresas = Empresa::consultarEmpresa();
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
                        <h2>Consultar Empresa</h2>
                        <h5>Aqui você pode consultar suas empresas</h5>

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
                                Empresas Cadastradas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da Empresa</th>
                                                <th>Telefone</th>
                                                <th>Endereço</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($empresas as $empresa) : ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $empresa->nome_empresa ?></td>
                                                    <td><?= $empresa->telefone_empresa ?></td>
                                                    <td><?= $empresa->endereco_empresa ?></td>
                                                    <td>
                                                        <form action="consultar_empresa.php" method="post">
                                                            <a href="alterar_empresa.php?id=<?= $empresa->id_empresa ?>" class="btn btn-warning btn-sm">Alterar</a>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?= $empresa->id_empresa ?>">Excluir</button>
                                                            <div class="modal fade" id="myModal<?= $empresa->id_empresa ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Excluir <?= $empresa->nome_empresa ?></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Você confirma excluir?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" name="id" value="<?= $empresa->id_empresa ?>" class="btn btn-danger">Excluir</button>
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