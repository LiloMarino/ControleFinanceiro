<?php if (isset($ret)): ?>
    <?php
    switch ($ret):
        case 2: ?>
            <div class="alert alert-warning">
                Você não tem Categoria ou Empresa ou Conta cadastradas
            </div>
            <?php break;
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
        case -2: ?>
            <div class="alert alert-danger">
                A senha deverá conter no mínimo 6 caracteres
            </div>
            <?php break;
        case -3: ?>
            <div class="alert alert-danger">
                A senha e o repetir senha não coincidem
            </div>
            <?php break;
        case -4: ?>
            <div class="alert alert-danger">
                O registro não poderá ser excluído, pois está em uso!
            </div>
            <?php break;
        case -5: ?>
            <div class="alert alert-danger">
                Email já em uso! Use outro email
            </div>
            <?php break;
        case -6: ?>
            <div class="alert alert-danger">
                Usuário não encontrado!
            </div>
            <?php break;
        default: ?>
            <div class="alert alert-danger">
                Ocorreu um erro na operação. Tente mais tarde!
            </div>
    <?php endswitch; ?>
<?php endif; ?>