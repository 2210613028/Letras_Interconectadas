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

$especialidad = "Redacción"; // Especificar la especialidad a filtrar

// Crear la consulta SQL para obtener los datos de la vista
$sql = "
SELECT 
    e.id_ejercicio,
    e.nombre AS nombre_ejercicio,
    e.referencias,
    esp.nombre_esp AS nombre_esp,
    a.url AS ruta_archivo
FROM ejercicios AS e
JOIN especialidad AS esp ON e.id_especialidad = esp.id_especialidad
JOIN archivos AS a ON e.id_archivo = a.id_archivo
WHERE esp.nombre_esp = 'Redacción';"; // Filtrar por la especialidad seleccionada

$result = $conn->query($sql);
?>