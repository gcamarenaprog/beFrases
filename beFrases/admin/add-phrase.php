<?php
/*
** =================================================
** ### beFrases                                  ###
** ### Version: 1.0                              ###
** ### Opción de menú "Añadir frase" de beFrases ###
** =================================================
*/

  // Evitar que se pueda ejecutar código PHP insertando la ruta en la barra del navegador
  defined('ABSPATH') or die("Bye bye");

  global $wpdb;
  $urlMain = "?page=beFrases/admin/main.php";
  $autor = $frase = $idEditar = $autorEditar = $fraseEditar = null;
  $tabla = "{$wpdb->prefix}befrases";

  // Guardar datos POST
  if ( isset($_POST['inputAnadirAutor']) ) {
    $autor = $_POST['inputAnadirAutor'];
  }
  
  if ( isset($_POST['inputAnadirFrase']) ) {
    $frase = $_POST['inputAnadirFrase'];
  }

  $frase = stripslashes($frase);

  if ($autor != null || $frase!= null){
      global $autor, $frase, $tabla;
      $query = "SELECT befrases_id FROM $tabla ORDER BY befrases_id DESC limit 1";
      $resultado = $wpdb -> get_results($query, ARRAY_A);
      $proximoID = $resultado[0]['befrases_id'] + 1;

      $datos = [
        'befrases_id' => null,
        'befrases_autor' => $autor,
        'befrases_frase' => $frase
      ];

      $wpdb -> insert($tabla, $datos);
      header('Location: '.$urlMain);
  }
  else {
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
      <p class="lead">Completa los campos siguientes.</p>
      
      <hr class="my-4">
    
      <!-- Formulario añadir frase -->
      <form method="post" onsubmit="return fn_anadir()">

        <!-- "Autor" -->
        <div class="mb-3">
            <label for="inputAnadirAutor" class="form-label">Autor</label>
            <div class="">
            <input type="text" class="form-control" id="inputAnadirAutor" name="inputAnadirAutor" placeholder="Autor">
            </div>
        </div>
        
        <!-- "Frase" -->
        <div class="mb-3">
            <label for="inputAnadirFrase" class="form-label">Frase</label>
            <textarea class="form-control" id="inputAnadirFrase" name="inputAnadirFrase" rows="3" placeholder="&quot;Esta es la forma correcta de escribir una frase&quot;."></textarea>
        </div>

        <!-- Callout "Ayuda" -->
        <div id="calloutAnadirAyuda" class="bd-callout bd-callout-warning" style="   
            border-bottom: 1px solid #eee;
            border-top: 1px solid #eee;
            padding: 1.25rem;margin-top: 1.25rem;
            margin-bottom: 1.25rem;
            border-left: 1px solid #007bff;
            border-left-width: .25rem;
            border-radius: .25rem;
            border-right: 1px solid #eee;">
            <button id="btnAnadirCerrarAyuda" type="button" class="close" data-dismiss="bd-callout" aria-label="Close">
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
          <button type="submit" class="btn btn-primary" id="btnAnadirGuardar" name="btnAnadirGuardar">Guardar</button>
          <button type="button" class="btn btn-info" id="btnAnadirAyuda" name="btnAnadirAyuda">?</button>
        </div>
          
        <!-- Alerta "¡No puede haber campos vacíos!" -->
        <div id="alertAnadirCamposVacios" class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>¡Error!</strong> ¡No puede haber campos vacíos!
        </div>

        <!-- Alerta "¡Datos guardados correctamente!" -->
        <div id="alertAnadirCamposGurdados" class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
         ¡Datos guardados correctamente!
        </div>

        <!-- Alerta "¡Verifica el formato de la frase!" -->
        <div id="alertAnadirCamposSinFormato" class="alert alert-danger alert-dismissible fade show" role="alert">
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
  $( "#inputAnadirAutor" ).autocomplete({
    source: data
  });
} );
</script>