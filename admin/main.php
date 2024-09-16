<?php
/*
 * Manage plugin option
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

  global $wpdb;

  # Add new phrase from add form
  if(isset($_POST['nButtonNewPhrase'])){
    $authorPrhase = $_POST['nInputAuthor'];
    $textPhrase = $_POST['nTextAreaPhrase'];
    $categoryIdPhrase = $_POST['nSelectCategory'];
    addPhraseRecord($authorPrhase, $textPhrase, $categoryIdPhrase);
  }
  
  # Update the changes from edit form
  if(isset($_POST['nButtonSaveEditPhrase'])){
    $idPhrase = $_POST['nInputEditPhraseId'];
    $authorPrhase = $_POST['nInputEditPhraseAuthor'];
    $textPhrase = $_POST['nTextAreaEditPhraseText'];
    $categoryIdPhrase = $_POST['nSelectEditCategory'];
    updatePhraseRecord($idPhrase, $authorPrhase, $textPhrase, $categoryIdPhrase);
  }

  # Delete record from delete form
  if(isset($_POST['nButtonDeletePhrase'])){
    $idPhrase = $_POST['nInputDeletePhraseId'];
    deletePhraseRecord($idPhrase);
  }

  # Get all phrases from database
  $listPhrases = getPhrases();

  # Get all authors from list phrases no repeat
  $listAuthorsNoRepeat = getAllAuthorsNoRepeat($listPhrases);
  print_r($listAuthorsNoRepeat);

  # Get all phrases from list phrases no repeat
  //$listPhrasesNoRepeat = getAllPhrasesNoRepeat($listPhrases);

 // print_r($listPhrasesNoRepeat);

?>


<!-- HTML Code -->
  <div class="container-fluid">

  <h1 class="display-6"><?php echo get_admin_page_title(); ?></h1>
  <p class="lead">Un plugin fácil y simple de usar que te permitirá gestionar una colección de frases célebres con sus autores respectivos, además de categorizarlas y mostrarlas de en un widget aleatoriamente.</p>

  <hr>

  <!-- Row: Content -->
  <div class="row">

    <!-- First column -->
    <div class="col-lg-3 col-md-6 col-sm-12">

      <!-- Add phrase form -->
      <form method="post" class="mb-3" style="display: block;" id="iFormAddPhrase" name="nFormAddPhrase">

        <p class="be-title"><strong>Añadir frase</strong> </p>
        <p class="be-description">Escribe el autor, frase y categoría de la frase.</p>
      
        <hr>

        <div class="mb-3">
          <label for="iInputAuthor" class="form-label">Autor</label>
          <input class="form-control" name="nInputAuthor" id="iInputAuthor" placeholder="Autor.." required>
          <div id="iHelpAuthorName" class="form-text">Autor de la frase</div>
        </div>

        <div class="mb-3">
          <label for="iTextAreaPhrase" class="form-label">Frase</label>
          <textarea class="form-control" name="nTextAreaPhrase" id="iTextAreaPhrase" placeholder="Escriba aquí la frase.." rows="3" required></textarea>
          <div id="iHelpPhraseDescription" class="form-text">Escriba la frase sin comillas al inicio o al final.</div>
        </div>

        <div class="mb-3">
          <label for="iSelectCategory" class="form-label">Categoría</label>
          <select class="form-select" aria-label="Default select example" id="iSelectCategory" name="nSelectCategory">
            <?php         
              $namesCategoriesList = getAllDataCategoriesList();
              foreach ($namesCategoriesList as $key => $value) {
                $phraseCategoryId = $value['befrases_cat_id'];
                $phraseCategoryName = $value['befrases_cat_name']; 
                if($phraseCategoryId == 1){
                  echo '<option selected value="'.$phraseCategoryId.'">'.$phraseCategoryName.'</option>';
                } else {
                  echo '<option value="'.$phraseCategoryId.'">'.$phraseCategoryName.'</option>';
                }                
              }
            ?>
          </select>
          <div id="iHelpCategory" class="form-text">Nombre de la categoría.</div>
        </div>

        <button id="iButtonNewPhrase" name="nButtonNewPhrase" type="submit" class="btn btn-dark">Añadir</button>
        
      </form>
      
      <!-- Edit phrase form -->
      <form method="post" class="mb-3" style="display: none;" id="iFormEditPhrase" name="nFormEditPhrase">

        <p class="be-title"><strong>Editar frase</strong> </p>
        <p class="be-description">Modificar la frase seleccionada.</p>
        
        <hr>

        <input type="hidden" class="form-control" name="nInputEditPhraseId" id="iInputEditPhraseId">

        <div class="mb-3">
          <label for="iInputEditPhraseAuthor" class="form-label">Autor</label>
          <input class="form-control" name="nInputEditPhraseAuthor" id="iInputEditPhraseAuthor">
          <div id="iHelpPhraseAuthor" class="form-text">El nombre del autor.</div>
        </div>

        <div class="mb-3">
          <label for="iTextAreaEditPhraseText" class="form-label">Frase</label>
          <textarea class="form-control" name="nTextAreaEditPhraseText" id="iTextAreaEditPhraseText" rows="3"></textarea>
          <div id="iHelpPhraseDescription" class="form-text">Escriba la frase sin comillas al inicio o al final.</div>
        </div>

        <div class="mb-3">
          <label for="iSelectEditCategory" class="form-label">Categoría</label>
          <select class="form-select" aria-label="Default select example" id="iSelectEditCategory" name="nSelectEditCategory">            
            <?php         
              $namesCategoriesList = getAllCategoriesList();
              foreach ($namesCategoriesList as $key => $value) {
                $phraseCategoryId = $value['befrases_cat_id'];
                $phraseCategoryName = $value['befrases_cat_name']; 
                echo '<option value="'.$phraseCategoryId.'">'.$phraseCategoryName.'</option>';             
              }
            ?>
          </select>
          <div id="iHelpEditCategory" class="form-text">Nombre de la categoría.</div>
        </div>

        <button type="submit" name="nButtonSaveEditPhrase" id="iButtonSaveEditPhrase" class="btn btn-dark">Guardar cambios</button>
        <button type="button" name="nButtonCancelEditPhrase" id="iButtonCancelEditPhrase" class="btn btn-dark" onclick="hiddeFormEditPhrase()">Cancelar</button>

      </form>

      <!-- Delete phrase form -->
      <form method="post" class="mb-3" style="display: none;" id="iFormDeletePhrase" name="nFormDeletePhrase">

        <p class="be-title"><strong>Eliminar frase</strong> </p>
        <p class="be-description">Eliminar la frase seleccionada.</p>
        
        <hr>

        <div class="card">
          <h5 class="card-header">Eliminar frase</h5>
          <div class="card-body">
            <h5 class="card-title">¿Confirmar la eliminación de la siguiente frase?</h5>
            <hr>
            <p class="be-phrase-delete-confirmation" id="iParagrahpDeletePhraseText" class="card-text"></p>
            <p class="be-author-delete-confirmation" id="iParagrahpDeleteAuthorText" class="card-text"></p>
            <p id="iPhrase" name="nPhrase"></p>
            <hr>
            <input type="hidden" class="form-control" name="nInputDeletePhraseId" id="iInputDeletePhraseId">
            <button type="submit" name="nButtonDeletePhrase" id="iButtonDeletePhrase" class="btn btn-dark">Eliminar</button>
            <button type="button" name="nButtonCancelDeletePhrase" id="iButtonCancelDeletePhrase" class="btn btn-dark" onclick="hiddeFormDeletePhrase()">Cancelar</button>
          </div>
        </div>

      </form>

    </div>

    <!-- Second column -->
    <div class="col-lg-9 col-md-6 col-sm-12">

      <p class="be-title"><strong>Lista de frases</strong> </p>
      <p class="be-description">Lista de frases, selecciona una para editar o eliminar.</p>							

      <hr>

      <!-- Data Table -->
      <table id="table" class="display nowrap" style="width:100%">
          <thead>
            <tr>
              <th><strong></strong></th>
              <th><strong>Autor</strong></th>
              <th><strong>Frase</strong></th>
              <th><strong>Categoría</strong></th>
              <th class="text-center"><strong>Editar</strong></th>
              <th class="text-center"><strong>Borrar</strong></th>
            </tr>
          </thead>
          <tbody>
            <?php
              
              foreach ($listPhrases as $key => $value) {										
                $phraseId = $value['befrases_id'];
                $phraseAuthor = $value['befrases_author']; 
                $phraseText = $value['befrases_phrase'];
                $phraseCategoryId = $value['befrases_category'];

                $name = getCategoryName($phraseCategoryId);

                foreach ($name as $key => $value) {
                  $phraseCategory = $value['befrases_cat_name'];
                }                                
                echo "
                <tr>                
                  <td></td>
                  <td>$phraseAuthor</td>
                  <td>$phraseText</td>
                  <td>$phraseCategory</td>"; ?>
                  <td style="text-align:center">			
										<button 
                      class="btn btn-success" 
                      id="iButtonEditPhraseRegister" 
                      name="nButtonEditPhraseRegister" 
                      onclick="showFormEditPhrase('<?php echo $phraseId;?>', '<?php echo $phraseAuthor;?>', '<?php echo $phraseText;?>', '<?php echo $phraseCategoryId;?>')"
                      style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" \">
                      Editar
                    </button>

                 
                  </td>
                
                  <td style="text-align:center">						
                    <button 
                    class="btn btn-danger" 
                    id="iButtonDeletePhraseRegister" 
                    name="nButtonDeletePhraseRegister" 
                    onclick="showFormDeletePhrase('<?php echo $phraseId;?>', '<?php echo $phraseAuthor;?>', '<?php echo $phraseText;?>')" 
                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;\" \">Eliminar</button>
                  </td>               

                <?php
                echo "
                </tr>";
              }
            ?>  
          <tfoot>
            <th><strong></strong></th>
            <th><strong>Autor</strong></th>
            <th><strong>Frase</strong></th>
            <th><strong>Categoría</strong></th>
            <th class="text-center"><strong>Editar</strong></th>
            <th class="text-center"><strong>Borrar</strong></th>
          </tfoot>
        </table>
   
    </div>

  </div>

  <hr>

  </div>
<!-- HTML Code /-->


<!-- JS Code -->
  <script>

    $(document).ready( function () {
      
      // DataTables
      var t = $('#table').DataTable( {  
        "responsive": true,
        "pagingType": "full_numbers",    
        "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": [0, 4,5]
          } ],
        "order": [[ 1, "asc" ]],

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
<!-- JS Code /-->






<script>
$( function() {
  var data = <?php echo json_encode($listAuthorsNoRepeat) ?>;
  $( "#iInputEditPhraseAuthor" ).autocomplete({
    source: data,
    minLength: 3
  });
} );

$( function() {
  var data = <?php echo json_encode($listAuthorsNoRepeat) ?>;
  $( "#iInputAuthor" ).autocomplete({
    source: data,
    minLength: 3
  });
} );

</script>