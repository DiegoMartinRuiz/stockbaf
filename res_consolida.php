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

                        <br>
                        <div class="row">
                            </p>
                            <h1>Existencias en stock Propio que no estan en Claro</h1>
                            <table class="table table-bordered" >
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
//SELECT t1.id, t1.rolname, t2.rolname FROM user_old t1 INNER JOIN user_new t2 ON t1.id=t2.id WHERE t1.rolname<>t2.
//$sql = "SELECT `id_toa`,`ordentrabajo`,`desc_tramite`,`desc_mat`,`num_serie`,`cant`, `tecnico`, `centro`, `f_informado` FROM `historial` ORDER BY `f_informado` ";  
                                    $sql = "SELECT * FROM stock_serie WHERE  `disponible`='si'";
                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                    if (mysqli_num_rows($resultset)) {
                                        while ($rows = mysqli_fetch_assoc($resultset)) {
                                            $num_serie_stock = $rows['num_serie'];
                                            $sql2 = "SELECT * FROM auditoria WHERE num_serie='$num_serie_stock'";
                                            $resultset2 = mysqli_query($conn, $sql2) or die("database error:" . mysqli_error($conn));
                                            if (mysqli_num_rows($resultset2)) {
                                                
                                            } else {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows['descrp_mat']; ?></td>
                                                    <td><?php echo $rows['num_serie']; ?></td>
                                                    <td><?php echo $rows['mac_address']; ?></td>
                                                    <td><?php echo $rows['lote']; ?></td>
                                                    <td><?php echo $rows['cantidad']; ?></td>
                                                    <td><?php echo $rows['estado']; ?></td>
                                                    <td><?php echo $rows['centro']; ?></td>
                                                    <td><a class="btn btn-primary" href="borrar.php?id=<?php echo $rows['num_serie']; ?>"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <tr><td colspan="5">No records to display.....</td></tr>
    <?php } ?>
                                </tbody>
                            </table>
                            <h1>Existencias en Stock de Claro que no estan en el stock Propio</h1>
                            <table class="table table-bordered" >
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
//SELECT t1.id, t1.rolname, t2.rolname FROM user_old t1 INNER JOIN user_new t2 ON t1.id=t2.id WHERE t1.rolname<>t2.
//$sql = "SELECT `id_toa`,`ordentrabajo`,`desc_tramite`,`desc_mat`,`num_serie`,`cant`, `tecnico`, `centro`, `f_informado` FROM `historial` ORDER BY `f_informado` ";  
                                    $sqlC = "SELECT * FROM auditoria ";
                                    $resultsetC = mysqli_query($conn, $sqlC) or die("database error:" . mysqli_error($conn));
                                    if (mysqli_num_rows($resultsetC)) {
                                        while ($rowsC = mysqli_fetch_assoc($resultsetC)) {
                                            $num_serie_stockC = $rowsC['num_serie'];
                                            $sql2C = "SELECT * FROM stock_serie WHERE num_serie='$num_serie_stockC' AND `disponible`='si'";
                                            $resultset2C = mysqli_query($conn, $sql2C) or die("database error:" . mysqli_error($conn));
                                            if (mysqli_num_rows($resultset2C)) {
                                                
                                            } else {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rowsC['descrp_mat']; ?></td>
                                                    <td><?php echo $rowsC['num_serie']; ?></td>
                                                    <td><?php echo $rowsC['mac_address']; ?></td>
                                                    <td><?php echo $rowsC['lote']; ?></td>
                                                    <td><?php echo $rowsC['cantidad']; ?></td>
                                                    <td><?php echo $rowsC['estado']; ?></td>
                                                    <td><?php echo $rowsC['centro']; ?></td>
                                                    <td><a class="btn btn-primary" href="borrar.php?id=<?php echo $rowsC['num_serie']; ?>"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a></td>
                                                </tr>
                                                <?php
                                            }
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