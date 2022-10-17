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
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <LINK REL=StyleSheet HREF="estilos.css" TYPE="text/css" MEDIA=screen>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
            <link rel="shortcut icon" href="tech.ico" />
            <script type="text/javascript">
                $(document).ready(function () {
                    $("form").keypress(function (e) {
                        if (e.which == 13) {
                            return false;
                        }
                    });
                });
            </script>
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
                            <form action="consulta_serie.php" method="post">
                                <input type='text'name='serie'>     Numero de Serie</p>
                                <input type='submit' name='import_data' value='Consultar' style=" color: #FFFFFF; background-color: #FF8633; border-color: #FF8633"></p>
                            </form>
                            <?php
                            if (isset($_POST['serie'])) {
                                $serie = $_POST['serie'];
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
                                        $sql = "SELECT * FROM `stock_serie` WHERE `num_serie`='$serie' ";
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
                                        } else {
                                            ?>
                                            <tr><td colspan="5">No records to display.....</td></tr>
        <?php } ?>
                                    </tbody>
                                </table>
                                <h1> Reporte de TOA</h1>
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>Indice</th>    
                                            <th>Orden de Trabajo</th>
                                            <th>Desc Tramite</th>
                                            <th>Tecnico</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql1 = "SELECT * FROM `historial` WHERE `num_serie`='$serie' ";
                                        $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
                                        if (mysqli_num_rows($resultset1)) {
                                            while ($rows1 = mysqli_fetch_assoc($resultset1)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows1['id_toa']; ?></td>
                                                    <td><?php echo $rows1['ordentrabajo']; ?></td>
                                                    <td><?php echo $rows1['desc_tramite']; ?></td>
                                                    <td><?php echo $rows1['tecnico']; ?></td>
                                                    <td><?php echo $rows1['f_informado']; ?></td>
                                                </tr>
                                            <?php }
                                        } else {
                                            ?>
                                            <tr><td colspan="5">No records to display.....</td></tr>
        <?php } ?>
                                    </tbody>
                                </table>
                                <h1> Reporte de TOA Manual</h1>
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>Indice</th>    
                                            <th>Numero de Serie</th>
                                            <th>Desc Material</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
                                            <th>Orden de Trabajo</th> 
                                            <th>Tipo de Trabajo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql17 = "SELECT * FROM `mov_manuales` WHERE `num_serie`='$serie' ";
                                        $resultset17 = mysqli_query($conn, $sql17) or die("database error:" . mysqli_error($conn));
                                        if (mysqli_num_rows($resultset17)) {
                                            while ($rows17 = mysqli_fetch_assoc($resultset17)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows17['id']; ?></td>
                                                    <td><?php echo $rows17['num_serie']; ?></td>
                                                    <td><?php echo $rows17['desc_mat']; ?></td>
                                                    <td><?php echo $rows17['usuario']; ?></td>
                                                    <td><?php echo $rows17['fecha_carga']; ?></td>
                                                    <td><?php echo $rows17['ot']; ?></td>
                                                    <td><?php echo $rows17['tipo_trabajo']; ?></td>
                                                </tr>
                                            <?php }
                                        } else {
                                            ?>
                                            <tr><td colspan="5">No records to display.....</td></tr>
        <?php } ?>
                                    </tbody>
                                </table>
                                <h1> Historial de Movimientos</h1>
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>Indice</th>    
                                            <th>Fecha</th>
                                            <th>Almacen de Destino</th>
                                            <th>Numero de Serie</th>
                                            <th>Descripcion de Material</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql3 = "SELECT * FROM `reg_asig` WHERE `num_serie`='$serie' ";
                                        $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
                                        if (mysqli_num_rows($resultset3)) {
                                            while ($rows3 = mysqli_fetch_assoc($resultset3)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows3['id']; ?></td>
                                                    <td><?php echo $rows3['fecha']; ?></td>
                                                    <td><?php echo $rows3['almacen_destino']; ?></td>
                                                    <td><?php echo $rows3['num_serie']; ?></td>
                                                    <td><?php echo $rows3['desc_mat']; ?></td>
                                                </tr>
                                            <?php }
                                        } else {
                                            ?>
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
