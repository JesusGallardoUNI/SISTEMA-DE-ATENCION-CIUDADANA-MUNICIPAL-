import requests
import pandas as pd

# URL de tu endpoint PHP
URL = "http://localhost/MUNICIPAL/Recursos/API/ApiPrueba.php"

# Hacemos la petición GET
response = requests.get(URL)

# Verificamos que la petición fue exitosa
if response.status_code == 200:
    data = response.json()

    if data["success"]:
        colonias = data["colonias_lista"]

        # Convertimos el JSON a DataFrame
        df = pd.DataFrame(colonias)

        print("Datos cargados correctamente")
        #print(df.head())  # muestra las primeras filas
        print(df.to_string())

    else:
        print("Error en la respuesta del API")
else:
    print("Error HTTP:", response.status_code)
