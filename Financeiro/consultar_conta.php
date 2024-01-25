<?php
require_once '../DAO/Conta.php';
if (isset($_POST['id'])) {
    $conta = Conta::consultarConta($_POST['id']);
    $ret = $conta->excluirConta();
}
$contas = Conta::consultarConta();
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
                        <h2>Consultar Contas</h2>
                        <h5>Aqui você pode consultar suas contas</h5>

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
                                Contas Cadastradas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Banco</th>
                                                <th>Agência</th>
                                                <th>Número da conta</th>
                                                <th>Saldo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($contas as $conta) : ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $conta->banco_conta ?></td>
                                                    <td><?= $conta->agencia_conta ?></td>
                                                    <td><?= $conta->numero_conta ?></td>
                                                    <td>R$ <?= $conta->saldo_conta ?></td>
                                                    <td>
                                                        <form action="consultar_conta.php" method="post">
                                                            <a href="alterar_conta.php?id=<?= $conta->id_conta ?>" class="btn btn-warning btn-sm">Alterar</a>
                                                            
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?= $conta->id_conta ?>">Excluir</button>
                                                            <div class="modal fade" id="myModal<?= $conta->id_conta ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Excluir <?= $conta->banco_conta ?></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Você confirma excluir?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" name="id" value="<?= $conta->id_conta ?>" class="btn btn-danger">Excluir</button>
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