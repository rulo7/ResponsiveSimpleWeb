<?php
if (!isset($_SESSION['admin'])) {


    $coneccion = mysql_connect("localhost", "root", "root");
    $bd = mysql_select_db("galeria_y_noticias");

    $sql = "SELECT * FROM chat";
    $res = mysql_query($sql);

    while ($s = mysql_fetch_assoc($res)) {
        
        $sala = $s["sala"];
        
        echo "<h2>Sala $sala</h2>";


        echo"
        <div class = 'container'>
            <form onsubmit = 'return chatear()'>
                <p>
                    <textarea id = '$sala' rows = '8' readonly></textarea>
                </p>
                <p>
                    <input onsubmit = 'return chatear()' type = 'text' id = 'msg_client' placeholder = '...mensaje'>
                </p>
                <button type = 'submit' class = 'btn btn-default'>Enviar</button>
            </form>
        </div>
        ";
    }

    mysql_close();
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" >

    $(document).ready(function ()
    {
        cargar();
        setInterval("cargar()", 2000);
    });

    function cargar()
    {
        $("#msg_server").load("chat/chat.php?operation=read");
        var psconsole = $('#msg_server');
        if (psconsole.length)
            psconsole.scrollTop(psconsole[0].scrollHeight - psconsole.height());
    }


    function chatear()
    {
        texto_chat = $("#msg_client").val();
        $("#msg_server").load("chat/chat.php?operation=insert", {msg: texto_chat, usuario: "client"});

        $("#msg_client").val("");
        cargar();
        return false;
    }

</script> 