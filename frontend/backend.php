<?php
// Conectar a la base de datos
$servername = "127.0.0.1:3306";
$username = "u104036906_admin";
$password = "Helader@1";
$database = "u104036906_nombres";

// Intentar establecer la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    // Mostrar mensaje de error y finalizar el script
    die("Error de conexión: " . $conn->connect_error);
}

// Agregar un nuevo nombre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se proporcionó un nombre
    if (isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
        $nombre = $_POST["nombre"];

        // Preparar la consulta SQL
        $sql = "INSERT INTO nombres (nombre) VALUES ('$nombre')";

        // Ejecutar la consulta SQL y manejar errores
        if ($conn->query($sql) === TRUE) {
            echo "Nombre agregado correctamente";
        } else {
            echo "Error al agregar el nombre: " . $conn->error;
        }
    } else {
        // Mostrar mensaje de error si no se proporcionó un nombre
        echo "Error: Se requiere un nombre para agregar";
    }
}

// Obtener todos los nombres
$sql = "SELECT * FROM nombres";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result) {
    if ($result->num_rows > 0) {
        // Mostrar la lista de nombres
        while($row = $result->fetch_assoc()) {
            echo "<li>{$row['nombre']} <button onclick=\"eliminarNombre({$row['id']})\">Eliminar</button></li>";
        }
    } else {
        // Mostrar mensaje si no se encontraron resultados
        echo "0 resultados";
    }
} else {
    // Mostrar mensaje de error si hubo un error en la consulta
    echo "Error al obtener los nombres: " . $conn->error;
}

// Eliminar un nombre
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Verificar si se proporcionó un ID para eliminar
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];

        // Preparar la consulta SQL
        $sql = "DELETE FROM nombres WHERE id=$id";

        // Ejecutar la consulta SQL y manejar errores
        if ($conn->query($sql) === TRUE) {
            echo "Nombre eliminado correctamente";
        } else {
            echo "Error al eliminar el nombre: " . $conn->error;
        }
    } else {
        // Mostrar mensaje de error si no se proporcionó un ID para eliminar
        echo "Error: Se requiere un ID para eliminar un nombre";
    }
}

// Cerrar la conexión
$conn->close();
