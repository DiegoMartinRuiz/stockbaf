<?php
include('funciones.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
} else {
    // Show users the page!
    ?>
    <!DOCTYPE html>
    <!--
    Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
    Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
    -->
    <html>
        <head>
            <title>TechMovil </title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <LINK REL=StyleSheet HREF="estilos.css" TYPE="text/css" MEDIA=screen>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
            <link rel="shortcut icon" href="tech.ico" />
        </head>
        <body>
            <?php mostrarMenu() ?>

            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <br>
                        <div class="row">


                        </div>
                        <br>
                        <div class="row">
                            </p>
                            <form action="reg_devo.php" method="post" enctype="multipart/form-data" id="import_form"></br>
                                <table>
                                    <td>
                                        <label> Ingresar Numeros de Series para Devolucion</label></br>
                                        <textarea name="nserie" cols="40" rows="8"></textarea></br>
                                        
                                    </td>
                                    </td>
                                    <td style="width:120px">
                                    <td>
                                        <label>Motivo de la devolucion</label></br>
                                        <textarea cols="40" rows="8" name="texto" onKeyDown="valida_longitud()" onKeyUp="valida_longitud()"></textarea></br>
                                        <label>(450 caracteres maximo)</label></br>           </br></br>                             
                                        <input type="submit"  name="import_data" value="Registrar Movimiento Manual..."></p>
                                    </td>
                                </table>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </body>
        <script type="text/javascript">
            contenido_textarea = "";
            num_caracteres_permitidos = 450;

            function valida_longitud() {
                num_caracteres = document.forms[0].texto.value.length;
                if (num_caracteres > num_caracteres_permitidos) {
                    document.forms[0].texto.value = contenido_textarea;
                } else {
                    contenido_textarea = document.forms[0].texto.value;
                }

                if (num_caracteres >= num_caracteres_permitidos) {
                    document.forms[0].caracteres.style.color = "#ff0000";
                } else {
                    document.forms[0].caracteres.style.color = "#000000";
                }
                cuenta()
            }

            function cuenta() {
                document.forms[0].caracteres.value = document.forms[0].texto.value.length;
            }

        </script>

    </html>
    <?php
}


