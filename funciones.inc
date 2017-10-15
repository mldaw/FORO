<?php
/******************** FUNCION CONECTAR A LA BASE DE DATOS ***********************/

function conexion_bd (){

		try{
			
			//Para que no tengamos problemas con los acentos, en la cadena de conexión indicamos en el array de opciones la codificación
			$con = new PDO('mysql:host=localhost;dbname=foro4', 'dwes', 'dwesforo4', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
			//Habilito el uso de excepciones
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			return $con;

		} catch (PDOException $e) {
			 $error = $e->getCode();
             $mensaje = $e->getMessage();
             print "¡Error!: " . $mensaje . " " . $error;
             die();
		}
}
/******************** FIN FUNCION CONECTAR A LA BASE DE DATOS ***********************/

/*
 * Insertamos un mensaje en la BD
 * Devuelve true si la inserción se realizó y false en caso contrario
 */
function inserta_mensaje($autor, $contenido, $fecha, $titulo, $conexion){
     try {
	 
	     $consulta=$conexion->prepare("INSERT INTO mensajes(autor, contenido, fecha, titulo) VALUES(?,?,?,?)");
		 $consulta->bindParam(1,$autor);
		 $consulta->bindParam(2,$contenido);
         $consulta->bindParam(3,$fecha);
		 $consulta->bindParam(4,$titulo);
		 $resultado =$consulta->execute();
		 return $resultado;
		 
     } catch (PDOException $e) {
        $error = $e->getCode();
        $mensaje = $e->getMessage();
        die("Error: " . $mensaje . " " . $error);
     }
}//fin de inserta_mensaje


/*
 * Función para consultar todos los mensajes del foro y retorna array
 * 
 */
function consulta_full_mensajes($conexion){
    try {
        
		
	    $consulta=$conexion->prepare("SELECT id_mensaje,autor, contenido, fecha,titulo FROM mensajes");
      
        $consulta->execute();
		//cogemos toda la tabla
		$registros= $consulta->fetchAll(PDO::FETCH_ASSOC);
		//retorna array de la tabla
		return $registros;
      
  
    } catch (PDOException $e) {
        $error = $e->getCode();
        $mensaje = $e->getMessage();
        die("Error: " . $mensaje . " " . $error);
     }
}//fin consulta_full_mensajes



/*
 * Función para consultar el registro , se le pasa su id_mensaje
 * 
 */
function consulta_registro($conexion,$id){
    try {
        
		
	    $consulta=$conexion->prepare("SELECT id_mensaje,autor, contenido, fecha,titulo FROM mensajes where id_mensaje= ?");
        $consulta->bindParam(1,$id);
        $consulta->execute();
		//cogemos el registro
		$registro = $consulta->fetch(PDO::FETCH_ASSOC);
		//retorna array de la tabla
		return $registro;
      
  
    } catch (PDOException $e) {
        $error = $e->getCode();
        $mensaje = $e->getMessage();
        die("Error: " . $mensaje . " " . $error);
     }
}//fin consulta_full_mensajes


/*
 * Insertamos un comentario en la BD
 * Devuelve true si la inserción se realizó y false en caso contrario
 */
function inserta_comentario($id, $autor, $contenido, $fecha, $conexion){
     try {
	 
	     $consulta=$conexion->prepare("INSERT INTO contenido(autor, contenido, fecha,id_mensaje) VALUES(?,?,?,?)");
		 
		 $consulta->bindParam(1,$autor);
         $consulta->bindParam(2,$contenido);
		 $consulta->bindParam(3,$fecha);
		 $consulta->bindParam(4,$id);
		 $resultado =$consulta->execute();
		 return $resultado;
		 
     } catch (PDOException $e) {
        $error = $e->getCode();
        $mensaje = $e->getMessage();
        die("Error: " . $mensaje . " " . $error);
     }
}//fin de inserta_mensaje


/*
 * Función para consultar toda la tabla contenido y retorna array
 * 
 */
function consulta_full_contenido($conexion,$id){
    try {
        
		
	    $consulta=$conexion->prepare("SELECT autor, contenido, fecha,id_mensaje FROM contenido where id_mensaje= ?");
        $consulta->bindParam(1,$id);
        $consulta->execute();
		//cogemos toda la tabla
		$registros= $consulta->fetchAll(PDO::FETCH_ASSOC);
		//retorna array de la tabla
		return $registros;
      
  
    } catch (PDOException $e) {
        $error = $e->getCode();
        $mensaje = $e->getMessage();
        die("Error: " . $mensaje . " " . $error);
     }
}//fin consulta_full_mensajes
