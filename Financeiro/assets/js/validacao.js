function isCampoPreenchido(inputId, inputCssId, focus) {
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

function ValidarCampos(...inputIds) {
    var ret = true;
    var campos = "";

    for (let i = 0; i < inputIds.length; i++) {
        let id = inputIds[i];
        if (!isCampoPreenchido("#" + id, "#div" + Capitalizar(id), ret)) {
            let label = $("#" + id).closest("div").find("label");
            campos += "- " + label.text() + "\n";
            ret = false;
        }
    }

    if (!ret) {
        alert("Preencher o(s) campo(s):\n" + campos);
    }
    return ret;
}

function Capitalizar(str)
{
    return str.charAt(0).toUpperCase() + str.slice(1);
}