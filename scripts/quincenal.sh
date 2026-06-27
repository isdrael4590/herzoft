#!/bin/bash
# Script para subir los archivos a GDrive
# Configurar de acuerdo a la ubicación de tu proyecto sin el / final
RUTA_PROYECTO="/opt/docker/herzoft"

CARPETA_REMOTA="herzoft_respaldo:hz_respaldos"
ANHO="$(date +%Y)"
MES="$(date +%m)"
RUTA_REMOTA="${CARPETA_REMOTA}/${ANHO}/${MES}"

# Previene que se enmascare errores
set -euo pipefail
# Carga las variables del archivo .env
# shellcheck source=/dev/null
source "$RUTA_PROYECTO/.env"

echo "Subiendo archivos de respaldo a GDrive en la ruta $RUTA_REMOTA ..."
rclone mkdir "$RUTA_REMOTA" || true

echo "Selecionando el archivo más reciente..."
ARCHIVO_RECIENTE=""
for archivo in "$RUTA_RESPALDO"/*.zip; do
	# Si no existen archivos .zip, el bucle podría tomar el string literal '*.zip', lo controlamos aquí:
	[[ -e "$archivo" ]] || break
	# Compara si este archivo es más reciente (-nt = newer than) que el guardado previamente
	[[ -z "$ARCHIVO_RECIENTE" || "$archivo" -nt "$ARCHIVO_RECIENTE" ]] && ARCHIVO_RECIENTE="$archivo"
done
echo "Archivo seleccionado: $ARCHIVO_RECIENTE"

if [ -z "$ARCHIVO_RECIENTE" ]; then
	echo "[ERROR] No hay archivos de respaldo para subir."
	exit 1
fi

echo "Subiendo $ARCHIVO_RECIENTE a GDrive..."
rclone copy "$ARCHIVO_RECIENTE" "$RUTA_REMOTA" --progress

echo "Subida completada."
