document.addEventListener("DOMContentLoaded", () => {
  // ================== ALERTA (solo si existe) ==================
  const alerta = document.getElementById("alerta");
  const ReporteAlerta = document.getElementById("alerta__resuelto");

  if (alerta) {
    // Ocultar al hacer clic
    Swal.fire({
      title: "Reporte subido correctamente",
      text: "En espera para su pronta atencion, pronto nos comunicaremos con tigo",
      icon: "success",
      draggable: true
    }).then(() => {
      window.location.href = 'ReporteCivil.php';
    });
    /*
    alerta.addEventListener("click", () => {
      alerta.classList.add("Ciego");
    });

    // Ocultar automáticamente después de 4 segundos
    setTimeout(() => {
      alerta.style.transition = "opacity 1s";
      alerta.style.opacity = "0";
      setTimeout(() => alerta.remove(), 1000);
    }, 4000);
    */
  }

  if(ReporteAlerta){
    Swal.fire({
      title: "Reporte subido correctamente",
      text: "Asegúrate de comunicárselo a quien hizo el reporte",
      icon: "success"
    }).then(() => {
      window.location.href = 'Muestra.php';
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
