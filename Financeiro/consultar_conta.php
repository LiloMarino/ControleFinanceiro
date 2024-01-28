<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Conta.php';
if (isset($_POST['id'])) {
    $conta = Conta::consultarConta($_POST['id']);
    $ret = $conta->excluirConta();
}
$paginaAtual = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, 
['options' => ['default' => 1, 'min_range' => 1]]);
$itensPagina = filter_input(INPUT_GET, 'itensPagina', FILTER_VALIDATE_INT, 
['options' => ['default' => 10, 'min_range' => 1, 'max_range' => 15]]);
$termoPesquisado = (isset($_GET['search']) && trim($_GET['search']) != '') ? $_GET['search'] : null;
$intervalo = Util::determinaLimit($paginaAtual, $itensPagina);
$totalContas = Conta::totalContas($termoPesquisado);
$contas = Conta::consultarConta(search: $termoPesquisado, limit: $intervalo);
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
                <?php
                include_once '_msg.php';
                ?>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Contas Cadastradas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <div class="row">
                                            <form action="consultar_conta.php" method="get">
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
                                                    <th>Banco</th>
                                                    <th>Agência</th>
                                                    <th>Número da Conta</th>
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
                                                                                <h4 class="modal-title" id="myModalLabel">Deseja excluir a conta</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <strong>Banco:</strong> <?= $conta->banco_conta ?><br>
                                                                                <strong>Agência:</strong> <?= $conta->agencia_conta ?><br>
                                                                                <strong>Número da Conta:</strong> R$<?= $conta->numero_conta ?><br>
                                                                                <strong>Saldo:</strong> <?= $conta->saldo_conta ?><br>
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
                                        <div class="row">
                                            <?php Util::criaPaginacao("consultar_conta.php", $paginaAtual, $itensPagina, $totalContas); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->


</body>

</html>