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
              <?php   mostrarMenu() ?>
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <br>
                        <div class="row">
                           <!-- <form action="import_stock.php" method="post" enctype="multipart/form-data" id="import_form">-->
                        </div>
                        <br>
                        <div class="row">
                            <form action="remito_herramientas.php" method="post" enctype="multipart/form-data" id="import_form">
                            <input type="submit"  name="import_data" value="Registrar Asignacion..."></p>

                            </p>
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>Indice</th>    
                                        <th>Detalle</th>
                                        <th>Stock Rosario</th>
                                        <th>Stock Buenos Aires</th>
                                        <th>Cantinada a Asignar</th>
                                        <th>Ubicacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT  * FROM `herramientas`";
                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                    if (mysqli_num_rows($resultset)) {
                                        while ($rows = mysqli_fetch_assoc($resultset)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $rows['id']; ?></td>
                                                <td><?php echo $rows['detalle']; ?></td>
                                                <td><?php echo $rows['cantidad_rosario']; ?></td>
                                                <td><?php echo $rows['cantidad_bsas']; ?></td>
                                                
                                                <td><input type="text" name="<?php echo $rows['id']; ?>" /></td>
                                                <td><select name="s_ubicacion<?php echo $rows['id']; ?>">
                                                    <option value"Buenos Aires">Buenos Aires</option>
                                                    <option value"Rosario">Rosario</option>
                                                </select><td>
                                                <input type="hidden" name="flag">
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr><td colspan="5">No records to display.....</td></tr>
    <?php } ?>
                                </tbody>
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

