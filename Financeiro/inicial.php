<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Movimento.php';
$totalEntrada = Movimento::obterTotalMovimento(true);
$totalSaida = Movimento::obterTotalMovimento(false);
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
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>