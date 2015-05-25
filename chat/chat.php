<?php

session_start();

// en el caso de que el usuario no tenga sala de chat se el asigna una
if (!isset($_SESSION["sala"])) {

    $coneccion = mysql_connect("localhost", "root", "root");
    $bd = mysql_select_db("galeria_y_noticias");

    //EXTRAEMOS EL CONTENIDO DEL CHAT 
    $sql = "SELECT `sala` FROM `chat` ORDER BY `sala` DESC LIMIT 1";
    $rec = mysql_query($sql);


    //Guardamos la sala del usuario en su sesion
    if (mysql_num_rows($rec) == 0) {
        $_SESSION["sala"] = 0;
    } else {
        $row = mysql_fetch_assoc($rec);
        $_SESSION["sala"] = $row["sala"] + 1;
    }
}

switch ($_REQUEST["operation"]) {
    case "insert":

        $coneccion = mysql_connect("localhost", "root", "root");
        $bd = mysql_select_db("galeria_y_noticias");

        $sala = $_SESSION["sala"];
        $usuario = $_REQUEST["usuario"];
        $msg = $_REQUEST["msg"];

        //INSERTAMOS EL COMENTARIO 
        $sql = "INSERT INTO `chat`(`sala`, `usuario`, `msg`) VALUES ($sala,'$usuario','$msg')";
        $rec = mysql_query($sql);

        mysql_close();

        break;
    case "read":
        $coneccion = mysql_connect("localhost", "root", "root");
        $bd = mysql_select_db("galeria_y_noticias");


        $sala = $_SESSION["sala"];
        //EXTRAEMOS EL CONTENIDO DEL CHAT 
        $sql = "SELECT * FROM chat where `sala`='$sala' ORDER BY `id` ASC";
        $rec = mysql_query($sql);

        while ($row = mysql_fetch_assoc($rec)) {
            echo "[".$row['usuario'] . "]: " . $row['msg'] . "\n";
        }

        mysql_close();
        break;
    case "delete":
        break;
}
?> 

