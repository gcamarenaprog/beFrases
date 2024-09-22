<?php
  /**
   * Manage plugin option
   *
   * @package            beFrases
   * @version            2.0.0
   * @author             Guillermo Camarena <gcamarenaprog@outlook.com>
   * @copyright          Copyright (c) 2004 - 2023, Guillermo Camarena
   * @link               https://gcamarenaprog.com/beFrases/
   * @license            http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
   *
   */
  
  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined ('ABSPATH') or die("Bye bye and remember: Silence is golden!");
  
  global $wpdb;
  
  # Add new quote from add form
  if (isset($_POST['nButtonNewQuote'])) {
    $authorIdQuote = $_POST['nSelectAuthor'];
    $textQuote = $_POST['nTextAreaQuote'];
    $categoryIdQuote = $_POST['nSelectCategory'];
    addQuoteRecord ($authorIdQuote, $textQuote, $categoryIdQuote);
  }
  
  # Update the changes from edit form
  if (isset($_POST['nButtonSaveEditQuote'])) {
    $idQuote = $_POST['nInputEditQuoteId'];
    $authorQuote = $_POST['nSelectEditAuthor'];
    $textQuote = $_POST['nTextAreaEditQuoteText'];
    $categoryIdQuote = $_POST['nSelectEditCategory'];
    updateQuoteRecord ($idQuote, $authorQuote, $textQuote, $categoryIdQuote);
  }
  
  # Delete record from delete form
  if (isset($_POST['nButtonDeleteQuote'])) {
    $idQuote = $_POST['nInputDeleteQuoteId'];
    deleteQuoteRecord ($idQuote);
  }
  
  # Get all quotes
  $listQuotes = getAllQuotes ();
  
  # Get all authors from list quotes no repeat
  $listAuthorsWithoutRepeat = getAllAuthorsWithoutRepeat ($listQuotes);
  
  # Get all categories
  $namesCategoriesList = getAllDataCategoriesList ();

?>

<div class="container" style="max-width: 100%">
  <div class="row g-2" style="margin-right: 10px;">

    <!-- Title and description /-->
    <div>
      <div class="card">
        <h5 class="card-header"><?php echo get_admin_page_title (); ?></h5>
        <div class="card-body">
          <p class="card-text">
            Un plugin fácil y simple de usar que te permitirá gestionar una colección de frases célebres con sus autores
            respectivos, además de categorizarlas y mostrarlas de en un widget aleatoriamente.
          </p>
        </div>
      </div>
    </div>

    <!-- Add, edit and delete content /-->
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">
        <div class="card-body">

          <!-- Add quote form /-->
          <form method="post" class="mb-3" style="display: block;" id="iFormAddQuote" name="nFormAddQuote">

            <!-- Title and description /-->
            <h5 class="card-title">Añadir frase</h5>
            <p class="card-text">Escribe el autor, frase y categoría de la frase.</p>

            <hr>

            <!-- Author /-->
            <div class="mb-3">
              <label for="iSelectAuthor" class="form-label">Autor</label>
              <select class="form-select"
                      id="iSelectAuthor"
                      name="nSelectAuthor"
                      title="Escoge un autor."
                      required
              >
                <?php
                  $namesAuthorsList = getAllDataAuthorsList ();
                  echo '<option selected></option>';
                  foreach ($namesAuthorsList as $key => $value) {
                    $quoteAuthorId = $value['befrases_aut_id'];
                    $quoteAuthorName = $value['befrases_aut_name'];
                    echo '<option value="' . $quoteAuthorId . '">' . $quoteAuthorName . '</option>';
                  }
                ?>
              </select>
              <div id="iHelpCategory" class="form-text">Nombre de la autor.</div>
            </div>

            <!-- Quote /-->
            <div class="mb-3">
              <label for="iTextAreaQuote" class="form-label">Frase</label>
              <textarea class="form-control"
                        name="nTextAreaQuote"
                        id="iTextAreaQuote"
                        placeholder="Escriba una frase.."
                        rows="3"
                        title="Escriba la frase sin comillas al inicio y al final."
                        required></textarea>
              <div id="iHelpQuoteDescription" class="form-text">Escriba la frase sin comillas al inicio y al final.
              </div>
            </div>

            <!-- Category /-->
            <div class="mb-3">
              <label for="iSelectCategory" class="form-label">Categoría</label>
              <select class="form-select"
                      id="iSelectCategory"
                      name="nSelectCategory"
                      title="Escoge una categoría."
                      required
              >
                <?php
                  echo '<option selected></option>';
                  foreach ($namesCategoriesList as $key => $value) {
                    $quoteCategoryId = $value['befrases_cat_id'];
                    $quoteCategoryName = $value['befrases_cat_name'];
                    echo '<option value="' . $quoteCategoryId . '">' . $quoteCategoryName . '</option>';
                  }
                ?>
              </select>
              <div id="iHelpCategory" class="form-text">Nombre de la categoría.</div>
            </div>

            <!-- Add button /-->
            <button id="iButtonNewQuote"
                    name="nButtonNewQuote"
                    type="submit"
                    title="Clic para añadir la categoría."
                    class="btn btn-success btn-sm">
              Añadir
            </button>

          </form>

          <!-- Edit quote form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormEditQuote" name="nFormEditQuote">

            <!-- Title and description /-->
            <h5 class="card-title">Editar frase</h5>
            <p class="card-text">Modificar la frase seleccionada.</p>

            <hr>

            <!-- Quote Id /-->
            <input type="hidden"
                   class="form-control"
                   name="nInputEditQuoteId"
                   id="iInputEditQuoteId">

            <!-- Author /-->
            <div class="mb-3">
              <label for="iSelectEditAuthor" class="form-label">Autor</label>
              <select class="form-select"
                      id="iSelectEditAuthor"
                      title="Escoge un autor."
                      name="nSelectEditAuthor">
                <?php
                  $namesCategoriesList = getAllDataAuthorsList ();
                  foreach ($namesCategoriesList as $key => $value) {
                    $quoteAuthorId = $value['befrases_aut_id'];
                    $quoteAuthorName = $value['befrases_aut_name'];
                    echo '<option value="' . $quoteAuthorId . '">' . $quoteAuthorName . '</option>';
                  }
                ?>
              </select>
              <div id="iHelpEditAuthor" class="form-text">Nombre del autor.</div>
            </div>

            <!-- Quote /-->
            <div class="mb-3">
              <label for="iTextAreaEditQuoteText" class="form-label">Frase</label>
              <textarea class="form-control"
                        name="nTextAreaEditQuoteText"
                        id="iTextAreaEditQuoteText"
                        required
                        title="Escriba la frase sin comillas al inicio y al final."
                        rows="3"></textarea>
              <div id="iHelpQuoteDescription" class="form-text">Escriba la frase sin comillas al inicio y al final.
              </div>
            </div>

            <!-- Category /-->
            <div class="mb-3">
              <label for="iSelectEditCategory" class="form-label">Categoría</label>
              <select class="form-select"
                      aria-label="Default select example"
                      id="iSelectEditCategory"
                      name="nSelectEditCategory"
                      title="Escoge una categoría."
              >
                <?php
                  $namesCategoriesList = getAllCategoriesList ();
                  foreach ($namesCategoriesList as $key => $value) {
                    $quoteCategoryId = $value['befrases_cat_id'];
                    $quoteCategoryName = $value['befrases_cat_name'];
                    echo '<option value="' . $quoteCategoryId . '">' . $quoteCategoryName . '</option>';
                  }
                ?>
              </select>
              <div id="iHelpEditCategory" class="form-text">Escoge una categoría.</div>
            </div>

            <!-- Save edit /-->
            <button type="submit"
                    name="nButtonSaveEditQuote"
                    id="iButtonSaveEditQuote"
                    title="Clic para actualizar los cambios."
                    class="btn btn-success btn-sm">
              Actualizar
            </button>

            <!-- Cancel edit /-->
            <button type="button"
                    name="nButtonCancelEditQuote"
                    id="iButtonCancelEditQuote"
                    class="btn btn-danger btn-sm"
                    title="Clic para cancelar."
                    onclick="hiddeFormEditQuote()">
              Cancelar
            </button>

          </form>

          <!-- Delete quote form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormDeleteQuote" name="nFormDeleteQuote">

            <!-- Title and description /-->
            <h5 class="card-title">Eliminar frase</h5>
            <p class="card-text">¿Desea eliminar el siguiente registro?</p>

            <hr>

            <!-- Quote and author /-->
            <div class="mb-4" style="padding: 10px !important;">

              <!-- Quote text /-->
              <p class="card-text be-quote-delete-confirmation" id="iDeleteQuoteText"></p>

              <!-- Quote author /-->
              <p class="card-text be-author-delete-confirmation" id="iDeleteAuthorText"></p>

            </div>

            <hr>

            <!-- Quote Id /-->
            <input type="hidden"
                   class="form-control"
                   name="nInputDeleteQuoteId"
                   id="iInputDeleteQuoteId">

            <!-- Delete quote /-->
            <button type="submit"
                    name="nButtonDeleteQuote"
                    id="iButtonDeleteQuote"
                    title="Clic para eliminar la frase."
                    class="btn btn-success btn-sm">
              Eliminar
            </button>

            <!-- Cancel delete /-->
            <button type="button"
                    name="nButtonCancelDeleteQuote"
                    id="iButtonCancelDeleteQuote"
                    class="btn btn-danger btn-sm"
                    title="Clic para cancelar."
                    onclick="hiddeFormDeleteQuote()">
              Cancelar
            </button>

          </form>

        </div>
      </div>
    </div>

    <!-- List of quotes /-->
    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">

        <!-- Title and description /-->
        <h5 class="card-title">Lista de frases</h5>
        <p class="card-text">Lista de frases, selecciona una para editar o eliminar.</p>

        <hr>

        <!-- List of quotes table /-->
        <table id="table" class="display " style="width:100%">

          <thead>
          <tr>
            <th>#</th>
            <th>Autor</th>
            <th>Frase</th>
            <th>Categoría</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Borrar</th>
          </tr>
          </thead>

          <tbody>
          <?php
            
            foreach ($listQuotes as $key => $value) {
              
              $quoteId = $value['befrases_id'];
              $quoteAuthorId = $value['befrases_author'];
              $quoteText = $value['befrases_quote'];
              $quoteCategoryId = $value['befrases_category'];
              
              $nameOfCategory = getCategoryName ($quoteCategoryId);
              foreach ($nameOfCategory as $key => $value) {
                $quoteCategory = $value['befrases_cat_name'];
              }
              
              $nameOfAuthor = getAuthorName ($quoteAuthorId);
              foreach ($nameOfAuthor as $key => $value) {
                $quoteAuthor = $value['befrases_aut_name'];
              }
              ?>

              <tr>
                <!-- # /-->
                <td></td>

                <!-- Author /-->
                <td><?php echo $quoteAuthor; ?></td>

                <!-- Quote /-->
                <td>"<?php echo $quoteText; ?>"</td>

                <!-- Category /-->
                <td><?php echo $quoteCategory; ?></td>

                <!-- Edit button /-->
                <td style="text-align:center">
                  <button
                      class="btn btn-primary btn-sm"
                      id="iButtonEditQuoteRegister"
                      name="nButtonEditQuoteRegister"
                      title="Clic para editar."
                      onclick="showFormEditQuote('<?php echo $quoteId; ?>', '<?php echo $quoteAuthorId; ?>', '<?php echo $quoteText; ?>', '<?php echo $quoteCategoryId; ?>')">
                    Editar
                  </button>
                </td>

                <!-- Delete button /-->
                <td style="text-align:center">
                  <button
                      class="btn btn-danger btn-sm"
                      id="iButtonDeleteQuoteRegister"
                      name="nButtonDeleteQuoteRegister"
                      title="Clic para eliminar."
                      onclick="showFormDeleteQuote('<?php echo $quoteId; ?>', '<?php echo $quoteAuthor; ?>', '<?php echo $quoteText; ?>')">
                    Eliminar
                  </button>
                </td>

              </tr>
              <?php
            }
          ?>

          <tfoot>
          <th>#</th>
          <th>Autor</th>
          <th>Frase</th>
          <th>Categoría</th>
          <th class="text-center">Editar</th>
          <th class="text-center">Borrar</th>
          </tfoot>

        </table>

      </div>
    </div>

  </div>
</div>

<script>

  $(document).ready(function () {

    // DataTables
    let t = $('#table').DataTable({
      "responsive": true,
      "pagingType": "full_numbers",
      "columnDefs": [{
        "searchable": false,
        "orderable": false,
        "targets": [0, 4, 5]
      }],
      "order": [[1, "asc"]],
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "emptyTable": "¡No hay registros para mostrar!",
        "zeroRecords": "¡No hay registros para mostrar!",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponinles",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": "Buscar:",
        "paginate": {
          first: "Primero",
          previous: "Anterior",
          next: "Siguiente",
          last: "Último"
        },
      },
    });

    t
      .on('order.dt search.dt', function () {
        let i = 1;
        t
          .cells(null, 0, {search: 'applied', order: 'applied'})
          .every(function (cell) {
            this.data(i++);
          });
      })
      .draw();

  });

</script>