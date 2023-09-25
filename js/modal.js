function abrirModal(puesto_id, estado_actual) {
  document.getElementById("modal_puesto_id").value = puesto_id;
  document.getElementById("modal_estado_actual").value = estado_actual;
  document.getElementById("modal_cedula_estudiante").value = "";
  var modal = document.getElementById("modal");
  modal.style.display = "block";
}

function cerrarModal() {
  var modal = document.getElementById("modal");
  modal.style.display = "none";
}

window.onclick = function(event) {
  var modal = document.getElementById("modal");
  if (event.target == modal) {
    cerrarModal();
  }
}