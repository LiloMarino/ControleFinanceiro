<?php if (isset($ret)) : ?>
    <?php
    switch ($ret):
        case 1: ?>
            <div class="alert alert-success">
                Ação realizada com sucesso
            </div>
        <?php break;
        case 0: ?>
            <div class="alert alert-warning">
                Preencher o(s) campo(s) obrigatório(s)
            </div>
        <?php break;
        case -1: ?>
            <div class="alert alert-danger">
                Ocorreu um erro na operação. Tente mais tarde!
            </div>
            <?php break;
        default: ?>
            <div class="alert alert-danger">
                Ocorreu um erro na operação. Tente mais tarde!
            </div>
    <?php endswitch; ?>
<?php endif; ?>