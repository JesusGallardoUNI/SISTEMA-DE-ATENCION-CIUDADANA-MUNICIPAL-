document.addEventListener("DOMContentLoaded", () => {
  // ================== ALERTA (solo si existe) ==================
  //const ReporteCivil = document.getElementById("ReporteCivil");   //Lo mando a reportecivil.js porque no supe transferir los valores a otros archivos
  const ReporteAlerta = document.getElementById("alerta__resuelto");
  const ReporteDescartado = document.getElementById("ReporteDescartar");
  const Funcionario = document.getElementById("Funcionario");
  const AlertaSolicitud = document.getElementById("AlertaSolicitud");
  const ErrorReporte = document.getElementById("ErrorReporte");

  

  if(ReporteAlerta){
    Swal.fire({
      title: "Reporte subido correctamente",
      text: "Asegúrate de comunicárselo a quien hizo el reporte",
      icon: "success"
    }).then(() => {
      window.location.href = 'SecretariaServiciosPublicos.php';
    });
  }

  if(ReporteDescartado){
    Swal.fire({
      title: "Reporte descartado correctamente",
      text: "Las autoridades investigaran mas a detalle",
      icon: "success"
    }).then(() => {
      window.location.href = 'SecretariaServiciosPublicos.php';
    });
  }

  if(Funcionario){
    Swal.fire({
      title: "Funcionario registrado correctamente",
      text: "Ahora puedes acceder al sistema",
      icon: "success"
    })
  }

  if (AlertaSolicitud) {
    // Ocultar al hacer clic
    Swal.fire({
      title: "Reporte subido correctamente",
      text: "El solicitante recibio la informacion",
      icon: "success",
      draggable: true
    }).then(() => {
      window.location.href = 'ListaCambios.php';
    });
  }

  if (ErrorReporte) {
    // Ocultar al hacer clic
    Swal.fire({
      title: "Error",
      text: "Clave de reporte no existe",
      icon: "error",
      draggable: true
    })
  }




//===========================================//
// GENERADOR DE ALERTAS POR MEDIO DE FUNCION //
//===========================================//
window.Muestra_Alerta = function(titulo, mensaje, icono){
    Swal.fire({
      title: titulo,
      text: mensaje,
      icon: `${icono}`,
      draggable: true
    });
}






  // ================== MAPA ==================
  
  
  
  let coordenadas = document.getElementById("coordenadas").value;
  let partes = coordenadas.split(",");
  let lat = parseFloat(partes[0].trim());
  let lng = parseFloat(partes[1].trim());

  var map = L.map('mi_mapa').setView([lat, lng], 17);

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { 
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Icono personalizado
  var iconoUbicacion = L.icon({
    iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
    iconSize: [30, 30],
    iconAnchor: [15, 30],
    popupAnchor: [0, -30]
  });

  // Marcador inicial
  var marker = L.marker([lat, lng], { icon: iconoUbicacion })
               .addTo(map)
               .bindPopup("Ubicación inicial");

  // Evento clic en el mapa
  map.on('click', function(e) {
    var lat = e.latlng.lat.toFixed(6);  
    var lng = e.latlng.lng.toFixed(6);  

    // Actualizar input con nuevas coordenadas
    document.getElementById("coordenadas").value = lat + ", " + lng;

    // Mover marcador
    marker.setLatLng(e.latlng)
          .bindPopup("Nueva ubicación: " + lat + ", " + lng)
          .openPopup();
  });
});



const Barra = document.getElementById("ScrollNavBar");
if(Barra) {
  let Truco = 0;
  function AcortarNavegador() {
    Truco++;
    const Barra = document.querySelector("nav");
    let OpcionTitulo = document.querySelector(".Titulo_opcion h2");
    let Opciones = document.querySelectorAll(".opcion a");
    if(Truco%2 == 0){
      Opciones.forEach(enlace => {
        enlace.classList.add("Ciego");
      });
      OpcionTitulo.classList.add("Ciego");
      Barra.classList.add("AnchoAuto");
    } else {
      Opciones.forEach(enlace => {
        enlace.classList.remove("Ciego");
      });
      OpcionTitulo.classList.remove("Ciego");
      Barra.classList.remove("AnchoAuto");
    }

  }

  Barra.addEventListener("click", AcortarNavegador);
}