<?php
include('funciones.php');
session_start();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=almacenes.xls");
header("Pragma: no-cache");
header("Expires: 0");
if (isset($_POST["submit"])) {
    $sql = "SELECT * FROM `stock_serie`";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    if (mysqli_num_rows($resultset) > 0) {
        $export= '
 <table>
                            <thead>
                                <tr>
                                <th>Indice</th>    
                                <th>descrp_mat</th>
                                <th>num_serie</th>
                                <th>mac_address</th>
                                <th>lote</th>
                                <th>cantidad</th>
                                <th>Almacen</th> 
                                <th>centro</th>
                                <th>Disponible</th>
                                </tr>
                            </thead>
                            <tbody>
 ';
 echo $export;
 while ($rows = mysqli_fetch_assoc($resultset)) {
    ?>
    <tr>
        <td><?php echo $rows['id']; ?></td>
        <td><?php echo $rows['descrp_mat']; ?></td>
        <td><?php echo $rows['num_serie']; ?></td>
        <td><?php echo $rows['mac_address']; ?></td>
        <td><?php echo $rows['lote']; ?></td>
        <td><?php echo $rows['cantidad']; ?></td>
        <td><?php echo $rows['almacen']; ?></td>
        <td><?php echo $rows['centro']; ?></td>
        <td><?php echo $rows['disponible']; ?></td>
    </tr>
<?php }
}
}
        echo '</table>';
        