<?php
// Conexion a la base de datos MySQL
$servername = "localhost";
$username = "root"; 
$password = ""; 


// Creamos una nueva instancia de 'mysqli' que se encarga de gestionar la conexión a la base de datos
// Se pasan como parámetros el servidor, el nombre de usuario y la contraseña



// Crear conexion
// Creamos una nueva instancia de mysqli que se encarga de gestionar la conexion a la base de datos
// Se pasan como parametros el servidor, el nombre de usuario y la contrasena si hay
$conn = new mysqli($servername, $username, $password);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// parte para crear la base de datos si no existe
$dbname = "ines_base_datos";   // el nombre de la base de datos que nos vamos a crear
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";//  crear la base de datos si no existe
// Ejecutar la consulta de creacion de la base de datos
if ($conn->query($sql) === FALSE) {
    die("Error al crear la base de datos: " . $conn->error);//aqui mostramos mensaje de error si hay una problema de crear la base 
}


$conn->select_db($dbname); // para seleccionar la base de datos

// Crear la tabla de datos si no existe
$sql = "CREATE TABLE IF NOT EXISTS personas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    dni VARCHAR(9) NOT NULL,
    usuario VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL
)";



if ($conn->query($sql) === FALSE) {
    die("Error al crear la tabla: " . $conn->error);//mensaje de error  si hay una problema de crear la tabla 
}

// Recibir y decodificar los datos JSON enviados por el cliente
$datos = json_decode(file_get_contents('php://input'), true);

if ($datos) {
    // Escapar los datos para prevenir inyecciones SQL
    $nombre = $conn->real_escape_string($datos["nombre"]);
    // Se hace lo mismo que con el nombre para asegurar que la entrada de apellidos sea segura
    $apellidos = $conn->real_escape_string($datos["apellidos"]);
    $dni = $conn->real_escape_string($datos["dni"]);
    $usuario = $conn->real_escape_string($datos["usuario"]);
    $password = $conn->real_escape_string($datos["password"]);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO personas (nombre, apellidos, dni, usuario, password) 
            VALUES ('$nombre', '$apellidos', '$dni', '$usuario', '$password')";

   



if ($conn->query($sql) === TRUE) {
        // Respuesta en caso de éxito
        $response = array("response" => 200, "texto" => "Datos insertados correctamente");
    } else {
        // Respuesta en caso de error
        $response = array("response" => 500, "texto" => "Error al insertar datos: " . $conn->error);
    }
} else {
    // Respuesta en caso de no recibir datos válidos
    $response = array("response" => 400, "texto" => "Datos no válidos");
}






// Cerrar la conexión
$conn->close();

// Devolver la respuesta al cliente
echo json_encode($response);
?>
