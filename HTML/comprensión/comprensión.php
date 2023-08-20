<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="include/css/bootstrap.min.css">
  <title>Comprensión</title>
  <link rel="stylesheet" href="../comprensión/css/style_paginas.css">
</head>
<body>
  <header>
    <h2>Ejercicios para la comprensión lectora</h2>
    <div class="search-container">
      <form method="post" action="../../DB/buscador.php">
        <input type="text" id="campo-busqueda" placeholder="Buscar..." onkeyup="realizarBusqueda()">
        <button class="search-btn" type="submit">Buscar</button>
      </form>
    </div>
  </header>
  <footer>
    <div>
      <button class="back-btn" class="footer-link" onclick="document.location='../menu/menu.html'">Regresar</button>
      <button class="add-project-btn" class="footer-link" onclick="document.location='../Sub_Datos/form.html'">Agregar ejercicio</button>
    </div>
  </footer>
  <main>
    <!-- Contenido de la página -->
  </main>
  <div id="resultado-busqueda">
    <!-- Aquí se mostrarán los resultados de búsqueda -->
  </div>
  <table id="tabla-proyectos" class="table">
    <thead class="table-dark">
      <tr>
        <th>No.Ejercicio</th>
        <th>Nombre del Ejercicio</th>
        <th>Autor y/o derechos</th>
        <th>Especialidad</th>
        <th>Documentación</th>
      </tr>
    </thead>
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
      WHERE esp.nombre_esp = 'Comprensión'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id_ejercicio"] . "</td>";
          echo "<td>" . $row["nombre_ejercicio"] . "</td>";
          echo "<td>" . $row["referencias"] . "</td>";
          echo "<td>" . $row["nombre_esp"] . "</td>";
          echo "<td><a href='" . $row["ruta_archivo"] . "' download>" . $row["ruta_archivo"] . "</a></td>";
          echo "</tr>";
        }
      }
      $conn->close();
      ?>
    </tbody>
  </table>
  <script>
function realizarBusqueda() {
    var campo = document.getElementById("campo-busqueda").value;
    var filasTabla = document.querySelectorAll("#tabla-proyectos tbody tr"); // Obtener todas las filas de la tabla
    var resultadoBusqueda = document.getElementById("resultado-busqueda"); // Obtener el contenedor de resultados

    // Iterar a través de las filas de la tabla
    for (var i = 0; i < filasTabla.length; i++) {
        var fila = filasTabla[i];
        var idEjercicio = fila.querySelector("td:nth-child(1)").textContent.toLowerCase();
        var nombreEjercicio = fila.querySelector("td:nth-child(2)").textContent.toLowerCase();
        var referencia = fila.querySelector("td:nth-child(3)").textContent.toLowerCase();
        var especialidad = fila.querySelector("td:nth-child(4)").textContent.toLowerCase();
        var url = fila.querySelector("td:nth-child(5) a").textContent.toLowerCase();

        // Comprobar si el campo de búsqueda coincide con alguna columna
        if (
            idEjercicio.includes(campo.toLowerCase()) ||
            nombreEjercicio.includes(campo.toLowerCase()) ||
            referencia.includes(campo.toLowerCase()) ||
            especialidad.includes(campo.toLowerCase()) ||
            url.includes(campo.toLowerCase())
        ) {
            fila.style.display = ""; // Mostrar la fila si coincide
        } else {
            fila.style.display = "none"; // Ocultar la fila si no coincide
        }
    }

    resultadoBusqueda.style.display = "none"; // Ocultar el contenedor de resultados vacío
}
</script>
</body>
</html>
