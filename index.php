<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="estilos.css"/>
<script>
function myFunction(x){
   x.style.background = "yellow";
}
</script>
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
<form name="foro" action="index.php" method="post">
<input type="submit" class="menu" name="inicio" value="inicio" />
<input type="submit" class="menu" name="post" value="post" /> 
<input type="submit" class="menu" name="info" value="info" />
</center>


<div id="caja" class="cajaPost">
<h4 align="center">Cree su post debajo</h4>
<input type="text" name="titulo" value="<?php if(isset($_REQUEST['titulo'])) echo $_POST['titulo']; ?>" class="formularioPost" placeholder="Titulo de post"  onfocus="myFunction(this)"/><br/><br/>
<textarea name="contenido" value="<?php if(isset($_REQUEST['contenido'])) echo $_POST['contenido']; ?>" class="formularioTextarea" placeholder="Escribir post" onfocus="myFunction(this)"></textarea><br/>
<p style="padding-left:40px;">Nombre:&nbsp;&nbsp;&nbsp;<input type="text" name="nombre" value="<?php if(isset($_REQUEST['nombre'])) echo $_POST['nombre']; ?>"  class="nombre" onfocus="myFunction(this)"/>
<input type="submit" name="publicar" value="publicar" class="botonPublicar"/></p>
</div>
<?php

/********* SI PULSA EL NAME="PUBLICAR"*************/
if(isset($_REQUEST['publicar'])){
  if(empty($_REQUEST['titulo']) ||  empty($_REQUEST['contenido']) || empty($_REQUEST['nombre'])){
  $error="Los campos no pueden estar vacios";
  }else{
  
  $titulo =  $_POST['titulo'];
  $contenido =  $_POST['contenido'];
  $nombre =  $_POST['nombre'];
 $resultado= inserta_mensaje($nombre, $contenido,0000-00-00,$titulo, $conexion);
  if($resultado){
  $mensaje="Mensaje insertado";
  }else{
  $error="error";
  }
  }
}
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
</body>
</html>
