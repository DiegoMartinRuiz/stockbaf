<?php declare(strict_types=1) ?>
<?php
include('funciones.php');
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
} else {
    if($_POST['cuadrilla']=='null'){
        header("Location: remito_baf.php");
    }else{
    if (isset($_POST['id_1'])) {
        $id_operacion = htmlspecialchars($_POST['id_1']);
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
                            <form action="import_cuadrilla.php" method="post" enctype="multipart/form-data" id="import_form">
                                <input type="file" name="file" /></br>
                                </br>
                                </br>
                                <input type="submit"  name="import_data" value="Importar Archivo..."></p>
                            </form>
                            <form action="import_cuadrilla.php" method="post" enctype="multipart/form-data" id="import_form" style="float: right"></br>
                                <table>
                                    <td>
                                        <label> Ingresar Numeros de Series para Asignacion</label></br>
                                        <textarea name="nserie" cols="40" rows="8"></textarea></br>
                                    </td>
                                    </td>
                                    <td style="width:120px">
                                    <td>
                                        <input type="submit"  name="flag" value="Importar Numeros de Serie..."></p>
                                    </td>
                                </table>
                            </form>
                        </div>
                            </div>
                            <br>
                            <div class="row">
                                </p>
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr> 
                                            <th>Material</th>
                                            <th>Numero de Serie</th>
                                            <th>Almacen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id_seguie = "SELECT * FROM `temp_asig` WHERE `id_op` = $id_operacion";
                                        $id_res = mysqli_query($conn, $id_seguie);
                                        if (mysqli_num_rows($id_res)) {
                                            while ($rows = mysqli_fetch_assoc($id_res)) {
                                                $n_s = $rows['num_serie'];
                                                $des_mat = $rows['desc_mat'];
                                                $actu_almacen = "UPDATE `stock_serie` SET `almacen`='$cuadrilla' WHERE `num_serie`='$n_s'";
                                                mysqli_query($conn, $actu_almacen);
                                                $auditoria = "INSERT INTO `reg_asig`(`almacen_destino`, `num_serie`, `desc_mat`) VALUES ('$cuadrilla', '$n_s', '$des_mat')";
                                                mysqli_query($conn, $auditoria);
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows['desc_mat']; ?></td>
                                                    <td><?php echo $rows['num_serie']; ?></td>
                                                    <td><?php echo $cuadrilla; ?></td>
                                                </tr>
                                            <?php }
                                        } else {
                                            ?>
                                            <tr><td colspan="5">No records to display.....</td></tr>
        <?php } }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </body
    <?php } ?>
    </html>
    <?php
}
