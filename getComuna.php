<?php
	require('connection/conexion.php');
	// establezco la conexión para que funcione $mysqli
	$mysqli = new mysqli("localhost", "root", "", "formulario");
	
	$id_regiones = $_POST['id_regiones'];
	
	$queryC = "SELECT id_comunas, nombre_comunas, region_id  FROM comunas WHERE region_id = '$id_regiones' ORDER BY nombre_comunas";
	$resultadoC=$mysqli->query($queryC);

	$html= "<option value='0'>Seleccionar Comuna</option>";

	while($rowC = $resultadoC->fetch_assoc())
	{
		$html.= "<option value='".$rowC['id_comunas']."'>".$rowC['nombre_comunas']."</option>";
	}
	echo $html;
?>