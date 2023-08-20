<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hackaton';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $referencias = $_POST["referencias"];
    $especialidad = $_POST["especialidad"];

    // Subir el archivo a la carpeta "Archivos"
    $archivo_nombre_original = $_FILES["archivo"]["name"]; // Usar el nombre original del archivo
    $archivo_extension = strtolower(pathinfo($archivo_nombre_original, PATHINFO_EXTENSION));
    $archivo_nombre_final = $archivo_nombre_original; // Usar el nombre original como nombre final
    $archivo_tmp = $_FILES["archivo"]["tmp_name"];
    $carpeta_destino = "C:/xampp/htdocs/Hackaton/Archivos/";

    // Verificar extensiones permitidas
    $extensiones_permitidas = array("pdf", "rar");
    if (!in_array($archivo_extension, $extensiones_permitidas)) {
        echo "<script>alert('Tipo de archivo no permitido. Solo se permiten archivos PDF y RAR.'); window.history.back();</script>";
    } else {
        if (move_uploaded_file($archivo_tmp, $carpeta_destino . $archivo_nombre_final)) {
            // Insertar nombre de archivo en la tabla archivos
            $sql_insert_archivo = "INSERT INTO archivos (url) VALUES ('$archivo_nombre_original')";
            if ($conn->query($sql_insert_archivo) !== TRUE) {
                echo "Error al insertar nombre de archivo: " . $conn->error;
            }

            // Obtener el ID del archivo insertado
            $id_archivo_insertado = $conn->insert_id;

            // Insertar datos en la tabla de ejercicios
            $sql_insert_ejercicio = "INSERT INTO ejercicios (nombre, referencias, id_archivo, id_especialidad) VALUES ('$nombre', '$referencias', '$id_archivo_insertado', '$especialidad')";
            if ($conn->query($sql_insert_ejercicio) !== TRUE) {
                echo "Error al insertar ejercicio: " . $conn->error;
            } else {
                // Ejercicio subido exitosamente
                echo "<script>alert('¡Nuevo ejercicio registrado exitosamente!'); window.location.replace('../comprensión/comprensión.php');</script>";
            }
        } else {
            echo "Error al cargar el archivo.<br>";
        }
    }
}

$conn->close();
?>
