<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--meta name="description" content="I dont know in this moment"-->
        <link rel="icon" href="images/logo.png">

        <title>CONTACTO</title>

        <!-- Bootstrap core CSS -->
        <link href="styles/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Sticky footer -->
        <link href="styles/sticky-footer.css" rel="stylesheet">
        <!-- Personal styles -->
        <link href="styles/ppalStyle.css" rel="stylesheet"> 

    </head>

    <body>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="Galeria_Y_Noticias/admin/panel_admin.php"><img src="images/logo.png"/></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php#">HOME</a></li>
                        <li><a href="galeria.php">GALERIA</a></li>
                        <li><a href="noticias.php">NOTICIAS</a></li>
                        <li class="active"><a href="contacto.php">CONTACTO</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Begin page content -->
        <div class="container">
            <div class="page-header">
                <h1>Contáctanos</h1>
            </div>
            <div class="col-md-8">
                <div class="jumbotron">

                    <h2>Chat</h2>
                    <div class="container">
                        <form onsubmit="return chatear()">
                            <div class="form-group">
                                <textarea id="msg_server" class="form-control" rows="8" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label>Mensaje</label>
                                <input onsubmit="return chatear()" type="text" id="msg_client" class="form-control" placeholder="...mensaje">
                            </div>
                            <button type="submit" class="btn btn-default">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron">
                    <h2>Correo</h2>
                    <form role="form" method="POST" action="">
                        <div class="form-group">
                            <label>Email</label>
                            <input required type="email" name="email" class="form-control" id="email"
                                   placeholder="...email">
                        </div>
                        <div class="form-group">
                            <label>Mensaje</label>
                            <textarea required name="msg" class="form-control" placeholder="...mensaje" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Enviar</button>
                    </form>
                </div>
            </div>


            <div class="col-md-12">
                <div class="page-header">
                    <h1>Dónde estamos</h1>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3035.9976041623727!2d-3.7336100000002004!3d40.453189997574405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4229d2a8bc845d%3A0x117f835839d72a25!2sProfesor+Garcia+Santesmases+-+Informatica!5e0!3m2!1ses!2ses!4v1431517393133" width="100%" height="450" frameborder="0"></iframe>
            </div>

        </div>

        <footer class="footer">
            <div class="container">
                <p>AW-PracticaLibre 2014-2015</p>
                <p>Raúl Cobos</p>
            </div>
        </footer>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="styles/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
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

        <?PHP
        // si se ha mandado un email se responde si se ha realizado correctamente y se continua con la navegación
        if (isset($_POST["email"]) && isset($_POST["msg"])) {

            $email = $_POST["email"];
            $mensaje = $_POST["msg"];


            if (mail("racobos@ucm.es", "message from: $email", "$mensaje")) {
                $ok = "su mensaje ha sido realizado con exito";
            } else {
                $ok = "su mensaje ha sido realizado con exito";
            }


            echo"<script>alert('$ok');</script>";
        }
        ?>

    </body>
</html>