<?php
  /*
  ** =================================================
  ** ### beFrases                                  ###
  ** ### Version: 1.0                              ###
  ** ### Opción de menú "Editar frase" de beFrases ###
  ** =================================================
  */

  // Evitar que se pueda ejecutar código PHP insertando la ruta en la barra del navegador
  defined('ABSPATH') or die("Bye bye");
 
  $urlMain = "?page=beFrases/admin/main.php";
  
  /** --- Llenar el formulario ---*/
  // Obtener datos
  $editarID = $_POST['idEditar'];
  $editarAutor = $_POST['autorEditar'];
  $editarFrase = $_POST['fraseEditar'];

  // Verifica si hay datos
  if( ($editarID == null) && ($editarAutor == null) && ($editarFrase == null) ) {   
    
    // Si no hay datos (Reedirige a la página principal del plugin)
    header('Location: '.$urlMain);
  }
  else 
  {
    // Limpia la cadena de texto "autor" y asigna
    $autorSinFinal1 = substr($editarAutor, 0, -1);
    $autorSinInicio1 = substr($autorSinFinal1, 1);
    $editarAutor = $autorSinInicio1;
    
    // Limpia la cadena de texto "frase" y asigna
    $fraseSinFinal2 = substr($editarFrase, 0, -1);
    $fraseSinInicio2 = substr($fraseSinFinal2, 1);
    $editarFrase = $fraseSinInicio2;
  }

  /** --- Actualizar los datos ---*/
  // Actualizar datos POST
  $editarAutor_ = $editarFrase_ = $editarID_ = $editarFrase__= null; 

  if ( (isset($_POST ['inputEditarID'] ) ) && (isset($_POST ['inputEditarAutor'] ) ) && (isset($_POST ['inputEditarFrase'] ) ) ) {
    global $editarID_;
    global $editarAutor_;
    global $editarFrase__;

    $editarID_ = $_POST['inputEditarID'];  
    $editarAutor_ = $_POST['inputEditarAutor'];    
    $editarFrase__ = $_POST['inputEditarFrase'];
    $editarFrase_ = stripslashes($editarFrase__);
    
    $datos = [
      'befrases_id' => $editarID_,
      'befrases_autor' => $editarAutor_,
      'befrases_frase' => $editarFrase_
    ];
  
    global $wpdb;
    $tabla = "{$wpdb->prefix}befrases";
    $wpdb -> replace($tabla, $datos); 
 
  }  
?>

<!-- -------------------------------------->
<!-- --- Contenido HTML ----->
<!-- -------------------------------------->

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
  </head>

  <body>
    <div class="container-fluid" style="padding-left: 0px;">
    
      <h1 class="display-4"><?php echo get_admin_page_title(); ?></h1>
      <p class="lead">Edita los campos siguientes.</p>
      
      <hr class="my-4">
    
      <!-- Formulario añadir frase -->
      <form method="post" onsubmit="return fn_editar()">

        <!-- "ID" -->
        <div class="mb-3">
          <input type="hidden" id="inputEditarID" name="inputEditarID" value="<?php echo $editarID;?>">
        </div>

        <!-- "Autor" -->
        <div class="mb-3">
          <label for="inputEditarAutor" class="form-label">Autor</label>
          <div class="">
            <input type="text" class="form-control" id="inputEditarAutor" name="inputEditarAutor" placeholder="Autor" value="<?php echo $editarAutor;?>">
          </div>
        </div>
        
        <!-- "Frase" -->
        <div class="mb-3">
            <label for="inputEditarFrase" class="form-label">Frase</label>
            <textarea class="form-control" id="inputEditarFrase" name="inputEditarFrase">"<?php echo $editarFrase; ?>".</textarea>
        </div>

        <!-- Callout "Ayuda" -->
        <div id="calloutEditarAyuda" class="bd-callout bd-callout-warning" style="   
          border-bottom: 1px solid #eee;
          border-top: 1px solid #eee;
          padding: 1.25rem;margin-top: 1.25rem;
          margin-bottom: 1.25rem;
          border-left: 1px solid #007bff;
          border-left-width: .25rem;
          border-radius: .25rem;
          border-right: 1px solid #eee;">
          <button id="btnEditarCerrarAyuda" type="button" class="close" data-dismiss="bd-callout" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p style="font-size: 1.2rem;">Ayuda</h5>
          <p style="font-size: 1rem;">Para el aviso: "<strong>¡Error!</strong> ¡Verifica el formato de la frase!" 
          <br>Revisa las siguientes reglas:</p>
          <hr>
          <p style="font-size: 1rem;">
            * No <strong>espacios en blanco o saltos de línea</strong> al inicio o fin de la frase.
            <br>* El formato de inicio de la frase es con:  <strong>"</strong>
            <br>* El formato de fin de la frase es con:  <strong>".</strong>
          </p>
        </div>

        <!-- Botones -->
        <div class="mb-3" style="text-align: left;">            
          <button type="submit" class="btn btn-primary" id="btnEditarActualizar" name="btnEditarActualizar">Actualizar</button>
          <button type="button" class="btn btn-info" id="btnEditarAyuda" name="btnEditarAyuda">?</button>
        </div>
          
        <!-- Alerta "¡No puede haber campos vacíos!" -->
        <div id="alertEditarCamposVacios" class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>¡Error!</strong> ¡No puede haber campos vacíos!
        </div>

        <!-- Alerta "¡Datos guardados correctamente!" -->
        <div id="alertEditarCamposGurdados" class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          ¡Datos guardados correctamente!
        </div>

        <!-- Alerta "¡Verifica el formato de la frase!" -->
        <div id="alertEditarCamposSinFormato" class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>¡Error!</strong> ¡Verifica el formato de la frase!
        </div>

      </form>

      <hr class="my-4">      
      
    </div>
  </body>
</html>

<?php

  // Autocompletar autor
  $query = "SELECT * FROM {$wpdb -> prefix}befrases";
  $lista_frases = $wpdb -> get_results($query,ARRAY_A);
  if(empty($lista_frases)){
    $lista_frases = array();
  }

  global $wpdb;
  $listaAutores = array();
  
  $queryFrases = "SELECT * FROM {$wpdb -> prefix}befrases";
  $listaFrases = $wpdb -> get_results($queryFrases,ARRAY_A);
  $maxElementoArreglo =  count($listaFrases);
  
  for ($i = 0; $i < $maxElementoArreglo; ++$i){
    $registroExtraido = $listaFrases[$i];
    $autorRegistroExtraido = $registroExtraido['befrases_autor'];
    array_push($listaAutores, $autorRegistroExtraido);
  }
  
  $listaAutoresSinRepetir = array_values(array_unique($listaAutores));
?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
  var data = <?php echo json_encode($listaAutoresSinRepetir) ?>;  
  $( "#inputEditarAutor" ).autocomplete({
    source: data
  });
} );
</script>