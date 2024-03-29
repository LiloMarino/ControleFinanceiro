<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Movimento.php';
if (isset($_GET['id'])) {
    $id = filter_input(
        INPUT_GET,
        'id',
        FILTER_VALIDATE_INT,
        ['options' => ['default' => 1, 'min_range' => 1]]
    );
    $movimento = Movimento::consultarMovimento($id);
    if ($movimento) {
        $ret = $movimento->excluirMovimento();
    }
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
$tipo = filter_input(
    INPUT_GET,
    'tipo',
    FILTER_VALIDATE_INT,
    ['options' => ['default' => 0, 'min_range' => 0, 'max_range' => 2]]
);
$dataInicio = isset($_GET['dataInicio']) && Util::isValidDate($_GET['dataInicio']) ? $_GET['dataInicio'] : null;
$dataFinal =  isset($_GET['dataFinal']) && Util::isValidDate($_GET['dataFinal']) ? $_GET['dataFinal'] : null;
$termoPesquisado = (isset($_GET['search']) && trim($_GET['search']) != '') ? $_GET['search'] : null;
$intervalo = Util::determinaLimit($paginaAtual, $itensPagina);
$valorTotal = Movimento::obterValorTotalMovimento(
    $tipo,
    $dataInicio,
    $dataFinal,
    $termoPesquisado
);
$totalMovimentos = Movimento::totalMovimentos(
    $tipo,
    $dataInicio,
    $dataFinal,
    $termoPesquisado
);
$movimentos = Movimento::consultarMovimentos(
    $tipo,
    $dataInicio,
    $dataFinal,
    $termoPesquisado,
    $intervalo
);
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
                        <h2>Consultar Movimento</h2>
                        <h5>Aqui você pode consultar todos os seus movimentos em um determinado período</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="consultar_movimento.php" method="get">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo do movimento</label>
                            <select name="tipo" class="form-control">
                                <option <?= (isset($tipo) && $tipo == 0) ? 'selected' : ''; ?> value="0">Todos</option>
                                <option <?= (isset($tipo) && $tipo == 1) ? 'selected' : ''; ?> value="1">Entrada</option>
                                <option <?= (isset($tipo) && $tipo == 2) ? 'selected' : ''; ?> value="2">Saída</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="divDataInicial">
                            <label for="dataInicial">Data Inicial</label><span class="red-text">*</span>
                            <input id="dataInicial" type="date" onblur="isCampoPreenchido(dataInicial,divDataInicial,false)" class="form-control" name="dataInicio" value="<?= (isset($dataInicio)) ? $dataInicio : ''; ?>" placeholder="Coloque a data do movimento">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="divDataFinal">
                            <label for="dataFinal">Data Final</label><span class="red-text">*</span>
                            <input id="dataFinal" type="date" onblur="isCampoPreenchido(dataFinal,divDataFinal,false)" name="dataFinal" value="<?= (isset($dataFinal)) ? $dataFinal : ''; ?>" class="form-control" placeholder="Coloque a data do movimento">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button onclick="return ValidarCampos('dataInicial','dataFinal')" type="submit" class="btn btn-info">Pesquisar</a>
                    </div>
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
                    <?php foreach ($movimentos as $movimento) : ?>
                        <tr class="odd gradeX">
                            <th><?= date('d/m/Y', strtotime($movimento->data_movimento)); ?></th>
                            <th><?= ($movimento->tipo_movimento == 1) ? 'Entrada' : 'Saída' ?></th>
                            <th><?= $movimento->categoria->nome_categoria ?></th>
                            <th><?= $movimento->empresa->nome_empresa ?></th>
                            <th><?= $movimento->conta->banco_conta ?></th>
                            <th>R$<?= number_format($movimento->valor_movimento, 2, ',', '.') ?></th>
                            <th><?= $movimento->obs_movimento ?></th>
                            <td>
                                <form action="consultar_movimento.php" method="get">
                                    <input type="hidden" name="tipo" value="<?= $tipo ?>">
                                    <input type="hidden" name="dataInicio" value="<?= $dataInicio ?>">
                                    <input type="hidden" name="dataFinal" value="<?= $dataFinal ?>">
                                    <input type="hidden" name="search" value="<?= $termoPesquisado ?>">
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
                </tbody>
            </table>
            <div class="row">
                <?php Util::criaPaginacao("consultar_movimento.php", $paginaAtual, $itensPagina, $totalMovimentos); ?>
            </div>
            <div class="text-center">
                <label style="color:<?= ($valorTotal < 0) ? "red" : "green" ?>;">TOTAL: R$<?= number_format($valorTotal, 2, ',', '.'); ?></label>
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