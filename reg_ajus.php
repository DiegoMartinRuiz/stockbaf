<?php
session_start();
include('funciones.php');
if (isset($_POST['nserie'])) {
    $usu=$_SESSION['name'];
    $serie = htmlspecialchars($_POST['nserie']);
    $motivo = htmlspecialchars($_POST['texto']);
    $desc_mat = htmlspecialchars($_POST['desc_mat']);
    //consultuo si existe el numero de serie en la tabla de stock de existir actualizo el estado a usado y inserto un registro en la auditoria
    $consulta = ("SELECT * FROM `stock_serie` WHERE `num_serie`= '$serie'");
    $resultado = mysqli_query($conn, $consulta);
    if (mysqli_num_rows($resultado) != 0) {
        //consulto si el equipo ya fue cargado en un archivo de toa
        $consulta3 = ("SELECT * FROM `historial` WHERE `num_serie`= '$serie'");
        $resultado3 = mysqli_query($conn, $consulta3);
        if (mysqli_num_rows($resultado3) != 0) {
        } else {
            $consulta2 = ("UPDATE `stock_serie` SET `disponible`='ajuste negativo', `almacen`='Claro' WHERE `num_serie`= '$serie'");
            mysqli_query($conn, $consulta2);
            $auditoria = "INSERT INTO `reg_asig`(`almacen_destino`, `num_serie`, `desc_mat`) VALUES ('Claro', '$serie', '$desc_mat')";
            mysqli_query($conn, $auditoria);
            $mov_manual = "INSERT INTO `reg_ajus`(`serie`, `desc_mat`, `usuario`, `motivo`) VALUES ('$serie', '$desc_mat','".$_SESSION['name']."','$motivo')";
            mysqli_query($conn, $mov_manual);
        }
    } else {
        
    }
    
  
}
header("Location: ajuste_inv.php" . $import_status);

