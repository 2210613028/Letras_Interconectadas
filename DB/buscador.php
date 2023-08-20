<tbody>
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

    $campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : '';

    // Crear la consulta SQL para obtener los datos de la vista
    $sql = "
    SELECT 
        e.id_ejercicio,
        e.nombre,
        e.referencias,
        esp.nombre_esp AS especialidad,
        a.url
    FROM ejercicios AS e
    JOIN especialidad AS esp ON e.id_especialidad = esp.id_especialidad
    JOIN archivos AS a ON e.id_archivo = a.id_archivo
    WHERE e.id_ejercicio LIKE '%$campo%'
        OR e.nombre LIKE '%$campo%'
        OR e.referencias LIKE '%$campo%'
        OR esp.nombre_esp LIKE '%$campo%'
        OR a.url LIKE '%$campo%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_ejercicio"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["referencias"] . "</td>";
            echo "<td>" . $row["especialidad"] . "</td>";
            echo "<td><a href='" . $row["url"] . "' download>" . $row["url"] . "</a></td>";
            echo "</tr>";
        }
    } else {
        echo '<tr>';
        echo '<td colspan="5">Sin Resultados</td>';
        echo '</tr>';
    }
    $conn->close();
    ?>
</tbody>
