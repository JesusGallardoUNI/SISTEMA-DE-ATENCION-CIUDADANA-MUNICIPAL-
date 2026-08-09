import pandas as pd
import warnings
from bs4 import BeautifulSoup, MarkupResemblesLocatorWarning
import re
import string
import nltk

from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
from nltk.stem import PorterStemmer

from sklearn.feature_extraction.text import CountVectorizer

from sklearn.linear_model import LogisticRegression


from sklearn.metrics import accuracy_score






# Descargamos los recursos necesarios de nltk (solo la primera vez)
nltk.download('punkt', quiet=True)
nltk.download('punkt_tab', quiet=True)
nltk.download('stopwords', quiet=True)


# Veamos algunas stopwords en inglés
stop_words = set(stopwords.words('english'))       #spanish por si quiero hacerlo en mi idioma
#print(f"Número de stopwords: {len(stop_words)}")
#print(f"\nAlgunos ejemplos: {list(stop_words)[:20]}")




warnings.filterwarnings("ignore", category=MarkupResemblesLocatorWarning)

def strip_html(text):
    """Elimina las etiquetas HTML de un texto."""
    return BeautifulSoup(text, "html.parser").get_text()

def remove_urls(text):
    """Elimina las URLs de un texto."""
    return re.sub(r'https?://\S+', '', text)

def remove_punctuation(text):
    """Convierte el texto a minúsculas y elimina los signos de puntuación."""
    text = text.lower()
    # Eliminamos la puntuación estándar ASCII
    text = text.translate(str.maketrans('', '', string.punctuation))
    # Eliminamos también las comillas tipográficas y otros caracteres especiales Unicode
    # que no están incluidos en string.punctuation
    text = re.sub(r'[\u2018\u2019\u201C\u201D\u2013\u2014\u2026]', '', text)
    return text

def preprocesar_texto(text):
    """
    Aplica todas las transformaciones de preprocesamiento sobre un texto:
    0. Eliminar prefijos de fuentes
    1. Eliminar etiquetas HTML
    2. Eliminar URLs
    3. Convertir a minúsculas
    4. Eliminar signos de puntuación
    5. Tokenizar
    6. Eliminar stopwords
    7. Aplicar stemming
    
    Devuelve el texto procesado como un único string.
    """
    # 0. Eliminar prefijos de fuente tipo "CIUDAD (Reuters) -" o "CIUDAD (AP) -"
    text = re.sub(r'^[A-Z\s,.]+ \([^)]+\)\s*[-–—]?\s*', '', text)
    # 1. Eliminar HTML
    text = strip_html(text)
    # 2. Eliminar URLs
    text = remove_urls(text)
    # 3 y 4. Minúsculas y puntuación
    text = remove_punctuation(text)
    # 5. Tokenizar
    tokens = word_tokenize(text)
    # 6. Eliminar stopwords
    tokens = [t for t in tokens if t not in stop_words]
    # 7. Stemming
    stemmer = PorterStemmer()
    tokens = [stemmer.stem(t) for t in tokens]
    # Unimos los tokens de nuevo en un string
    return " ".join(tokens)



# Leemos los dos archivos CSV
df_true = pd.read_csv("True.csv")
df_fake = pd.read_csv("Fake.csv")



df_true["label"] = "REAL"
df_fake["label"] = "FAKE"  

print(df_true.head())
print(df_fake.head())

# Unimos ambos DataFrames en uno solo
df = pd.concat([df_true, df_fake], ignore_index=True)

# Verificamos el resultado
print(f"Noticias verdaderas: {len(df_true)}")
print(f"Noticias falsas: {len(df_fake)}")
print(f"Total de noticias: {len(df)}")

#print(df.head()) # Dice las primeras 5
print(df.tail()) # Dice las ultimas 5


# Probamos con una noticia real del conjunto de datos
print(strip_html(df.iloc[0]["text"])[:300])



# Probamos con una noticia del conjunto de datos
texto_original = df.iloc[0]["text"]
print("TEXTO ORIGINAL (primeros 300 caracteres):")
print(texto_original[:300])
print("\n" + "=" * 80)
print("\nTEXTO PROCESADO (primeros 300 caracteres):")
print(preprocesar_texto(texto_original)[:300])


# Para empezar, trabajamos con un subconjunto de 1000 noticias
# Mezclamos el DataFrame para tener noticias falsas y verdaderas mezcladas
df_sample = df.sample(n=1000, random_state=42)

print(f"Tamaño del subconjunto: {len(df_sample)}")
print(f"\nDistribución de etiquetas:")
print(df_sample["label"].value_counts())


# Aplicamos el preprocesamiento a todas las noticias del subconjunto
# Esto puede tardar unos segundos
print("Preprocesando noticias...")
df_sample["text_clean"] = df_sample["text"].apply(preprocesar_texto)
print("¡Listo!")


# Veamos el resultado #PRIMERAS 5
df_sample[["text", "text_clean", "label"]].head()

# Ejemplo de antes y después
print("ANTES:")
print(df_sample.iloc[0]["text"][:200])
print("\nDESPUÉS:")
print(df_sample.iloc[0]["text_clean"][:200])


# Aplicamos CountVectorizer sobre nuestros textos procesados
vectorizer = CountVectorizer()
vectorizer.fit(df_sample["text_clean"])

print(f"Tamaño del vocabulario: {len(vectorizer.get_feature_names_out())} palabras únicas")

# Transformamos los textos en vectores
X_vect = vectorizer.transform(df_sample["text_clean"])

print(f"Dimensiones de la matriz resultante: {X_vect.shape}")
print(f"  → {X_vect.shape[0]} noticias")
print(f"  → {X_vect.shape[1]} palabras en el vocabulario")


print(pd.DataFrame(
    X_vect.toarray(), 
    columns=vectorizer.get_feature_names_out()
))

# Leemos únicamente un subconjunto de 1500 noticias
df_all = df.sample(n=1500, random_state=42)

# Nos quedamos con 1000 noticias para el entrenamiento
df_sample = df_all.iloc[:1000]

print(f"Tamaño del subconjunto: {len(df_sample)}")
print(f"\nDistribución de etiquetas:")
print(df_sample["label"].value_counts())




# Aplicamos el preprocesamiento
print("Preprocesando noticias...")
df_sample["text_clean"] = df_sample["text"].apply(preprocesar_texto)
print("¡Listo!")


vectorizer = CountVectorizer()
X_train = vectorizer.fit_transform(df_sample["text_clean"])


print(X_train.toarray())
print("\nFeatures:", len(vectorizer.get_feature_names_out()))


print(pd.DataFrame(X_train.toarray(), columns=[vectorizer.get_feature_names_out()]))

y_train = df_sample["label"]
print(y_train)


clf = LogisticRegression(max_iter=1000)
clf.fit(X_train, y_train)


# Tomamos las 500 noticias que NO se han utilizado para entrenar el algoritmo
df_test = df_all.iloc[1000:]

print("Preprocesando noticias de test...")
df_test["text_clean"] = df_test["text"].apply(preprocesar_texto)
print("¡Listo!")


X_test = df_test["text_clean"]
y_test = df_test["label"]

print(f"Noticias de test: {len(X_test)}")

# Aplicamos CountVectorizer (solo .transform(), NO .fit())
X_test = vectorizer.transform(X_test)

y_pred = clf.predict(X_test)
print(y_pred)

print("Predicción:\n", y_pred)
print("\nEtiquetas reales:\n", y_test.values)


print("Accuracy: {:.3f}".format(accuracy_score(y_test, y_pred)))


# Leemos 42000 noticias
df_grande = df.sample(n=42000, random_state=42)

print("Preprocesando noticias...")
df_grande["text_clean"] = df_grande["text"].apply(preprocesar_texto)
print("¡Listo!")


# Utilizamos 40000 noticias para entrenar el algoritmo y 2000 para realizar pruebas
X_train, y_train = df_grande["text_clean"][:40000], df_grande["label"][:40000]
X_test, y_test = df_grande["text_clean"][40000:], df_grande["label"][40000:]

print(f"Noticias de entrenamiento: {len(X_train)}")
print(f"Noticias de test: {len(X_test)}")

vectorizer = CountVectorizer()
X_train = vectorizer.fit_transform(X_train)

clf = LogisticRegression(max_iter=1000)
clf.fit(X_train, y_train)


X_test = vectorizer.transform(X_test)

y_pred = clf.predict(X_test)


print("Accuracy: {:.3f}".format(accuracy_score(y_test, y_pred)))

# Definimos algunas noticias de prueba
noticias_nuevas = [
    """Entertainment Reform: The Democratic National Committee has officially 
    announced a strategic partnership with Disney+ to grant free annual 
    subscriptions to all citizens who present proof of voting in the upcoming 
    federal elections, as part of a program to incentivize civic participation.""",
    """Regional Conflict: Following weeks of intense hostilities, the United 
    States and Iran have agreed to a temporary two-week ceasefire to allow 
    for a round of peace negotiations in Islamabad, Pakistan. The agreement 
    seeks to alleviate the global energy crisis following the partial 
    blockade of the Strait of Hormuz, which has sent global oil prices soaring.""",
    """Territorial Expansion: In a historic closed-door session, the U.S. 
    Congress approved the "Northern Unification Act," initiating the formal 
    process to annex the Canadian provinces of Ontario and Quebec as new 
    states of the Union, citing continental energy security as the 
    primary justification.""",
    """Geopolitical Tension: China's Ministry of Defense has confirmed 
    the start of a "total reunification operation," deploying airborne 
    forces to major administrative centers across the island of Taiwan 
    after declaring the failure of all previous diplomatic channels""",
    """Political Indicators: The latest polling data shows that President 
    Donald Trump's approval rating has leveled off at approximately 39%, 
    reflecting a complex public sentiment following the implementation 
    of new tariff policies and intensified border security operations 
    across the country."""
]

# Preprocesamos las noticias
noticias_procesadas = [preprocesar_texto(n) for n in noticias_nuevas]

# Vectorizamos usando el mismo vectorizer entrenado (solo .transform())
noticias_vect = vectorizer.transform(noticias_procesadas)

# Realizamos las predicciones
predicciones = clf.predict(noticias_vect)
probabilidades = clf.predict_proba(noticias_vect)

# Mostramos los resultados
for noticia, pred, prob in zip(noticias_nuevas, predicciones, probabilidades):
    print(f"Noticia: {noticia[:80]}...")
    print(f"  → Predicción: {pred}")
    print(f"  → Probabilidad FAKE: {prob[0]:.2%} | Probabilidad REAL: {prob[1]:.2%}")
    print()