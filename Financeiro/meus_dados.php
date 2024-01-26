<?php
require_once '../DAO/Util.php';
Util::verificarLogado();
require_once '../DAO/Usuario.php';
$usuario = new Usuario(Util::codigoLogado());
if (isset($_POST['btn'])) {
    $ret = $usuario->atualizarDados($_POST['nome'],$_POST['email']);
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
                        <h2>Meus Dados</h2>
                        <h5>Nesta página você poderá alterar seus dados</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <?php include_once '_msg.php' ?>
                <form action="meus_dados.php" method="post">
                    <div class="form-group" id="divNome">
                        <label for="nome">Nome</label>
                        <input id="nome" onblur="isCampoPreenchido(nome,divNome,false)" class="form-control" placeholder="Insira seu Nome" name="nome" value="<?= $usuario->getNome() ?>">
                    </div>
                    <div class="form-group" id="divEmail">
                        <label for="email">Email</label>
                        <input id="email" onblur="isCampoPreenchido(email,divEmail,false)" class="form-control" placeholder="Insira seu Email" name="email" value="<?= $usuario->getEmail() ?>">
                    </div>
                    <button type="submit" onclick="return ValidarCampos('nome','email')" class="btn btn-success" name="btn">Concluído</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>