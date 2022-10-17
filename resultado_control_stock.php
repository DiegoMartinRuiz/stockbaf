<?php
session_start();
include('funciones.php');
if (isset($_POST['nserie'])) {
    $arr = explode("\r\n", trim($_POST['nserie']));
    $usu = $_SESSION['name'];
    $serie = htmlspecialchars($_POST['nserie']);
    $almacen = htmlspecialchars($_POST['almacen']);
    //consultuo si existe el numero de serie en la tabla de stock de existir actualizo el estado a usado y inserto un registro en la auditoria
}
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

                        <br>
                        <div class="row">
                            </p>
                            <h1>Articulos Controlados Correctamente</h1>
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>

                                        <th>Material</th>
                                        <th>Numero de Serie</th>
                                        <th>Mac Address</th>
                                        <th>Lote</th>
                                        <th>Cantidad</th>
                                        <th>Estado</th> 
                                        <th>Centro</th>
                                        <th>Disponible</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //inicio lectura de variable del textarea
                                    for ($i = 0; $i < count($arr); $i++) {
                                        $consulta = ("SELECT * FROM `stock_serie` WHERE `num_serie`= '$arr[$i]' AND `almacen`= '$almacen'");
                                        $resultado = mysqli_query($conn, $consulta);
                                        $rows = mysqli_fetch_assoc($resultado);
                                        if (mysqli_num_rows($resultado) != 0) {
                                            //consulto si el equipo ya fue cargado en un archivo de toa
                                            $consulta3 = ("SELECT * FROM `historial` WHERE `num_serie`= '$arr[$i]'");
                                            $resultado3 = mysqli_query($conn, $consulta3);
                                            if (mysqli_num_rows($resultado3) != 0) {
                                                
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
                                                    <td><?php echo $rows['disponible']; ?></td>

                                                </tr>
                                                <?php
                                            }
                                        }
                                    }//fin del for
                                    //finalizo acciones con la lectura del textarea
                                    ?>

                                </tbody>
                            </table>
                            <h1>Articulos Asignados a otras Cuadrillas</h1>
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>

                                        <th>descrp_mat</th>
                                        <th>num_serie</th>
                                        <th>mac_address</th>
                                        <th>lote</th>
                                        <th>cantidad</th>
                                        <th>estado</th> 
                                        <th>Almacen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //inicio lectura de variable del textarea
                                    for ($i = 0; $i < count($arr); $i++) {
                                        $consulta1 = ("SELECT * FROM `stock_serie` WHERE `num_serie`= '$arr[$i]' AND `almacen`!= '$almacen'");
                                        $resultado1 = mysqli_query($conn, $consulta1);
                                        $rows1 = mysqli_fetch_assoc($resultado1);
                                        if (mysqli_num_rows($resultado1) != 0) {
                                            //consulto si el equipo ya fue cargado en un archivo de toa
                                            $consulta4 = ("SELECT * FROM `historial` WHERE `num_serie`= '$arr[$i]'");
                                            $resultado4 = mysqli_query($conn, $consulta4);
                                            if (mysqli_num_rows($resultado4) != 0) {
                                                echo "El articulo con numero de Serie... " . $arr[$i] . "Ha sido Utilizado";
                                                echo"</br>";
                                            } else {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows1['descrp_mat']; ?></td>
                                                    <td><?php echo $rows1['num_serie']; ?></td>
                                                    <td><?php echo $rows1['mac_address']; ?></td>
                                                    <td><?php echo $rows1['lote']; ?></td>
                                                    <td><?php echo $rows1['cantidad']; ?></td>
                                                    <td><?php echo $rows1['estado']; ?></td>
                                                    <td><?php echo $rows1['almacen']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }//fin del for
                                    //finalizo acciones con la lectura del textarea
                                    ?>
                                </tbody>
                            </table>
                             <h1>Historial de Articulos ya Utilizados</h1>
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>

                                        <th>Orden de Trabajo</th>
                                        <th>Material</th>
                                        <th>Numero de Seire</th>
                                        <th>Tecnico</th>
                                        <th>Fecha de Informe</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //inicio lectura de variable del textarea
                                    for ($i = 0; $i < count($arr); $i++) {
                                        $consulta13 = ("SELECT * FROM `historial` WHERE `num_serie`= '$arr[$i]'");
                                        $resultado13 = mysqli_query($conn, $consulta13);
                                        $rows1 = mysqli_fetch_assoc($resultado13);
                                        if (mysqli_num_rows($resultado13) != 0) {
                                           
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows1['ordentrabajo']; ?></td>
                                                    <td><?php echo $rows1['desc_mat']; ?></td>
                                                    <td><?php echo $rows1['num_serie']; ?></td>
                                                    <td><?php echo $rows1['tecnico']; ?></td>
                                                    <td><?php echo $rows1['f_informado']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    //fin del for
                                    //finalizo acciones con la lectura del textarea
                                    ?>
                                </tbody>
                            </table>
                            <h1>Articulos No Registrados en el Stock</h1>
                            <?php
                            for ($i = 0; $i < count($arr); $i++) {
                                $consulta12 = ("SELECT * FROM `stock_serie` WHERE `num_serie`= '$arr[$i]'");
                                $resultado12 = mysqli_query($conn, $consulta12);
                                $rows12 = mysqli_fetch_assoc($resultado12);
                                if (mysqli_num_rows($resultado12) == 0) {
                                    echo"El articulo con numero de Serie " . $arr[$i] . " No existe en el stock";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
}

