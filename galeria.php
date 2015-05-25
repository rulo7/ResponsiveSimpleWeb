<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--meta name="description" content="I dont know in this moment"-->
        <link rel="icon" href="images/logo.png">

        <title>GALERIA</title>

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
                        <li><a href="index.php">HOME</a></li>
                        <li class="active"><a href="galeria.php">GALERIA</a></li>
                        <li><a href="noticias.php">NOTICIAS</a></li>
                        <li><a href="contacto.php">CONTACTO</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php
            include_once ("Galeria_Y_Noticias/model/DAOGalery.php");
            include_once ("Galeria_Y_Noticias/model/DAOContents.php");


            $imagenes = Galery::getInstance()->getGalery();
            $ruta = "Galeria_Y_Noticias/galeria/";

            echo "<h1>Galeria</h2>";
            while ($img = mysql_fetch_assoc($imagenes)) {
                echo "<a href='" . $ruta . $img['nombre_archivo'] . "'><img width='150px' style='margin: 1%' title='" . $img['descripcion'] . "' src='" . $ruta . $img['nombre_archivo'] . "'/></a>";
            }
            ?>
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
    </body>
</html>