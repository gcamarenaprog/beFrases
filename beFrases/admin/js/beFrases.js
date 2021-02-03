/*
** ==========================================
** ### beFrases              			  ###
** ### Version: 1.0         		 	  ###
** ### JavaScript del plugin 			  ###
** ==========================================
*/

/*
** ----------------------------------------
** --- JQuery ---
** ----------------------------------------
*/

jQuery(document).ready(function($) {
  
  /* delete-all.php -------------------------- */

  // Alerta "¡Se han eliminado todos los registros!" de delete-all.php
  $('#alertEliminarTodoElementosEliminadosCorrectamente').hide();


  /* add-phrase.php -------------------------- */

	// Alerta "¡No puede haber campos vacíos!" de add-phrase.php  
  $('#alertAnadirCamposVacios').hide();
   
  // Alerta "¡Datos guardados correctamente!" de add-phrase.php  
  $('#alertAnadirCamposGurdados').hide();
  
  // Alerta "¡Verifica el formato de la frase!" de add-phrase.php  
  $('#alertAnadirCamposSinFormato').hide();
  
  // Callout "Ayuda" de add-phrase.php  
  $("#calloutAnadirAyuda").hide();

	// Botón "Ayuda" de add-phrase.php 
	$("#btnAnadirAyuda").click(function() {
		$("#calloutAnadirAyuda").show();
  });

  // Botón "Cerrar Ayuda" de add-phrase.php
	$("#btnAnadirCerrarAyuda").click(function() {
		$("#calloutAnadirAyuda").hide();
  });


  /* edit-phrase.php -------------------------- */

	// Alerta "¡No puede haber campos vacíos!" de edit-phrase.php
  $('#alertEditarCamposVacios').hide();
   
  // Alerta "¡Datos guardados correctamente!" de edit-phrase.php  
  $('#alertEditarCamposGurdados').hide();
  
  // Alerta "¡Verifica el formato de la frase!" de edit-phrase.php  
  $('#alertEditarCamposSinFormato').hide();
  
  // Callout "Ayuda" de edit-phrase.php 
  $("#calloutEditarAyuda").hide();

	// Botón "Ayuda" de edit-phrase.php 
	$("#btnEditarAyuda").click(function() {
		$("#calloutEditarAyuda").show();
  });

  // Botón "Cerrar Ayuda" de edit-phrase.php 
	$("#btnEditarCerrarAyuda").click(function() {
		$("#calloutEditarAyuda").hide();
  });


  /* main.php -------------------------- */

	// Alerta "Registro eliminado correctamente" de main.php
  $('#alertEliminarRegistroEliminado').hide();

  // Alerta "Registro no eliminado" de main.php
  $('#alertEliminarRegistroNoEliminado').hide();
  
   
  /* settings.php ---------------------------- */

  // Alerta "Ajustes guardados" de settings.php
  $('#alertAjustesGuardados').hide(); 

});
  


/*
** ----------------------------------------
** --- Funciones JavaScript ---
** ----------------------------------------
*/

/* delete-all.php -------------------------- */

/*
** --- Función "onsubmit" de delete-all.php ---
*/
function fn_eliminarTodo() {
  var elemento = document.getElementById('btnEliminarTodoAceptar');
  var respuesta = elemento.dataset.id_eliminar_todos_registros;
    if(respuesta == 1) {
      $("#alertEliminarTodoElementosEliminadosCorrectamente").fadeTo(4000,500).slideUp(500,function(){
        $("#alertEliminarTodoElementosEliminadosCorrectamente").slideUp(500);
      });
      return true;
    }else {
      return false;
    }
}


/* add-phrase.php -------------------------- */

/*
** --- Función "onsubmit" de add-phrase.php ---
*/
function fn_anadir() {
	var cadena = document.getElementById("inputAnadirFrase").value;
	var subcadena_inicial = cadena.substr(0, 1);
	var subcadena_final = cadena.substr(-2);

	if (document.getElementById("inputAnadirAutor").value == "" || document.getElementById("inputAnadirFrase").value == "") {

		$("#alertAnadirCamposVacios").fadeTo(4000,500).slideUp(500,function(){
			$("#alertAnadirCamposVacios").slideUp(500);
		});
		return false;
	}
	else if (subcadena_inicial != "\"" || subcadena_final != "\".") {
		$("#alertAnadirCamposSinFormato").fadeTo(4000,500).slideUp(500,function() {
			$("#alertAnadirCamposSinFormato").slideUp(500);
		});
		return false;
	}
	else {

		$("#alertAnadirCamposGurdados").fadeTo(4000,500).slideUp(500,function() {
			$("#alertAnadirCamposGurdados").slideUp(500);
		});
		return true;
	}
}


/* edit-phrase.php -------------------------- */

/*
** --- Función "onsubmit" de edit-phrase.php ---
*/
function fn_editar() {
	var cadena = document.getElementById("inputEditarFrase").value;
	var subcadena_inicial = cadena.substr(0, 1);
	var subcadena_final = cadena.substr(-2);

	if (document.getElementById("inputEditarAutor").value == "" || document.getElementById("inputEditarFrase").value == "") {

		$("#alertEditarCamposVacios").fadeTo(4000,500).slideUp(500,function(){
			$("#alertEditarCamposVacios").slideUp(500);
		});
		return false;
	}
	else if (subcadena_inicial != "\"" || subcadena_final != "\".") {
		$("#alertEditarCamposSinFormato").fadeTo(4000,500).slideUp(500,function() {
			$("#alertEditarCamposSinFormato").slideUp(500);
		});
		return false;
	}
	else {

		$("#alertEditarCamposGurdados").fadeTo(4000,500).slideUp(500,function() {
			$("#alertEditarCamposGurdados").slideUp(500);
		});
		return true;
	}
}


/* main.php -------------------------- */

/*
** --- Función de alerta "¡Registro eliminado correctamente!"de main.php ---
*/
function fn_eliminar() {
  if (confirm("¿Seguro que deseas eliminar la frase?")) {
    $("#alertEliminarRegistroEliminado").fadeTo(4000,500).slideUp(500,function() {
      $("#alertEliminarRegistroEliminado").slideUp(500);
    } );
    return true;
  } else {    
    $("#alertEliminarRegistroNoEliminado").fadeTo(4000,500).slideUp(500,function() {
      $("#alertEliminarRegistroNoEliminado").slideUp(500);
    } );
    return false;
  }
}