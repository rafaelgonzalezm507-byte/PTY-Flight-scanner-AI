import sys
import mysql.connector
from serpapi import GoogleSearch

# --- 1. CONFIGURACIÓN DE SEGURIDAD Y API ---
SERPAPI_KEY = "f99fc1720ff63c003904ff050e2ce693de5d9e15a45d643fc08e91b2725dbacf"
db_config = {
    "host": "127.0.0.1",
    "user": "pentesting",
    "password": "_1M9a0.23",
    "database": "pentestingweb_vulnerabilidades"
}

def buscar_vuelo(destino_iata):
    destino = destino_iata.upper()
    print(f"\n[SISTEMA] Consultando API para destino: {destino}")

    params = {
        "engine": "google_flights",
        "departure_id": "PTY",
        "arrival_id": destino,
        "outbound_date": "2026-07-15",
        "return_date": "2026-07-22",
        "currency": "USD",
        "hl": "es",
        "api_key": SERPAPI_KEY
    }

    try:
        # FASE A: OBTENER DATOS (Consume 1 crédito de tu cuota)
        search = GoogleSearch(params)
        results = search.get_dict()

        # Verificamos si hay vuelos en la respuesta
        vuelos = results.get("best_flights", [])
        url_google = results.get("search_metadata", {}).get("google_flights_url", "https://google.com/flights")

        if vuelos:
            precio = vuelos[0].get("price")
            print(f"✈️ Vuelo encontrado: ${precio} USD")

            # FASE B: PERSISTENCIA EN MARIADB
            conn = mysql.connector.connect(**db_config)
            cursor = conn.cursor()

            # Limpiamos datos viejos del mismo destino para mantener la DB ligera
            cursor.execute("DELETE FROM hallazgos_agente WHERE descripcion = %s", (destino,))

            # Insertamos el nuevo hallazgo
            query = """INSERT INTO hallazgos_agente
                       (precio_detectado, fecha, plataforma, descripcion, enlace_afiliado)
                       VALUES (%s, NOW(), 'Google Flights', %s, %s)"""

            cursor.execute(query, (precio, destino, url_google))
            conn.commit()

            print(f"✅ Sincronización exitosa: {destino} guardado en la base de datos.")
            cursor.close()
            conn.close()
        else:
            print(f"⚠️ No se hallaron vuelos disponibles para {destino} en esta fecha.")

    except Exception as e:
        print(f"❌ ERROR DE SISTEMA: {e}")

# --- 2. BLOQUE DE EJECUCIÓN PRINCIPAL (CORREGIDO) ---
# Esta es la línea que evita el NameError: name 'name' is not defined
if __name__ == "__main__":
    if len(sys.argv) > 1:
        # Si pasas un argumento (ej: MIA), ejecuta la búsqueda
        buscar_vuelo(sys.argv[1])
    else:
        # Si no pasas nada, muestra el manual de uso
        print("Uso correcto: python3 agente_inteligente.py [CODIGO_IATA]")
        print("Ejemplo: python3 agente_inteligente.py MAD")
