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
                        <form method="post" action="export_excel_fechas.php">
                            <input type="submit" name="submit" value="Export" />
                        </form>
                    </div>
                    <br>
                    <div class="row">
                        </p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Indice</th>
                                    <th>descrp_mat</th>
                                    <th>num_serie</th>
                                    <th>mac_address</th>
                                    <th>lote</th>
                                    <th>cantidad</th>
                                    <th>estado</th>
                                    <th>centro</th>
                                    <th>Fecha Limite</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fecha_30 = date("d-m-Y");
                                $fecha_30_cal = date("d-m-Y", strtotime($fecha_30 . "+ 30 days"));
                                $fecha_60 = date("d-m-Y");
                                $fecha_60_cal = date("d-m-Y", strtotime($fecha_60 . "+ 60 days"));
                                $sql = "SELECT  `id`, `descrp_mat`,`num_serie`,`mac_address`,`lote`,`cantidad`,`estado`,`centro`, `f_limite` FROM `stock_serie` WHERE `disponible`='si' ORDER BY `f_limite` ASC";
                                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                if (mysqli_num_rows($resultset)) {
                                    while ($rows = mysqli_fetch_assoc($resultset)) {
                                        $fecha_registro = date('d/m/Y', strtotime($rows['f_limite']));
                                        $primera = $fecha_registro;
                                        $segunda = $fecha_30_cal;
                                        $dias_30 = compararFechas($primera, $segunda);
                                        if ($dias_30 < 0) {
                                            echo "<tr>";
                                            echo "<td>" . $rows['id'] . "</td>";
                                            echo "<td>" . $rows['descrp_mat'] . "</td>";
                                            echo "<td>" . $rows['num_serie'] . "</td>";
                                            echo "<td>" . $rows['mac_address'] . "</td>";
                                            echo "<td>" . $rows['lote'] . "</td>";
                                            echo "<td>" . $rows['cantidad'] . "</td>";
                                            echo "<td>" . $rows['estado'] . "</td>";
                                            echo "<td>" . $rows['centro'] . "</td>";
                                            echo "<td style='background-color: red;'>" . $fecha_registro . "</td>";
                                            echo "</tr>";
                                        } elseif ($dias_30 < 30 and $dias_30 > 0) {
                                            echo "<tr>";
                                            echo "<td>" . $rows['id'] . "</td>";
                                            echo "<td>" . $rows['descrp_mat'] . "</td>";
                                            echo "<td>" . $rows['num_serie'] . "</td>";
                                            echo "<td>" . $rows['mac_address'] . "</td>";
                                            echo "<td>" . $rows['lote'] . "</td>";
                                            echo "<td>" . $rows['cantidad'] . "</td>";
                                            echo "<td>" . $rows['estado'] . "</td>";
                                            echo "<td>" . $rows['centro'] . "</td>";
                                            echo "<td style='background-color: yellow;'>" . $fecha_registro . "</td>";
                                            echo "</tr>";
                                        } else {
                                            echo "<tr>";
                                            echo "<td>" . $rows['id'] . "</td>";
                                            echo "<td>" . $rows['descrp_mat'] . "</td>";
                                            echo "<td>" . $rows['num_serie'] . "</td>";
                                            echo "<td>" . $rows['mac_address'] . "</td>";
                                            echo "<td>" . $rows['lote'] . "</td>";
                                            echo "<td>" . $rows['cantidad'] . "</td>";
                                            echo "<td>" . $rows['estado'] . "</td>";
                                            echo "<td>" . $rows['centro'] . "</td>";
                                            echo "<td>" . $fecha_registro . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                                ?>
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
