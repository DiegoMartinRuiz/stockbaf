<?php
session_start();
include('funciones.php');
if ($_POST['cuadrilla'] == 'null') {
    header("Location: asig_herramientas.php");
} else {
    $sql = "SELECT * FROM herramientas";
    if ($result = mysqli_query($conn, $sql)) {
        $rowcount = mysqli_num_rows($result);
    }
    $cuadrilla = htmlspecialchars($_POST['cuadrilla']);
    $usu = $_SESSION['name'];
    $num = $_POST['numero'];
    $i = 1;
    while ($i <= $rowcount) {
        if (isset($_POST[$i])) {
            if ($_POST[$i] > 0) {
                $sql2 = "SELECT * FROM herramientas WHERE `id`=$i";
                if ($result2 = mysqli_query($conn, $sql2)) {
                    while ($rows2 = mysqli_fetch_assoc($result2)) {
                        $mysql_insert = "INSERT INTO `herramientas_cuadrillas`(`id_op`, `id_herramienta`, `resp_asigno`, `cuadrilla`, `cantidad`) VALUES ($num,$i,'$usu','$cuadrilla',$_POST[$i])";
                        mysqli_query($conn, $mysql_insert) or die("database error:" . mysqli_error($conn));
                        if ($_POST['s_ubicacion' . $i] == 'Rosario') {
                            $new_cant = $rows2['cantidad_rosario'] - $_POST[$i];
                            $mysql_update = "UPDATE `herramientas` SET `cantidad_rosario`=$new_cant WHERE `id`=$i";
                            mysqli_query($conn, $mysql_update) or die("database error:" . mysqli_error($conn));
                        } else {
                            $new_cant = $rows2['cantidad_bsas'] - $_POST[$i];
                            $mysql_update = "UPDATE `herramientas` SET `cantidad_bsas`=$new_cant WHERE `id`=$i";
                            mysqli_query($conn, $mysql_update) or die("database error:" . mysqli_error($conn));
                        }


                        $sqlz = "SELECT * FROM stock_herr WHERE `id_herramienta`=$i AND `cuadrilla`='$cuadrilla'";

                        $resultz = mysqli_query($conn, $sqlz);
                        if (mysqli_num_rows($resultz) != 0) {
                            while ($rowsz = mysqli_fetch_assoc($resultz)) {
                                $actu_cant = $rowsz['cantidad'] + $_POST[$i];
                                $mysql_updatez = "UPDATE `stock_herr` SET `cantidad`=$actu_cant WHERE `id_herramienta`=$i AND `cuadrilla`='$cuadrilla' ";
                                mysqli_query($conn, $mysql_updatez) or die("database error:" . mysqli_error($conn));
                            }
                        } else {
                            $mysql_updatex = "INSERT INTO `stock_herr`(`cuadrilla`, `id_herramienta`, `cantidad`) VALUES ('$cuadrilla',$i,$_POST[$i])";
                            mysqli_query($conn, $mysql_updatex) or die("database error:" . mysqli_error($conn));
                        }
                    }
                }
            } else {
            }
        }
        $i = $i + 1;
    }

    header("Location: asig_herramientas.php");
}
