<?php
// Lee los datos del archivo de texto
$filename = "datoss.txt"; // El nombre del archivo de donde va a leer los datos es "datoss.txt"

//  la función "file()" para leer todo el contenido del archivo que tenemos
// "FILE_IGNORE_NEW_LINES" elimina los saltos de linea al final de cada linea
// 'FILE_SKIP_EMPTY_LINES' ignora cualquier linea vacia en el archivo para evitar errores 
$datos_texto = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if ($datos_texto === false) { //devuelve un false por si acaso hay un error de leer archivo 
    die("Error al leer el archivo.");
}



// esta parte asignamos Los datos y deben estar en el orden: nombre, apellidos, DNI, usuario, contraseña
$data = array(
	// Asignamos la primera linea del archivo (nombre) al campo 'nombre' del array
    // 'trim()' para eliminar espacios en blanco alrededor del texto
    "nombre" => trim($datos_texto[0]),
    "apellidos" => trim($datos_texto[1]),// Asignamos la tercera linea del archivo (apellido) al campo 'apellido' del array
    "dni" => trim($datos_texto[2]),
    "usuario" => trim($datos_texto[3]),
    "password" => trim($datos_texto[4])
);







// Inicializa cURL para enviar los datos al servidor
$handle = curl_init("http://localhost/rest/servidor.php");
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

// Ejecuta la solicitud cURL y cierra
$response = curl_exec($handle);
curl_close($handle);

// Mostrar la respuesta del servidor
echo "Respuesta del servidor:\n";

// Decodifica la respuesta JSON que ha enviado el servidor y la muestra en pantalla
var_dump(json_decode($response));
?>
