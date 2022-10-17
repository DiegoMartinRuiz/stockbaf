<?php
include('funciones.php');
$sql_1 = "SELECT `num_serie`, COUNT(*) Total FROM `historial` WHERE `num_serie` <>'' GROUP BY `num_serie` HAVING COUNT(*) > 1;;";
$resultset1 = mysqli_query($conn, $sql_1);
if (mysqli_num_rows($resultset1)) {
    while ($rows = mysqli_fetch_assoc($resultset1)) {
        $sql_2 = "SELECT MAX(`id_toa`) AS 'id_d' FROM `historial` WHERE `num_serie`='".$rows['num_serie']."'";
        $resultset2 = mysqli_query($conn, $sql_2);
        while ($rows2 = mysqli_fetch_assoc($resultset2)) {
            $sql_3 = "DELETE FROM `historial` WHERE `id_toa`='".$rows2['id_d']."'";
            mysqli_query($conn, $sql_3);
        }
    }
}

