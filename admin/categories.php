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
    insertCategoryRecord ($categoryName, $categoryDescription);
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

            <!-- Name of category /-->
            <div class="mb-3">
              <label for="iInputCategoryName" class="form-label">Name of category</label>
              <input class="form-control"
                     name="nInputCategoryName"
                     id="iInputCategoryName"
                     title="Name of category."
                     placeholder="Name of category"
                     required>
              <div id="iHelpCategoryName" class="form-text">Name of category.</div>
            </div>

            <!-- Description /-->
            <div class="mb-3">
              <label for="iTextAreaCategoryDescription" class="form-label">Description</label>
              <textarea class="form-control"
                        name="nTextAreaCategoryDescription"
                        id="iTextAreaCategoryDescription"
                        placeholder="Write a description.."
                        rows="3"
                        title="The description of the category."
                        required
              ></textarea>
              <div id="iHelpCategoryDescription" class="form-text">The description of the category..</div>
            </div>

            <!-- Add button /-->
            <button class="btn btn-success btn-sm"
                    name="nButtonNewCategory"
                    id="iButtonNewCategory"
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
                   name="nInputEditCategoryId"
                   id="iInputEditCategoryId">

            <!-- Name /-->
            <div class="mb-3">
              <label for="iInputEditCategoryName" class="form-label">Name of category</label>
              <input class="form-control"
                     name="nInputEditCategoryName"
                     id="iInputEditCategoryName"
                     required
                     title="Name of category">
              <div id="iHelpCategoryName" class="form-text">Name of category.</div>
            </div>

            <!-- Description /-->
            <div class="mb-3">
              <label for="iTextAreaEditCategoryDescription" class="form-label">Description</label>
              <textarea class="form-control"
                        name="nTextAreaEditCategoryDescription"
                        id="iTextAreaEditCategoryDescription"
                        placeholder="Description de la categoría"
                        required
                        title="Write a description."
                        rows="3"></textarea>
              <div id="iHelpCategoryDescription" class="form-text">Category description.
              </div>
            </div>

            <!-- Save edit /-->
            <button type="submit"
                    name="nButtonSaveEditCategory"
                    id="iButtonSaveEditCategory"
                    title="Click to update."
                    class="btn btn-success btn-sm">Update
            </button>

            <!-- Cancel edit /-->
            <button type="button"
                    name="nButtonCancelEditCategory"
                    id="iButtonCancelEditCategory"
                    title="Click to cancel."
                    class="btn btn-danger btn-sm"
                    onclick="hideFormEditCategory()">Cancel
            </button>


          </form>

          <!-- Delete category form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormDeleteCategory" name="nFormDeleteCategory">

            <!-- Title /-->
            <h6 class="card-title"
                id="iTitleCategoryDeleteQuestion"
                name="nTitleCategoryDeleteQuestion">Delete category
            </h6>

            <!-- Description /-->
            <div>
              <p class="card-text"
                 style="margin-top: 10px;"
                 id="iTextCategoryDeleteQuestion"
                 name="nTextCategoryDeleteQuestion">Do you want to delete the following category?
              </p>

            </div>

            <hr>

            <!-- Data to delete /-->
            <input type="hidden" class="form-control" name="nInputDeleteCategoryId" id="iInputDeleteCategoryId">

            <!-- Title /-->
            <p class="card-text" style="margin-bottom: 0px;">
              <b name="nTextDeleteCategoryTitleName"
                 id="iTextDeleteCategoryTitleName">Name of category</b
            </p>

            <!-- Title text /-->
            <p class="card-text"
               name="nTextDeleteCategoryName"
               id="iTextDeleteCategoryName">
            </p>

            <!-- Description title /-->
            <p class="card-text" style="margin-bottom: 0px;">
              <b name="nTextDeleteCategoryTitleDescription" id="iTextDeleteCategoryTitleDescription">Description</b>
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
                    name="nButtonDeleteAccept"
                    id="iButtonDeleteAccept"
                    title="Click to delete.">
              Delete
            </button>

            <!-- Cancel delete button /-->
            <button type="button"
                    class="btn btn-danger btn-sm"
                    name="nButtonDeleteCancel"
                    id="iButtonDeleteCancel"
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
        "lengthMenu": "Show _MENU_ entries per page",
        "emptyTable": "There are no records to show!",
        "zeroRecords": "There are no records to show!",
        "info": "Showing page _PAGE_ of _PAGES_",
        "infoEmpty": "No records available.",
        "infoFiltered": "(filtered from the total _MAX_ records)",
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

</script>