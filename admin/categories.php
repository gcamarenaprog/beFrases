<?php
  /**
   * Add categories plugin option
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
  
  # Save new category record from add new category form
  if (isset($_POST['nButtonNewCategory'])) {
    $categoryName = $_POST['nInputCategoryName'];
    $categoryDescription = $_POST['nTextAreaCategoryDescription'];
    saveNewCategoryRecord ($categoryName, $categoryDescription);
  }
  
  # Delete category record from delete form
  if (isset($_POST['nButtonDeleteAccept'])) {
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
            En esta sección podrás añadir, editar o eliminar categorías. Para editar o eliminar selecciona una categoría
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
            <h6 class="card-title">Añadir categoría</h6>
            <p class="card-text">Escribe el nombre y la descripción de la nueva categoría.</p>

            <hr>

            <!-- Categoría /-->
            <div class="mb-3">
              <label for="iInputCategoryName" class="form-label">Nombre</label>
              <input class="form-control"
                     name="nInputCategoryName"
                     id="iInputCategoryName"
                     title="Nombre de la categoría."
                     placeholder="Nombre.."
                     required>
              <div id="iHelpCategoryName" class="form-text">Nombre de la categoría.</div>
            </div>

            <!-- Description /-->
            <div class="mb-3">
              <label for="iTextAreaCategoryDescription" class="form-label">Descripción</label>
              <textarea class="form-control"
                        name="nTextAreaCategoryDescription"
                        id="iTextAreaCategoryDescription"
                        placeholder="Escribe una descripción.."
                        rows="3"
                        title="Descripción de la categoría."
                        required
              ></textarea>
              <div id="iHelpCategoryDescription" class="form-text">La descripción de la categoría.</div>
            </div>

            <!-- Add button /-->
            <button class="btn btn-success btn-sm"
                    name="nButtonNewCategory"
                    id="iButtonNewCategory"
                    type="submit"
                    title="Clic para añadir."
            >Añadir
            </button>


          </form>

          <!-- Edit category form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormEditCategory" name="nFormEditCategory">

            <!-- Title and description /-->
            <h6 class="card-title">Editar categoría</h6>
            <p class="card-text">Modificar la categoría seleccionada.</p>

            <hr>

            <!-- Category Id /-->
            <input type="hidden"
                   class="form-control"
                   name="nInputEditCategoryId"
                   id="iInputEditCategoryId">

            <!-- Name /-->
            <div class="mb-3">
              <label for="iInputEditCategoryName" class="form-label">Nombre de la categoría</label>
              <input class="form-control"
                     name="nInputEditCategoryName"
                     id="iInputEditCategoryName"
                     required
                     title="Nombre de la categoría">
              <div id="iHelpCategoryName" class="form-text">Nombre de la categoría.</div>
            </div>

            <!-- Description /-->
            <div class="mb-3">
              <label for="iTextAreaEditCategoryDescription" class="form-label">Descripción</label>
              <textarea class="form-control"
                        name="nTextAreaEditCategoryDescription"
                        id="iTextAreaEditCategoryDescription"
                        placeholder="Descripción de la categoría"
                        required
                        title="Escribe una descripción."
                        rows="3"></textarea>
              <div id="iHelpCategoryDescription" class="form-text">Descripción de la categoría.
              </div>
            </div>

            <!-- Save edit /-->
            <button type="submit"
                    name="nButtonSaveEditCategory"
                    id="iButtonSaveEditCategory"
                    title="Clic para actualizar cambios."
                    class="btn btn-success btn-sm">Actualizar
            </button>

            <!-- Cancel edit /-->
            <button type="button"
                    name="nButtonCancelEditCategory"
                    id="iButtonCancelEditCategory"
                    title="Clic para cancelar."
                    class="btn btn-danger btn-sm"
                    onclick="hiddeFormEditCategory()">Cancelar
            </button>


          </form>

          <!-- Delete category form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormDeleteCategory" name="nFormDeleteCategory">

            <!-- Title and description /-->
            <h6 class="card-title">Eliminar categoría</h6>
            <p class="card-text">¿Desea eliminar la siguiente categoría?</p>

            <hr>

            <!-- Data to delete /-->
            <input type="hidden" class="form-control" name="nInputDeleteCategoryId" id="iInputDeleteCategoryId">

            <!-- Title /-->
            <p class="card-text" style="margin-bottom: 0px;">
              <b name="nTextDeleteCategoryTitleName"
                 id="iTextDeleteCategoryTitleName">Nombre</b
            </p>

            <!-- Title text /-->
            <p class="card-text"
               name="nTextDeleteCategoryName"
               id="iTextDeleteCategoryName">
            </p>

            <!-- Description title /-->
            <p class="card-text" style="margin-bottom: 0px;">
              <b name="nTextDeleteCategoryTitleDescription"
                 id="iTextDeleteCategoryTitleDescription">Descripción</b>
            </p>

            <!-- Description text /-->
            <p class="card-text"
               name="nTextDeleteCategoryDescription"
               id="iTextDeleteCategoryDescription">
            </p>

            <hr>

            <!-- Delete category /-->
            <button type="submit"
                    class="btn btn-success btn-sm"
                    name="nButtonDeleteAccept"
                    id="iButtonDeleteAccept"
                    title="Clic para eliminar.">Aceptar
            </button>

            <!-- Cancel delete /-->
            <button type="button"
                    class="btn btn-danger btn-sm"
                    name="nButtonDeleteCancel"
                    id="iButtonDeleteCancel"
                    title="Clic para cancelar."
                    onclick="hiddeFormDeleteCategory()">Cancelar
            </button>

          </form>

        </div>
      </div>
    </div>

    <!-- List of categories /-->
    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">

        <!-- Title and description /-->
        <h6 class="card-title">Lista de categorías</h6>
        <p class="card-text">Selecciona una para editar o eliminar.</p>

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
              foreach ($categoriesList as $key => $value) {
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
                            title="Clic para editar."
                            onclick="showFormEditCategory('<?php echo $categoryId; ?>', '<?php echo $categoryName; ?>', '<?php echo $categoryDescription; ?>')">
                      Editar
                    </button>
                  </td>

                  <!-- Delete button /-->
                  <td style="text-align:center">
                    <button class="btn btn-danger btn-sm"
                            id="iButtonDeleteCategoryRegister"
                            name="nButtonDeleteCategoryRegister"
                            title="Clic para eliminar."
                            onclick="showFormDeleteCategory('<?php echo $categoryId; ?>', '<?php echo $categoryName; ?>', '<?php echo $categoryDescription; ?>' , '<?php echo $categoryTotalQuotes; ?>')">
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
        "infoEmpty": "No hay registros disponibles.",
        "infoFiltered": "(filtrados del total de _MAX_ registros)",
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