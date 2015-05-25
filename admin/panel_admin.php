<!DOCTYPE html>
<html>
    <head>
        <title>Panel administracion</title>
    </head>

    <body>
        <article>
            <h1>PANEL DE ADMINISTRACION</h1>

            <?php
            include_once ("../Galeria_Y_Noticias/model/connection/FactoryConnection.php");
            include_once ("../Galeria_Y_Noticias/model/DAOContents.php");
            session_start();

            $connection = FactoryConnection::getInstance()->getConnection('MySQL');

            if (isset($_REQUEST['logout'])) {
                session_destroy();
                header("Location: panel_admin.php");
            } else if (isset($_SESSION['admin'])) {

                $query = "SELECT `password` FROM `passwords` WHERE  `password`='" . $_SESSION['admin'] . "'";
                $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);

                $result = $connection->execute($query);

                $connection->disconnect($link);

                if (mysql_num_rows($result) >= 1) {
                    ?>
                    <!--//////////////////////////////PANEL DE CONTROL//////////////////////-->

                    <p>
                        <a href='administrador_noticias.php?operacion=insertar_noticia'><h2>INSERTAR NUEVA NOTICIAS</h2></a>
                    </p>
                    <p>
                        <a href='administrador_noticias.php?operacion=eliminar_noticia'><h2>ELIMINAR NOTICIA</h2></a>
                    </p>
                    <p>
                        <a href='administrador_noticias.php?operacion=editar_noticias'><h2>EDITAR NOTICIAS</h2></a>
                    </p>
                    <p>
                        <a href='administrador_galeria.php?operacion=eliminar_fotos'><h2>ELIMINAR IMAGENES DE LA GALERIA</h2></a>
                    </p>
                    <p>
                        <a href='administrador_galeria.php?operacion=insertar_fotos'><h2>INSERTAR IMAGENES EN LA GALERIA</h2></a>
                    </p>
                    <p>
                        <a href='administrador_password.php'><h2>EDITAR PASSWORD</h2></a>
                    </p>
                    <p>
                        <a href='panel_admin.php?logout=true'>Cerrar sesion</a>
                    </p>
                    <!--//////////////////////////////FIN DEL PANEL DE CONTROL//////////////////////-->

                    <?PHP
                } else {
                    session_destroy();
                    echo "Acceso restringido";
                    header("Location: panel_admin.php");
                }
            } else if (isset($_REQUEST['password'])) {

                $psswd = mysql_real_escape_string($_REQUEST['password']);

                $query = "SELECT `password` FROM `passwords` WHERE  `password`='" . md5($psswd) . "'";
                $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);

                $result = $connection->execute($query);

                $connection->disconnect($link);

                if (mysql_num_rows($result) >= 1) {
                    $_SESSION['admin'] = md5($_REQUEST['password']);
                    header("Location: panel_admin.php");
                } else {
                    echo "<p>ERROR, password incorrecta</p>
		<p><a href='panel_admin.php'>volver</a></p>";
                }
            } else {
                echo "<form action='panel_admin.php' method='post'>
	<p>Password: <input type='password' name='password'/></p>
	<p><input type='submit' value='confirmar'/></p>
	</form>";
            }
            ?>
        </article>

        <footer>
        </footer>
    </body>
</html>