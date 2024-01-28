<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Movimento.php';
if (isset($_POST['id'])) {
    $movimento = Movimento::consultarMovimento($_POST['id']);
    $ret = $movimento->excluirMovimento();
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
$totalMovimentos = Movimento::totalMovimentos($termoPesquisado);
if (isset($_POST['btn'])) {
    $movimentos = Movimento::consultarMovimentos(
        $_POST['tipo'],
        $_POST['dataInicio'],
        $_POST['dataFinal'],
        $termoPesquisado,
        $intervalo
    );
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
                        <h2>Consultar Movimento</h2>
                        <h5>Aqui você pode consultar todos os seus movimentos em um determinado período</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <?php
                include_once '_msg.php';
                ?>
                <hr />
                <form action="consultar_movimento.php" method="post">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo do movimento</label>
                            <select name="tipo" class="form-control">
                                <option <?= (isset($_POST['tipo']) && $_POST['tipo'] == 0) ? 'selected' : ''; ?> value="0">Todos</option>
                                <option <?= (isset($_POST['tipo']) && $_POST['tipo'] == 1) ? 'selected' : ''; ?> value="1">Entrada</option>
                                <option <?= (isset($_POST['tipo']) && $_POST['tipo'] == 2) ? 'selected' : ''; ?> value="2">Saída</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="divDataInicial">
                            <label for="dataInicial">Data Inicial</label><span class="red-text">*</span>
                            <input id="dataInicial" type="date" onblur="isCampoPreenchido(dataInicial,divDataInicial,false)" class="form-control" name="dataInicio" value="<?= (isset($_POST['dataInicio'])) ? $_POST['dataInicio'] : ''; ?>" placeholder="Coloque a data do movimento">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="divDataFinal">
                            <label for="dataFinal">Data Final</label><span class="red-text">*</span>
                            <input id="dataFinal" type="date" onblur="isCampoPreenchido(dataFinal,divDataFinal,false)" name="dataFinal" value="<?= (isset($_POST['dataFinal'])) ? $_POST['dataFinal'] : ''; ?>" class="form-control" placeholder="Coloque a data do movimento">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button onclick="return ValidarCampos('dataInicial','dataFinal')" type="submit" name="btn" class="btn btn-info">Pesquisar</a>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Resultado Encontrado
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <div class="row">
                                            <form action="consultar_movimento.php" method="get">
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
                                                    <th>Data</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observações</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $total = 0; ?>
                                                <?php if (isset($_POST['btn'])) : ?>
                                                    <?php foreach ($movimentos as $movimento) : ?>
                                                        <tr class="odd gradeX">
                                                            <?php $total += $movimento->valor_movimento; ?>

                                                            <th><?= date('d/m/Y', strtotime($movimento->data_movimento)); ?></th>
                                                            <th><?= ($movimento->tipo_movimento == 1) ? 'Entrada' : 'Saída' ?></th>
                                                            <th><?= $movimento->categoria->nome_categoria ?></th>
                                                            <th><?= $movimento->empresa->nome_empresa ?></th>
                                                            <th><?= $movimento->conta->banco_conta ?></th>
                                                            <th>R$<?= number_format($movimento->valor_movimento, 2, ',', '.') ?></th>
                                                            <th><?= $movimento->obs_movimento ?></th>
                                                            <td>
                                                                <form action="consultar_movimento.php" method="get">
                                                                    <input type="hidden" name="tipo" value="<?= $_POST['tipo'] ?>">
                                                                    <input type="hidden" name="dataInicio" value="<?= $_POST['dataInicio'] ?>">
                                                                    <input type="hidden" name="dataFinal" value="<?= $_POST['dataFinal'] ?>">
                                                                    <input type="hidden" name="id" value="<?= $movimento->id_movimento ?>">
                                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?= $movimento->id_movimento ?>">Excluir</button>
                                                                    <div class="modal fade" id="myModal<?= $movimento->id_movimento ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                                                                    <h4 class="modal-title" id="myModalLabel">Deseja excluir o movimento</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <strong>Data do movimento:</strong> <?= date('d/m/Y', strtotime($movimento->data_movimento)); ?><br>
                                                                                    <strong>Tipo do movimento:</strong> <?= ($movimento->tipo_movimento == 1) ? 'Entrada' : 'Saída' ?><br>
                                                                                    <strong>Categoria:</strong> <?= $movimento->categoria->nome_categoria ?><br>
                                                                                    <strong>Empresa:</strong> <?= $movimento->empresa->nome_empresa ?><br>
                                                                                    <strong>Conta:</strong> <?= $movimento->conta->banco_conta ?><br>
                                                                                    <strong>Valor:</strong> R$ <?= number_format($movimento->valor_movimento, 2, ',', '.') ?><br>
                                                                                    Você confirma excluir?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                    <button type="submit" name="id" value="<?= $movimento->id_movimento ?>" class="btn btn-danger">Excluir</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <?php Util::criaPaginacao("consultar_movimento.php", $paginaAtual, $itensPagina, $totalMovimentos); ?>
                                        </div>
                                        <div class="text-center">
                                            <label style="color:<?= ($total < 0) ? "red" : "green" ?>;">TOTAL: R$<?= number_format($total, 2, ',', '.') ?></label>
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