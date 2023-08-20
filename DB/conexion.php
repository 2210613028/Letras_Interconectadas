<?php
    // session_start();
    // if (isset($_SESSION['nombre'])){
    //       $cliente = $_SESSION['nombre'];
    // } else {
    //     header('Location: ../index.php');
    //     die() ;
    // }
    $servername='localhost';
    $username='root';
    $password='';
    $dbname='hackaton';
    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
      die('No se pudo conectar a MySQL, revisar que la BD esté activa...');            
    } /* aqui guardamos en variables los valores con los que haremos la coneccion a la base de datos */
?>  
