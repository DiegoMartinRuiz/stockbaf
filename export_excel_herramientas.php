<?php
include('funciones.php');
session_start();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=herramientas.xls");
header("Pragma: no-cache");
header("Expires: 0");
if (isset($_POST["submit"])) {
    $sql7 = "SELECT * FROM `stock_herr` ";
    $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
    if (mysqli_num_rows($resultset7) > 0) {
        $export= '
 <table>
                            <thead>
                                <tr>
                                <th>Cuadrilla</th>    
                                <th>Herramienta</th>
                                <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
 ';
 echo $export;
 while ($rows7 = mysqli_fetch_assoc($resultset7)) {
    $sql_herr8 = "SELECT * FROM `herramientas` WHERE `id`=" . $rows7['id_herramienta'];
    $resultset9 = mysqli_query($conn, $sql_herr8) or die("database error:" . mysqli_error($conn));
    if (mysqli_num_rows($resultset9)) {
        while ($rowsj = mysqli_fetch_assoc($resultset9)) {
            ?>
            <tr>
                <td><?php echo $rows7['cuadrilla']; ?></td>
                <td><?php echo $rowsj['detalle']; ?></td>
                <td><?php echo $rows7['cantidad']; ?></td>
            </tr>
            <?php
        }
    }
}
}
}
        echo '</table>';