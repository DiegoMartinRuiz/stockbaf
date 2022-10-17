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


                        </div>
                        <br>
                        <div class="row">
                            </p>
                            <form action="cons_almacen.php" method="post">
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
                                <input type="submit"  name="import_data" value="Realizar Consulta..."></p>
                            </form>
                            <form method="post" action="export_excel_almacenes.php">
                            <input type="submit" name="submit" value="Export" />
                        </form></br></br></br>

                            <?php
                            if (isset($_POST['almacen'])) {
                                $almacen = $_POST['almacen'];
                                ?>
                                <h1> Detalle de Stock</h1>
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>Indice</th>    
                                            <th>descrp_mat</th>
                                            <th>num_serie</th>
                                            <th>mac_address</th>
                                            <th>lote</th>
                                            <th>cantidad</th>
                                            <th>Almacen</th> 
                                            <th>centro</th>
                                            <th>Disponible</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `stock_serie` WHERE `almacen`='$almacen' ";
                                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                        if (mysqli_num_rows($resultset)) {
                                            while ($rows = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows['id']; ?></td>
                                                    <td><?php echo $rows['descrp_mat']; ?></td>
                                                    <td><?php echo $rows['num_serie']; ?></td>
                                                    <td><?php echo $rows['mac_address']; ?></td>
                                                    <td><?php echo $rows['lote']; ?></td>
                                                    <td><?php echo $rows['cantidad']; ?></td>
                                                    <td><?php echo $rows['almacen']; ?></td>
                                                    <td><?php echo $rows['centro']; ?></td>
                                                    <td><?php echo $rows['disponible']; ?></td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr><td colspan="5">No records to display.....</td></tr>
                                <?php } ?>
                                    </tbody>
                                </table>
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

