
// Configurar Signature Pad
const canvas = document.getElementById('signature-pad');
const signaturePad = new SignaturePad(canvas);

// Ajustar las coordenadas del lienzo
window.addEventListener('resize', resizeCanvas);
resizeCanvas();

function resizeCanvas() {
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext('2d').scale(ratio, ratio);
    signaturePad.clear(); // Borra la firma cuando se ajusta el tamaño del lienzo
}

// Función para borrar la firma
function clearSignature() {
    signaturePad.clear();
}

async function generatePDF() {
    const { jsPDF } = window.jspdf;

    // Crear una nueva instancia de jsPDF
    const doc = new jsPDF();

    // Obtener los valores del formulario
    const estado = document.getElementById('estado').value;
    const municipio = document.getElementById('municipio').value;
    const alcalde = document.getElementById('alcalde').value;
    const fecha = document.getElementById('fecha').value;
    const signatureImage = signaturePad.toDataURL('image/png');

    // Agregar fecha en el encabezado
    doc.setFontSize(12);
    doc.text(`Fecha: ${fecha}`, 150, 20);

    // Título de la carta
    doc.setFontSize(14);
    doc.setFont("Arial", "bold");
    doc.text("Carta compromiso", 20, 40);
    doc.setLineWidth(0.5);
    doc.line(20, 41, 75, 41);

    // Contenido de la carta
    doc.setFontSize(12);
    doc.setFont("Arial", "normal");
    const text = `Por medio de la presente solicitud para dar a conocer las problemáticas y necesidades que presentan, yo el alcalde ${alcalde} del municipio de ${municipio} del Estado libre y soberano de ${estado}, me comprometo en atender y resolver todo lo señalado para darle solución de manera inmediata, garantizando así la calidad de los trabajos que se van a realizar con el fin de que los resultados esperados sean buenos en beneficio para la ciudadanía, además de que se garantice que los resultados sean duraderos.`;
    doc.text(text, 20, 60, { maxWidth: 170 });

    // Firma
    doc.setLineWidth(0.5);
    const signatureX = (doc.internal.pageSize.getWidth() - 150) / 2;
    const signatureY = 120;
    doc.line(signatureX, signatureY + 60, signatureX + 150, signatureY + 60); // Subraya la firma
    doc.addImage(signatureImage, 'PNG', signatureX, signatureY, 150, 60);

    // Nombre y firma del alcalde
    doc.setFont("Arial", "normal");
    doc.text("Nombre y firma del alcalde", doc.internal.pageSize.getWidth() / 2, signatureY + 80, { align: 'center' });
    doc.text(alcalde, doc.internal.pageSize.getWidth() / 2, signatureY + 90, { align: 'center' });

    // Descargar el PDF
    doc.save('Carta Compromiso.pdf');
}