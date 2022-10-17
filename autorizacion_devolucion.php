<?php declare(strict_types=1) ?>
<?php
include('funciones.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
} else {

    if (isset($_POST['ch1'])) {
        if (is_array($_POST['ch1'])) {
            $selected = '';
            $num_dev = count($_POST['ch1']);
            $current = 0;
            foreach ($_POST['ch1'] as $key => $value) {
                if ($current != $num_dev - 1)
                    $selected .= $value;
                else
                    $selected .= $value;
                $sql = "UPDATE `devolucion` SET `autorizado`='aceptada' WHERE `serie`='$value'";
                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                $current++;
                //echo '<div>Has seleccionado: ' . $selected . '</div>';
            }
        }
    }
    if (isset($_POST['ch2'])) {
        if (is_array($_POST['ch2'])) {
            $selected = '';
            $num_dev = count($_POST['ch2']);
            $current = 0;
            foreach ($_POST['ch2'] as $key => $value) {
                if ($current != $num_dev - 1)
                    $selected .= $value;
                else
                    $selected .= $value;
                $consulta2 = ("UPDATE `stock_serie` SET `disponible`='si', `almacen`='ATDX' WHERE `num_serie`= '$value'");
                mysqli_query($conn, $consulta2);
                $auditoria = "INSERT INTO `reg_asig`(`almacen_destino`, `num_serie`) VALUES ('ATDX', '$value')";
                mysqli_query($conn, $auditoria);
                $mov_manual = "UPDATE `devolucion` SET `autorizado`='rechazado' WHERE  `serie`= '$value'";
                mysqli_query($conn, $mov_manual);
                $current++;
                //echo '<div>Has seleccionado: ' . $selected . '</div>';
            }
        }
    }
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
            <script type="text/javascript" src="jquery.js"></script>
            <script type="text/javascript">
                $('document').ready(function ()
                {
                    $(".select-all").click(function ()
                    {
                        $('.chk-box').attr('checked', this.checked)
                    });

                    $(".chk-box").click(function ()
                    {
                        if ($(".chk-box").length === $(".chk-box:checked").length)
                        {
                            $(".select-all").attr("checked", "checked");
                        } else
                        {
                            $(".select-all").removeAttr("checked");
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

                        <br>
                        <div class="row">
                            </p>
                            <h1>Devoluciones pendientes de confirmar</h1>
                            <p>
                            <form method="post" action="export_excel_devoluciones.php">
                            <input type="submit" name="submit" value="Export" />
                        </form></br></br></br>
                                <input type="checkbox" class="select-all"  /> Select / Deselect All
                            <form action="" method="post" enctype="multipart/form-data" name="f1" id="formElement">
                                <input type="submit" name="enviar">
                                </p>
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>Indice</th>    
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Motivo</th>
                                            <th>Material</th>
                                            <th>Numero de Serie</th>
                                            <th>Estado</th>
                                            <th>Aprobar/Rechazar</th> 

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM devolucion WHERE autorizado='pendiente'";
                                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                        if (mysqli_num_rows($resultset)) {
                                            while ($rows = mysqli_fetch_assoc($resultset)) {
                                                $num_serie_stock = $rows['serie'];
                                                $sql2 = "SELECT * FROM stock_serie WHERE num_serie='$num_serie_stock'";
                                                $resultset2 = mysqli_query($conn, $sql2) or die("database error:" . mysqli_error($conn));
                                                while ($rows2 = mysqli_fetch_assoc($resultset2)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $rows['id']; ?></td>
                                                        <td><?php echo $rows['fecha']; ?></td>
                                                        <td><?php echo $rows['usuario']; ?></td>
                                                        <td><?php echo $rows['motivo']; ?></td>
                                                        <td><?php echo $rows2['descrp_mat']; ?></td>
                                                        <td><?php echo $rows['serie']; ?></td>
                                                        <td><?php echo $rows['autorizado']; ?></td>
                                                        <td>
                                                            <input type="hidden" value="<?php echo $rows['serie']; ?>" name="serie">
                                                            <input type="checkbox" name="ch1[]" class="chk-box" value="<?php echo $rows['serie']; ?>"/> Autorizar
                                                            <input type="checkbox" name="ch2[]" class="chk-box2" value="<?php echo $rows['serie']; ?>"/> rechazar
                                                        </td>
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
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
}
