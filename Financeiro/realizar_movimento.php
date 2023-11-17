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
                        <div class="form-group" id="divTipo">
                            <label for="tipo">Tipo do movimento</label><span class="red-text">*</span>
                            <select id="tipo" onblur="isCampoPreenchido(tipo,divTipo,false)" name="tipo" class="form-control">
                                <option value="">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saída</option>
                            </select>
                        </div>
                        <div class="form-group" id="divData">
                            <label for="data">Data</label><span class="red-text">*</span>
                            <input id="data" onblur="isCampoPreenchido(data,divData,false)" name="data" type="date" class="form-control"
                                placeholder="Coloque a data do movimento">
                        </div>
                        <div class="form-group" id="divValor">
                            <label for="valor">Valor</label><span class="red-text">*</span>
                            <input id="valor" onblur="isCampoPreenchido(valor,divValor,false)" name="valor" class="form-control"
                                placeholder="Digite o valor do movimento">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="divCategoria">
                            <label for="categoria">Categoria</label><span class="red-text">*</span>
                            <select id="categoria" onblur="isCampoPreenchido(categoria,divCategoria,false)" name="categoria" class="form-control">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                        <div class="form-group" id="divEmpresa">
                            <label for="empresa">Empresa</label><span class="red-text">*</span>
                            <select id="empresa" onblur="isCampoPreenchido(empresa,divEmpresa,false)" name="empresa" class="form-control">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                        <div class="form-group" id="divConta">
                            <label for="conta">Conta</label><span class="red-text">*</span>
                            <select id="conta" onblur="isCampoPreenchido(conta,divConta,false)" name="conta" class="form-control">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observações (Opcional)</label>
                            <textarea name="obs" class="form-control" rows="3"></textarea>
                        </div>
                        <button onclick="return ValidarCampos('tipo', 'data', 'valor', 'categoria', 'empresa', 'conta')"
                            type="submit" name="btn" class="btn btn-success">Finalizar Lançamento</button>
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