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
  if (isset($_POST['nButtonAcceptAdd'])) {
    $categoryName = $_POST['nInputCategoryAdd'];
    $categoryDescription = $_POST['nTextAreaDescriptionAdd'];
    insertCategoryRecord ($categoryName, $categoryDescription);
  }
  
  # Delete category record from delete form
  if (isset($_POST['nButtonAcceptDelete'])) {
    $categoryId = $_POST['nInputCategoryIdDelete'];
    deleteCategoryRecord ($categoryId);
  }
  
  # Update the changes from edit form
  if (isset($_POST['nButtonAcceptEdit'])) {
    $idCategory = $_POST['nInputCategoryIdEdit'];
    $nameCategory = $_POST['nInputCategoryEdit'];
    $descriptionCategory = $_POST['nTextAreaDescriptionEdit'];
    updateCategoryRecord ($idCategory, $nameCategory, $descriptionCategory);
  }
  
  # Gets list of all categories from database
  $categoriesListName = array();
  $categoriesList = getAllCategoriesList ();
  foreach ($categoriesList as $key => $value) {
    $categoriesListName[] = $value['befrases_cat_name'];
  }

?>

<div class="container" style="max-width: 100%">
  <div class="row g-2" style="margin-right: 10px;">

    <!-- Title and description /-->
    <div>
      <div class="card">
        <h5 class="card-header"><?php echo get_admin_page_title (); ?></h5>
        <div class="card-body">
          <p class="card-text">
            In this section you can add, edit or delete categories. To edit or delete, select a category
            from the list.
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
            <h6 class="card-title">Add category</h6>
            <p class="card-text">Enter the name and description of the new category.</p>

            <hr>

            <!-- Category /-->
            <div class="mb-3">
              <label for="iInputCategoryAdd" class="form-label">Name of category</label>
              <input class="form-control"
                     name="nInputCategoryAdd"
                     id="iInputCategoryAdd"
                     title="Name of category."
                     placeholder="Name of category"
                     required>
              <span id="iInputCategoryErrorAdd" name="nInputAuthorErrorAdd" class="form-text text-danger">The category's name is registered or empty!</span>
              <span id="iInputCategoryHelpAdd" class="form-text">Name of category (auto-complete)</span>
            </div>

            <!-- Description /-->
            <div class="mb-3">
              <label for="iTextAreaCategoryDescriptionAdd" class="form-label">Description</label>
              <textarea class="form-control"
                        name="nTextAreaDescriptionAdd"
                        id="iTextAreaDescriptionAdd"
                        placeholder="Write a description.."
                        rows="3"
                        title="The description of the category."
                        required
              ></textarea>
              <div id="nTextAreaDescriptionHelpAdd" class="form-text">The description of the category..</div>
            </div>

            <!-- Add button /-->
            <button class="btn btn-success btn-sm"
                    name="nButtonAcceptAdd"
                    id="iButtonAcceptAdd"
                    type="submit"
                    title="Click to add."
            >Add
            </button>


          </form>

          <!-- Edit category form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormEditCategory" name="nFormEditCategory">

            <!-- Title and description /-->
            <h6 class="card-title">Edit Category</h6>
            <p class="card-text">Modify the selected category.</p>

            <hr>

            <!-- Category Id /-->
            <input type="hidden"
                   class="form-control"
                   name="nInputCategoryIdEdit"
                   id="iInputCategoryIdEdit">

            <!-- Name /-->
            <div class="mb-3">
              <label for="iInputEditCategoryName" class="form-label">Name of category</label>
              <input class="form-control"
                     name="nInputCategoryEdit"
                     id="iInputCategoryEdit"
                     required
                     title="Name of category">
              <span id="iInputCategoryErrorEdit" name="nInputAuthorErrorEdit" class="form-text text-danger">This category name is registered or empty!</span>
              <span id="iInputCategoryHelpEdit" class="form-text">Name of category (auto-complete)</span>
            </div>

            <!-- Description /-->
            <div class="mb-3">
              <label for="iTextAreaEditCategoryDescription" class="form-label">Description</label>
              <textarea class="form-control"
                        name="nTextAreaDescriptionEdit"
                        id="iTextAreaDescriptionEdit"
                        placeholder="Description de la categoría"
                        required
                        title="Write a description."
                        rows="3"></textarea>
              <div id="nTextAreaDescriptionHelpEdit" class="form-text">Category description.
              </div>
            </div>

            <!-- Save edit /-->
            <button type="submit"
                    name="nButtonAcceptEdit"
                    id="iButtonAcceptEdit"
                    title="Click to accept to update."
                    class="btn btn-success btn-sm">Accept
            </button>

            <!-- Cancel edit /-->
            <button type="button"
                    name="nButtonAcceptCancel"
                    id="iButtonAcceptCancel"
                    title="Click to cancel."
                    class="btn btn-danger btn-sm"
                    onclick="hideFormEditCategory()">Cancel
            </button>


          </form>

          <!-- Delete category form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormDeleteCategory" name="nFormDeleteCategory">

            <!-- Title /-->
            <h6 class="card-title"
                id="iTitleQuestionDelete"
                name="nTitleQuestionDelete">Delete category
            </h6>

            <!-- Description /-->
            <div>
              <p class="card-text"
                 style="margin-top: 10px;"
                 id="iTextDescriptionDelete"
                 name="nTextDescriptionDelete">Do you want to delete the following category?
              </p>

            </div>

            <hr>

            <!-- Category Id /-->
            <input type="hidden"
                   class="form-control"
                   name="nInputCategoryIdDelete"
                   id="iInputCategoryIdDelete">

            <!-- Name of category /-->
            <p class="card-text" style="margin-bottom: 0px;">
              <b name="nTextTitleNameOfCategoryDelete"
                 id="iTextTitleNameOfCategoryDelete">Name of category</b
            </p>

            <!-- Category's name /-->
            <p class="card-text"
               name="nTextNameOfCategoryDelete"
               id="iTextNameOfCategoryDelete">
            </p>

            <!-- Description /-->
            <p class="card-text" style="margin-bottom: 0px;">
              <b name="nTextDescriptionOfCategoryDelete"
                 id="iTextDescriptionOfCategoryDelete">Description</b>
            </p>

            <!-- Description text /-->
            <p class="card-text"
               name="nTextDeleteCategoryDescription"
               id="iTextDeleteCategoryDescription">
            </p>

            <hr>

            <!-- Delete category button /-->
            <button type="submit"
                    class="btn btn-success btn-sm "
                    name="nButtonAcceptDelete"
                    id="iButtonAcceptDelete"
                    title="Click to accept to delete.">
              Accept
            </button>

            <!-- Cancel delete button /-->
            <button type="button"
                    class="btn btn-danger btn-sm"
                    name="nButtonCancelDelete"
                    id="iButtonCancelDelete"
                    title="Click to cancel."
                    onclick="hideFormDeleteCategory()">
              Cancel
            </button>

          </form>

        </div>
      </div>
    </div>

    <!-- List of categories /-->
    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">

        <!-- Title and description /-->
        <h6 class="card-title">List of categories</h6>

        <p class="card-text">Select one to edit or delete.</p>

        <hr>

        <!-- List of categories table /-->
        <div class="table-responsive">

          <table id="table" class="display " style="width:100%">

            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Description</th>
              <th>Quotes</th>
              <th class="text-center">Edit</th>
              <th class="text-center">Delete</th>
            </tr>
            </thead>

            <tbody>
            <?php
              foreach ($categoriesList as $key => $value) {
                $categoryId = $value['befrases_cat_id'];
                $categoryName = $value['befrases_cat_name'];
                $categoryDescription = $value['befrases_cat_description'];
                $categoryTotalQuotes = countTotalRecordsCategory ($categoryId);
                
                if ($categoryName != 'All categories'): ?>
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
                              id="iButtonEditCategoryListOfCategories"
                              name="nButtonEditCategoryListOfCategories"
                              title="Click to edit."
                              onclick="showFormEditCategory('<?php echo $categoryId; ?>', '<?php echo $categoryName; ?>', '<?php echo $categoryDescription; ?>')">
                        Edit
                      </button>
                    </td>

                    <!-- Delete button /-->
                    <td style="text-align:center">
                      <button class="btn btn-danger btn-sm"
                              id="iButtonDeleteCategoryListOfCategories"
                              name="nButtonDeleteCategoryListOfCategories"
                              title="Click to delete."
                              onclick="showFormDeleteCategory('<?php echo $categoryId; ?>', '<?php echo $categoryName; ?>', '<?php echo $categoryDescription; ?>' , '<?php echo $categoryTotalQuotes; ?>')">
                        Delete
                      </button>
                    </td>

                  </tr>
                
                
                <?php
                endif;
              }
            ?>

            <tfoot>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Quotes</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
            </tfoot>

          </table>

        </div>
      </div>
    </div>

  </div>
</div>

<script>
  var iInputCurrentCategoryEdit = '';
  
  $(document).ready(function () {

    $('#iInputCategoryErrorAdd').hide();
    $('#iInputCategoryErrorEdit').hide();
    $('#iButtonAcceptAdd').attr('disabled', 'disabled');
    
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
        "lengthMenu": "Show _MENU_ entries per page",
        "emptyTable": "There are no records to show!",
        "zeroRecords": "There are no records to show!",
        "info": "Showing page _PAGE_ of _PAGES_",
        "infoEmpty": "No records available.",
        "infoFiltered": "(filtered from the total _MAX_ categories)",
        "emptyTable": "No data available in table",
        "info": "Showing _START_ to _END_ of _TOTAL_ categories",
        "infoEmpty": "Showing 0 to 0 of 0 categories",
        "search": "Search:",
        "paginate": {
          first: "First",
          previous: "Previous",
          next: "Next",
          last: "Last"
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

  $(function () {
    let data = <?php echo json_encode ($categoriesListName) ?>;
    $("#iInputCategoryAdd").autocomplete({
      source: data,
      minLength: 1
    });
  });

  $(function () {
    let data = <?php echo json_encode ($categoriesListName) ?>;
    $("#iInputCategoryEdit").autocomplete({
      source: data,
      minLength: 1
    });
  });

  $(document).ready(function () {
    $('#iInputCategoryAdd').on("keyup change focus blur click", function (e) {

      let iInputCategory = $('#iInputCategoryAdd').val();
      let data = <?php echo json_encode ($categoriesListName) ?>;

      if (data.includes(iInputCategory) || iInputCategory == null || iInputCategory == '') {
        $('#iButtonAcceptAdd').attr('disabled', 'disabled');
        $('#iInputCategoryErrorAdd').show();
        $('#iInputCategoryHelpAdd').hide();
      } else {
        $('#iButtonAcceptAdd').removeAttr('disabled');
        $('#iInputCategoryErrorAdd').hide();
        $('#iInputCategoryHelpAdd').show();
      }

    });
  });

  $(document).ready(function () {
    $('#iInputCategoryEdit').on("keyup change focus blur click", function (e) {
      let iInputCategory = $('#iInputCategoryEdit').val();
      let data = <?php echo json_encode ($categoriesListName) ?>;
      let index = data.indexOf(iInputCurrentCategoryEdit);
      data.splice(index, 1);
      if (data.includes(iInputCategory) || iInputCategory == null || iInputCategory == '') {
        $('#iButtonAcceptEdit').attr('disabled', 'disabled');
        $('#iInputCategoryErrorEdit').show();
        $('#iInputCategoryHelpEdit').hide();
      } else {
        $('#iButtonAcceptEdit').removeAttr('disabled');
        $('#iInputCategoryErrorEdit').hide();
        $('#iInputCategoryHelpEdit').show();
      }
    });
  });

</script>