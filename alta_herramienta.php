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
                            <form action="conf_alta_herramienta.php" method="post" enctype="multipart/form-data" id="import_form">

                                </p>
                                <h1>Alta de Herramienta</h1>
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>Detalle</th>    
                                            <th>Remito</th>
                                            <th>Cantidad</th>
                                            <th>Ubicacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="n_detalle" style="width: 370px"/></td>
                                            <td><input type="text" name="remito_alta" /></td>
                                            <td><input type="text" name="n_cantidad" /></td>
                                            <td> <select name="n_ubicacion">
                                                    <option value"Buenos Aires">Buenos Aires</option>
                                                    <option value"Rosario">Rosario</option>
                                                </select></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" name="nueva">
                                <input type="submit"  name="import_data" value="Realizar el Alta..."></p>
                            </form>
                            <form action="conf_alta_herramienta.php" method="post" enctype="multipart/form-data" id="import_form">
                                <table class="table table-bordered" >
                                    <h1>Recepcion de Herramienta</h1>
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>Detalle</th>
                                                <th>Remito</th>    
                                                <th>Cantidad</th>
                                                <th>Ubicacion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="s_producto">
                                                        <?php
                                                        $con_alma1 = "SELECT * FROM `herramientas` ";
                                                        $resultset = mysqli_query($conn, $con_alma1);
                                                        if (mysqli_num_rows($resultset)) {
                                                            while ($rows = mysqli_fetch_assoc($resultset)) {
                                                                echo"<option value=" . $rows['id'] . ">" .$rows['detalle'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="remito_alta" /></td>
                                                <td><input type="text" name="s_cantidad" /></td>
                                                <td>
                                                    <select name="s_ubicacion">
                                                        <option value="Buenos Aires">Buenos Aires</option>
                                                        <option value="Rosario">Rosario</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="stock">
                                    <input type="submit"  name="import_data" value="Aumentat el Stock..."></p>
                                    </form>







                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </body>
                                    </html>
                                    <?php
                                }


