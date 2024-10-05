<?php
  /**
   * Add authors plugin option
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
  
  # Save new author record from add new author form
  if (isset($_POST['nButtonNewAuthor'])) {
    $authorName = $_POST['nInputAuthorName'];
    insertAuthorRecord ($authorName);
  }
  
  # Delete author record from delete form
  if (isset($_POST['nButtonDeleteAccept'])) {
    $authorId = $_POST['nInputDeleteAuthorId'];
    deleteAuthorRecord ($authorId);
  }
  
  # Update the changes from edit form
  if (isset($_POST['nButtonSaveEditAuthor'])) {
    $idAuthor = $_POST['nInputEditAuthorId'];
    $nameAuthor = $_POST['nInputEditAuthorName'];
    updateAuthorRecord ($idAuthor, $nameAuthor);
  }
  
  # Gets list of all authors from database
  $authorsList = getAllAuthorsList ();

?>

<div class="container" style="max-width: 100%">
  <div class="row g-2" style="margin-right: 10px;">

    <!-- Title and description /-->
    <div>
      <div class="card">
        <h5 class="card-header"><?php echo get_admin_page_title (); ?></h5>
        <div class="card-body">
          <p class="card-text">
            In this section you can add, edit or delete authors. To edit or delete, select an author from the list.
          </p>
        </div>
      </div>
    </div>

    <!-- Add, edit and delete content /-->
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">
        <div class="card-body">

          <!-- Add author form /-->
          <form method="post" class="mb-3" style="display: block;" id="iFormAddAuthor" name="nFormAddAuthor">

            <!-- Title and description /-->
            <h6 class="card-title">Add author</h6>
            <p class="card-text">Write the name and description of the new author.</p>

            <hr>

            <!-- Categoría /-->
            <div class="mb-3">
              <label for="iInputAuthorName" class="form-label">Name of author</label>
              <input class="form-control"
                     name="nInputAuthorName"
                     id="iInputAuthorName"
                     title="Name of author."
                     placeholder="Name"
                     required>
              <div id="iHelpAuthorName" class="form-text">Name of author.</div>
            </div>

            <!-- Add button /-->
            <button class="btn btn-success btn-sm"
                    name="nButtonNewAuthor"
                    id="iButtonNewAuthor"
                    type="submit"
                    title="Click to add."
            >Add
            </button>

          </form>

          <!-- Edit author form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormEditAuthor" name="nFormEditAuthor">

            <!-- Title and description /-->
            <h6 class="card-title">Edit author</h6>
            <p class="card-text">Modify the selected author.</p>

            <hr>

            <!-- Author Id /-->
            <input type="hidden"
                   class="form-control"
                   name="nInputEditAuthorId"
                   id="iInputEditAuthorId">

            <!-- Name /-->
            <div class="mb-3">
              <label for="iInputEditAuthorName" class="form-label">Name of author</label>
              <input class="form-control"
                     name="nInputEditAuthorName"
                     id="iInputEditAuthorName"
                     required
                     title="Name of author">
              <div id="iHelpAuthorName" class="form-text">Name of author.</div>
            </div>

            <!-- Save edit /-->
            <button type="submit"
                    name="nButtonSaveEditAuthor"
                    id="iButtonSaveEditAuthor"
                    title="Click to update changes."
                    class="btn btn-success btn-sm">Update
            </button>

            <!-- Cancel edit /-->
            <button type="button"
                    name="nButtonCancelEditAuthor"
                    id="iButtonCancelEditAuthor"
                    title="Click to cancel."
                    class="btn btn-danger btn-sm"
                    onclick="hideFormEditAuthor()">Cancel
            </button>


          </form>

          <!-- Delete author form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormDeleteAuthor" name="nFormDeleteAuthor">

            <!-- Title /-->
            <h6 class="card-title"
                id="iTitleAuthorDeleteQuestion"
                name="nTitleAuthorDeleteQuestion">Delete author
            </h6>

            <!-- Description /-->
            <div>
              <p class="card-text"
                 style="margin-top: 10px;"
                 id="iTextAuthorDeleteQuestion"
                 name="nTextAuthorDeleteQuestion">Do you want to delete the following author?
              </p>

            </div>

            <hr>

            <!-- Data to delete /-->
            <input type="hidden" class="form-control" name="nInputDeleteAuthorId" id="iInputDeleteAuthorId">

            <!-- Title /-->
            <p class="card-text" style="margin-bottom: 0px;">
              <b name="nTextDeleteAuthorTitleName"
                 id="iTextDeleteAuthorTitleName">Name of author</b
            </p>

            <!-- Title text /-->
            <p class="card-text"
               name="nTextDeleteAuthorName"
               id="iTextDeleteAuthorName">
            </p>

            <hr>

            <!-- Delete category button /-->
            <button type="submit"
                    class="btn btn-success btn-sm "
                    name="nButtonDeleteAccept"
                    id="iButtonDeleteAccept"
                    title="Click to delete.">Delete
            </button>

            <!-- Cancel delete button /-->
            <button type="button"
                    class="btn btn-danger btn-sm"
                    name="nButtonDeleteCancel"
                    id="iButtonDeleteCancel"
                    title="Click to cancel."
                    title="Click to cancel."
                    onclick="hideFormDeleteAuthor()">Cancel
            </button>

          </form>

        </div>
      </div>
    </div>

    <!-- List of authors /-->
    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">

        <!-- Title and description /-->
        <h6 class="card-title">List of authors</h6>
        <p class="card-text">Select one to edit or delete.</p>

        <hr>

        <!-- List of authors table /-->
        <div class="table-responsive">

          <table id="table" class="display " style="width:100%">

            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Quotes</th>
              <th class="text-center">Edit</th>
              <th class="text-center">Delete</th>
            </tr>
            </thead>

            <tbody>
            <?php
              foreach ($authorsList as $key => $value) {
                $authorId = $value['befrases_aut_id'];
                $authorName = $value['befrases_aut_name'];
                $authorTotalQuotes = countTotalRecordsAuthor ($authorId);
                ?>
                <tr>

                  <!-- # /-->
                  <td></td>

                  <!-- Name /-->
                  <td><?php echo $authorName ?></td>

                  <!-- Quotes /-->
                  <td><?php echo $authorTotalQuotes ?></td>

                  <!-- Edit button /-->
                  <td style="text-align:center">
                    <button class="btn btn-primary btn-sm"
                            id="iButtonEditListOfAuthors"
                            name="nButtonEditListOfAuthors"
                            title="Click to edit."
                            onclick="showFormEditAuthor('<?php echo $authorId; ?>', '<?php echo $authorName; ?>')">
                      Edit
                    </button>
                  </td>

                  <!-- Delete button /-->
                  <td style="text-align:center">
                    <button class="btn btn-danger btn-sm"
                            id="iButtonDeleteListOfAuthors"
                            name="nButtonDeleteListOfAuthors"
                            title="Click to delete."
                            onclick="showFormDeleteAuthor('<?php echo $authorId; ?>', '<?php echo $authorName; ?>', '<?php echo $authorTotalQuotes; ?>')">
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
        "targets": [0, 3, 4]
      }],
      "order": [[1, "asc"]],
      "language": {
        "lengthMenu": "Show _MENU_ entries per page",
        "emptyTable": "There are no records to show!",
        "zeroRecords": "There are no records to show!",
        "info": "Showing page _PAGE_ of _PAGES_",
        "infoEmpty": "No records available.",
        "infoFiltered": "(filtered from the total _MAX_ authors)",
        "emptyTable":     "No data available in table",
        "info":           "Showing _START_ to _END_ of _TOTAL_ authors",
        "infoEmpty":      "Showing 0 to 0 of 0 authors",
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