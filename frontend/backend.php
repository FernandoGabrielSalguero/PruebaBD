<?php
// Conectar a la base de datos
$servername = "127.0.0.1:3306";
$username = "u104036906_admin";
$password = "Helader@1";
$database = "u104036906_nombres";

// Nombre de la tabla: nombres. Esta tabla tiene 2 columnas: id y nombre.

// Intentar establecer la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Agregar un nuevo nombre
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "add") {
    // Verificar si se proporcionó un nombre
    if (isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
        $nombre = $_POST["nombre"];

        // Preparar la consulta SQL
        $stmt = $conn->prepare("INSERT INTO nombres (nombre) VALUES (?)");
        $stmt->bind_param("s", $nombre);

        // Ejecutar la consulta SQL y manejar errores
        if ($stmt->execute()) {
            echo "Nombre agregado correctamente";
        } else {
            echo "Error al agregar el nombre: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Se requiere un nombre para agregar";
    }
}

// Eliminar un nombre
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "delete") {
    // Verificar si se proporcionó un ID para eliminar
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        $id = $_POST["id"];

        // Preparar la consulta SQL
        $stmt = $conn->prepare("DELETE FROM nombres WHERE id = ?");
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta SQL y manejar errores
        if ($stmt->execute()) {
            echo "Nombre eliminado correctamente";
        } else {
            echo "Error al eliminar el nombre: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Se requiere un ID para eliminar un nombre";
    }
}

// Obtener todos los nombres
$sql = "SELECT * FROM nombres";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Mostrar la lista de nombres
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>{$row['nombre']} <form method='POST' style='display:inline;' onsubmit='return confirm(\"¿Está seguro?\");'>
                    <input type='hidden' name='action' value='delete'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button type='submit'>Eliminar</button>
                  </form></li>";
        }
        echo "</ul>";
    } else {
        echo "0 resultados";
    }
} else {
    echo "Error al obtener los nombres: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
