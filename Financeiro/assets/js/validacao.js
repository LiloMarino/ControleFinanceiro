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
            if (label.text() == '') {
                campos += "- " + Capitalizar(id) + "\n";
            }
            else {
                campos += "- " + label.text() + "\n";
            }
            ret = false;
        }
    }

    if (!ret) {
        alert("Preencher o(s) campo(s):\n" + campos);
    }
    return ret;
}

function ValidarCadastro(...inputIds) {
    var ret = ValidarCampos(...inputIds);
    if (ret) {

        /* Validar Email */
        if (!validarEmail($("#email").val())) {
            alert("Email inválido!");
            ret = false;
        }

        /* Validar Senha */
        if ($("#senha").val().trim().length < 6) {
            $("#senha").focus();
            alert("A senha deverá conter no mínimo 6 caracteres");
            ret = false;
        }

        if ($("#senha").val().trim() != $("#rsenha").val().trim()) {
            $("#rsenha").focus();
            alert("A senha e o repetir senha não coincidem");
            ret = false;
        }
    }
    return ret;
}

function coincideSenha(idSenha, cssSenha) {
    /* Verifica se o repetir senha está preenchido */
    if ($("#rsenha").val().trim() != '') {
        /* Verifica se as senhas coincidem */
        if ($("#senha").val().trim() == $("#rsenha").val().trim()) {
            /* Senhas coincidem */
            $("#labelSenha").hide();
            /* Avalia a força da senha */
            validarSenha();
        }
        else {
            /* Senhas não coincidem */
            $("#labelSenha").show();
            $("#labelSenha").text("As senhas não coincidem");
            $("#divSenha").removeClass("has-success").removeClass("has-warning").addClass("has-error");
            $("#divRsenha").removeClass("has-success").removeClass("has-warning").addClass("has-error");
        }
    }

    /* Verifica se o campo está vazio */
    if ($(idSenha).val().trim() == '') {
        $(cssSenha).removeClass("has-success").removeClass("has-warning").addClass("has-error");
    }
}

function validarSenha() {
    /* Verifica se a senha tem pelo menos 6 caracteres */
    if ($("#senha").val().trim().length < 6) {
        $("#divSenha").addClass("has-error");
        $("#labelSenha").text("A senha deverá conter no mínimo 6 caracteres");
        $("#labelSenha").show();
    }
    else {
        /* Avalia a força da senha */
        if ($("#rsenha").val().trim() == '' || $("#senha").is(":focus")) {
            $("#labelSenha").show();
            switch (avaliarForcaSenha($("#senha").val())) {
                case 1:
                    $("#labelSenha").text("Senha Fraca");
                    $("#divSenha").removeClass("has-success").removeClass("has-warning").addClass("has-error");
                    break;
                case 2:
                    $("#labelSenha").text("Senha Média");
                    $("#divSenha").removeClass("has-success").removeClass("has-error").addClass("has-warning");
                    break;
                case 3:
                    $("#labelSenha").text("Senha Forte");
                    $("#divSenha").removeClass("has-error").removeClass("has-warning").addClass("has-success");
                    break;
                case 4:
                    $("#labelSenha").text("Senha Muito Forte");
                    $("#divSenha").removeClass("has-error").removeClass("has-warning").addClass("has-success");
                    break;
            }
        }
        else {
            switch (avaliarForcaSenha($("#senha").val())) {
                case 1:
                    $("#divSenha").removeClass("has-success").removeClass("has-warning").addClass("has-error");
                    $("#divRsenha").removeClass("has-success").removeClass("has-warning").addClass("has-error");
                    break;
                case 2:
                    $("#divSenha").removeClass("has-success").removeClass("has-error").addClass("has-warning");
                    $("#divRsenha").removeClass("has-success").removeClass("has-error").addClass("has-warning");
                    break;
                case 3:
                    $("#divSenha").removeClass("has-error").removeClass("has-warning").addClass("has-success");
                    $("#divRsenha").removeClass("has-error").removeClass("has-warning").addClass("has-success");
                    break;
                case 4:
                    $("#divSenha").removeClass("has-error").removeClass("has-warning").addClass("has-success");
                    $("#divRsenha").removeClass("has-error").removeClass("has-warning").addClass("has-success");
                    break;
            }
        }
    }

}

function Capitalizar(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function validarEmail(email) {
    // Expressão regular mais abrangente para validar o formato do e-mail
    const regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    // Testa se o e-mail corresponde à expressão regular
    return regexEmail.test(email);
}

function avaliarForcaSenha(senha) {
    // Critérios para avaliação da força da senha
    const comprimento = 10;
    const contemLetras = /[a-zA-Z]/.test(senha);
    const contemNumeros = /\d/.test(senha);
    const contemCaracteresEspeciais = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(senha);

    // Pontuação inicial
    let pontuacao = 0;

    // Verifica se contém letras, números e caracteres especiais
    if (contemLetras) {
        pontuacao += 1;
    }
    if (contemNumeros) {
        pontuacao += 1;
    }
    if (contemCaracteresEspeciais) {
        pontuacao += 1;
    }

    // Verifica o tamanho da senha e se ela contem numa senha comprida pelo menos uma combinação de 2 critérios anteriores
    if (senha.length >= comprimento && pontuacao >= 2) {
        pontuacao += 1;
    }

    // Classifica a força da senha com base na pontuação
    if (pontuacao <= 1) {
        return 1; // Fraca
    } else if (pontuacao === 2) {
        return 2; // Média  
    } else if (pontuacao == 3) {
        return 3; // Forte
    } else {
        return 4; // Muito Forte
    }
}

