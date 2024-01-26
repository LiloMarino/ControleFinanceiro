<?php
require_once '../DAO/Util.php';
Util::verificarLogado();

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
                
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>