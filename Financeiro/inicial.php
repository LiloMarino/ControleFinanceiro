<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Movimento.php';
$totalEntrada = Movimento::obterTotalMovimento(true);
$totalSaida = Movimento::obterTotalMovimento(false);
$movimentos = Movimento::consultarUltimosMovimentos();
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
                        <h2>Página Inicial</h2>
                        <h5>Aqui você acompanha todos os números de uma forma geral</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa-solid fa-chart-column fa-5x"></i>
                            <h3>R$ <?= $totalEntrada ?></h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            Total de Entrada
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa-solid fa-chart-column fa-5x"></i>
                            <h3>R$ <?= $totalSaida ?></h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Total de Saída
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (count($movimentos) > 0) : ?>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Últimos 10 lançamentos de Movimento
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $total = 0; ?>
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
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            <label style="color:<?= ($total < 0) ? "red" : "green" ?>;">TOTAL: R$<?= number_format($total, 2, ',', '.') ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                <?php else : ?>
                    <div class="alert alert-info col-md-12 text-center">
                        Não existe nenhum movimento para ser exibido
                    </div>
                <?php endif; ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>