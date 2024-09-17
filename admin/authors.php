<?php
  /*
   * Add authors plugin option
   *
   * @package   				beFrases
   * @version  					2.0.0
   * @author    				Guillermo Camarena <gcamarenaprog@outlook.com>
   * @copyright 				Copyright (c) 2004 - 2023, Guillermo Camarena
   * @link      				https://gcamarenaprog.com/beFrases/
   * @license   				http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
   *
   */
?>

<?php
  
  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined('ABSPATH') or die("Bye bye and remember: Silence is golden!");
  
  # Save new author record from add new author form
  if(isset($_POST['nButtonNewAuthor'])){
    $authorName = $_POST['nInputAuthorName'];
    $authorDescription = $_POST['nTextAreaAuthorDescription'];
    saveNewAuthorRecord($authorName, $authorDescription);
  }
  
  # Delete author record from delete form
  if(isset($_POST['nButtonDeleteAuthor'])){
    $authorId = $_POST['nInputDeleteAuthorId'];
    deleteAuthorRecord($authorId);
  }
  
  # Update the changes from edit form
  if(isset($_POST['nButtonSaveEditAuthor'])){
    $idAuthor = $_POST['nInputEditAuthorId'];
    $nameAuthor = $_POST['nInputEditAuthorName'];
    $descriptionAuthor = $_POST['nTextAreaEditAuthorDescription'];
    updateAuthorRecord($idAuthor, $nameAuthor, $descriptionAuthor);
  }
  
  # Gets list of all categories from database
  $categoriesList = getAllCategoriesList();

?>

<div class="container-fluid">
  
  <h1 class="display-6"><?php echo get_admin_page_title(); ?></h1>
  <p class="lead">En esta sección podrás añadir, editar o eliminar categorías, para editar o eliminar selecciona una categoría de la lista.</p>
  
  <hr>
  
  <!-- Row: Content -->
  <div class="row">
    
    <!-- First column -->
    <div class="col-lg-3 col-md-6 col-sm-12">
      
      <!-- Add author form -->
      <form method="post" class="mb-3" style="display: block;" id="iFormAddAuthor" name="nFormAddAuthor">
        
        <p class="be-title"><strong>Añadir categoría</strong> </p>
        <p class="be-description">Escribe el nombre y la descripción de la nueva categoría.</p>
        
        <hr>
        
        <div class="mb-3">
          <label for="iInputAuthorName" class="form-label">Nombre de la categoría</label>
          <input class="form-control" name="nInputAuthorName" id="iInputAuthorName" placeholder="Nombre.." required>
          <div id="iHelpAuthorName" class="form-text">El nombre es como aparece en tu sitio..</div>
        </div>
        
        <div class="mb-3">
          <label for="iTextAreaAuthorDescription" class="form-label">Descripción</label>
          <textarea class="form-control" name="nTextAreaAuthorDescription" id="iTextAreaAuthorDescription" placeholder="Descripción.." rows="3" required></textarea>
          <div id="iHelpAuthorDescription" class="form-text">La descripción no se muestra por defecto; sin embargo, hay algunos temas y opciones que pueden mostrarla.</div>
        </div>
        
        <button id="iButtonNewAuthor" name="nButtonNewAuthor" type="submit" class="btn btn-dark">Añadir</button>
      
      </form>
      
      <!-- Edit author form -->
      <form method="post" class="mb-3" style="display: none;" id="iFormEditAuthor" name="nFormEditAuthor">
        
        <p class="be-title"><strong>Editar categoría</strong> </p>
        <p class="be-description">Modificar la categoría seleccionada.</p>
        
        <hr>
        
        <input type="hidden" class="form-control" name="nInputEditAuthorId" id="iInputEditAuthorId">
        
        <div class="mb-3">
          <label for="iInputEditAuthorName" class="form-label">Nombre de la categoría</label>
          <input class="form-control" name="nInputEditAuthorName" id="iInputEditAuthorName">
          <div id="iHelpAuthorName" class="form-text">El nombre es como aparece en tu sitio..</div>
        </div>
        
        <div class="mb-3">
          <label for="iTextAreaEditAuthorDescription" class="form-label">Descripción</label>
          <textarea class="form-control" name="nTextAreaEditAuthorDescription" id="iTextAreaEditAuthorDescription" rows="3"></textarea>
          <div id="iHelpAuthorDescription" class="form-text">La descripción no se muestra por defecto; sin embargo, hay algunos temas y opciones que pueden mostrarla.</div>
        </div>
        
        <button type="submit" name="nButtonSaveEditAuthor" id="iButtonSaveEditAuthor" class="btn btn-dark">Guardar cambios</button>
        <button type="button" name="nButtonCancelEditAuthor" id="iButtonCancelEditAuthor" class="btn btn-dark" onclick="hiddeFormEditAuthor()">Cancelar</button>
      
      </form>
      
      <!-- Delete author form -->
      <form method="post" class="mb-3" style="display: none;" id="iFormDeleteAuthor" name="nFormDeleteAuthor">
        
        <p class="be-title"><strong>Eliminar categoría</strong> </p>
        <p class="be-description">Eliminar la categoría seleccionada.</p>
        
        <hr>
        
        <div id="iCardDeleteMessageYes" name="nCardDeleteMessageYes" class="card text-center">
          <h5 class="card-header">Eliminar categoría</h5>
          <div class="card-body">
            <h5 class="card-title" id="iCardDeleteMessageTitleMessage" name="nCardDeleteMessageTitleMessage"></h5>
            <p class="be-message" id="iCardDeleteMessageParagrahpMessage" name="nCardDeleteMessageParagrahpMessage" class="card-text"><strong id="iCardDeleteMessageParagrahpStrongMessage" name="nCardDeleteMessageParagrahpStrongMessage"></strong></p>
            <input type="hidden" class="form-control" name="nInputDeleteAuthorId" id="iInputDeleteAuthorId">
            
            <div class="row justify-content-center">
              <div class="col-4">
                <button type="button" name="nButtonAcceptDeleteAuthor" id="iButtonAcceptDeleteAuthor" class="btn btn-dark" style="display: none;" onclick="hiddeFormDeleteAuthor()">Aceptar</button>
              </div>
            </div>
            
            <div class="row justify-content-center">
              <div class="col-4">
                <button type="submit" name="nButtonDeleteAuthor" id="iButtonDeleteAuthor" class="btn btn-dark" style="display: none;">Eliminar</button>
              </div>
              <div class="col-4">
                <button type="button" name="nButtonCancelDeleteAuthor" id="iButtonCancelDeleteAuthor" class="btn btn-dark" style="display: none;" onclick="hiddeFormDeleteAuthor()">Cancelar</button>
              </div>
            </div>
          
          </div>
        </div>
      
      </form>
    
    </div>
    
    <!-- Second column -->
    <div class="col-lg-9 col-md-6 col-sm-12">
      
      <p class="be-title"><strong>Lista de categorías</strong> </p>
      <p class="be-description">Lista de categorías, selecciona una para editar o eliminar.</p>
      
      <hr>
      
      <!-- Data Table -->
      <div class="table-responsive">
        
        <table id="table" class="display nowrap" style="width:100%">
          <thead>
          <tr>
            <th><strong></strong></th>
            <th><strong>Id</strong></th>
            <th><strong>Nombre</strong></th>
            <th><strong>Descripción</strong></th>
            <th><strong>No. Frases</strong></th>
            <th class="text-center"><strong>Editar</strong></th>
            <th class="text-center"><strong>Borrar</strong></th>
          </tr>
          </thead>
          <tbody>
          <?php
            foreach ($categoriesList as $key => $value) {
              $authorId = $value['befrases_cat_id'];
              $authorName = $value['befrases_cat_name'];
              $authorDescription = $value['befrases_cat_description'];
              
              $authorTotalQuotes = countTotalRecordsAuthor($authorId);
              
              echo "
									<tr>
										<td></td>
										<td>$authorId</td>
										<td>$authorName</td>
										<td>$authorDescription</td>
										<td>$authorTotalQuotes</td>"; ?>
              <td style="text-align:center">
                <button class="btn btn-success" id="iButtonEditAuthorRegister" name="nButtonEditAuthorRegister"  onclick="showFormEditAuthor('<?php echo $authorId;?>', '<?php echo $authorName;?>', '<?php echo $authorDescription;?>')" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" \">Editar</button>
              </td>
              
              <td style="text-align:center">
                <button class="btn btn-danger" id="iButtonDeleteAuthorRegister" name="nButtonDeleteAuthorRegister" onclick="showFormDeleteAuthor('<?php echo $authorId;?>', '<?php echo $authorName;?>', '<?php echo $authorTotalQuotes; ?>')" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;\" \">Eliminar</button>
              </td>
              <?php
              echo "
									</tr>";
            }
          ?>
          <tfoot>
          <th><strong></strong></th>
          <th><strong>Id</strong></th>
          <th><strong>Nombre</strong></th>
          <th><strong>Descripción</strong></th>
          <th><strong>No. Frases</strong></th>
          <th class="text-center"><strong>Editar</strong></th>
          <th class="text-center"><strong>Borrar</strong></th>
          </tfoot>
        </table>
      
      </div>
    
    </div>
  
  </div>
  
  <hr>

</div>

<script>

  $(document).ready( function () {

    // DataTables
    var t = $('#table').DataTable( {
      "responsive": true,
      "pagingType": "full_numbers",
      "columnDefs": [ {
        "searchable": false,
        "orderable": false,
        "targets": [0, 3,4]
      } ],
      "order": [[ 2, "asc" ]],

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

    t
      .on('order.dt search.dt', function () {
        let i = 1;
        t
          .cells(null, 0, { search: 'applied', order: 'applied' })
          .every(function (cell) {
            this.data(i++);
          });
      })
      .draw();

  });

</script>