# PHP cURL Client-Server Architecture

Este repositorio implementa una arquitectura cliente-servidor utilizando cURL y PHP. El cliente envía datos de una persona (nombre, apellidos, DNI, usuario y contraseña) que son leídos desde un archivo de texto y luego se insertan en una base de datos MySQL en el servidor.

## Descripción

El proyecto está dividido en dos partes:

1. **Cliente (client.php)**: 
   - Lee los datos de un archivo de texto (`datoss.txt`).
   - Usa cURL para enviar los datos al servidor.
   - Muestra la respuesta del servidor.

2. **Servidor (servidor.php)**:
   - Recibe los datos enviados por el cliente.
   - Inserta los datos en una base de datos MySQL (`ines_base_datos`).
   - Devuelve una respuesta en formato JSON indicando si los datos se han insertado correctamente o si ha ocurrido un error.

## Requisitos

- **PHP**: Asegúrate de tener PHP instalado en tu sistema.
- **MySQL**: Necesitarás una base de datos MySQL para almacenar los datos.
- **cURL**: PHP debe tener la extensión cURL habilitada para enviar solicitudes al servidor.

## Instrucciones

### 1. Configuración del servidor:

1. Clona este repositorio a tu máquina local.
2. Asegúrate de tener MySQL corriendo en tu sistema.
3. Configura las credenciales de MySQL en el archivo `servidor.php` si es necesario (por defecto: `localhost`, `root`, `""`).
4. Ejecuta el servidor en un entorno compatible con PHP (por ejemplo, utilizando un servidor web local como Apache o Nginx).
   
### 2. Configuración del cliente:

1. Crea un archivo de texto llamado `datoss.txt` en la misma carpeta donde se encuentra el archivo `client.php`.
2. Asegúrate de que el archivo `datoss.txt` contenga los datos en el siguiente formato:



3. Ejecuta el script `client.php` para enviar los datos al servidor.

### 3. Ejecución:

Para ejecutar el proyecto, abre una terminal y navega hasta el directorio donde se encuentran los archivos `client.php` y `servidor.php`. Luego, accede al archivo `client.php` a través de tu navegador o usando el comando CLI de PHP:

```bash
php -S localhost:8000 client.php
