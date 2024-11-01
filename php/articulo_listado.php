<?php
    $ruta = '../';
    require_once "encabezado.php";
    require "conexion.php";
?>
<header class="d-flex flex-row justify-content-between">
        
        <h1>Bienvenido/a</h1>

        <section class="d-flex flex-row">
        <?php 
            
            if (!empty($_GET['usu']) && !empty($_GET['pass'])) {
                
                $usuario = $_GET['usu'];
                $foto = $_GET['img'];

                if ($foto == "") {
                    echo '<p><strong>'.$usuario.'</strong></p>';
                    echo '<img src=../img/usuarios/usuario_default.png>';
                    
                    
                }

                else {
                    echo '<img src=../img/usuarios/'.$foto.'>';
                    echo '<p class="m-2"><strong>'.$usuario.'</strong></p>';
                }
                
            }
            

        ?>
        </section>
</header>
<main class="container">
    <section>
        <article class="row text-center">
            <section class="menu_tmp pt-3 pb-3">
                <a class="btn btn-dark" href="articulo_alta.php">+ Alta Articulo</a>
            </section>
            <section class="d-flex justify-content-center">
                <table class="table table-bordered table-hover table-striped w-auto">
                    <caption class="caption-top text-center bg-dark text-white">Listado de articulos</caption>
                    <tr>
                        <th class="bg-secondary text-white">Foto</th>
                        <th class="bg-secondary text-white">Producto</th>
                        <th class="bg-secondary text-white">Categoria</th>
                        <th class="bg-secondary text-white">Precio</th>
                        <th class="bg-secondary text-white">Modificar</th>
                        <th class="bg-secondary text-white">Eliminar</th>
                    </tr>
                    
                    <?php
                        $conexion = conectar();

                        if ($conexion) {  
                          $peticion = 'SELECT id_articulo,nombre,categoria,precio,foto FROM articulo';
                          $sentencia = mysqli_prepare($conexion,$peticion);

                          mysqli_execute($sentencia);
                          mysqli_stmt_bind_result($sentencia,$id,$nombre,$cat,$precio,$foto);

                          echo '<tr>';
                          while (mysqli_stmt_fetch($sentencia)) {
                               if ($foto == '') {
                                   echo '<td><img src=../img/articulos/sin_imagen.png></td><td>'.$nombre.'</td><td>'.$cat.'</td><td>$ '.number_format($precio,2,",",".").'</td>';
                               }

                               else {
                                   echo '<td><img src=../img/articulos/'.$foto.'></td><td>'.$nombre.'</td><td>'.$cat.'</td><td>$ '.number_format($precio,2,",",".").'</td>';
                               }
                               
                               echo '<td><a href=modificar.php><img src=../img/modificar.png></a></td><td><a href=eliminar.php?id='.$id.'><img src=../img/eliminar.png></a></td></tr><tr>';
                           }
                           echo '</tr>';

                            desconectar($conexion);
                        }
                    ?>
                </table>
            </section>
        </article>
    </section>
</main>

<?php
    require("pie.php");
?>