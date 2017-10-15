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
<!---------------------- FORMULARIO INFO.PHP ------------------------------------>
<center>
<form name="foro" action="info.php?parametro1=<?php if (isset($_GET['parametro1'])) echo $_GET['parametro1']; ?>"  method="post">
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

//cogemos el parametro pasado por la url 
$id= $_GET['parametro1'];
//llamamos a la funcion para recoger ese registro
$resultado=consulta_registro($conexion,$id);
//print_r($resultado);
//sale: Array ( [id_mensaje] => 2 [autor] => nuevoU [contenido] => Segundo comentario [fecha] => 0000-00-00 [titulo] => Trabajo )
//guardamos el id_mensaje de ese registro
$idMensaje=$resultado['id_mensaje'];
//imprimimos en la tabla ese registro
echo "<br/>";
echo "<table class='tablaRegistro' border=1 cellspacing=0 cellpadding=0 >";
echo "<tr>";
echo "<td class='tablaRegistroPrimera' colspan='2' id='" . $resultado['titulo']. "'> " . $resultado['titulo'] ."</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='tablaRegistroPrimera' id='" . $resultado['autor']. "'> " . $resultado['autor'] ."</td>";
echo "<td class='tablaRegistroPrimera' id='" . $resultado['fecha']. "'> " . $resultado['fecha'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='tablaRegistroPrimera' colspan='2' id='" . $resultado['contenido']. "'> " . $resultado['contenido'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='tablaRegistroSegunda'  colspan='2' id='" . $resultado['id_mensaje'] . "'> Numero BD: " . $resultado['id_mensaje']. "</td>";
echo "</tr>";
echo "</table>";
?>

<?php
//imprimimos la tabla entera de contenido
$registrosContenido = consulta_full_contenido($conexion,$idMensaje);
//print_r($registrosContenido);
//sale:Array ( [0] => Array ( [id_mensaje] => 3 [autor] => pepe [contenido] => comentario-................ [fecha] => 0000-00-00 ) )
//recorremos el array con toda la tabla de contenido

foreach($registrosContenido as $clave => $valor){
echo "<br/>";
echo "<table class='tablaComentario' border=1 cellspacing=0 cellpadding=0 id='" . $valor['id_mensaje'] . "'>";
echo "<tr>";
echo "<td class='tablaComentarioPrimera'  id='" . $valor['autor'] . "'> " . $valor['autor'] . "</td>";
echo "<td class='tablaComentarioPrimera'  id='" . $valor['fecha'] . "'> " . $valor['fecha'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='tablaComentarioSegunda' colspan='2'  id='" . $valor['contenido'] . "'>" . $valor['contenido']. "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='tablaComentarioSegunda'  colspan='2' id='" . $valor['id_mensaje'] . "'> Numero BD: " . $valor['id_mensaje']. "</td>";
echo "</tr>";
echo "</table>";
}
?>


<!--------- DIV QUE MUESTRA LOS COMENTARIOS ------------->
<div id="caja">
<?php
//contamos el tamaño del array
if($registrosContenido != null){
$tamano=count($registrosContenido);
echo "<br><center>Comentario $tamano</center><br>";
echo "<center><input type='submit' name='comentar2'  id='comentar2' value='Comentar'/><br/><br/></center>";
}else{
echo "<h4 align='center'>Aun no hay respuestas en esta publicación...</h4>";
echo "<center><input type='submit' name='comentar2'  id='comentar2' value='Comentar'/><br/><br/></center>";
}
?>
</div>

<!-- FORMULARIO OCULTO DEBE DE SALIR AL PINCHAR EL BOTON COMENTAR-->
<div id="oculto" style="display:none;">
<center>
<input type="text" name="nombre" value="<?php if(isset($_REQUEST['nombre'])) echo $_POST['nombre']; ?>" class="formularioPost" placeholder="nombre"  onfocus="myFunction(this)"/><br/><br/>
<textarea name="contenido2"   value="<?php if(isset($_REQUEST['contenido2'])) echo $_POST['contenido2']; ?>" class="formularioTextarea" placeholder="Escribir post" onfocus="myFunction(this)"></textarea><br/>
<input type="submit" name="publicar2" value="publicar" class="botonPublicar"/></p>
</center>
</div>
<!-- FIN FORMULARIO OCULTO -->

<?php
/************************************************************/
/*********** SI SE HA PULSADO EL NAME="PUBLICAR2" ***********/
/************************************************************/
if(isset($_REQUEST['publicar2'])){
//miramos si estan vacios los campos
if(empty($_REQUEST['nombre']) || empty($_REQUEST['contenido2'])){
    $error="Los campos no pueden estar vacios";
}else{
//recogemos los valores
$n = $_POST['nombre'];
$c2 = $_POST['contenido2'];
//insertamos ese comentario
$r= inserta_comentario($id, $n, $c2 , 0000-00-00, $conexion);

if($r){
$mensaje="Comentario insertado correctamente";

}else{
$error="Ha ocurrido un error";
}//fin if $r

}//fin if empty

}//fin isset publicar2

?>

<div id="error">
<?php
if(isset($error)){
echo $error;
}
?>
</div>


<div id="mensaje">
<?php
if(isset($mensaje)){
echo $mensaje;
}
?>
</div>

</form>
<!---------------- FIN FORMULARIO INFO.PHP ----------------------->
</body>
</html>

