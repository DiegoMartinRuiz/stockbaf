<?php
include('funciones.php');
session_start();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=control_fechas.xls");
header("Pragma: no-cache");
header("Expires: 0");
if (isset($_POST["submit"])) {
    $query = "SELECT  `id`, `descrp_mat`,`num_serie`,`mac_address`,`lote`,`cantidad`,`estado`,`centro`, `f_limite` FROM `stock_serie` WHERE `disponible`='si' ORDER BY `f_limite` ASC";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
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
                                    <th>estado</th>
                                    <th>centro</th>
                                    <th>Fecha Limite</th>
                                </tr>
                            </thead>
                            <tbody>
 ';
 echo $export;
 while ($rows = mysqli_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>" . $rows['id'] . "</td>";
        echo "<td>" . $rows['descrp_mat'] . "</td>";
        echo "<td>" . $rows['num_serie'] . "</td>";
        echo "<td>" . $rows['mac_address'] . "</td>";
        echo "<td>" . $rows['lote'] . "</td>";
        echo "<td>" . $rows['cantidad'] . "</td>";
        echo "<td>" . $rows['estado'] . "</td>";
        echo "<td>" . $rows['centro'] . "</td>";
        echo "<td>" . $rows['f_limite']  . "</td>";
        echo "</tr>";
    } 
}
        echo '</table>';
        
    }
