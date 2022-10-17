<?php
session_start();
include('funciones.php');
if (isset($_POST['nserie'])) {
    $arr = explode("\r\n", trim($_POST['nserie']));
    $usu = $_SESSION['name'];
    $serie = htmlspecialchars($_POST['nserie']);
    $motivo = htmlspecialchars($_POST['texto']);
    $desc_mat = htmlspecialchars($_POST['desc_mat']);
    for ($i = 0; $i < count($arr); $i++) {
        //consultuo si existe el numero de serie en la tabla de stock de existir actualizo el estado a usado y inserto un registro en la auditoria
        $consulta = ("SELECT * FROM `stock_serie` WHERE `num_serie`= '$arr[$i]'");
        $resultado = mysqli_query($conn, $consulta);
        if (mysqli_num_rows($resultado) != 0) {
            //consulto si el equipo ya fue cargado en un archivo de toa
            $consulta3 = ("SELECT * FROM `historial` WHERE `num_serie`= '$arr[$i]'");
            $resultado3 = mysqli_query($conn, $consulta3);
            if (mysqli_num_rows($resultado3) != 0) {
                
            } else {
                $consulta2 = ("UPDATE `stock_serie` SET `disponible`='devuelto', `almacen`='Claro' WHERE `num_serie`= '$arr[$i]'");
                mysqli_query($conn, $consulta2);
                $auditoria = "INSERT INTO `reg_asig`(`almacen_destino`, `num_serie`) VALUES ('Claro', '$arr[$i]')";
                mysqli_query($conn, $auditoria);
                $mov_manual = "INSERT INTO `devolucion`(`serie`,  `usuario`, `motivo`, `autorizado`) VALUES ('$arr[$i]', '" . $_SESSION['name'] . "','$motivo', 'pendiente')";
                mysqli_query($conn, $mov_manual);
            }
        } else {
            
        }
    }//fin del for
}
header("Location: devolucion.php" . $import_status);
