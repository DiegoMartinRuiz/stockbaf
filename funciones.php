<?php

/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unificada";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn->set_charset('utf8');
if (mysqli_connect_errno()) {
    printf("Connect failed: %sn", mysqli_connect_error());
    exit();
}

function mostrarMenu() {
    echo"<nav id = 'menu'>";
    echo"<a href = '#' class = 'enlace'>";
    echo"<img src = 'logo.png' alt = '' class = 'logo'>";
    echo"</a>";
    //<!--start menu-->
    echo"<ul>";
    echo"<li><a href = '#'>Stock</a>";
    //<!--start menu desplegable Stock-->
    echo"<ul>";
    echo"<li><a href = 'stock_import.php'>Carga de Productos por Archivo</a></li>";
    echo"<li><a href = 'Consulta_serie.php'>Consulta por Numero de Serie</a></li>";
    echo"<li><a href = 'cons_almacen.php'>Consulta por Deposito</a></li>";
    echo"<li><a href = 'consolidacion.php'>Consolidacion por Archivo</a></li>";
    echo"<li><a href = 'devolucion.php'>Devoluciones</a></li>";
    echo"<li><a href = 'ajuste_inv.php'>Ajuste de Inventarios</a></li>";
    echo"<li><a href = 'consulta_fechas.php'>Stock Ordenado por Fechas</a></li>";
    echo"</ul>";
    //<!--end menu desplegable-->
    echo"</li>";
    echo"<li><a href = '#'>Cuadrillas</a>";
    //<!--start menu desplegable Cuadrillas-->
    echo"<ul>";
    echo"<li><a href ='cuadrillas_asignacion.php'>Asignacion de Materiales</a></li>";
    echo"<li><a href ='control_stock.php'>Control de Stock</a></li>";
    echo"<li><a href ='asig_herramientas.php'>Asignacion de Herramientas</a></li>";
    echo"<li><a href ='cons_herramientas_cuadrilla.php'>Control de Herramientas</a></li>";
    echo"<li><a href ='reasignar_herramienta.php'>Reasignar Herramientas</a></li>";
    echo"</ul>";
    //<!--end menu desplegable-->
    echo"</li>";
    echo"<li><a href = '#'>Movimientos TOA</a>";
     //<!--start menu desplegable Movimientos Toa-->
    echo"<ul>";
    echo"<li><a href = 'toa_imp.php'>Importacion de archivo de TOA</a></li>";
    echo"<li><a href = 'toa_imp_man.php'>Ingreso Manual de Movimientos TOA</a></li>";
    echo"<li><a href = 'cons_toa_fecha.php'>Consulta movimientos por fecha</a></li>";
    echo"<li><a href = 'consulta_toa_ot.php'>Consultar Orden de trabajo</a></li>";
    echo"</ul>";
     //<!--end menu desplegable-->
    echo"</li>";
    echo"<li><a href = '#'>Altas</a>";
     //<!--start menu desplegable Altas-->
    echo"<ul>";
    echo"<li><a href = 'alta_herramienta.php'>Alta de Herramientas</a></li>";
    echo"<li><a href = 'alta_cuadrilla.php'>Alta - Modificacion de Cuadrilla</a></li>";
    echo"<li><a href = 'register.php'>Alta de Usuario</a></li>";
    echo"</ul>";
    //<!--end menu desplegable-->
    echo"</li>";
    echo"<li><a href = '#'>Autorizaciones</a>";
    //<!--start menu desplegable Autorizaciones-->
    echo"<ul>";
    echo"<li><a href = 'autorizacion_devolucion.php'>Autorizacion de Devolucion</a></li>";
    echo"<li><a href = 'autorizacion_ajuste.php'>Autorizacion de Ajuste</a></li>";
    echo"</ul>";
    echo"</li>";
    echo"<li><a href = 'salir.php'>SALIR</a></li>";
    echo"</ul>";
    //<!--end menu-->
    echo"</nav>";
}

function compararFechas($primera, $segunda)
 {
  $valoresPrimera = explode ("/", $primera);   
  $valoresSegunda = explode ("-", $segunda); 

  $diaPrimera    = $valoresPrimera[0];  
  $mesPrimera  = $valoresPrimera[1];  
  $anyoPrimera   = $valoresPrimera[2]; 

  $diaSegunda   = $valoresSegunda[0];  
  $mesSegunda = $valoresSegunda[1];  
  $anyoSegunda  = $valoresSegunda[2];

  $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
  $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);     

  if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
    // "La fecha ".$primera." no es v&aacute;lida";
    return 0;
  }elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
    // "La fecha ".$segunda." no es v&aacute;lida";
    return 0;
  }else{
    return  $diasPrimeraJuliano - $diasSegundaJuliano;
  } 

}

