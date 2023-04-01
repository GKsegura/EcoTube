let count = 1;

document.getElementById("radio1").checked = true;

function function1() {
  count = 1;
}

function function2() {
  count = 2;
}

function function3() {
  count = 3;
}

function function4() {
  count = 4;
}

setInterval(function () {
  nextImage();
}, 5000);

function nextImage() {
  count++;
  if (count > 4) {
    count = 1;
  }

  document.getElementById("radio" + count).checked = true;
}

function opt() {
  var d = document.getElementById("tipo").value;
  window.location.href = "./selecao_produtos_front.php?tipo=" + d;
}
