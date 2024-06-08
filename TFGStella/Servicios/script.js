 // Función para mostrar u ocultar información adicional
 function toggleMoreInfo() {
    var moreInfo = document.getElementById("moreInfo");
    if (moreInfo.style.display === "none") {
        moreInfo.style.display = "block";
    } else {
        moreInfo.style.display = "none";
    }
}

// Función para redirigir a la página de pedir cita
function pedirCita() {
    window.location.href = "../PedirCita/pedir.php";
}