<!DOCTYPE html>
<html>
    <head>
        <title>Administrador password</title>
    </head>

    <body>
        <article>
            <?php
            session_start();
            if (isset($_SESSION['admin'])) {
                include_once ("../Galeria_Y_Noticias/model/connection/FactoryConnection.php");
                include_once ("../Galeria_Y_Noticias/model/DAOContents.php");

                if (isset($_REQUEST['password'])) {
                    $connection = FactoryConnection::getInstance()->getConnection('MySQL');
                    $query = "UPDATE `passwords` SET `password`='" . md5($_REQUEST['password']) . "' WHERE `password`='" . md5($_REQUEST['passwordA']) . "'";
                    $link = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);

                    $result = $connection->execute($query);

                    $query = "SELECT `password` FROM `passwords` WHERE  `password`='" . md5($_REQUEST['password']) . "'";
                    $link2 = $connection->connect(DAOContents::getInstance()->hostName, DAOContents::getInstance()->dbUser, DAOContents::getInstance()->dbPassword, DAOContents::getInstance()->dbName);

                    $result2 = $connection->execute($query);

                    $connection->disconnect($link2);

                    if (mysql_num_rows($result2) >= 1) {

                        echo "<p>Password actualizada con exito</p>";
                        echo "<p><a href='panel_admin.php'>Volver</a></p>";
                    } else {
                        echo "<p>ERROR al actualizar la password</p>";
                        echo "<p><a href='panel_admin.php'>Volver</a></p>";
                    }

                    $connection->disconnect($link);
                } else {
                    echo "<form action='administrador_password.php'>
			<p><label>Nueva password: </label><input type='password' name='password'/></p>
			<p><label>Password actual: </label><input type='password' name='passwordA'/></p>
			<input type='submit' value='cambiar'>
			</form>";
                    echo "<p><a href='panel_admin.php'>Volver</a></p>";
                }
            } else {
                header('Location: panel_admin.php');
            }
            ?>
        </article>
        <footer>
        </footer>
    </body>
</html>