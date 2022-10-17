<?php
include('funciones.php');
if (isset($_POST['import_data'])) {
// validate to check uploaded file is a valid csv file
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');
            while (($emp_record = fgetcsv($csv_file)) !== FALSE) {
                $sql_query = "SELECT * FROM stock_serie";
                $resultset = mysqli_query($conn, $sql_query) or die("database error:" . mysqli_error($conn));

//si el numero de serie esta vacio cargo la info
                if (empty($emp_record[8])) {
                    $fecha_limite = date("$emp_record[15]");
                    //$fecha_limite = date("Y-m-d", strtotime($fecha_actual . "+ 120 days"));
                    $mysql_insert = "INSERT INTO stock_serie (contratista, r_soc, cod_opera, centro, sociedad, almacen, num_mat, descrp_mat, num_serie, mac_address, elemen_pep, lote, cantidad, unidad, estado, fec_ing, pedido, fec_ult_mov, cl_mov, doc_mat, orden, posicion, doc_mat2, rechazado, pre_aprobado, aprobado, disponible, f_limite)VALUES('" . $emp_record[0] . "','" . $emp_record[1] . "', '" . $emp_record[2] . "', '" . $emp_record[3] . "', '" . $emp_record[4] . "', '" . $emp_record[5] . "', '" . $emp_record[6] . "', '" . $emp_record[7] . "', '" . $emp_record[8] . "', '" . $emp_record[9] . "', '" . $emp_record[10] . "', '" . $emp_record[11] . "', '" . $emp_record[12] . "', '" . $emp_record[13] . "', '" . $emp_record[14] . "', '" . $emp_record[15] . "', '" . $emp_record[16] . "', '" . $emp_record[17] . "', '" . $emp_record[18] . "', '" . $emp_record[19] . "', '" . $emp_record[20] . "', '" . $emp_record[21] . "', '" . $emp_record[22] . "','" . $emp_record[23] . "', '" . $emp_record[24] . "', '" . $emp_record[25] . "', 'si', '$fecha_limite')";
                    mysqli_query($conn, $mysql_insert) or die("database error:" . mysqli_error($conn));
                    $auditoria = "INSERT INTO `reg_asig`(`almacen_destino`, `num_serie`, `desc_mat`) VALUES ('" . $emp_record[5] . "', '" . $emp_record[8] . "', '" . $emp_record[7] . "')";
                    mysqli_query($conn, $auditoria);
                     
                       
            } else {
                    //si el numero de serie no esta vacio consulto si esta en la base de datos
                    $duplicado = ("SELECT * FROM `stock_serie` WHERE `num_serie` = '" . $emp_record[8] . "'");
                    $consulta_duplicado = mysqli_query($conn, $duplicado);
                    if (mysqli_num_rows($consulta_duplicado) != 0) {
                        
                    } else {
                        if(!empty($emp_record[15])){
                        $resul = str_replace("/", "-", $emp_record[15]);
                        $fecha_actual = date('m/d/Y',strtotime($resul));
                        $fecha_limite = date("Y-m-d", strtotime($fecha_actual . "+ 120 days"));
                        $mysql_insert = "INSERT INTO stock_serie (contratista, r_soc, cod_opera, centro, sociedad, almacen, num_mat, descrp_mat, num_serie, mac_address, elemen_pep, lote, cantidad, unidad, estado, fec_ing, pedido, fec_ult_mov, cl_mov, doc_mat, orden, posicion, doc_mat2, rechazado, pre_aprobado, aprobado, disponible, f_limite, remito, f_remito)VALUES('" . $emp_record[0] . "','" . $emp_record[1] . "', '" . $emp_record[2] . "', '" . $emp_record[3] . "', '" . $emp_record[4] . "', '" . $emp_record[5] . "', '" . $emp_record[6] . "', '" . $emp_record[7] . "', '" . $emp_record[8] . "', '" . $emp_record[9] . "', '" . $emp_record[10] . "', '" . $emp_record[11] . "', '" . $emp_record[12] . "', '" . $emp_record[13] . "', '" . $emp_record[14] . "', '" . $emp_record[15] . "', '" . $emp_record[16] . "', '" . $emp_record[17] . "', '" . $emp_record[18] . "', '" . $emp_record[19] . "', '" . $emp_record[20] . "', '" . $emp_record[21] . "', '" . $emp_record[22] . "','" . $emp_record[23] . "', '" . $emp_record[24] . "', '" . $emp_record[25] . "', 'si', '$fecha_limite','".$_POST['remito']."','".$_POST['fecha_remito']."')";
                        mysqli_query($conn, $mysql_insert) or die("database error:" . mysqli_error($conn));
                        $auditoria = "INSERT INTO `reg_asig`(`almacen_destino`, `num_serie`, `desc_mat`) VALUES ('" . $emp_record[5] . "', '" . $emp_record[8] . "', '" . $emp_record[7] . "')";
                        mysqli_query($conn, $auditoria);
                        }
                    else{
                        
                        $fecha_limite = date("Y-m-d", strtotime($_POST['fecha_remito'] . "+ 120 days"));
                        $mysql_insert = "INSERT INTO stock_serie (contratista, r_soc, cod_opera, centro, sociedad, almacen, num_mat, descrp_mat, num_serie, mac_address, elemen_pep, lote, cantidad, unidad, estado, fec_ing, pedido, fec_ult_mov, cl_mov, doc_mat, orden, posicion, doc_mat2, rechazado, pre_aprobado, aprobado, disponible, f_limite, remito, f_remito)VALUES('" . $emp_record[0] . "','" . $emp_record[1] . "', '" . $emp_record[2] . "', '" . $emp_record[3] . "', '" . $emp_record[4] . "', '" . $emp_record[5] . "', '" . $emp_record[6] . "', '" . $emp_record[7] . "', '" . $emp_record[8] . "', '" . $emp_record[9] . "', '" . $emp_record[10] . "', '" . $emp_record[11] . "', '" . $emp_record[12] . "', '" . $emp_record[13] . "', '" . $emp_record[14] . "', '" . $emp_record[15] . "', '" . $emp_record[16] . "', '" . $emp_record[17] . "', '" . $emp_record[18] . "', '" . $emp_record[19] . "', '" . $emp_record[20] . "', '" . $emp_record[21] . "', '" . $emp_record[22] . "','" . $emp_record[23] . "', '" . $emp_record[24] . "', '" . $emp_record[25] . "', 'si', '$fecha_limite','".$_POST['remito']."','".$_POST['fecha_remito']."')";
                        mysqli_query($conn, $mysql_insert) or die("database error:" . mysqli_error($conn));
                        $auditoria = "INSERT INTO `reg_asig`(`almacen_destino`, `num_serie`, `desc_mat`) VALUES ('" . $emp_record[5] . "', '" . $emp_record[8] . "', '" . $emp_record[7] . "')";
                        mysqli_query($conn, $auditoria);
                    }
                    }
                }
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
header("Location: stock_import.php");