<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="funciones.js"></script>
<link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>

<body>
<?php
include 'funciones.inc';

//llamamos a la conexion para conectar a la base de datos
$conexion=conexion_bd ();
/*if($conexion){
echo "entrado";
}else{
echo "no entrado";
}*/
?>
<center>
<form name="foro" action="post.php"  method="post">
<input type="submit" class="menu" name="inicio" value="inicio" />
<input type="submit" class="menu" name="post" value="post" /> 
<input type="submit" class="menu" name="info" value="info" />
</center>
<?php


/****************************************************************/
/********************* NAME="POST"*********************/
/****************************************************************/

if(isset($_REQUEST['post'])){
header('Location:post.php');
}//fin isset POST

/******** SI SE HA PULSADO EL NAME "INFO" *****************/
/*if(isset($_REQUEST['info'])){
header('Location:info.php');  
 }*/
 
/******** SI SE HA PULSADO EL NAME "INICIO" *****************/
if(isset($_REQUEST['inicio'])){
header('Location:index.php');  
 } 
 
 
 //mostramos el tablon con los comentarios
$resultadoRegistros=consulta_full_mensajes($conexion);
//print_r($resultadoRegistros);
//Sale: Array ( [0] => Array ( [autor] => nuevoU [contenido] => Primer comentario [fecha] => 0000-00-00 ) ) 
foreach($resultadoRegistros as $clave => $valor){

//por cada registro de la BD, sale una tabla con 
//su id de id_mensaje de la BD
echo "<br/>";
echo "<table class='tablaPost' border=1 cellspacing=0 cellpadding=0 id='" . $valor['id_mensaje'] . "'>";
echo "<tr>";
echo "<td class='primera' colspan='2' id='" . $valor['titulo'] . "'> " . $valor['titulo'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='segunda' id='" . $valor['autor'] . "'>" . $valor['autor']. "</td>";
echo "<td  class='segunda' id='" . $valor['fecha'] . "'>" . $valor['fecha']. "</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='2' id='" . $valor['contenido'] . "'>" . $valor['contenido']. "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='segunda'  colspan='2' id='" . $valor['id_mensaje'] . "'> Numero BD: " . $valor['id_mensaje']. "</td>";
echo "</tr>";
//echo "<tr>";
//echo "<td><input type='submit' name='responder' value='responder'></td>";
//campos ocultos que el formulario llevara a leermas.php
//llevamos el array de la base de datos, su registro correspondiente
/*echo "<input type='hidden' id=''" .$valor['autor']. "'' name='autor'>";
echo "<input type='hidden' id=''" .$valor['contenido']. "'' name='contenido'>";
echo "<input type='hidden' id='fecha' name='fecha' value='" .$valor['fecha']. "'>";
echo "<input type='hidden' id='titulo' name='titulo' value='" .$valor['titulo']. "'>";
echo "<input type='hidden' id='id' name='id' value='" .$valor['id_mensaje']. "'>";
echo "</tr>";
*/
echo "</table>";
}
 
?>

</form>
</body>
</html>
