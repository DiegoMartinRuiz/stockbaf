<?php
include('funciones.php');
session_start();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=devoluciones.xls");
header("Pragma: no-cache");
header("Expires: 0");
if (isset($_POST["submit"])) {
    $sql = "SELECT * FROM devolucion WHERE autorizado='pendiente'";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    if (mysqli_num_rows($resultset) > 0) {
        $export= '
 <table>
                            <thead>
                                <tr>
                                <th>Indice</th>    
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Motivo</th>
                                <th>Material</th>
                                <th>Numero de Serie</th>
                                </tr>
                            </thead>
                            <tbody>
 ';
 echo $export;
 while ($rows = mysqli_fetch_assoc($resultset)) {
    $num_serie_stock = $rows['serie'];
    $sql2 = "SELECT * FROM stock_serie WHERE num_serie='$num_serie_stock'";
    $resultset2 = mysqli_query($conn, $sql2) or die("database error:" . mysqli_error($conn));
    while ($rows2 = mysqli_fetch_assoc($resultset2)) {
        ?>
        <tr>
            <td><?php echo $rows['id']; ?></td>
            <td><?php echo $rows['fecha']; ?></td>
            <td><?php echo $rows['usuario']; ?></td>
            <td><?php echo $rows['motivo']; ?></td>
            <td><?php echo $rows2['descrp_mat']; ?></td>
            <td><?php echo $rows['serie']; ?></td>
        </tr>
        <?php
    }
}
}
        echo '</table>';
        
    }
