<?php declare(strict_types=1) ?>
<?php
include('funciones.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
} else {
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
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
            <link rel="shortcut icon" href="tech.ico" />
        </head>
        <body>
            <?php mostrarMenu() ?>
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <br>
                        <div class="row">
                            <form action="import_cuadrilla.php" method="post" enctype="multipart/form-data" id="import_form">
                                <input type="file" name="file" /></br>
                                </br>
                                </br>
                                <input type="submit"  name="import_data" value="Importar Archivo..."></p>
                            </form>
                            <form action="import_cuadrilla.php" method="post" enctype="multipart/form-data" id="import_form" style="float: right"></br>
                                <table>
                                    <td>
                                        <label> Ingresar Numeros de Series para Asignacion</label></br>
                                        <textarea name="nserie" cols="40" rows="8"></textarea></br>
                                    </td>
                                    </td>
                                    <td style="width:120px">
                                    <td>
                                        <input type="submit"  name="flag" value="Importar Numeros de Serie..."></p>
                                    </td>
                                </table>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
        </body>
    </html>
    <?php
}