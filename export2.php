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

    </head>
    <body>              
<!-- start nav -->
<?php 
mostrarMenu();

$arr = explode("\r\n", trim($_POST['nserie']));
for ($i = 0; $i < count($arr); $i++) {
   $linea = $arr[$i];
   echo"$arr[$i]</br>";
}
?>


<!-- end nav -->
    </body>
</html>
