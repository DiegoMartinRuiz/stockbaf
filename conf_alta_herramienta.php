<?php

include('funciones.php');
if (isset($_POST['nueva'])) {
    $n_detalle = htmlspecialchars($_POST['n_detalle']);
    $n_cantidad = htmlspecialchars($_POST['n_cantidad']);
    $n_remito = htmlspecialchars($_POST['remito_alta']);
    $n_ubicacion = htmlspecialchars($_POST['n_ubicacion']);
    if ($n_ubicacion == 'Buenos Aires') {
        $sql_alta = "INSERT INTO `herramientas`(`detalle`, `cantidad_bsas`) VALUES ('$n_detalle',$n_cantidad)";
        mysqli_query($conn, $sql_alta) or die("database error:" . mysqli_error($conn));
        $sql_nuevo_rem = "SELECT * FROM `herramientas` WHERE `detalle`='$n_detalle'";
        $resu_nuevo_rem = mysqli_query($conn, $sql_nuevo_rem);
        while ($rows22 = mysqli_fetch_assoc($resu_nuevo_rem)) {
            $id_carga=$rows22['id'];
            $hist_herra="INSERT INTO `hist_mov_herr`(`id_herramienta`, `remito`, `cantidad`, `ubicacion`) VALUES ('$id_carga','$n_remito',$n_cantidad,'Buenos Aires')";
            mysqli_query($conn,  $hist_herra) or die("database error:" . mysqli_error($conn));
        }
    } else {
        $sql_alta = "INSERT INTO `herramientas`(`detalle`, `cantidad_rosario`) VALUES ('$n_detalle',$n_cantidad)";
        mysqli_query($conn, $sql_alta) or die("database error:" . mysqli_error($conn));
        $sql_nuevo_rem = "SELECT * FROM `herramientas` WHERE `detalle`='$n_detalle'";
        $resu_nuevo_rem = mysqli_query($conn, $sql_nuevo_rem);
        while ($rows22 = mysqli_fetch_assoc($resu_nuevo_rem)) {
            $id_carga=$rows22['id'];
            $hist_herra="INSERT INTO `hist_mov_herr`(`id_herramienta`, `remito`, `cantidad`, `ubicacion`) VALUES ('$id_carga','$n_remito',$n_cantidad,'Rosario')";
            mysqli_query($conn,  $hist_herra) or die("database error:" . mysqli_error($conn));
        }
       
    }
}
if (isset($_POST['stock'])) {
    $n_remito = htmlspecialchars($_POST['remito_alta']);
    $s_id = htmlspecialchars($_POST['s_producto']);
    $s_cantidad = htmlspecialchars($_POST['s_cantidad']);
    $s_ubicacion = htmlspecialchars($_POST['s_ubicacion']);
    $sql_stock = "SELECT * FROM `herramientas` WHERE `id`=$s_id";
    $resu = mysqli_query($conn, $sql_stock);
    while ($rows2 = mysqli_fetch_assoc($resu)) {
        if ($s_ubicacion == 'Buenos Aires') {
            $new_cant = $rows2['cantidad_bsas'] + $s_cantidad;
            $mysql_update = "UPDATE `herramientas` SET `cantidad_bsas`=$new_cant WHERE `id`=$s_id";
            mysqli_query($conn, $mysql_update) or die("database error:" . mysqli_error($conn));
            $hist_herra="INSERT INTO `hist_mov_herr`(`id_herramienta`, `remito`, `cantidad`, `ubicacion`) VALUES ($s_id,'$n_remito',$s_cantidad,'Buenos Aires')";
            mysqli_query($conn,  $hist_herra) or die("database error:" . mysqli_error($conn));
        } else {
            $new_cant = $rows2['cantidad_rosario'] + $s_cantidad;
            $mysql_update = "UPDATE `herramientas` SET `cantidad_rosario`=$new_cant WHERE `id`=$s_id";
            mysqli_query($conn, $mysql_update) or die("database error:" . mysqli_error($conn));
            $hist_herra="INSERT INTO `hist_mov_herr`(`id_herramienta`, `remito`, `cantidad`, `ubicacion`) VALUES ($s_id,'$n_remito',$s_cantidad,'Rosario')";
            mysqli_query($conn,  $hist_herra) or die("database error:" . mysqli_error($conn));
        }
    }
}
echo "$n_remito";
header("Location: alta_herramienta.php");