<?php
include('funciones.php');
if (isset($_POST['import_data'])) {
// validate to check uploaded file is a valid csv file
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');
            while (($emp_record = fgetcsv($csv_file)) !== FALSE) {
                        $mysql_insert = "INSERT INTO historial (actividad, ordentrabajo, tipo_tramite, desc_tramite, tecno, mat, desc_mat, num_serie, cant, nim, estado, servicio, desc_servicio, tecnico, tipo_agrupador, orden_compra, centro, desc_centro, almacen, desc_almacen, f_act_ofsc, f_informado, f_ult_mod, a_presup, agrup_de_pres_mo, agrup_de_pres_sm, almacen1, cant1, cege, centro_contratista, centro_costo, centro_serv, cl_valoracion, cl_movimiento, contratista, contratista1, contrato_marco, costo_servicio, denomina_contrato, desc_resultado, desc_almacen1, desc_centro2, desc_mat2, desc_serv2, doc_dev, doc_material, doc_presup, elemento_pep, error, estatus_act, f_cancela_serv, f_cierre_act, f_ejercicio_sig, f_instalacion, f_modifica, h_modifica, id_sitio, importe_dev, importe_pep, ind_agrupador_presup, lote, material2, naturaleza_pep, nodo_region, num_de_pago, num_de_posicion, num_de_serie, num_de_serv, operatoria, o_trabajo, pais, posicion_presup, prec_med_var_cal, precio_medio_var, procesado, provincia, resultado, sistema_legado, sociedad_fl, tecnologia, tipo_tramite2, tramite_sin_serie, ubic_tecnica, unidad_org, usuario, usuario_cancela_s, usuario_cierre_act, usuario_ejercicio_s, usuario_mod
)VALUES('" . $emp_record[0] . "','" . $emp_record[1] . "', '" . $emp_record[2] . "', '" . $emp_record[3] . "', '" . $emp_record[4] . "', '" . $emp_record[5] . "', '" . $emp_record[6] . "', '" . $emp_record[7] . "', '" . $emp_record[8] . "', '" . $emp_record[9] . "', '" . $emp_record[10] . "', '" . $emp_record[11] . "', '" . $emp_record[12] . "', '" . $emp_record[13] . "', '" . $emp_record[14] . "', '" . $emp_record[15] . "', '" . $emp_record[16] . "', '" . $emp_record[17] . "', '" . $emp_record[18] . "', '" . $emp_record[19] . "', '" . $emp_record[20] . "', '" . $emp_record[21] . "', '" . $emp_record[22] . "','" . $emp_record[23] . "', '" . $emp_record[24] . "', '" . $emp_record[25] . "','" . $emp_record[26] . "','" . $emp_record[27] . "', '" . $emp_record[28] . "', '" . $emp_record[29] . "', '" . $emp_record[30] . "', '" . $emp_record[31] . "', '" . $emp_record[32] . "', '" . $emp_record[33] . "', '" . $emp_record[34] . "', '" . $emp_record[35] . "', '" . $emp_record[36] . "', '" . $emp_record[37] . "', '" . $emp_record[38] . "', '" . $emp_record[39] . "', '" . $emp_record[40] . "', '" . $emp_record[41] . "', '" . $emp_record[42] . "', '" . $emp_record[43] . "', '" . $emp_record[44] . "', '" . $emp_record[45] . "', '" . $emp_record[46] . "', '" . $emp_record[47] . "', '" . $emp_record[48] . "','" . $emp_record[49] . "', '" . $emp_record[50] . "', '" . $emp_record[51] . "','" . $emp_record[52] . "','" . $emp_record[53] . "', '" . $emp_record[54] . "', '" . $emp_record[55] . "', '" . $emp_record[56] . "', '" . $emp_record[57] . "', '" . $emp_record[58] . "', '" . $emp_record[59] . "', '" . $emp_record[60] . "', '" . $emp_record[61] . "', '" . $emp_record[62] . "', '" . $emp_record[63] . "', '" . $emp_record[64] . "', '" . $emp_record[65] . "', '" . $emp_record[66] . "', '" . $emp_record[67] . "', '" . $emp_record[68] . "', '" . $emp_record[69] . "', '" . $emp_record[70] . "', '" . $emp_record[71] . "', '" . $emp_record[72] . "', '" . $emp_record[73] . "', '" . $emp_record[74] . "','" . $emp_record[75] . "', '" . $emp_record[76] . "', '" . $emp_record[77] . "','" . $emp_record[78] . "','" . $emp_record[79] . "', '" . $emp_record[80] . "', '" . $emp_record[81] . "', '" . $emp_record[82] . "', '" . $emp_record[83] . "', '" . $emp_record[84] . "', '" . $emp_record[85] . "', '" . $emp_record[86] . "', '" . $emp_record[87] . "', '" . $emp_record[88] . "')";
                        mysqli_query($conn, $mysql_insert) or die("database error:" . mysqli_error($conn));              
                $consulta = ("SELECT * FROM `stock_serie` WHERE `num_mat` = '" . $emp_record[5] . "' AND `num_serie`= '" . $emp_record[7] . "'");
                $resultado = mysqli_query($conn, $consulta);
                if (mysqli_num_rows($resultado) != 0) {
                    $consulta2 = ("UPDATE `stock_serie` SET `disponible`='usado' WHERE `num_mat`= '" . $emp_record[5] . "' AND`num_serie`= '" . $emp_record[7] . "'");
                    mysqli_query($conn, $consulta2);
                    $auditoria = "INSERT INTO `reg_asig`(`almacen_destino`, `num_serie`, `desc_mat`) VALUES ('Utilizado', '" . $emp_record[7] . "', '" . $emp_record[3] . "')";
                    mysqli_query($conn, $auditoria);
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
header("Location: toa_imp.php" . $import_status);

