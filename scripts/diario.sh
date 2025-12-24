#!/bin/bash
# Script para realizar un respaldo de la base de datos MySQL en un contenedor Docker

# Configurar de acuerdo a la ubicación de tu proyecto sin el / final
RUTA_PROYECTO="/opt/docker/herzoft"

# Configuracion
FECHA=$(date +"%Y_%m_%d_%H_%M_%S")
NOMBRE_ARCHIVO="mysql_backup_$FECHA.sql"
NOMBRE_ZIP="$NOMBRE_ARCHIVO.zip"
NOMBRE_CONTENEDOR="herzoft-mysql-1"
ARCHIVO_CONTRASENA="$RUTA_PROYECTO/database/credenciales/user_password.txt"
DIAS_GUARDAR_ARCHIVOS=45

# Previene que se enmascare errores
set -euo pipefail
# Carga las variables del archivo .env
source $RUTA_PROYECTO/.env
echo "Tratando de guardar $FECHA"
# Lee la contraseña del archivo secreto
MYSQL_PASSWORD=$(<"$ARCHIVO_CONTRASENA")
# Crea el directorio de respaldo sino existe
mkdir -p "$RUTA_RESPALDO"
echo "Obtener respaldo del usuario $DB_USERNAME y base de datos $DB_DATABASE"
# Guardar base de datos
docker exec "$NOMBRE_CONTENEDOR" /usr/bin/mysqldump -u"$DB_USERNAME" -p"$MYSQL_PASSWORD" "$DB_DATABASE" > "$NOMBRE_ARCHIVO"

echo "Comprimir el respaldo con el password..."
zip -P "$CONTRASENA_RESPALDO" "$RUTA_RESPALDO/$NOMBRE_ZIP" "$NOMBRE_ARCHIVO" >/dev/null

# Eliminar el archivo SQL sin comprimir
rm -f "$NOMBRE_ARCHIVO"

echo "Eliminando archivos más viejos que $DIAS_GUARDAR_ARCHIVOS días..."
find "$RUTA_RESPALDO" -type f -name "*.zip" -mtime +$DIAS_GUARDAR_ARCHIVOS -delete

echo "Respaldo completado"
