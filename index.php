<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--meta name="description" content="I dont know in this moment"-->
        <link rel="icon" href="images/logo.png">

        <title>HOME</title>

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
                        <li class="active"><a href="index.php">HOME</a></li>
                        <li><a href="galeria.php">GALERIA</a></li>
                        <li><a href="noticias.php">NOTICIAS</a></li>
                        <li><a href="contacto.php">CONTACTO</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Begin page content -->
        <div class="container">
            <div class="page-header">
                <h1>Bienvenido a la web de AW</h1>
            </div>
            <p class="lead">Esta es una web con fines formativos, su contenido es variado y se pueden realizar la siguientes tareas:</p>
            <ul>
                <li>                    
                    <p>Galería:</p>
                    <p>En esta web se puede añadir imagenes a través del panel de administración y visualizarlas en su correspondiente apartado.</p>
                </li>
                <li>                    
                    <p>Noticias:</p>
                    <p>Al igual que con las noticias, se podrán añadir noticias de forma dinámica y visualizarse en su apartado.</p>
                </li>
                <li>                    
                    <p>Contacto:</p>
                    <p>Es una sección donde se puede enviar un email con sugerencias a través del servicio mail y la función mail de PHP.</p>
                    <p>Además, contiene un mapa embebido de google maps donde identificar nuestra ubicación</p>
                </li>
            </ul>

            <p class="lead">Responsiva</p>
            <p>Es una web enteramente responsiva, gracias al sistema de rejilla del framwork utilizado para esta. <a href="http://getbootstrap.com">BOOTSTRAP</a>.</p>

            <p class="lead">Tecnología empleada</p>
            <ul>
                <li>                    
                    <p>Bootstrap</p>
                    <p>Framwork basado en javascript y CSS que nos permite realizar webs responsivas de manera sencilla.</p>
                </li>
                <li>                    
                    <p>PHP</p>
                    <p>Lenguaje utilizado para crear el backend.</p>
                    <p>Implementa toda la sección de galería y noticias, tanto su administración como su visualización.</p>
                    <p>Se utiliza para enviar emails a través del formulario situado en contacto.</p>
                    <p>Utiliza sesiones para poder acceder al panel de administración.</p>
                </li>
                <li>                    
                    <p>HTML</p>
                    <p>Lenguaje d emarcado con el que se genera todo el contenido de la web</p>
                </li>
                <li>                    
                    <p>CSS</p>
                    <p>Se utiliza para personalizar los elementos de la web como el footer y otros elementos.</p>
                    <p>Además, cambiamos las clases implementadas con bootstrap para personalizarlas en determinados lugares y no utilizar la configuración por defecto.</p>
                </li>
                <li>                    
                    <p>JavaScript, JQuery y AJAX</p>
                    <p>Javascript se utiliza para realizar notificaciones en la web además del propio navBar que utiliza dicha tecnología empleada por Bootstrap.</p>
                    <p>JQuery se utiliza para simpleficar la tecnología AJAX empleada para el chat en el apartado de contacto junto con PHP y MySQL.</p>
                </li>
                 <li>                    
                    <p>MySQL</p>
                    <p>Le otorga junto con PHP el dinamismo a la web a través de todas las querys PHP que dan la funcionalidad a la galería y a las noticias.</p>
                    <p>Almacena los mensajes del chat de contacto.</p>
                </li>
            </ul>
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