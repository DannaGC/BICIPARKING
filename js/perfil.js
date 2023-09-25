const estadoParqueadero = document.getElementById("estadoParqueadero");

function actualizarEstadoParqueadero() {
    const ahora = new Date();
    const horaActual = ahora.getHours();

    if (horaActual >= 6 && horaActual < 22) {
        estadoParqueadero.textContent = "Abierto";
    } else {
        estadoParqueadero.textContent = "Cerrado";
    }
}
actualizarEstadoParqueadero();

const reloj = document.getElementById("reloj");

function actualizarReloj() {
    const ahora = new Date();
    const horas = ahora.getHours().toString().padStart(2, "0");
    const minutos = ahora.getMinutes().toString().padStart(2, "0");
    const segundos = ahora.getSeconds().toString().padStart(2, "0");

    reloj.textContent = `${horas}:${minutos}:${segundos}`;
  }
setInterval(actualizarReloj, 1000);

const fotoPropietarioInput = document.getElementById("foto_propietario");
const imagenPropietario = document.getElementById("imagen_propietario");
const fotoBicicletaInput = document.getElementById("foto_bicicleta");
const imagenBicicleta = document.getElementById("imagen_bicicleta");

fotoPropietarioInput.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagenPropietario.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

fotoBicicletaInput.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagenBicicleta.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

function eliminarImagen(idImagen) {
    const imagen = document.getElementById(idImagen);
    imagen.src = "";
}