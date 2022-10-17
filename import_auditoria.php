<?php

include('funciones.php');
if (isset($_POST['import_data'])) {
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');
            while (($emp_record = fgetcsv($csv_file)) !== FALSE) {
// Check if employee already exists with same email
                $sql_query = "SELECT * FROM auditoria";
                $resultset = mysqli_query($conn, $sql_query) or die("database error:" . mysqli_error($conn));
                $mysql_insert = "INSERT INTO auditoria (contratista, r_soc, cod_opera, centro, sociedad, almacen, num_mat, descrp_mat, num_serie, mac_address, elemen_pep, lote, cantidad, unidad, estado, fec_ing, pedido, fec_ult_mov, cl_mov, doc_mat, orden, posicion, doc_mat2, rechazado, pre_aprobado, aprobado, disponible)VALUES('" . $emp_record[0] . "','" . $emp_record[1] . "', '" . $emp_record[2] . "', '" . $emp_record[3] . "', '" . $emp_record[4] . "', '" . $emp_record[5] . "', '" . $emp_record[6] . "', '" . $emp_record[7] . "', '" . $emp_record[8] . "', '" . $emp_record[9] . "', '" . $emp_record[10] . "', '" . $emp_record[11] . "', '" . $emp_record[12] . "', '" . $emp_record[13] . "', '" . $emp_record[14] . "', '" . $emp_record[15] . "', '" . $emp_record[16] . "', '" . $emp_record[17] . "', '" . $emp_record[18] . "', '" . $emp_record[19] . "', '" . $emp_record[20] . "', '" . $emp_record[21] . "', '" . $emp_record[22] . "','" . $emp_record[23] . "', '" . $emp_record[24] . "', '" . $emp_record[25] . "', 'si')";
                mysqli_query($conn, $mysql_insert) or die("database error:" . mysqli_error($conn));
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
header("Location: res_consolida.php");

