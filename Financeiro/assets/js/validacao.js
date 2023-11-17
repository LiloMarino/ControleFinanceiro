function VerificarCampoPreenchido(inputId, inputCssId, focus) {
    if ($(inputId).val().trim() == '') {
        if (focus) {
            $(inputId).focus();
        }
        $(inputCssId).addClass("has-error");
        return false;
    }
    $(inputCssId).removeClass("has-error").addClass("has-success");
    return true;
}

function ValidarMeusDados() {
    var ret = true;
    var campos = "";

    if (!VerificarCampoPreenchido("#nome", "#divNome", ret)) {
        campos += "- Nome\n";
        ret = false;
    }

    if (!VerificarCampoPreenchido("#email", "#divEmail", ret)) {
        campos += "- Email\n";
        ret = false;
    }

    if (!ret) {
        alert("Preencher o(s) campo(s):\n" + campos);
    }
    return ret;
}