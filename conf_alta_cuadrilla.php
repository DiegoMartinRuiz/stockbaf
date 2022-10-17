<?php
include('funciones.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
} else {
    if (isset($_POST['tecnico'])) {
        $tecnico = htmlspecialchars($_POST['tecnico']);
        $cuadrilla = htmlspecialchars($_POST['cuadrilla']);
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
                        <h1> Cuadrilla Agregada</h1>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cuadrilla</th>
                                        <th>Tecnico</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $con_cuadrilla = "SELECT * FROM `cuadrillas` WHERE `cuadrilla` = '$cuadrilla'";
                                    $res_cuadrilla = mysqli_query($conn, $con_cuadrilla);
                                    if (mysqli_num_rows($res_cuadrilla)!=0) {
                                            $actu_cuadrilla = "UPDATE `cuadrillas` SET `tecnico`='$tecnico' WHERE cuadrilla='$cuadrilla'";
                                            mysqli_query($conn, $actu_cuadrilla);
                                        ?>
                                            <tr>
                                                <td><?php echo $cuadrilla; ?></td>
                                                <td><?php echo $tecnico; ?></td>
                                            </tr>
                                        <?php 
                                    } else{
                                        $alta_cuadrilla = "INSERT INTO `cuadrillas`(`cuadrilla`, `tecnico`) VALUES ('$cuadrilla', '$tecnico')";
                                            mysqli_query($conn, $alta_cuadrilla);?>
                                            <tr>
                                            <td><?php echo $cuadrilla; ?></td>
                                            <td><?php echo $tecnico; ?></td>
                                        </tr>
                                 <?php   }
                                 ?>
                                </tbody>
                            </table>
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
                                    } ?>
                                        
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