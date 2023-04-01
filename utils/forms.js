$(document).ready(function () {
  $("#telefone").mask("(99) 99999-9999");

  $("#cpf").mask("999.999.999-99");
});

var password = document.getElementById("senha"),
  confirm_password = document.getElementById("confirma_senha");

function validatePassword() {
  if (password.value != confirm_password.value) {
    confirm_password.setCustomValidity("As senhas não coincidem!");
  } else {
    confirm_password.setCustomValidity("");
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

function view_password() {
  const senha = document.getElementById("senha");
  if (senha.type == "password") {
    senha.type = "text";
    document.getElementById("eye_password").style.color = "#79d1c3";
  } else {
    senha.type = "password";
    document.getElementById("eye_password").style.color = "#fff";
  }
}

function view_confirm_password() {
  const confirma_senha = document.getElementById("confirma_senha");
  if (confirma_senha.type == "password") {
    confirma_senha.type = "text";
    document.getElementById("eye_confirm_password").style.color = "#79d1c3";
  } else {
    confirma_senha.type = "password";
    document.getElementById("eye_confirm_password").style.color = "#fff";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  document.forms[0].onsubmit = function (e) {
    return val(e);
  };

  senha.oninput = function (e) {
    val(e);
  };

  function val(e) {
    var qtde = 0,
      v = senha.value,
      e = e.type == "submit";

    if (v.match(/.{6,}/)) {
      qtde++;
    }
    if (v.match(/[A-Z]{1,}/)) {
      qtde++;
    }
    if (v.match(/[0-9]{1,}/)) {
      qtde++;
    }
    if (v.match(/[!@#$%^&*(),.?":{}|<>]{1,}/)) {
      qtde++;
    }
    if (v.match()) {
      var validacao = "Fraca";
    }

    const progresso = document.querySelector(".barra div");

    switch (qtde) {
      case 1:
        validacao = "Fraca";
        progresso.setAttribute("style", "width: 5%");
        progresso.style.backgroundColor = "#ff0000";
        break;
      case 2:
        validacao = "M\u00e9dia";
        progresso.setAttribute("style", "width: 38%");
        progresso.style.backgroundColor = "#ff0";
        break;
      case 3:
        validacao = "Forte";
        progresso.setAttribute("style", "width: 71%");
        progresso.style.backgroundColor = "#00ff00";
        break;
      case 4:
        validacao = "Muito forte";
        progresso.setAttribute("style", "width: 100%");
        progresso.style.backgroundColor = "#055405";
        break;
    }
    if (qtde > 0) {
      document.getElementById("medidor").innerHTML =
        "<div id='forca'>For\u00e7a:</div>&nbsp;" + validacao;
    } else {
      document.getElementById("medidor").innerHTML = "";
      progresso.setAttribute("style", "width: 0%");
    }
  }
});
