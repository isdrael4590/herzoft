<picture>
    <source srcset="public/images/LOGOHERZ.jpg"  
            media="(prefers-color-scheme: dark)">
    <img src="public/images/LOGOHERZ.jpg" alt="App Logo">
</picture>


## Instalación

1. Instale Docker Engine para su plataforma como se explica en el siguiente [link](https://docs.docker.com/engine/install/)
2. Clone los archivos de este repositorio, por ejemplo con `git clone git@github.com:isdrael4590/herzoft.git`
3. Instale las dependencias de software necesarias para correr el proyecto, por ejemplo para Ubuntu:

    ```bash
    sudo apt update && sudo apt install composer php php-curl php-dom php-gd php-zip
    ```
4. Para iniciar con las opciones de desarrollo o correr los contenedores, instale las dependencias de PHP proyecto a través del siguiente comando:

    ```bash
    composer update
    ```
5. Los contenedores utilizan [variables de entorno](https://docs.docker.com/compose/environment-variables/set-environment-variables/) para establecer valores globales de funcionamiento, en la primera configuración, por favor haga una copia del archivo `.env.example` y renombrelo como `.env` y editelo si es necesario, un ejemplo como se hace en Linux sería de la siguiente forma:

    ```bash
    cp .env.example .env
    ```
6. Las contraseñas de MySQL son almacenadas a través de [Docker secrets](`https://docs.docker.com/compose/use-secrets/`) por seguridad. Antes de iniciar el programa, es necesario crear dos archivos en la carpeta `database/credenciales` llamados `root_password.txt` y `user_password.txt` para establecer las constraseñas de MySQL, use cualquier editor de texto para realizar esta tarea o con el siguiente comando en Linux.

    ```bash
    mkdir database/credenciales
    echo ejemplo_contraseña_root_secreto > database/credenciales/root_password.txt
    echo ejemplo_contraseña_user_secreto > database/credenciales/user_password.txt
    ```

7. El proyecto utiliza la herramienta [sail](https://laravel.com/docs/8.x/sail) de Laravel para gestionar los contenedores, para iniciar el desarollo, inice los contenedores con el siguiente comando:

    ```bash
    sudo chown -R $USER: .
    ./vendor/bin/sail up -d
    ./vendor/bin/sail artisan up
    # En otro terminal
    ./vendor/bin/sail artisan key:generate 
    ./vendor/bin/sail artisan migrate --seed 
    ./vendor/bin/sail artisan storage:link 
    ```

8. Para inicializar las bases de datos por primera vez, se recomienda utilizar el comando `./vendor/bin/sail artisan migrate:fresh --seed`
9. El proyecto correrá y estará disponible en la dirección [http://localhost](http://localhost)

> **Important Note:** "herZoft" uses Laravel Snappy Package for PDFs. If you are using Linux then no configuration is needed. But in other Operating Systems please refer to [Laravel Snappy Documentation](https://github.com/barryvdh/laravel-snappy).

# Admin Credentials
> Email: ferisdra@hotmail.com || Password: 12345678

## Demo

Features



# License
