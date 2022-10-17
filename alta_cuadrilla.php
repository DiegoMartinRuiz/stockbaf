<?php

declare(strict_types=1) ?>
<?php
include('funciones.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
} else {
?>
    <!DOCTYPE html>
    <!--
    Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
    Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
    -->
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
                    </div>
                    <br>
                    <div class="row">
                        </p>
                        <form method="post" action="conf_alta_cuadrilla.php">
                            <h1> Alta de cuadrilla</h1>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cuadrilla</th>
                                        <th>Tecnico</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="cuadrilla"></td>
                                        <td><input type="text" name="tecnico"></td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="submit" value="Confirma la Carga">
                        </form>
                        <h1> Listado de Cuadrillas</h1>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cuadrilla</th>
                                        <th>Tecnico</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $sql = "SELECT * FROM `cuadrillas` ORDER BY 'cuadrilla' ASC ";
                                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                        if (mysqli_num_rows($resultset)) {
                                            while ($rows = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                <tr>      
                                                    <td><?php echo $rows['cuadrilla']; ?></td>
                                                    <td><?php echo $rows['tecnico']; ?></td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr><td colspan="5">No records to display.....</td></tr>
                                <?php } ?>
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
}
