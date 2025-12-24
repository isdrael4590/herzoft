# Respaldo de Herzoft

## Instalación prerequisitos

```bash
sudo apt install rclone
```

## Sincronizar los datos

Por favor [configura](https://rclone.org/docs/#configure) `rclone` como muestra en el enlace.

### Sincronización con GDrive

Utiliza la configuración de SSH para configurar una computadora remota con las [instrucciones](https://rclone.org/remote_setup/#configuring-using-ssh-tunnel) cómo indica este enlace.

1. Inicia tu configuración con el comando

    ```bash
    rclone config
    ```

2. Presiona `n` para crear una nueva conexión remota
3. Añade el nombre `herzoft_respaldo`
4. Escribe `18` para iniciar la configuración de Google Drive
5. Presiona enter para que `rclone` seleccione el nombre del cliente por ti y luego enter para añadir el secreto automáticamente
6. Escribe `3` para definir la conexión solo de archivos
7. Presiona dos veces para continuar la configuración
8. Escribe `y` para iniciar la configuración
9. Seleccione `n` para no usar como unidad compartido
10. Acepta la configuración con `y` y luego `q` para indicar a rclone que la configuración está correcta
11. Crea la carpeta de respaldo con

    ```bash
    rclone mkdir herzoft_respaldo:hz_respaldos
    ```

### Sincronización con la computadora local

_Nota_: Reemplaza tu `nombre_usuario` y `/tu/carpeta/respaldo` con tus datos de preferencia

1. En tu computadora local, utiliza las instrucciones anteriores de 1 - 3 para crear una nueva conexión remota, nombrala cómo `herzoft_respaldo_local`
2. Escribe `36` para seleccionar la conexión `SSH/SFTP`
3. Escribe `45.90.220.111` para selecionar tu host
4. Añade tu `nombre_de_usuario` ahí
5. Define el puerto por defecto, en este caso `22`
6. Selecciona el tipo de autenticación
7. Escribe `true` para darle seguridad a tu cuenta
8. En tu computadora local, sincroniza tus archivos con el comando:

    ```bash
    rclone sync -P herzoft_respaldo_local:/opt/docker/backup /tu/carpeta/respaldo 
    ```

## Programar la ejecución de los servicios

1. Mueve los scripts y dales permisos de ejecución en tu carpeta local con el siguiente comando

    ```bash
    sudo cp scripts/diario.sh scripts/quincenal.sh /usr/local/bin
    sudo chmod +x /usr/local/bin/diario.sh /usr/local/bin/quincenal.sh
    source .env
    # Crea los archivos iniciales
    mkdir -p $RUTA_RESPALDO
    sudo touch /var/log/respaldo_diario.log /var/log/respaldo_quincenal.log 
    sudo chown -R $USER:$USER $RUTA_RESPALDO /var/log/respaldo_diario.log /var/log/respaldo_quincenal.log 
    ```

2. Edita en tus scripts, edita las variables `RUTA_PROYECTO` de acuerdo a la ubicación de tu proyecto

    ```bash
    sudo nano /usr/local/bin/diario.sh 
    sudo nano /usr/local/bin/quincenal.sh
    ```

3. Abre tu archivo de `crontab` para poder programar los scripts

    ```bash
    crontab -e
    ```

4. Añade las siguientes líneas al final del archivo para programar los scripts

    ```bash
    0 0 * * * /usr/local/bin/diario.sh >> /var/log/respaldo_diario.log 2>&1
    0 1 */14 * * /usr/local/bin/quincenal.sh >> /var/log/respaldo_quincenal.log 2>&1
    ```

## Restaurar

_Nota_: Usar las mismas contraseñas y `APP_KEY` que en producción

1. Parar los contenedores y volumenes

    ```bash
    docker compose -f docker-compose.prod.yml down
    ```

2. Borrar el contenedor anterior para no tener problemas

    ```bash
    docker volume rm herzoft_sail-mysql
    ```

3. Inicializar los contenedores

    ```bash
    docker compose -f docker-compose.prod.yml up nginx laravel-horizon -d --build
    ```

4. Descomprime y cargar la base de datos

    ```bash
    docker compose -f docker-compose.prod.yml exec -T mysql sh -c 'export MYSQL_PWD="$(cat "$MYSQL_ROOT_PASSWORD_FILE")";  exec mysql -u root --default-character-set=utf8mb4 --database=$MYSQL_DATABASE'   < backup/mysql_backup_reemplaza_el_nombre_de_tu_sql.sql
    ```
