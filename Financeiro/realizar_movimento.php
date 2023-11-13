<?php
require_once '../DAO/Movimento.php';
if (isset($_POST['btn'])) {
    $ret = (new Movimento)->realizarMovimento($_POST['tipo'], $_POST['categoria'], $_POST['data'], $_POST['empresa'], $_POST['valor'], $_POST['conta'], $_POST['obs']);
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
                        <h2>Realizar Movimento</h2>
                        <h5>Aqui você poderá realizar seus movimentos de entrada ou saída!</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <?php
                include_once '_msg.php';
                ?>
                <form action="realizar_movimento.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo do movimento</label>
                            <select name="tipo" class="form-control">
                                <option value="">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saída</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data</label>
                            <input name="data" type="date" class="form-control" placeholder="Coloque a data do movimento">
                        </div>
                        <div class="form-group">
                            <label>Valor</label>
                            <input name="valor" class="form-control" placeholder="Digite o valor do movimento">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select name="categoria" class="form-control">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Empresa</label>
                            <select name="empresa" class="form-control">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Conta</label>
                            <select name="conta" class="form-control">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observações (Opcional)</label>
                            <textarea name="obs" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="btn" class="btn btn-success">Finalizar Lançamento</button>
                    </div>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>