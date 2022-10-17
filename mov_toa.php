<?php
session_start();
include('funciones.php');
if (isset($_POST['nserie'])) {
    $arr = explode("\r\n", trim($_POST['nserie']));
    for ($i = 0; $i < count($arr); $i++) {
        $usu = $_SESSION['name'];
        $serie = htmlspecialchars($_POST['nserie']);
        $orden_trabajo = htmlspecialchars($_POST['ordentrabajo']);
        $tipo_trabajo = htmlspecialchars($_POST['t_trabajo']);
        $desc_mat = htmlspecialchars($_POST['desc_mat']);
        //consultuo si existe el numero de serie en la tabla de stock de existir actualizo el estado a usado y inserto un registro en la auditoria
        $consulta = ("SELECT * FROM `stock_serie` WHERE `num_serie`= '$arr[$i]'");
        $resultado = mysqli_query($conn, $consulta);
        if (mysqli_num_rows($resultado) != 0) {
            //consulto si el equipo ya fue cargado en un archivo de toa
            $consulta3 = ("SELECT * FROM `historial` WHERE `num_serie`= '$arr[$i]'");
            $resultado3 = mysqli_query($conn, $consulta3);
            if (mysqli_num_rows($resultado3) != 0) {
            } else {
                $consulta2 = ("UPDATE `stock_serie` SET `disponible`='usado' WHERE `num_serie`= '$arr[$i]'");
                mysqli_query($conn, $consulta2);
                $auditoria = "INSERT INTO `reg_asig`(`almacen_destino`, `num_serie`, `desc_mat`) VALUES ('Utilizado', '$arr[$i]', '$desc_mat')";
                mysqli_query($conn, $auditoria);
                $mov_manual = "INSERT INTO `mov_manuales`(`num_serie`, `desc_mat`, `usuario`, `ot`, `tipo_trabajo`) VALUES ('$arr[$i]', '$desc_mat','" . $_SESSION['name'] . "','$orden_trabajo','$tipo_trabajo')";
                mysqli_query($conn, $mov_manual);
            }
        } else {
        }
    }
}
header("Location: toa_imp_man.php" . $import_status);
