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
                <hr />
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tipo do movimento</label>
                        <select class="form-control">
                            <option value="0">Todos</option>
                            <option value="1">Entrada</option>
                            <option value="2">Saída</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data Inicial</label>
                        <input type="date" class="form-control" placeholder="Coloque a data do movimento">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data Final</label>
                        <input type="date" class="form-control" placeholder="Coloque a data do movimento">
                    </div>
                </div>
                <div class="col-md-12">
                    <a class="btn btn-info">Pesquisar</a>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Resultado Encontrado
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
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <th>(Data)</th>
                                                <th>(Tipo)</th>
                                                <th>(Categoria)</th>
                                                <th>(Empresa)</th>
                                                <th>(Conta)</th>
                                                <th>(Valor)</th>
                                                <th>(Observações)</th>
                                                <td>
                                                    <a type="submit" class="btn btn-danger btn-sm">Excluir</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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