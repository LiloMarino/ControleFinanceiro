<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Movimento.php';
require_once '../DAO/Empresa.php';
require_once '../DAO/Conta.php';
require_once '../DAO/Categoria.php';
if (isset($_POST['btn'])) {
    $ret = Movimento::realizarMovimento($_POST['tipo'], $_POST['data'], $_POST['tipo'] == 1 ? $_POST['valor'] : -$_POST['valor'], $_POST['obs'], $_POST['categoria'], $_POST['conta'], $_POST['empresa']);
}
$empresas = Empresa::consultarEmpresa();
$contas = Conta::consultarConta();
$categorias = Categoria::consultarCategoria();
if (count($empresas) == 0 || count($contas) == 0 || count($categorias) == 0)
{
    $ret = 2;
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
                <?php
                include_once '_msg.php';
                ?>
                <hr />
                <form action="realizar_movimento.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group" id="divTipo">
                            <label for="tipo">Tipo do movimento</label><span class="red-text">*</span>
                            <select id="tipo" onblur="isCampoPreenchido(tipo,divTipo,false)" name="tipo" class="form-control">
                                <option value="">Selecione</option>
                                <option <?= (isset($_POST['tipo']) && $_POST['tipo'] == 1) ? 'selected' : ''; ?> value="1">Entrada</option>
                                <option <?= (isset($_POST['tipo']) && $_POST['tipo'] == 2) ? 'selected' : ''; ?> value="2">Saída</option>
                            </select>
                        </div>
                        <div class="form-group" id="divData">
                            <label for="data">Data</label><span class="red-text">*</span>
                            <input id="data" onblur="isCampoPreenchido(data,divData,false)" name="data" type="date" class="form-control" value="<?= (isset($_POST['data'])) ? $_POST['data'] : ''; ?>" placeholder="Coloque a data do movimento">
                        </div>
                        <div class="form-group" id="divValor">
                            <label for="valor">Valor</label><span class="red-text">*</span>
                            <input id="valor" onblur="isCampoPreenchido(valor,divValor,false)" name="valor" class="form-control" value="<?= (isset($_POST['valor'])) ? $_POST['valor'] : ''; ?>" placeholder="Digite o valor do movimento">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="divCategoria">
                            <label for="categoria">Categoria</label><span class="red-text">*</span>
                            <select id="categoria" onblur="isCampoPreenchido(categoria,divCategoria,false)" name="categoria" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($categorias as $categoria) : ?>
                                    <option <?= (isset($_POST['categoria']) && $_POST['categoria'] == $categoria->id_categoria) ? 'selected' : ''; ?> value="<?= $categoria->id_categoria ?>"><?= $categoria->nome_categoria ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" id="divEmpresa">
                            <label for="empresa">Empresa</label><span class="red-text">*</span>
                            <select id="empresa" onblur="isCampoPreenchido(empresa,divEmpresa,false)" name="empresa" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($empresas as $empresa) : ?>
                                    <option <?= (isset($_POST['empresa']) && $_POST['empresa'] == $empresa->id_empresa) ? 'selected' : ''; ?> value="<?= $empresa->id_empresa ?>"><?= $empresa->nome_empresa ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" id="divConta">
                            <label for="conta">Conta</label><span class="red-text">*</span>
                            <select id="conta" onblur="isCampoPreenchido(conta,divConta,false)" name="conta" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($contas as $conta) : ?>
                                    <option <?= (isset($_POST['conta']) && $_POST['conta'] == $conta->id_conta) ? 'selected' : ''; ?> value="<?= $conta->id_conta ?>"><?= $conta->banco_conta ?> | Ag.:<?= $conta->agencia_conta ?> | Num .:<?= $conta->numero_conta ?> | Saldo: R$<?= $conta->saldo_conta ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observações (Opcional)</label>
                            <textarea name="obs" class="form-control" rows="3" maxlength="100"><?= (isset($_POST['obs'])) ? $_POST['obs'] : ''; ?></textarea>
                        </div>
                        <button onclick="return ValidarCampos('tipo', 'data', 'valor', 'categoria', 'empresa', 'conta')" type="submit" name="btn" class="btn btn-success">Finalizar Lançamento</button>
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