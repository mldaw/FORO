
$(document).ready(function(){
	//cuando en post.php se haga un click
	//con el raton a una tabla de la lista
	//de comentarios, recoge los valores de los
	//inputs hidden y lo lleva a la url a la pagina
	//info.php
    $(".tablaPost").click(function(){
			//$this es el elemento table, que se le
			//coge su atributo id(el valor, que es su
		    //id_mensaje de la BD)
			var tableID = $(this).attr("id");
		
			document.location.href = "info.php?parametro1=" + tableID + "&";
			//alert(tableID);
			//cogemos cada td de la tabla
			/*var c= $("td").each(function(){
			//y cogemos el atributo id de esa td							 
            var r= $(this).attr("id");
           //alert(r);
		   //vamos a la pagina info.php y le pasamos los valores
		   });//fin $td*/
				
			
  });//fin $table
	
	
	
	//funcion cuando pincha el boton comentar
	$("#comentar2").click(function(){ 
					
					
					$("#oculto").css("display", "block");		
						
					
							  
									  
								  
								  
								  
	   });//fin #comentar*/
});//fin document.ready