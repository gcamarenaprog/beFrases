<?php
/*
** =============================================
** ### beFrases                              ###
** ### Version: 1.0                          ###
** ### Opción de menú "beFrases" de beFrases ###
** =============================================
*/

  // Evitar que se pueda ejecutar código PHP insertando la ruta en la barra del navegador
  defined('ABSPATH') or die("Bye bye");

  $urlAddPhrase = "?page=beFrases/admin/add-phrase.php";
  $urlDeleteAll = "?page=beFrases/admin/delete-all-phrases.php";
  $urlEditPhrase = "?page=beFrases/admin/edit-phrase.php";
  $urlMain = "?page=beFrases/admin/main.php";


  // Eliminar datos POST
  global $wpdb;
  $tabla = "{$wpdb->prefix}befrases";
  if ( isset($_POST ['idEliminar'] ) ) {
    $idFraseEliminar = $_POST['idEliminar'];
    global $wpdb;	
    $tabla = "{$wpdb -> prefix}befrases";
    $wpdb->delete( $tabla, array( 'befrases_id' => $idFraseEliminar ) );	  
  }
	
  // Cargar datos en tabla
  $query = "SELECT * FROM {$wpdb -> prefix}befrases";
  $lista_frases = $wpdb -> get_results($query,ARRAY_A);
  if(empty($lista_frases)){
    $lista_frases = array();
  }

  // Comprobar si hay registros para habilitar o deshabilitar botón "Eliminar todo"
  $flagDeshabilitar = 0;
  $query = "SELECT * FROM {$wpdb -> prefix}befrases";
  $lista_frases = $wpdb -> get_results($query,ARRAY_A);
  if(empty($lista_frases)) {    
    $flagDeshabilitar = 1;
  }else {
    
  } 

  // Obtener el total de elementos
  $totalElementos = count($lista_frases, 0);
?>


<!-- -------------------------------------->
<!-- --- Contenido HTML ----->
<!-- -------------------------------------->
<h1 class="display-4"><?php echo get_admin_page_title(); ?></h1>
<p class="lead">Un plugin simple y fácil de usar que te permitirá gestionar frases célebres con sus autores respectivos y mostrarlos en un widget de manera aleatoria.</p>

<hr class="my-4">

<!-- Botones Top -->
<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" href="<?php echo $urlAddPhrase; ?>">Añadir frase</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo $urlDeleteAll; ?>"  <?php if($flagDeshabilitar == 1) {echo "hidden";}?> >Eliminar todo</a>
  </li>
</ul>

<hr style="width: 80%;/*! padding: -2px; */margin-bottom:   10px;margin-top: 0px;" class="">

<!-- Elementos encontrados -->
<ul class="nav justify-content-center">
  <li class="nav-item">
    <p style="font-size: 1rem;"><?php echo $totalElementos; ?> elementos encontrados</p>
  </li>
</ul>

<!-- Alerta "¡Registro eliminado correctame!" -->
<div id="alertEliminarRegistroEliminado" class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  ¡Registro eliminado correctame!
</div>

<!-- Alerta "¡Registro no eliminado" -->
<div id="alertEliminarRegistroNoEliminado" class="alert alert-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  ¡Registro no eliminado!
</div>
 
<!-- Tabla de datos -->
<table id="table" style="width: 100%;" aria-describedby="table_info" role="" class="display dataTable dtr-inline collapsed">
  <thead>
    <tr>
      <th></th>
      <th>Autor</th>
      <th>Frase</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </thead>    
  <tbody id="the-list">
    <?php
      foreach ($lista_frases as $key => $value) {

        $id = $value['befrases_id'];
        $autor = $value['befrases_autor'];
        $frase = $value['befrases_frase'];        
        $frase_clean_1 = substr($frase, 0, -2);
        $frase_clean_2 = substr($frase_clean_1, 1);
  
        echo "
          <tr>
            <td></td>       
            <td>$autor</td>
            <td>$frase</td>
            <td>";

            echo "<form method=\"post\" action="; echo $urlEditPhrase; echo"\>
            <input type=\"hidden\" name=\"idEditar\" value=\" $id \"/>
            <input type=\"hidden\" name=\"autorEditar\" value=\" $autor \"/>
            <input type=\"hidden\" name=\"fraseEditar\" value=\" $frase_clean_2 \"/>
            <button class=\"btn btn-link\" type=\"submit\"  id=\"btnEditarFrase\" style=\"padding: 10px;\">Editar</button>
            </form>             
            </td>
            <td>";
     
            echo "<form id=\"formEliminar\" method=\"post\" onsubmit=\"return fn_eliminar()\""; echo"\>
            <input type=\"hidden\" name=\"idEliminar\" value=\" $id \"/>
            <input type=\"hidden\" name=\"autorEliminar\" value=\" $autor \"/>
            <input type=\"hidden\" name=\"fraseEliminar\" value=\" $frase_clean_2 \"/>
            <button class=\"btn btn-link\" type=\"submit\"  id=\"btnEliminarFrase\" style=\"padding: 10px;\">Eliminar</button>
            </form> 

            </td>
          </tr>
        ";
      }
    ?>  
  </tbody> 
  <tfoot>
    <tr>
      <th></th>
      <th>Autor</th>
      <th>Frase</th>
      <th>Editar</th>
      <th>Borrar</th>
    </tr>
  </tfoot>
</table>


<!-- -------------------------------------->
<!-- --- Contenido JavaScript ----->
<!-- -------------------------------------->
<script>
  $(document).ready( function () {

    // DataTables
    var t = $('#table').DataTable( {  
      "responsive": {
        details: {
            type: 'inline'
        }
    },
      "pagingType": "full_numbers",    
      "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": [0,3,4]
        } ],
      "order": [[ 1, "desc" ]],

      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "¡No hay registros para mostrar!",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponinles",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": "Buscar:",
        "paginate": {
          first:      "Primero",
          previous:   "Anterior",
          next:       "Siguiente",
          last:       "Último"
        },
      },
    });
    

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

  });
</script>

<?php
// Autocompletar autor
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
  $( "#inputAutorAnadir" ).autocomplete({
    source: data
  });
} );

</script>