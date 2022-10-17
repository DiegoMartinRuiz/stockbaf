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
            <LINK REL=StyleSheet HREF="estilos.css" TYPE="text/css" MEDIA=screen>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link rel="shortcut icon" href="tech.ico" />
        </head>
        <body>
                  <?php   mostrarMenu() ?>

            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <br>
                        <div class="row">
                            <table>
                                <td>
                                    <form action="import_toa.php" method="post" enctype="multipart/form-data" id="import_form"></br>
                                        <input type="file" name="file" /></br>
                                        </br>
                                        </br>
                                        <input type="submit"  name="import_data" value="Importar Archivo..."></p>
                                    </form>
                                </td>
                                <td style="width:120px">
                                </td>
                                <td>

                                </td>
                            </table>
                        </div>
                        <br>

                        <div class="row">

                           

                        </div>
                    </div>
                </div>
            </div>

        </body>
    </html>
    <?php
}