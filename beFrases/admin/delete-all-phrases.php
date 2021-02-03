<?php
/*
** ==================================================
** ### beFrases                                   ###
** ### Version: 1.0                               ###
** ### Opción de menú "Eliminar todo" de beFrases ###
** ==================================================
*/

// Evitar que se pueda ejecutar código PHP insertando la ruta en la barra del navegador
defined('ABSPATH') or die("Bye bye");
 
$urlMain = "?page=beFrases/admin/main.php";
global $wpdb;

// Eliminar datos POST
if ( empty($_POST) ) {
  
} else {
  print_r($_POST);  	
  $tabla = "{$wpdb -> prefix}befrases";
  $wpdb -> query( "DELETE FROM $tabla"); 
  header('Location: '.$urlMain);
}

// Comprobar si hay registros
$flag;
$query = "SELECT * FROM {$wpdb -> prefix}befrases";
$lista_frases = $wpdb -> get_results($query,ARRAY_A);

if(empty($lista_frases)) {
  // Si no hay datos (Reedirige a la página principal del plugin)
}else {
  $flag = 1;
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
      <p class="lead">¿Estás seguro que deseas eliminar todos los registros de forma permanente?</p>
      
      <hr class="my-4">
    
      <!-- Formulario añadir frase -->
      <form method="post" onsubmit="return fn_eliminarTodo()">

        <!-- Botones -->
        <div class="mb-3" style="text-align: left;">        
          <button type="submit" <?php echo "data-id_eliminar_todos_registros='$flag'"; ?>  class="btn btn-primary" id="btnEliminarTodoAceptar" name="btnEliminarTodoAceptar">Aceptar</button>
          <button type="button" class="btn btn-secondary" id="btnEliminarTodoCancelar" name="btnEliminarTodoCancelar" onclick="window.location.href='<?php echo $urlMain; ?>'">Cancelar</button>
        </div>
          
        <!-- Alerta "¡Se ha eliminado todo correctamente!" -->
        <div id="alertEliminarTodoElementosEliminadosCorrectamente" class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          ¡Se ha eliminado todo correctamente!
        </div>
       
      </form>

      <hr class="my-4">      
      
    </div>
  </body>
</html>