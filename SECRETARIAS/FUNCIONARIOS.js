function validarYGenerarPDF() {
    // Obtener valores de los campos
    const estado = document.getElementById('estado').value;
    const municipio = document.getElementById('municipio').value;
    const colonia = document.getElementById('colonia').value;
    const reporte = document.getElementById('reporte').value;
    const fechaHora = document.getElementById('fechaHora').value;
    const imagenInput = document.getElementById('imagen');

    // Validar que todos los campos tengan valores válidos
    if (estado === "NULL" || municipio === "NULL" || colonia === "NULL" || reporte === "NULL" || !imagenInput.value) {
        alert("Por favor, asegúrese de que todos los campos están completos y válidos.");
        return;
    }
}