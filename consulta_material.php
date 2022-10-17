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
            <?php mostrarMenu() ?>

            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <br>
                        <div class="row">
                            <table>
                                <td>
                                    <form action="consulta_material.php" method="post" enctype="multipart/form-data" id="import_form"></br>
                                        <input type="text" name="material" /></br>
                                        </br>
                                        </br>
                                        <input type="submit"  name="consultarr_data" value="consultar fecha..."></p>
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

                            <table class="table table-bordered">
                                <thead>
                                    <tr class="header">
                                        <th>Cuadrilla</th>
                                        <th>Fecha</th>
                                        <th>Material</th>
                                        <th>Numero de Serie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['material'])) {
                                        $material = $_POST['material'];
                                       
                                        $sql = "SELECT * FROM `reg_asig` WHERE `desc_mat`='$material '  ORDER BY`almacen_destino`ASC ";
                                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                        if (mysqli_num_rows($resultset)) {
                                            while ($rows = mysqli_fetch_assoc($resultset)) {
                                                $sql2 = "SELECT * FROM `stock_serie` WHERE `num_serie`='".$rows['num_serie']." ' AND  `disponible`='si'";
                                                $resultset2 = mysqli_query($conn, $sql2) or die("database error:" . mysqli_error($conn));
                                                if (mysqli_num_rows($resultset2)) {
                                                    while ($rows2 = mysqli_fetch_assoc($resultset2)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $rows['almacen_destino']; ?></td>
                                                            <td><?php echo $rows['fecha']; ?></td>
                                                            <td><?php echo $rows['desc_mat']; ?></td>
                                                            <td><?php echo $rows['num_serie']; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        $sql = "SELECT `id_toa`,`ordentrabajo`,`desc_tramite`,`desc_mat`,`num_serie`,`cant`, `tecnico`, `centro`, `f_informado` FROM `historial` ORDER BY `f_informado` ";
                                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                        if (mysqli_num_rows($resultset)) {
                                            while ($rows = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows['id_toa']; ?></td>
                                                    <td><?php echo $rows['ordentrabajo']; ?></td>
                                                    <td><?php echo $rows['desc_tramite']; ?></td>
                                                    <td><?php echo $rows['desc_mat']; ?></td>
                                                    <td><?php echo $rows['num_serie']; ?></td>
                                                    <td><?php echo $rows['cant']; ?></td>
                                                    <td><?php echo $rows['tecnico']; ?></td>
                                                    <td><?php echo $rows['centro']; ?></td>
                                                    <td><?php echo $rows['f_informado']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
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
}

