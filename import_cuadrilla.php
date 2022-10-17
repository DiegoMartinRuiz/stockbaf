<?php
session_start();
include('funciones.php');
if (isset($_POST['import_data'])) {
// validate to check uploaded file is a valid csv file
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');
            $id_seguie = "SELECT MAX(`id_op`) as id_max FROM `temp_asig` ";
            $id_res = mysqli_query($conn, $id_seguie);
            $id_nueva = mysqli_query($conn, $id_seguie);
            $rows1 = mysqli_fetch_assoc($id_nueva);
            $id_car = $rows1['id_max'] + 1;
//fgetcsv($csv_file);
// get data records from csv file
            while (($emp_record = fgetcsv($csv_file)) !== FALSE) {
// Check if employee already exists with same email
                $sql_query = "SELECT * FROM historial";
                $resultset = mysqli_query($conn, $sql_query) or die("database error:" . mysqli_error($conn));
// if employee already exist then update details otherwise insert new record
//if(mysqli_num_rows($resultset)) {
//$sql_update = "UPDATE stock_serie set contratista='".$emp_record[0]."', r_soc='".$emp_record[1]."', cod_opera='".$emp_record[2]."', centro='".$emp_record[3]."', sociedad='".$emp_record[4]."', almacen='".$emp_record[5]."',  descrp_mat='".$emp_record[7]."', mac_address='".$emp_record[9]."', elemen_pep='".$emp_record[10]."', lote='".$emp_record[11]."', cantidad='".$emp_record[12]."', unidad='".$emp_record[13]."', estado='".$emp_record[14]."', fec_ing='".$emp_record[15]."', pedido='".$emp_record[16]."', fec_ult_mov='".$emp_record[17]."', cl_mov='".$emp_record[18]."', doc_mat='".$emp_record[19]."', orden='".$emp_record[20]."', posicion='".$emp_record[21]."', doc_mat2='".$emp_record[22]."', rechazado='".$emp_record[23]."', pre_aprobado='".$emp_record[24]."', aprobado='".$emp_record[25]."' WHERE num_mat='".$emp_record[6]."' AND num_serie='".$emp_record[8]."'";                                                                                                                                  									
//mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));
//$mysql_insert = "INSERT INTO stock_serie (contratista, r_soc, cod_opera, centro, sociedad, almacen, num_mat, descrp_mat, num_serie, mac_address, elemen_pep, lote, cantidad, unidad, estado, fec_ing, pedido, fec_ult_mov, cl_mov, doc_mat, orden, posicion, doc_mat2, rechazado, pre_aprobado, aprobado)VALUES('".$emp_record[0]."','".$emp_record[1]."', '".$emp_record[2]."', '".$emp_record[3]."', '".$emp_record[4]."', '".$emp_record[5]."', '".$emp_record[6]."', '".$emp_record[7]."', '".$emp_record[8]."', '".$emp_record[9]."', '".$emp_record[10]."', '".$emp_record[11]."', '".$emp_record[12]."', '".$emp_record[13]."', '".$emp_record[14]."', '".$emp_record[15]."', '".$emp_record[16]."', '".$emp_record[17]."', '".$emp_record[18]."', '".$emp_record[19]."', '".$emp_record[20]."', '".$emp_record[21]."', '".$emp_record[22]."','".$emp_record[23]."', '".$emp_record[24]."', '".$emp_record[25]."')";
//mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
//}
                $stock1 = "SELECT * FROM `stock_serie` WHERE `num_serie`='$emp_record[0]' AND `disponible`='si'";
                $resul1 = mysqli_query($conn, $stock1);
                while ($setw1 = mysqli_fetch_assoc($resul1)) {
                    $mat = $setw1['descrp_mat'];
                    $mysql_insert1 = "INSERT INTO temp_asig (id_op, num_serie, desc_mat)VALUES($id_car,'" . $emp_record[0] . "', '$mat')";
                    mysqli_query($conn, $mysql_insert1) or die("database error:" . mysqli_error($conn));
                }
//si se encuentra el material y el numero de serie se actualiza el estado de disponibilidad de la tabla de stock
//mysql_query($conn, $consulta);
            }
            fclose($csv_file);
            $import_status = '?import_status=success';
        } else {
            $import_status = '?import_status=error';
        }
    } else {
        $import_status = '?import_status=invalid_file';
    }
}
if (isset($_POST['flag'])) {
    $id_seguie = "SELECT MAX(`id_op`) as id_max FROM `temp_asig` ";
            $id_res = mysqli_query($conn, $id_seguie);
            $id_nueva = mysqli_query($conn, $id_seguie);
            $rows1 = mysqli_fetch_assoc($id_nueva);
            $id_car = $rows1['id_max'] + 1;
    $arr = explode("\r\n", trim($_POST['nserie']));
    $usu = $_SESSION['name'];
    //consultuo si existe el numero de serie en la tabla de stock de existir actualizo el estado a usado y inserto un registro en la auditoria
    for ($i = 0; $i < count($arr); $i++) {
       $stock = "SELECT * FROM `stock_serie` WHERE `num_serie`='$arr[$i]' AND `disponible`='si'";
                $resul = mysqli_query($conn, $stock);
                while ($setw = mysqli_fetch_assoc($resul)) {
                    $mat = $setw['descrp_mat'];
                    $mysql_insert = "INSERT INTO temp_asig (id_op, num_serie, desc_mat)VALUES($id_car,'$arr[$i]', '$mat')";
                    mysqli_query($conn, $mysql_insert) or die("database error:" . mysqli_error($conn));
                }
    }//fin del for
}

header("Location: remito_baf.php");
