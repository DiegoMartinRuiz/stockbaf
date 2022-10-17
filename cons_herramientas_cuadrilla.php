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
                            <form method="post" action="export_excel_herramientas.php">
                            <input type="submit" name="submit" value="Export" />
                        </form></br></br></br>
                            <form action="cons_herramientas_cuadrilla.php" method="post">
                                <select name="almacen">
                                    <?php
                                    $con_alma1 = "SELECT DISTINCT `cuadrilla` FROM `herramientas_cuadrillas` ";
                                    $resultset = mysqli_query($conn, $con_alma1);
                                    if (mysqli_num_rows($resultset)) {
                                        while ($rows = mysqli_fetch_assoc($resultset)) {
                                            echo"<option value" . $rows['cuadrilla'] . ">" . $rows['cuadrilla'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="submit"  name="import_data" value="Realizar Consulta..."></p>
                            </form>

                            <form action="cons_herramientas_cuadrilla.php" method="post">
                                <?php
                                if (isset($_POST['almacen'])) {
                                    $almacen = $_POST['almacen'];
                                    ?>
                                    <h1> Detalle de Stock</h1>
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>Cuadrilla</th>    
                                                <th>Herramienta</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql7 = "SELECT * FROM `stock_herr` WHERE `cuadrilla`='$almacen' ";
                                            $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                                            if (mysqli_num_rows($resultset7)) {
                                                while ($rows7 = mysqli_fetch_assoc($resultset7)) {
                                                    $sql_herr8 = "SELECT * FROM `herramientas` WHERE `id`=" . $rows7['id_herramienta'];
                                                    $resultset9 = mysqli_query($conn, $sql_herr8) or die("database error:" . mysqli_error($conn));
                                                    if (mysqli_num_rows($resultset9)) {
                                                        while ($rowsj = mysqli_fetch_assoc($resultset9)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $rows7['cuadrilla']; ?></td>
                                                                <td><?php echo $rowsj['detalle']; ?></td>
                                                                <td><?php echo $rows7['cantidad']; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <tr><td colspan="5">No records to display.....</td></tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <h1> Historia de asignacion</h1>
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>Cuadrilla</th>    
                                                <th>Fecha Asignacion</th>
                                                <th>Herramienta</th>
                                                <th>Cantidad</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM `herramientas_cuadrillas` WHERE `cuadrilla`='$almacen' ";
                                            $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                            if (mysqli_num_rows($resultset)) {
                                                while ($rows = mysqli_fetch_assoc($resultset)) {
                                                    $sql_herr = "SELECT * FROM `herramientas` WHERE `id`=" . $rows['id_herramienta'];
                                                    $resultset2 = mysqli_query($conn, $sql_herr) or die("database error:" . mysqli_error($conn));
                                                    if (mysqli_num_rows($resultset2)) {
                                                        while ($rows2 = mysqli_fetch_assoc($resultset2)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $rows['cuadrilla']; ?></td>
                                                                <td><?php echo $rows['fecha']; ?></td>
                                                                <td><?php echo $rows2['detalle']; ?></td>
                                                                <td><?php echo $rows['cantidad']; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <tr><td colspan="5">No records to display.....</td></tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </form>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
}