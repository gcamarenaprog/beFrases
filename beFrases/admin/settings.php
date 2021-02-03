<?php
/*
** ============================================
** ### beFrases                             ###
** ### Version: 1.0                         ###
** ### Opción de menú "Ajustes" de beFrases ###
** ============================================
*/

  // Evitar que se pueda ejecutar código PHP insertando la ruta en la barra del navegador
  defined('ABSPATH') or die("Bye bye");

  // Obtenemos las opciones de la base de datos
  global $wpdb;
  $tablaOpciones = "{$wpdb -> prefix}befrases_opt";
  $queryOpciones = "SELECT * FROM {$wpdb -> prefix}befrases_opt";
  $listaOpciones = $wpdb -> get_results($queryOpciones,ARRAY_A);

  // Si hay opciones con valor null
  if( ( $listaOpciones[0]['befrases_ali_tex_aut'] == null ) || ( $listaOpciones[0]['befrases_est_tex_aut'] == null ) || ( $listaOpciones[0]['befrases_ali_tex_fra'] == null )  || ( $listaOpciones[0]['befrases_est_tex_fra'] == null ) ) {
        
    // Inicializamos y guardamos valores predeterminados en la base de datos
    $datos = [
      'befrases_ajustes_id' => 1,
      'befrases_ali_tex_aut' => 3,
      'befrases_est_tex_aut' => 1,
      'befrases_ali_tex_fra' => 1,
      'befrases_est_tex_fra' => 2,
    ];
    $tablaOpciones = "{$wpdb -> prefix}befrases_opt";
    $wpdb -> replace($tablaOpciones, $datos);
    opcionesSeleccionadas();
  }

  // Si no hay valores null
  else {

    // Obtenermos las opciones de la base de datos
    $grupo1Opcion =  $listaOpciones[0]['befrases_ali_tex_aut'];
    $grupo2Opcion =  $listaOpciones[0]['befrases_est_tex_aut'];
    $grupo3Opcion =  $listaOpciones[0]['befrases_ali_tex_fra'];
    $grupo4Opcion =  $listaOpciones[0]['befrases_est_tex_fra'];

    opcionesSeleccionadas();
  }

  // Guardar datos POST
  if ($_POST) {
    global $wpdb;
    $tablaOpciones = "{$wpdb -> prefix}befrases_opt";
        
    $opt_g1 = $_POST['ata'];
    $opt_g2 = $_POST['efa'];
    $opt_g3 = $_POST['atf'];
    $opt_g4 = $_POST['eff'];
    
    $datos = [
      'befrases_ajustes_id' => 1,
      'befrases_ali_tex_aut' => $opt_g1,
      'befrases_est_tex_aut' => $opt_g2,
      'befrases_ali_tex_fra' => $opt_g3,
      'befrases_est_tex_fra' => $opt_g4,
    ];

    $wpdb -> replace($tablaOpciones, $datos);
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
  }

  /*
  ** --- Función asigna opciones seleccionadas ---
  */
  function opcionesSeleccionadas(){
    // Llenamos el formulario con las opciones guardadas (habilitadas y seleccionadas)
    global $grupo1Opcion, $grupo2Opcion, $grupo3Opcion, $grupo4Opcion;
    global $ata1Chk, $ata2Chk, $ata3Chk, $ata4Chk;
    global $efa1Chk, $efa2Chk, $efa3Chk, $efa4Chk;
    global $atf1Chk, $atf2Chk, $atf3Chk, $atf4Chk;
    global $eff1Chk, $eff2Chk, $eff3Chk, $eff4Chk;
        
    if( $grupo1Opcion == 1 ) {
      $ata1Chk = true;
      $ata2Chk = false;
      $ata3Chk = false;
      $ata4Chk = false;
    }
    elseif ( $grupo1Opcion == 2 )
    {   
      $ata1Chk = false;
      $ata2Chk = true;
      $ata3Chk = false;
      $ata4Chk = false;
    }
    elseif ( $grupo1Opcion == 3 )
    {   
      $ata1Chk = false;
      $ata2Chk = false;
      $ata3Chk = true;
      $ata4Chk = false;
    }
    else
    {   
      $ata1Chk = false;
      $ata2Chk = false;
      $ata3Chk = false;
      $ata4Chk = true;
    }
    
    if ( $grupo2Opcion == 1 ) {
      $efa1Chk = true;
      $efa2Chk = false;
      $efa3Chk = false;
      $efa4Chk = false;
    }
    elseif ( $grupo2Opcion == 2 )
    {   
      $efa1Chk = false;
      $efa2Chk = true;
      $efa3Chk = false;
      $efa4Chk = false;
    }
    elseif ( $grupo2Opcion == 3 )
    {   
      $efa1Chk = false;
      $efa2Chk = false;
      $efa3Chk = true;
      $efa4Chk = false;
    }
    else
    {   
      $efa1Chk = false;
      $efa2Chk = false;
      $efa3Chk = false;
      $efa4Chk = true;
    }

    if ( $grupo3Opcion == 1 ) {
      $atf1Chk = true;
      $atf2Chk = false;
      $atf3Chk = false;
      $atf4Chk = false;
    }
    elseif ( $grupo3Opcion == 2 )
    {   
      $atf1Chk = false;
      $atf2Chk = true;
      $atf3Chk = false;
      $atf4Chk = false;
    }
    elseif ( $grupo3Opcion == 3 )
    {   
      $atf1Chk = false;
      $atf2Chk = false;
      $atf3Chk = true;
      $atf4Chk = false;
    }
    else
    {   
      $atf1Chk = false;
      $atf2Chk = false;
      $atf3Chk = false;
      $atf4Chk = true;
    }

    if ( $grupo4Opcion == 1 ) {
      $eff1Chk = true;
      $eff2Chk = false;
      $eff3Chk = false;
      $eff4Chk = false;
    }
    elseif ( $grupo4Opcion == 2 )
    {   
      $eff1Chk = false;
      $eff2Chk = true;
      $eff3Chk = false;
      $eff4Chk = false;
    }
    elseif ( $grupo4Opcion == 3 )
    {   
      $eff1Chk = false;
      $eff2Chk = false;
      $eff3Chk = true;
      $eff4Chk = false;
    }
    else
    {   
      $eff1Chk = false;
      $eff2Chk = false;
      $eff3Chk = false;
      $eff4Chk = true;
    }
  }

?>

<!-- -------------------------------------->
<!-- --- Contenido HTML ----->
<!-- -------------------------------------->
<h1 class="display-4"><?php echo get_admin_page_title(); ?></h1>
<p class="lead">Los ajustes no se guardan después de desactivar o desinstalar este plugin, así que usa esta característica con prudencia.</p>

<!-- Alerta configuración guardada -->
<div id="alertAjustesGuardados" class="alert alert-success alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  ¡Ajustes guardados correctamente!
</div>

<!-- Formulario -->
<form method="post" onsubmit="return fn_alertAjustesGuardados()">
   
  <hr class="my-4">

  <div class="row">

    <!-- Alineación del texto autor -->
    <div class="col-sm">
      <div class="form-check">
        <fieldset>
          <legend style="font-size: 16px;font-weight: 300;">Alineación del texto autor</legend>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="ata" value="1" required <?php if($ata1Chk) { echo "checked"; } ?> > Derecha
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="ata" value="2" required <?php if($ata2Chk) { echo "checked"; } ?> > Centro
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="ata" value="3" required <?php if($ata3Chk) { echo "checked"; } ?> > Izquierda
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="ata" value="4" required <?php if($ata4Chk) { echo "checked"; } ?> > Justificado
          </label>
        </fieldset>
      </div>
    </div>

    <!-- Estilo de fuente autor -->
    <div class="col-sm">
      <div class="form-check">
        <fieldset>
          <legend style="font-size: 16px;font-weight: 300;">Estilo del fuente autor</legend>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="efa" value="1" required <?php if($efa1Chk) { echo "checked"; } ?> > Normal
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="efa" value="2" required <?php if($efa2Chk) { echo "checked"; } ?> > Cursiva
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="efa" value="3" required <?php if($efa3Chk) { echo "checked"; } ?> > Negrita
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="efa" value="4" required <?php if($efa4Chk) { echo "checked"; } ?> > Curisva / Negrita
          </label>
        </fieldset>
      </div>
    </div>

    <!-- Alineación del texto frase -->
    <div class="col-sm">
      <div class="form-check">
        <fieldset>
          <legend style="font-size: 16px;font-weight: 300;">Alineación del texto frase</legend>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="atf" value="1" required <?php if($atf1Chk) { echo "checked"; } ?> > Derecha
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="atf" value="2" required <?php if($atf2Chk) { echo "checked"; } ?> > Centro
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="atf" value="3" required <?php if($atf3Chk) { echo "checked"; } ?> > Izquierda
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="atf" value="4" required <?php if($atf4Chk) { echo "checked"; } ?> > Justificado
          </label>
        </fieldset>
      </div>
    </div>

    <!-- Estilo de fuente frase -->
    <div class="col-sm">
      <div class="form-check">
        <fieldset>
          <legend style="font-size: 16px;font-weight: 300;">Estilo de fuente frase</legend>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="eff" value="1" required <?php if($eff1Chk) { echo "checked"; } ?> > Normal
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="eff" value="2" required <?php if($eff2Chk) { echo "checked"; } ?> > Cursiva
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="eff" value="3" required <?php if($eff3Chk) { echo "checked"; } ?> > Negrita
          </label>
          <br>
          <label class="" for="radio2" style="font-size: 14px;font-weight: 300;">
              <input type="radio" name="eff" value="4" required <?php if($eff4Chk) { echo "checked"; } ?> > Curisva / Negrita
          </label>
        </fieldset>
      </div>
    </div>

  </div>
  
  <hr class="my-4">

  <!-- Botón guradar -->
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Guardar</button>
  </div>

</form>