<?php
// Conectar a la base de datos
$servername = "127.0.0.1:3306";
$username = "u104036906_admin";
$password = "Helader@1a";
$database = "u104036906_nombres";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Agregar un nuevo nombre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];

    $sql = "INSERT INTO nombres (nombre) VALUES ('$nombre')";
    if ($conn->query($sql) === TRUE) {
        echo "Nombre agregado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todos los nombres
$sql = "SELECT * FROM nombres";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li>{$row['nombre']} <button onclick=\"eliminarNombre({$row['id']})\">Eliminar</button></li>";
    }
} else {
    echo "0 resultados";
}

// Eliminar un nombre
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $id = $_GET["id"];

    $sql = "DELETE FROM nombres WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Nombre eliminado correctamente";
    } else {
        echo "Error al eliminar el nombre: " . $conn->error;
    }
}

$conn->close();
?>
