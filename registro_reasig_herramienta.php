<?php
session_start();
include('funciones.php');
$id_seguie = "SELECT MAX(`id_op`) as id_max FROM `herramientas_cuadrillas` ";
$id_nueva = mysqli_query($conn, $id_seguie);
$rows1 = mysqli_fetch_assoc($id_nueva);
$id_op_nuevo = $rows1['id_max'] + 1;
$usu = $_SESSION['name'];
$sql = "SELECT * FROM herramientas";
if ($result = mysqli_query($conn, $sql)) {
    $rowcount = mysqli_num_rows($result);
}

$i = 1;
while ($i <= $rowcount) {
    if (isset($_POST['cuadrilla' . $i])) {
        if ($_POST['cuadrilla' . $i] == 'null') {
            header("Location: asig_herramientas.php");
        } else {
            $depo_destino = $_POST['cuadrilla' . $i];
            $depo_origen = $_POST['depo_origen'];
            $cant_reasig = $_POST['cant_reasig' . $i];
            $id_herramienta = $_POST['id_herr' . $i];
            if ($depo_destino == 'ros') {
                $sql_ros = "SELECT * FROM `herramientas` WHERE  `id`=$id_herramienta";
                $res_sql_ros = mysqli_query($conn, $sql_ros) or die("database error:" . mysqli_error($conn));
                while ($rows_sql_ros = mysqli_fetch_assoc($res_sql_ros)) {
                    $new_cant_ros = $rows_sql_ros['cantidad_rosario'] + $cant_reasig;
                    $sql_up_ros = "UPDATE `herramientas` SET `cantidad_rosario`=$new_cant_ros WHERE `id`=$id_herramienta";
                    mysqli_query($conn, $sql_up_ros);
                }
            }
            if ($depo_destino == 'bsas') {
                $sql_ros = "SELECT * FROM `herramientas` WHERE  `id`=$id_herramienta";
                $res_sql_ros = mysqli_query($conn, $sql_ros) or die("database error:" . mysqli_error($conn));
                if (mysqli_num_rows($res_sql_ros)) {
                    while ($rows_sql_ros = mysqli_fetch_assoc($res_sql_ros)) {
                        $new_cant_ros = $rows_sql_ros['cantidad_bsas'] + $cant_reasig;
                        $sql_up_ros = "UPDATE `herramientas` SET `cantidad_bsas`=$new_cant_ros WHERE `id`=$id_herramienta";
                        mysqli_query($conn, $sql_up_ros);
                    }
                }
            }
            if ($depo_destino != 'bsas' and $depo_destino != 'ros') {
                $sql_destino = "SELECT * FROM `stock_herr` WHERE `cuadrilla`='$depo_destino' AND `id_herramienta`='$id_herramienta'";
                $res_destino = mysqli_query($conn, $sql_destino) or die("database error:" . mysqli_error($conn));
                if (mysqli_num_rows($res_destino)) {
                    while ($rows_destino = mysqli_fetch_assoc($res_destino)) {
                        $new_destino = $rows_destino['cantidad'] + $cant_reasig;
                        $sql_nueva_cantidad = "UPDATE `stock_herr` SET `cantidad`=$new_destino WHERE `cuadrilla`='$depo_destino' AND `id_herramienta`='$id_herramienta'";
                        mysqli_query($conn, $sql_nueva_cantidad);
                        $sql_nuevo_destx = "INSERT INTO `herramientas_cuadrillas`( `id_op`, `id_herramienta`, `resp_asigno`, `cuadrilla`, `cantidad`) VALUES ($id_op_nuevo,$id_herramienta,'$usu','$depo_destino',$cant_reasig)";
                        mysqli_query($conn, $sql_nuevo_destx);
                        $cant_nega= $cant_reasig* -1;
                        $sql_nuevo_destx_negativo = "INSERT INTO `herramientas_cuadrillas`( `id_op`, `id_herramienta`, `resp_asigno`, `cuadrilla`, `cantidad`) VALUES ($id_op_nuevo,$id_herramienta,'$usu','$depo_origen',$cant_nega)";
                        mysqli_query($conn, $sql_nuevo_destx_negativo);
                    }
                } else {
                    $sql_nuevo_destx1 = "INSERT INTO `herramientas_cuadrillas`( `id_op`, `id_herramienta`, `resp_asigno`, `cuadrilla`, `cantidad`) VALUES ($id_op_nuevo,$id_herramienta,'$usu','$depo_destino',$cant_reasig)";
                    mysqli_query($conn, $sql_nuevo_destx1);
                    $sql_nuevo_destx1_negativo = "INSERT INTO `stock_herr`( `cuadrilla`, `id_herramienta`, `cantidad`) VALUES ('$depo_destino',$id_herramienta,$cant_reasig)";
                    mysqli_query($conn, $sql_nuevo_destx1_negativo);
                    //$sqlnuevo2 = "INSERT INTO `stock_herr`( `cuadrilla`, `id_herramienta`, `cantidad`) VALUES ('$depo_destino',$id_herramienta,$cant_reasig)";
                    //mysqli_query($conn, $sqlnuevo2);
                }
            }



            $baja = "SELECT * FROM `stock_herr` WHERE `cuadrilla`='$depo_origen' AND `id_herramienta`='$id_herramienta'";
            $res_baja = mysqli_query($conn, $baja) or die("database error:" . mysqli_error($conn));
            if (mysqli_num_rows($res_baja)) {
                while ($rows_baja = mysqli_fetch_assoc($res_baja)) {
                    $new_baja = $rows_baja['cantidad'] - $cant_reasig;
                    $sql_nueva_cantidad = "UPDATE `stock_herr` SET `cantidad`=$new_baja WHERE `cuadrilla`='$depo_origen' AND `id_herramienta`='$id_herramienta'";
                    mysqli_query($conn, $sql_nueva_cantidad);
                    $sql_nuevo_destx = "INSERT INTO `herramientas_cuadrillas`( `id_op`, `id_herramienta`, `resp_asigno`, `cuadrilla`, `cantidad`) VALUES ($id_op_nuevo,$id_herramienta,'$usu','$depo_destino',$cant_reasig)";
                    mysqli_query($conn, $sql_nuevo_destx);
                }
            }
            $i = $i + 1;
        }
    } else {
        $i = $i + 1;
    }
}
header("Location: asig_herramientas.php");
