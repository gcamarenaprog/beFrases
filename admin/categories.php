<?php
  /**
   * Add categories plugin option
   *
   * @package   				beFrases
   * @version  					2.0.0
   * @author    				Guillermo Camarena <gcamarenaprog@outlook.com>
   * @copyright 				Copyright (c) 2004 - 2023, Guillermo Camarena
   * @link      				https://gcamarenaprog.com/beFrases/
   * @license   				http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
   *
   */
  
  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined ('ABSPATH') or die("Bye bye and remember: Silence is golden!");
  
  # Save new category record from add new category form
  if (isset($_POST['nButtonNewCategory'])) {
    $categoryName = $_POST['nInputCategoryName'];
    $categoryDescription = $_POST['nTextAreaCategoryDescription'];
    saveNewCategoryRecord ($categoryName, $categoryDescription);
  }
  
  # Delete category record from delete form
  if (isset($_POST['nButtonDeleteCategory'])) {
    $categoryId = $_POST['nInputDeleteCategoryId'];
    deleteCategoryRecord ($categoryId);
  }
  
  # Update the changes from edit form
  if (isset($_POST['nButtonSaveEditCategory'])) {
    $idCategory = $_POST['nInputEditCategoryId'];
    $nameCategory = $_POST['nInputEditCategoryName'];
    $descriptionCategory = $_POST['nTextAreaEditCategoryDescription'];
    updateCategoryRecord ($idCategory, $nameCategory, $descriptionCategory);
  }
  
  # Gets list of all categories from database
  $categoriesList = getAllCategoriesList ();

?>

<div class="container" style="max-width: 100%">
  <div class="row g-2" style="margin-right: 10px;">

    <!-- Title and description /-->
    <div>
      <div class="card">
        <h5 class="card-header"><?php echo get_admin_page_title (); ?></h5>
        <div class="card-body">
          <p class="card-text">
            En esta sección podrás añadir, editar o eliminar categorías, para editar o eliminar selecciona una categoría
            de la lista.
          </p>
        </div>
      </div>
    </div>

    <!-- Add, edit and delete content /-->
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">
        <div class="card-body">

          <!-- Add category form /-->
          <form method="post" class="mb-3" style="display: block;" id="iFormAddCategory" name="nFormAddCategory">

            <!-- Title and description /-->
            <h5 class="card-title">Añadir categoría</h5>
            <p class="card-text">Escribe el nombre y la descripción de la nueva categoría.</p>

            <hr>

            <!-- Author /-->
            <div class="mb-3">
              <label for="iSelectAuthor" class="form-label">Autor</label>
              <select class="form-select"
                      id="iSelectAuthor"
                      name="nSelectAuthor"
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
              <div id="iHelpCategory" class="form-text">Nombre de la categoría.</div>
            </div>

            <!-- Quote /-->
            <div class="mb-3">
              <label for="iTextAreaQuote" class="form-label">Frase</label>
              <textarea class="form-control"
                        name="nTextAreaQuote"
                        id="iTextAreaQuote"
                        placeholder="Escriba la frase.."
                        rows="3"
                        required></textarea>
              <div id="iHelpQuoteDescription" class="form-text">Escriba la frase sin comillas.</div>
            </div>

            <!-- Category /-->
            <div class="mb-3">
              <label for="iSelectCategory" class="form-label">Categoría</label>
              <select class="form-select"
                      id="iSelectCategory"
                      name="nSelectCategory"
                      required
              >
                <?php
                  $namesCategoriesList = getAllDataCategoriesList ();
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
                    class="btn btn-success btn-sm">
              Añadir
            </button>

          </form>

          <!-- Edit category form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormEditCategory" name="nFormEditCategory">

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
              <label for="iSelectEditAuthor" class="form-label">Categoría</label>
              <select class="form-select"
                      id="iSelectEditAuthor"
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
              <div id="iHelpEditAuthor" class="form-text">Nombre de la categoría.</div>
            </div>

            <!-- Quote /-->
            <div class="mb-3">
              <label for="iTextAreaEditQuoteText" class="form-label">Frase</label>
              <textarea class="form-control"
                        name="nTextAreaEditQuoteText"
                        id="iTextAreaEditQuoteText"
                        rows="3"></textarea>
              <div id="iHelpQuoteDescription" class="form-text">Escriba la frase sin comillas al inicio o al final.
              </div>
            </div>

            <!-- Category /-->
            <div class="mb-3">
              <label for="iSelectEditCategory" class="form-label">Categoría</label>
              <select class="form-select"
                      aria-label="Default select example"
                      id="iSelectEditCategory"
                      name="nSelectEditCategory">
                <?php
                  $namesCategoriesList = getAllCategoriesList ();
                  foreach ($namesCategoriesList as $key => $value) {
                    $quoteCategoryId = $value['befrases_cat_id'];
                    $quoteCategoryName = $value['befrases_cat_name'];
                    echo '<option value="' . $quoteCategoryId . '">' . $quoteCategoryName . '</option>';
                  }
                ?>
              </select>
              <div id="iHelpEditCategory" class="form-text">Nombre de la categoría.</div>
            </div>

            <!-- Save edit /-->
            <button type="submit"
                    name="nButtonSaveEditQuote"
                    id="iButtonSaveEditQuote"
                    class="btn btn-success btn-sm">
              Guardar
            </button>

            <!-- Cancel edit /-->
            <button type="button"
                    name="nButtonCancelEditQuote"
                    id="iButtonCancelEditQuote"
                    class="btn btn-danger btn-sm"
                    onclick="hiddeFormEditQuote()">
              Cancelar
            </button>

          </form>

          <!-- Delete category form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormDeleteCategory" name="nFormDeleteCategory">

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
                    class="btn btn-success btn-sm">
              Eliminar
            </button>

            <!-- Cancel delete /-->
            <button type="button"
                    name="nButtonCancelDeleteQuote"
                    id="iButtonCancelDeleteQuote"
                    class="btn btn-danger btn-sm"
                    onclick="hiddeFormDeleteQuote()">
              Cancelar
            </button>

          </form>


          <!-- Add category form -->
          <form method="post" class="mb-3" style="display: block;" id="iFormAddCategory" name="nFormAddCategory">

            <p class="be-title"><strong>Añadir categoría</strong></p>
            <p class="be-description">Escribe el nombre y la descripción de la nueva categoría.</p>

            <hr>

            <div class="mb-3">
              <label for="iInputCategoryName" class="form-label">Nombre de la categoría</label>
              <input class="form-control" name="nInputCategoryName" id="iInputCategoryName" placeholder="Nombre.."
                     required>
              <div id="iHelpCategoryName" class="form-text">El nombre es como aparece en tu sitio..</div>
            </div>

            <div class="mb-3">
              <label for="iTextAreaCategoryDescription" class="form-label">Descripción</label>
              <textarea class="form-control" name="nTextAreaCategoryDescription" id="iTextAreaCategoryDescription"
                        placeholder="Descripción.." rows="3" required></textarea>
              <div id="iHelpCategoryDescription" class="form-text">La descripción no se muestra por defecto; sin
                embargo,
                hay algunos temas y opciones que pueden mostrarla.
              </div>
            </div>

            <button id="iButtonNewCategory" name="nButtonNewCategory" type="submit" class="btn btn-dark">Añadir</button>

          </form>

          <!-- Edit category form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormEditCategory" name="nFormEditCategory">

            <p class="be-title"><strong>Editar categoría</strong></p>
            <p class="be-description">Modificar la categoría seleccionada.</p>

            <hr>

            <input type="hidden" class="form-control" name="nInputEditCategoryId" id="iInputEditCategoryId">

            <div class="mb-3">
              <label for="iInputEditCategoryName" class="form-label">Nombre de la categoría</label>
              <input class="form-control" name="nInputEditCategoryName" id="iInputEditCategoryName">
              <div id="iHelpCategoryName" class="form-text">El nombre es como aparece en tu sitio..</div>
            </div>

            <div class="mb-3">
              <label for="iTextAreaEditCategoryDescription" class="form-label">Descripción</label>
              <textarea class="form-control" name="nTextAreaEditCategoryDescription"
                        id="iTextAreaEditCategoryDescription"
                        rows="3"></textarea>
              <div id="iHelpCategoryDescription" class="form-text">La descripción no se muestra por defecto; sin
                embargo,
                hay algunos temas y opciones que pueden mostrarla.
              </div>
            </div>

            <button type="submit" name="nButtonSaveEditCategory" id="iButtonSaveEditCategory" class="btn btn-dark">
              Guardar
              cambios
            </button>
            <button type="button" name="nButtonCancelEditCategory" id="iButtonCancelEditCategory" class="btn btn-dark"
                    onclick="hiddeFormEditCategory()">Cancelar
            </button>

          </form>

          <!-- Delete category form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormDeleteCategory" name="nFormDeleteCategory">

            <p class="be-title"><strong>Eliminar categoría</strong></p>
            <p class="be-description">Eliminar la categoría seleccionada.</p>

            <hr>

            <div id="iCardDeleteMessageYes" name="nCardDeleteMessageYes" class="card text-center">
              <h5 class="card-header">Eliminar categoría</h5>
              <div class="card-body">
                <h5 class="card-title" id="iCardDeleteMessageTitleMessage" name="nCardDeleteMessageTitleMessage"></h5>
                <p class="be-message" id="iCardDeleteMessageParagrahpMessage" name="nCardDeleteMessageParagrahpMessage"
                   class="card-text"><strong id="iCardDeleteMessageParagrahpStrongMessage"
                                             name="nCardDeleteMessageParagrahpStrongMessage"></strong></p>
                <input type="hidden" class="form-control" name="nInputDeleteCategoryId" id="iInputDeleteCategoryId">

                <div class="row justify-content-center">
                  <div class="col-4">
                    <button type="button" name="nButtonAcceptDeleteCategory" id="iButtonAcceptDeleteCategory"
                            class="btn btn-dark" style="display: none;" onclick="hiddeFormDeleteCategory()">Aceptar
                    </button>
                  </div>
                </div>

                <div class="row justify-content-center">
                  <div class="col-4">
                    <button type="submit" name="nButtonDeleteCategory" id="iButtonDeleteCategory" class="btn btn-dark"
                            style="display: none;">Eliminar
                    </button>
                  </div>
                  <div class="col-4">
                    <button type="button" name="nButtonCancelDeleteCategory" id="iButtonCancelDeleteCategory"
                            class="btn btn-dark" style="display: none;" onclick="hiddeFormDeleteCategory()">Cancelar
                    </button>
                  </div>
                </div>

              </div>
            </div>

          </form>

        </div>
      </div>
    </div>

    <!-- List of categories /-->
    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">

        <!-- Title and description /-->
        <h5 class="card-title">Lista de categorías</h5>
        <p class="card-text">Lista de categorías, selecciona una para editar o eliminar.</p>

        <hr>

        <!-- List of categories table /-->
        <div class="table-responsive">

          <table id="table" class="display " style="width:100%">

            <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Frases</th>
              <th class="text-center">Editar</th>
              <th class="text-center">Borrar</th>
            </tr>
            </thead>

            <tbody>
            <?php
              
              foreach ($categoriesList
                       
                       as $key => $value) {
                
                $categoryId = $value['befrases_cat_id'];
                $categoryName = $value['befrases_cat_name'];
                $categoryDescription = $value['befrases_cat_description'];
                $categoryTotalQuotes = countTotalRecordsCategory ($categoryId);
                ?>
                <tr>

                  <!-- # /-->
                  <td></td>

                  <!-- Name /-->
                  <td><?php echo $categoryName ?></td>

                  <!-- Description /-->
                  <td><?php echo $categoryDescription ?></td>

                  <!-- Quotes /-->
                  <td><?php echo $categoryTotalQuotes ?></td>

                  <!-- Edit button /-->
                  <td style="text-align:center">
                    <button class="btn btn-primary btn-sm"
                            id="iButtonEditCategoryRegister"
                            name="nButtonEditCategoryRegister"
                            onclick="showFormEditCategory('<?php echo $categoryId; ?>', '<?php echo $categoryName; ?>', '<?php echo $categoryDescription; ?>')">
                      Editar
                    </button>
                  </td>

                  <!-- Delete button /-->
                  <td style="text-align:center">
                    <button class="btn btn-danger btn-sm"
                            id="iButtonDeleteCategoryRegister"
                            name="nButtonDeleteCategoryRegister"
                            onclick="showFormDeleteCategory('<?php echo $categoryId; ?>', '<?php echo $categoryName; ?>', '<?php echo $categoryTotalQuotes; ?>')">
                      Eliminar
                    </button>
                  </td>

                </tr>
                <?php
              }
            ?>

            <tfoot>
            <th>#</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Frases</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Borrar</th>
            </tfoot>

          </table>

        </div>
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