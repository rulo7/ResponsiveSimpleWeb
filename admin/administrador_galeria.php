<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Administrador galeria</title>
        <script>
            function confirmar() {
                if (confirm('Estas seguro de que quieres borrar?'))
                    return true;
                else
                    return false;
            }
        </script>
    </head>

    <body>

        <article>
            <?php
            include_once ("../Galeria_Y_Noticias/model/DAOGalery.php");
            include_once ("../Galeria_Y_Noticias/model/DAOContents.php");
            session_start();
            if (isset($_SESSION['admin'])) {

                $imagenes = Galery::getInstance()->getGalery("all");
                $ruta = "../Galeria_Y_Noticias/galeria/";

                switch ($_REQUEST['operacion']) {
                    case 'eliminar_fotos' :
                        echo "<h2>Selecciona la foto que deseas eliminar<h2>";
                        while ($img = mysql_fetch_assoc($imagenes)) {

                            echo "<a onclick='return confirmar()' href='administrador_galeria.php?operacion=eliminar&nombre=" . $img['nombre_archivo'] . "'><img style='margin:1%' width='150px' src='" . $ruta . $img['nombre_archivo'] . "'/></a>";
                        }

                        break;
                    case 'insertar_fotos' :

                        echo "
								<form name='formu' action='administrador_galeria.php?operacion=insertar' method='post' enctype='multipart/form-data'>
								<p><input type='file' name='archivo' /></p>
								<p><label>Descripcion: </label><input maxlength='50' size='50' type='text' name='descripcion'/></p>
								<p><input type='submit' value='Enviar' id='envia' name='envia' /></p>
								</form>";


                        $imagenes = Galery::getInstance()->getGalery("all");
                        $ruta = "../Galeria_Y_Noticias/galeria/";

                        while ($img = mysql_fetch_assoc($imagenes)) {
                            echo "<a href='" . $ruta . $img['nombre_archivo'] . "'><img width='150px' src='" . $ruta . $img['nombre_archivo'] . "'/></a>";
                        }

                        break;

                    case 'insertar' :
                        // obtenemos los datos del archivo
                        $tipo = $_FILES['archivo']['type'];
                        $archivo = $_FILES['archivo']['name'];
                        $prefijo = substr(md5(uniqid(rand())), 0, 6);

                        if ($archivo != "") {
                            // guardamos el archivo a la carpeta files
                            $destino = "../Galeria_Y_Noticias/galeria/" . $prefijo . "_" . $archivo;
                            $nombre_archivo_bdd = $prefijo . "_" . $archivo;

                            if (copy($_FILES['archivo']['tmp_name'], $destino)) {
                                echo 'El archivo se subio con el nombre de ' . $nombre_archivo_bdd . '<BR>';
                                echo 'La direccion completa es: ' . $destino;

                                Galery::getInstance()->insert($nombre_archivo_bdd, $_REQUEST['descripcion']);

                                header('Location: administrador_galeria.php?operacion=insertar_fotos');
                            } else {
                                echo 'Error al cargar el archivo';
                            }
                        }
                        break;

                    case 'eliminar' :
                        unlink("../Galeria_Y_Noticias/galeria/" . $_REQUEST['nombre']);
                        Galery::getInstance()->delete($_REQUEST['nombre']);
                        header('Location: administrador_galeria.php?operacion=eliminar_fotos');

                        break;
                }

                echo "<p><a href='panel_admin.php'>Volver</a></p>";
            } else {
                header('Location: panel_admin.php');
            }
            ?>
        </article>

        <footer>
        </footer>
    </body>
</html>