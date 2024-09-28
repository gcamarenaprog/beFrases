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
            An easy and simple to use plugin that will allow you to manage a collection of famous quotes with their
            respective authors, as well as categorize them and display them randomly in a widget.
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
            <h6 class="card-title">Add quote</h6>
            <p class="card-text">Write the author, quote and category of the quote.</p>

            <hr>

            <!-- Author /-->
            <div class="mb-3">
              <label for="iSelectAuthor" class="form-label">Author</label>
              <select class="form-select"
                      id="iSelectAuthor"
                      name="nSelectAuthor"
                      title="Choose an author."
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
              <div id="iHelpCategory" class="form-text">Name of the author.</div>
            </div>

            <!-- Quote /-->
            <div class="mb-3">
              <label for="iTextAreaQuote" class="form-label">Quote</label>
              <textarea class="form-control"
                        name="nTextAreaQuote"
                        id="iTextAreaQuote"
                        placeholder="Write a quote.."
                        rows="4"
                        title="Write the sentence without quotation marks at the beginning and end."
                        required></textarea>
              <div id="iHelpQuoteDescription" class="form-text">Write the quote without quotation marks at the beginning
                and end.
              </div>
            </div>

            <!-- Category /-->
            <div class="mb-3">
              <label for="iSelectCategory" class="form-label">Category</label>
              <select class="form-select"
                      id="iSelectCategory"
                      name="nSelectCategory"
                      title="Choose a category."
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
              <div id="iHelpCategory" class="form-text">Category name.</div>
            </div>

            <!-- Add button /-->
            <button id="iButtonNewQuote"
                    name="nButtonNewQuote"
                    type="submit"
                    title="Click to add category."
                    class="btn btn-success btn-sm">
              Add
            </button>

          </form>

          <!-- Edit quote form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormEditQuote" name="nFormEditQuote">

            <!-- Title and description /-->
            <h6 class="card-title">Edit quote</h6>
            <p class="card-text">Modify the selected quote.</p>

            <hr>

            <!-- Quote Id /-->
            <input type="hidden"
                   class="form-control"
                   name="nInputEditQuoteId"
                   id="iInputEditQuoteId">

            <!-- Author /-->
            <div class="mb-3">
              <label for="iSelectEditAuthor" class="form-label">Author</label>
              <select class="form-select"
                      id="iSelectEditAuthor"
                      title="Choose an author."
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
              <div id="iHelpEditAuthor" class="form-text">Author's name.</div>
            </div>

            <!-- Quote /-->
            <div class="mb-3">
              <label for="iTextAreaEditQuoteText" class="form-label">Quote</label>
              <textarea class="form-control"
                        name="nTextAreaEditQuoteText"
                        id="iTextAreaEditQuoteText"
                        required
                        title="Write the sentence without quotation marks at the beginning and end."
                        rows="4"></textarea>
              <div id="iHelpQuoteDescription" class="form-text">Write the sentence without quotation marks at the
                beginning and end.
              </div>
            </div>

            <!-- Category /-->
            <div class="mb-3">
              <label for="iSelectEditCategory" class="form-label">Category</label>
              <select class="form-select"
                      aria-label="Default select example"
                      id="iSelectEditCategory"
                      name="nSelectEditCategory"
                      title="Choose a category."
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
              <div id="iHelpEditCategory" class="form-text">Choose a category.</div>
            </div>

            <!-- Save edit /-->
            <button type="submit"
                    name="nButtonSaveEditQuote"
                    id="iButtonSaveEditQuote"
                    title="Click to update changes."
                    class="btn btn-success btn-sm">
              Update
            </button>

            <!-- Cancel edit /-->
            <button type="button"
                    name="nButtonCancelEditQuote"
                    id="iButtonCancelEditQuote"
                    class="btn btn-danger btn-sm"
                    title="Click to cancel."
                    onclick="hiddeFormEditQuote()">
              Cancel
            </button>

          </form>

          <!-- Delete quote form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormDeleteQuote" name="nFormDeleteQuote">

            <!-- Title and description /-->
            <h6 class="card-title">Delete quote</h6>
            <p class="card-text">Do you want to delete the following record?</p>

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
                    title="Click to delete the quote."
                    class="btn btn-success btn-sm">
              Delete
            </button>

            <!-- Cancel delete /-->
            <button type="button"
                    name="nButtonCancelDeleteQuote"
                    id="iButtonCancelDeleteQuote"
                    class="btn btn-danger btn-sm"
                    title="Click to cancel."
                    onclick="hiddeFormDeleteQuote()">
              Cancel
            </button>

          </form>

        </div>
      </div>
    </div>

    <!-- List of quotes /-->
    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">

        <!-- Title and description /-->
        <h6 class="card-title">List of quotes</h6>
        <p class="card-text">List of quotes, select one to edit or delete.</p>

        <hr>

        <!-- List of quotes table /-->
        <table id="table" class="display " style="width:100%">

          <thead>
          <tr>
            <th>#</th>
            <th>Author</th>
            <th>Quote</th>
            <th>Category</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
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
                      title="Click to edit."
                      onclick="showFormEditQuote('<?php echo $quoteId; ?>', '<?php echo $quoteAuthorId; ?>', '<?php echo $quoteText; ?>', '<?php echo $quoteCategoryId; ?>')">
                    Edit
                  </button>
                </td>

                <!-- Delete button /-->
                <td style="text-align:center">
                  <button
                      class="btn btn-danger btn-sm"
                      id="iButtonDeleteQuoteRegister"
                      name="nButtonDeleteQuoteRegister"
                      title="Click to delete."
                      onclick="showFormDeleteQuote('<?php echo $quoteId; ?>', '<?php echo $quoteAuthor; ?>', '<?php echo $quoteText; ?>')">
                    Delete
                  </button>
                </td>

              </tr>
              <?php
            }
          ?>

          <tfoot>
          <th>#</th>
          <th>Author</th>
          <th>Quote</th>
          <th>Category</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
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