import requests
from bs4 import BeautifulSoup
from datetime import datetime, timedelta
import random
from faker import Faker
import os
from datetime import datetime

fake = Faker("es_MX")

URL_FORM = "http://localhost/GUADALUPE/CIVILES/ReporteCivil.php"

session = requests.Session()

# ---------------------------
# Obtener HTML de la página
# ---------------------------

html = session.get(URL_FORM).text
soup = BeautifulSoup(html, "html.parser")

# ---------------------------
# Obtener colonias reales
# ---------------------------

colonias = []

for option in soup.select("select[name='colonia'] option"):
    val = option.get("value")
    if val and val.strip() != "":
        colonias.append(val)

print("Colonias encontradas:", len(colonias))

# ---------------------------
# Buscar imágenes en carpeta
# ---------------------------

carpeta_imagenes = "imagenes"

imagenes = [
    f for f in os.listdir(carpeta_imagenes)
    if f.lower().endswith((".jpg", ".jpeg", ".png"))
]

print("Imagenes encontradas:", len(imagenes))

# ---------------------------
# Tipos de reporte válidos
# ---------------------------

tipos_reporte = [2,3,4,7,8]

problemas = {
    2: "una lámpara de alumbrado público descompuesta",
    3: "acumulación de basura",
    4: "problemas en el mercado",
    7: "baches y daños en la calle",
    8: "situaciones de seguridad"
}

# ---------------------------
# Descripción con sentido
# ---------------------------

def descripcion_realista(tipo, calle):

    plantillas = [
        f"Desde hace varios días hay {problemas[tipo]} en la calle {calle} y los vecinos ya estamos afectados.",
        f"Se solicita apoyo del municipio debido a {problemas[tipo]} ubicado cerca de {calle}.",
        f"El problema de {problemas[tipo]} lleva tiempo sin resolverse en {calle}.",
        f"Vecinos reportan {problemas[tipo]} en la zona de {calle}."
    ]

    return random.choice(plantillas)

# ---------------------------
# Coordenadas dentro de Guadalupe
# ---------------------------

def coordenadas_guadalupe():
    lat = random.uniform(25.60, 25.75)
    lon = random.uniform(-100.35, -100.15)
    return f"{lat},{lon}"

# ---------------------------
# Generar reportes
# ---------------------------

cantidad = 100

for i in range(cantidad):

    tipo = random.choice(tipos_reporte)
    calle = fake.street_name()

    imagen_elegida = random.choice(imagenes)
    ruta_imagen = os.path.join(carpeta_imagenes, imagen_elegida)

    dias_atras = random.randint(0, 20)
    fecha = (datetime.now() - timedelta(days=dias_atras)).strftime("%Y-%m-%dT%H:%M")

    datos = {
        "nombre_persona": fake.name(),
        "telefono_persona": str(random.randint(8100000000, 8199999999)),
        "correo_persona": fake.email(),
        "estado": "Nuevo León",
        "municipio": "Guadalupe",
        "codigoPostal": random.randint(65000,70000),
        "colonia": random.choice(colonias),
        "reporte": tipo,
        "Descripcion": descripcion_realista(tipo, calle),
        "calle": calle,
        "mi_mapa": coordenadas_guadalupe(),
        "fechaHora": fecha,
        "Clave": f"REP[{random.randint(1000,9999)}"
    }

    files = {
        "imagen": (imagen_elegida, open(ruta_imagen, "rb"), "image/jpeg")
    }

    r = session.post(URL_FORM, data=datos, files=files)

    print("Reporte enviado:", r.status_code)
    print("Respuesta servidor:", r.text[:200])