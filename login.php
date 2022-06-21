<?php
//conexion con la base de datos y el servidor
	$link = mysql_connect("localhost","root","") or die("<h2>No se encuentra el servidor</h2>");
	$db = mysql_select_db("difusion",$link) or die("<h2>Error de Conexion</h2>");

	//obtenemos los valores del formulario
//	$nick = $_POST['nick'];
//	$correo = $_POST['correo'];


	//Obtiene la longitus de un string
//	$req = (strlen($nick)*strlen($correo));

	//ingresamos la informacion a la base de datos
//	mysql_query("INSERT INTO usuaio VALUES('1','$nick','','','','$correo','','')",$link) or die("<h2>Error Guardando los datos</h2>");
//	echo'
//		<script>
//			location.href="index.html";
//		</script>
//	'


?>