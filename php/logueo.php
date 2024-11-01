<?php
require_once 'encabezado.php';
require 'conexion.php';

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    

    $usuario = $_POST['username'];
    $pass1 = sha1($_POST['password']);

    $conexion = conectar();

    if ($conexion) {
        $recupero = 'SELECT usuario,pass,foto FROM usuario';
        $sentencia = mysqli_prepare($conexion,$recupero);

        
        mysqli_execute($sentencia);
        mysqli_stmt_bind_result($sentencia, $user, $pass2,$foto);

        while (mysqli_stmt_fetch($sentencia)) {
            if ($usuario === $user && $pass1 === $pass2) {
                header("refresh:0;url=articulo_listado.php?usu=".$user."&pass=".$pass2."&img=".$foto);
            }    
        }             
    }
    desconectar($conexion);
}

else {
    echo '<p>Faltan datos. Reintente nuevamente.</p>';
}

require_once 'pie.php';
?>