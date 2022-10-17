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
                    <?php   mostrarMenu() ?>

            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <br>
                        <div class="row">
                            <table>
                                <td>
                                    <form action="cons_toa_fecha.php" method="post" enctype="multipart/form-data" id="import_form"></br>
                                        <input type="date" name="fecha" /></br>
                                        </br>
                                        </br>
                                        <input type="submit"  name="consultarr_data" value="consultar fecha..."></p>
                                        <?php if (isset($_POST['fecha'])) {
                                            $theDate1    = new DateTime($_POST['fecha']);
                                            $stringDate1 = $theDate1->format('d.m.Y');
                                            echo "Fecha consultada = ". $stringDate1;}?>
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
                                        <th>ID</th>
                                        <th>OT</th>
                                        <th>Tramite</th>
                                        <th>Material</th>
                                        <th>Numero de Serie</th>
                                        <th>cantidad</th>
                                        <th>Tecnico</th> 
                                        <th>Centro</th>
                                        <th>Fecha Informado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     if (isset($_POST['fecha'])) {
                                    $theDate    = new DateTime($_POST['fecha']);
                                    $stringDate = $theDate->format('d.m.Y');
                                    $sql = "SELECT `id_toa`,`ordentrabajo`,`desc_tramite`,`desc_mat`,`num_serie`,`cant`, `tecnico`, `centro`, `f_informado` FROM `historial` WHERE `f_informado`='$stringDate' ";
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
                                        <?php }
                                     } 
                                     }else{
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
                                        <?php }
                                     } 
                                     else {
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