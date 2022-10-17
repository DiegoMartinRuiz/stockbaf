<?php
include('funciones.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TechMovil </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <LINK REL=StyleSheet HREF="estilos.css" TYPE="text/css" MEDIA=screen>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
     
    </head>
    <body>


        <!-- start nav -->
        <?php
        mostrarMenu();
        ?>
        </br>
        <form action="export2.php" method="post">
            <textarea name="prueba" cols="40" rows="8"></textarea>
            <input type="submit"   name="import_data" value="Registrar Asignacion..." onClik=""></p>
        </form>
        <!-- end nav -->
    </body>
</html>
