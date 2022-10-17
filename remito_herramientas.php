<?php
include('funciones.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
} else {
    $id_seguie = "SELECT MAX(`id_op`) as id_max FROM `herramientas_cuadrillas` ";
    $id_nueva = mysqli_query($conn, $id_seguie);
    $rows1 = mysqli_fetch_assoc($id_nueva);
    $id_op_nuevo = $rows1['id_max']+1;
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
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link rel="shortcut icon" href="tech.ico" />
        </head>
        <body>


            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <br>
                        <div class="row">
                            <img src="logo.png"/>
                            <h1>Remito</h1>
                            <form action="confirma_herramientas.php" method="post" enctype="multipart/form-data">
                                <table style="margin-left:10%">
                                    <tr style="height: 15px">
                                        <td>
                                            <label for="numero"style="height: 15px">Numero</label>
                                        </td>
                                        <td></br></td>
                                        <td>
                                            <label for="name"style="height: 15px">Fecha</label>
                                        </td>
                                        <td></br></td>
                                        <td>
                                            <label for="cuadrilla"style="height: 15px">Responsable de Cuadrilla</label>
                                        </td>
                                    </tr>
                                    <tr style="height: 15px">
                                        <td>
                                            <input type="text" name="numero" style="height: 15px"value="<?php echo $id_op_nuevo?>"></br>
                                        </td>
                                        <td></br></td>
                                        <td>
                                            <input type="text" name="fecha" style="height: 15px"value="<?php echo date('d.m.y'); ?>"></br>
                                        </td>
                                        <td></br></td>
                                        <td>
                                        <select name="cuadrilla">
                                            <option value="null"></option>
                                            <?php
                                            $con_alma1 = "SELECT DISTINCT `tecnico` FROM `cuadrillas`";
                                            $resultset = mysqli_query($conn, $con_alma1);
                                            if (mysqli_num_rows($resultset)) {
                                                while ($rows = mysqli_fetch_assoc($resultset)) {
                                                    echo "<option value" . $rows['tecnico'] . ">" . $rows['tecnico'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        </td>
                                    </tr>
                                </table>

                        </div>
                        <br>
                        <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="header">
                                            <th>Detalle</th>
                                            <th>Cantidad</th>
                                            <th>Ubicacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM herramientas";
                                        if ($result = mysqli_query($conn, $sql)) {
                                            $rowcount = mysqli_num_rows($result);
                                        }

                                        $i = 1;
                                        while ($i <= $rowcount) {
                                            if (isset($_POST[$i])) {
                                                if ($_POST[$i] > 0) {
                                                    $sql2 = "SELECT * FROM herramientas WHERE `id`=$i";
                                                    if ($result2 = mysqli_query($conn, $sql2)) {
                                                        while ($rows2 = mysqli_fetch_assoc($result2)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $rows2['detalle']; ?></td>
                                                                <td><?php echo $_POST[$i]; ?></td>
                                                                <td><?php echo $_POST['s_ubicacion'.$i.'']; ?></td>
                                                        <input type="hidden" name="<?php echo $i; ?>" value="<?php echo $_POST[$i]; ?>">
                                                         <input type="hidden" name="s_ubicacion<?php echo $i; ?>" value="<?php echo $_POST['s_ubicacion'.$i.'']; ?>">
                                                        <tr>
                                                            <?php
                                                        }
                                                        $i = $i + 1;
                                                    }
                                                } else {
                                                    $i = $i + 1;
                                                }
                                            }
                                        }
                                        ?>
                                        </div>

                                    <input type="submit" value="Confirmar el remito">
                                    </form>
                                    <form action="asig_herramientas.php">
                                        <input type="submit" value="Eliminar la carga">
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    <button onclick="printHTML()">Print this page</button><script>
                                        function printHTML() {
                                            if (window.print) {
                                                window.print();
                                            }
                                        }
                                    </script>


                                    </html>
                                    <?php
                                }
