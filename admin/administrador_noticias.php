<!DOCTYPE html>
<html>
    <head>
        <title>Administrador de noticias</title>
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
            include_once ("../Galeria_Y_Noticias/model/connection/FactoryConnection.php");
            include_once ("../Galeria_Y_Noticias/model/DAOContents.php");

            session_start();
            $connection = FactoryConnection::getInstance()->getConnection('MySQL');
            if (isset($_SESSION['admin'])) {

                switch ($_REQUEST['operacion']) {

                    case 'insertar_noticia' :
                        echo "
			<form action='administrador_noticias.php?operacion=insertar' method='POST' enctype='multipart/form-data'>
			<p><input type='text' name='fecha' value='" . date("d/m/Y") . "' size='8'/></p>
			<p><label>TITULAR*</label></p>
			<p><input size='100' maxlength='150' type='text' name='titular' placeholder='titular...'/></p>
			<p>IMAGEN (no es necesario)</p>
			<p><input type='file' name='archivo'/></p>
			<p><label>NOTICIA*</label></p>
			<p><textarea rows='20'cols='75' maxlength='1500' name='noticia' placeholder='noticia...'></textarea></p>
			<p><input type='submit' value='crear noticia'/></p>			
			</form>	
			";

                        break;

                    case 'eliminar_noticia' :
                        $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);
                        $query = "SELECT * FROM `noticias` ORDER BY id DESC";
                        $result = $connection->execute($query);
                        $connection->disconnect($link);

                        while ($titular = mysql_fetch_assoc($result)) {
                            echo "<p><a onclick='return confirmar()' href='administrador_noticias.php?operacion=eliminar&id=" . $titular['id'] . "'>" . $titular['titular'] . " (" . DAOContents::getInstance()->cambiaf_a_normal($titular['fecha']) . ")</a></p>";
                        }

                        break;

                    case 'editar_noticias' :
                        $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);
                        $query = "SELECT * FROM `noticias` ORDER BY id DESC";
                        $result = $connection->execute($query);
                        $connection->disconnect($link);

                        while ($titular = mysql_fetch_assoc($result)) {
                            echo "<p><a href='administrador_noticias.php?operacion=editar_noticia&id=" . $titular['id'] . "'>" . $titular['titular'] . "(" . DAOContents::getInstance()->cambiaf_a_normal($titular['fecha']) . ")</a></p>";
                        }

                        break;

                    case 'editar_noticia' :
                        $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);
                        $query = "SELECT * FROM `noticias` WHERE id='" . $_REQUEST['id'] . "'";
                        $result = $connection->execute($query);
                        $connection->disconnect($link);

                        $fila = mysql_fetch_assoc($result);

                        echo "
			<form action='administrador_noticias.php?operacion=editar&id=" . $_REQUEST['id'] . "' method='POST' enctype='multipart/form-data'>
			<p><label>TITULAR*</label></p>
			<p><input size='100' maxlength='150' type='text' name='titular' value='" . $fila['titular'] . "'/></p>
			<p><label>FECHA </label><input type='text' name='fecha' size='8' value='" . DAOContents::getInstance()->cambiaf_a_normal($fila['fecha']) . "'/>*</p>
			<p>IMAGEN (sustituye la imagen que hubiera si existiese)</p>
			<p><img style='width:15%;' src='../Galeria_Y_Noticias/galeria/noticias/" . $fila['imagen'] . "'></p>
			<p><style='width: 25%;' img src='../Galeria_Y_Noticias/galeria/noticias/" . $fila['imagen'] . "'></p>
			<p><input type='file' name='archivo'/></p>
			<p><label>NOTICIA*</label></p>
			<p><textarea rows='20'cols='75' maxlength='1500' name='noticia'>" . $fila['noticia'] . "</textarea></p>
			<p><input type='submit' value='editar noticia'/></p>			
			</form>	
			";
                        break;

                    case 'insertar' :

                        // obtenemos los datos del archivo
                        $tipo = $_FILES['archivo']['type'];
                        $archivo = $_FILES['archivo']['name'];
                        $prefijo = substr(md5(uniqid(rand())), 0, 6);

                        if ($archivo != "") {

                            unlink('../Galeria_Y_Noticias/galeria/noticias/' . $fila['imagen']);

                            // guardamos el archivo a la carpeta files
                            $destino = "../Galeria_Y_Noticias/galeria/noticias/" . $prefijo . "_" . $archivo;
                            $nombre_archivo_bdd = $prefijo . "_" . $archivo;

                            if (copy($_FILES['archivo']['tmp_name'], $destino)) {

                                $query = "INSERT INTO `noticias`(`fecha`, `titular`, `noticia`, `imagen`) VALUES ('" . DAOContents::getInstance()->cambiaf_a_mysql($_REQUEST['fecha']) . "','" . $_REQUEST['titular'] . "','" . $_REQUEST['noticia'] . "','" . $nombre_archivo_bdd . "')";
                            } else {
                                echo "error con la imagen";
                            }
                        } else {
                            $query = "INSERT INTO `noticias`(`fecha`, `titular`, `noticia`) VALUES ('" . DAOContents::getInstance()->cambiaf_a_mysql($_REQUEST['fecha']) . "','" . $_REQUEST['titular'] . "','" . $_REQUEST['noticia'] . "')";
                        }

                        $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);
                        $result = $connection->execute($query);
                        $connection->disconnect($link);
                        header('Location: panel_admin.php');
                        break;

                    case 'eliminar' :
                        $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);
                        $query = "SELECT * FROM `noticias` WHERE id='" . $_REQUEST['id'] . "'";
                        $result = $connection->execute($query);
                        $connection->disconnect($link);

                        $fila = mysql_fetch_assoc($result);
                        unlink('../Galeria_Y_Noticias/galeria/noticias/' . $fila['imagen']);

                        $query = "DELETE FROM `noticias` WHERE id='" . $_REQUEST['id'] . "'";

                        $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);
                        $result = $connection->execute($query);
                        $connection->disconnect($link);
                        header('Location: administrador_noticias.php?operacion=eliminar_noticia');
                        break;

                    case 'editar' :

                        // obtenemos los datos del archivo
                        $tipo = $_FILES['archivo']['type'];
                        $archivo = $_FILES['archivo']['name'];
                        $prefijo = substr(md5(uniqid(rand())), 0, 6);

                        if ($archivo != "") {
                            $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);
                            $query = "SELECT * FROM `noticias` WHERE id='" . $_REQUEST['id'] . "'";
                            $result = $connection->execute($query);
                            $connection->disconnect($link);

                            $fila = mysql_fetch_assoc($result);
                            unlink('../Galeria_Y_Noticias/galeria/noticias/' . $fila['imagen']);

                            // guardamos el archivo a la carpeta files
                            $destino = "../Galeria_Y_Noticias/galeria/noticias/" . $prefijo . "_" . $archivo;
                            $nombre_archivo_bdd = $prefijo . "_" . $archivo;

                            if (copy($_FILES['archivo']['tmp_name'], $destino)) {

                                $query = "UPDATE `noticias` SET `fecha`='" . DAOContents::getInstance()->cambiaf_a_mysql($_REQUEST['fecha']) . "',`titular`='" . $_REQUEST['titular'] . "',`noticia`='" . $_REQUEST['noticia'] . "',`imagen`='" . $nombre_archivo_bdd . "' WHERE `id`=" . $_REQUEST['id'];
                            } else {
                                echo "error con la imagen";
                            }
                        } else {
                            $query = "UPDATE `noticias` SET `fecha`='" . DAOContents::getInstance()->cambiaf_a_mysql($_REQUEST['fecha']) . "',`titular`='" . $_REQUEST['titular'] . "',`noticia`='" . $_REQUEST['noticia'] . "' WHERE `id`=" . $_REQUEST['id'];
                        }

                        $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);
                        $result = $connection->execute($query);
                        $connection->disconnect($link);
                        header('Location: administrador_noticias.php?operacion=editar_noticias');
                        break;
                }

                echo "<h2><a href='panel_admin.php'>Volver</a></h2>";
            } else {
                echo "Acceso restringido";
            }
            ?>

        </article>

        <footer>
        </footer>
    </body>
</html>