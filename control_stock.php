<?php
include('funciones.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
} else {
    // Show users the page!
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
                            <form action="resultado_control_stock.php" method="post" enctype="multipart/form-data" id="import_form"></br>
                                <table>
                                    <td>
                                        <label> Ingresar Numeros de Series para Control de Stock</label></br>
                                        <textarea name="nserie" cols="40" rows="8"></textarea></br>
                                        
                                    </td>
                                    </td>
                                    <td style="width:120px">
                                    <td>
                                        <label>Nombre de la Cuadrilla</label></br>
                                        
                                <select name="almacen">
                                    <?php
                                    $con_alma1 = "SELECT DISTINCT `almacen` FROM `stock_serie`";
                                    $resultset = mysqli_query($conn, $con_alma1);
                                    if (mysqli_num_rows($resultset)) {
                                        while ($rows = mysqli_fetch_assoc($resultset)) {
                                            echo"<option value" . $rows['almacen'] . ">" . $rows['almacen'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                        </br></br></br>                          
                                        <input type="submit"  name="import_data" value="Realizar Consulta..."></p>
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

