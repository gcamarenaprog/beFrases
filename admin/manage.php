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
  if (isset($_POST['nButtonAcceptAdd'])) {
    $authorIdValue = '';
    $authorExtra = '';
    $authorName = $_POST['nInputAuthorAdd'];
    $authorExtra = $_POST['nInputAuthorExtraAdd'];
    $authorIdObtained = getAuthorIdWithName ($authorName);
    
    if (empty($authorIdObtained)) {
    } else {
      foreach ($authorIdObtained as $key => $value) {
        $authorIdValue = $value['befrases_aut_id'];
      }
      $authorId = intval ($authorIdValue);
      $textQuote = $_POST['nTextAreaQuoteAdd'];
      $checkTextQuote = substr ($textQuote, -1);
      if ($checkTextQuote != '.') {
        $textQuote = $textQuote . '.';
      }
      $categoryIdQuote = $_POST['nSelectCategoryAdd'];
      insertQuoteRecord ($authorId, $textQuote, $categoryIdQuote, $authorExtra);
    }
  }
  
  # Update the changes from edit form
  if (isset($_POST['nButtonAcceptEdit'])) {
    $authorIdValue = '';
    $authorExtra = '';
    $authorName = $_POST['nInputAuthorEdit'];
    $authorExtra = $_POST['nInputAuthorExtraEdit'];
    $authorIdObtained = getAuthorIdWithName ($authorName);
    
    if (empty($authorIdObtained)) {
    } else {
      foreach ($authorIdObtained as $key => $value) {
        $authorIdValue = $value['befrases_aut_id'];
      }
      $authorId = intval ($authorIdValue);
      $idQuote = $_POST['nInputQuoteIdEdit'];
      $textQuote = $_POST['nTextAreaQuoteEdit'];
      $checkTextQuote = substr ($textQuote, -1);
      if ($checkTextQuote != '.') {
        $textQuote = $textQuote . '.';
      }
      $categoryIdQuote = $_POST['nSelectCategoryEdit'];
      updateQuoteRecord ($idQuote, $authorId, $authorExtra, $textQuote, $categoryIdQuote);
    }
  }
  
  # Delete record from delete form
  if (isset($_POST['nButtonAcceptDelete'])) {
    $idQuote = $_POST['nInputQuoteIdDelete'];
    deleteQuoteRecord ($idQuote);
  }
  
  # Get all quotes
  $listQuotes = getAllDataQuotes ();
  
  # Get all categories
  $namesCategories = getAllDataCategories ();
  
  # Get all authors
  $namesAuthors = getAllDataAuthors ();
  
  # Get all categories
  $namesCategoriesList = getAllDataCategories ();
  $totalNamesCategoriesList = count ($namesCategoriesList);
  
  # Get total authors
  $totalNamesAuthorsList = count ($namesAuthors);
  
  # Get all authors from list phrases no repeat
  $authorsList = array();
  $authorsList = getAllAuthorsList ();
  foreach ($authorsList as $key => $value) {
    $authorsList[] = $value['befrases_aut_name'];
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

          <!-- Add quote form /-->
          <form method="post" class="mb-3" style="display: block;" id="iFormAddQuote" name="nFormAddQuote">

            <!-- Title /-->
            <h6 class="card-title">Add quote</h6>

            <!-- If exist a category and an author then /-->
            <?php if ($totalNamesAuthorsList != 0 && $totalNamesCategoriesList != 0) : ?>

              <!-- Description /-->
              <p class="card-text">Write the author, quote and category of the quote.</p>

              <hr>

              <!-- Author /-->
              <div class="mb-3">
                <label for="iInputAuthorAdd" class="form-label">Author</label>
                <input class="form-control"
                       name="nInputAuthorAdd"
                       id="iInputAuthorAdd"
                       placeholder="Author"
                       title="Write the first three letters of the author."
                       required>
                <span id="iInputAuthorErrorAdd" name="nInputAuthorErrorAdd" class="form-text text-danger">This author name not registered or empty!</span>
                <span id="iInputAuthorHelpAdd" class="form-text">Name of author (auto-complete)</span>
              </div>

              <!-- Author's extra information /-->
              <div class="mb-3">
                <label for="iInputAuthorExtraAdd" class="form-label">Author's extra information</label>
                <input class="form-control"
                       name="nInputAuthorExtraAdd"
                       id="iInputAuthorExtraAdd"
                       placeholder="Author's extra information"
                       title="Author's extra information appears after the author's name (optional).">
                <span id="iInputAuthorExtraHelpAdd" class="form-text">Author's extra information (optional)</span>
              </div>

              <!-- Quote /-->
              <div class="mb-3">
                <label for="iTextAreaQuoteAdd" class="form-label">Quote</label>
                <textarea class="form-control"
                          name="nTextAreaQuoteAdd"
                          id="iTextAreaQuoteAdd"
                          placeholder="Write a quote.."
                          rows="4"
                          title="Write the sentence without quotation marks at the beginning and end."
                          required></textarea>
                <span id="iTextAreaQuoteErrorAdd" name="nTextAreaQuoteErrorAdd" class="form-text text-danger">There must be a maximum of 1000 characters or not be empty.</span>
                <span id="iTextAreaQuoteHelpAdd" class="form-text">Write the sentence without quotation marks at the
                  beginning and end.</span>
              </div>

              <!-- Category /-->
              <div class="mb-3">
                <label for="iSelectCategoryAdd" class="form-label">Category</label>
                <select class="form-select"
                        id="iSelectCategoryAdd"
                        name="nSelectCategoryAdd"
                        title="Choose a category."
                        required
                >
                  <?php
                    
                    foreach ($namesCategoriesList as $key => $value) {
                      if ($value['befrases_cat_id'] != 1) {
                        $quoteCategoryId = $value['befrases_cat_id'];
                        $quoteCategoryName = $value['befrases_cat_name'];
                        echo '<option value="' . $quoteCategoryId . '">' . $quoteCategoryName . '</option>';
                      }
                    }
                  ?>
                </select>
                <div id="iSelectCategoryHelpAdd" class="form-text">Category name.</div>
              </div>

              <!-- Add button /-->
              <button id="iButtonAcceptAdd"
                      name="nButtonAcceptAdd"
                      type="submit"
                      title="Click to accept for to add new quote."
                      disabled
                      class="btn btn-success btn-sm">
                Accept
              </button>
            
            <?php else: ?>

              <!-- Error /-->
              <p class="card-text text-danger">A category and a registered author must exist in order to add a
                phrase.</p>
            
            <?php endif; ?>
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
                   name="nInputQuoteIdEdit"
                   id="iInputQuoteIdEdit">

            <!-- Author /-->
            <div class="mb-3">
              <label for="iInputAuthorEdit" class="form-label">Author</label>
              <input class="form-control"
                     name="nInputAuthorEdit"
                     id="iInputAuthorEdit"
                     placeholder="Author.."
                     title="Write the first three letters of the author."
                     required>
              <span id="iInputAuthorErrorEdit" name="nInputAuthorErrorEdit" class="form-text text-danger">This author name not registered or empty!</span>
              <span id="iInputAuthorHelpEdit" class="form-text">Name of author (auto-complete)</span>
            </div>

            <!-- Author's extra information /-->
            <div class="mb-3">
              <label for="iInputAuthorExtraEdit" class="form-label">Author's extra information</label>
              <input class="form-control"
                     name="nInputAuthorExtraEdit"
                     id="iInputAuthorExtraEdit"
                     placeholder="Author's extra information"
                     title="Author's extra information appears after the author's name (optional).">
              <span id="iInputAuthorExtraHelpEdit" class="form-text">Author's extra information (optional)</span>
            </div>

            <!-- Quote /-->
            <div class="mb-3">
              <label for="iTextAreaQuoteEdit" class="form-label">Quote</label>
              <textarea class="form-control"
                        name="nTextAreaQuoteEdit"
                        id="iTextAreaQuoteEdit"
                        required
                        title="Write the sentence without quotation marks at the beginning and end."
                        rows="4"></textarea>
              <span id="iTextAreaQuoteErrorEdit" name="nInputAuthorErrorEdit" class="form-text text-danger">There must be a maximum of 1000 characters or not be empty.</span>
              <span id="iTextAreaQuoteHelpEdit" class="form-text">Write the sentence without quotation marks at the
                  beginning and end.</span>
            </div>

            <!-- Category /-->
            <div class="mb-3">
              <label for="iSelectCategoryEdit" class="form-label">Category</label>
              <select class="form-select"
                      aria-label="Default select example"
                      id="iSelectCategoryEdit"
                      name="nSelectCategoryEdit"
                      title="Choose a category."
              >
                <?php
                  foreach ($namesCategories as $key => $value) {
                    if ($value['befrases_cat_id'] != 1) {
                      $quoteCategoryId = $value['befrases_cat_id'];
                      $quoteCategoryName = $value['befrases_cat_name'];
                      echo '<option value="' . $quoteCategoryId . '">' . $quoteCategoryName . '</option>';
                    }
                  }
                ?>
              </select>
              <div id="iSelectCategoryHelpEdit" class="form-text">Choose a category.</div>
            </div>


            <!-- Save edit /-->
            <button type="submit"
                    name="nButtonAcceptEdit"
                    id="iButtonAcceptEdit"
                    title="Click accept to update changes."
                    class="btn btn-success btn-sm">
              Accept
            </button>

            <!-- Cancel edit /-->
            <button type="button"
                    name="nButtonCancelEdit"
                    id="nButtonCancelEdit"
                    class="btn btn-danger btn-sm"
                    title="Click to cancel."
                    onclick="hideFormEditQuote()">
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
              <p class="card-text" id="iTextQuoteDelete" name="nTextQuoteDelete"></p>

              <!-- Quote author /-->
              <p class="card-text" id="iTextAuthorDelete" name="nTextAuthorDelete"></p>

            </div>

            <hr>

            <!-- Quote Id /-->
            <input type="hidden"
                   class="form-control"
                   name="nInputQuoteIdDelete"
                   id="iInputQuoteIdDelete">

            <!-- Delete quote /-->
            <button type="submit"
                    name="nButtonAcceptDelete"
                    id="iButtonAcceptDelete"
                    title="Click to accept to delete the quote."
                    class="btn btn-success btn-sm">
              Accept
            </button>

            <!-- Cancel delete /-->
            <button type="button"
                    name="nButtonCancelDelete"
                    id="iButtonCancelDelete"
                    class="btn btn-danger btn-sm"
                    title="Click to cancel."
                    onclick="hideFormDeleteQuote()">
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
        <h6 class="card-title">List of quotes</h6>
        <p class="card-text">List of quotes, select one to edit or delete.</p>

        <hr>

        <!-- List of quotes table /-->
        <table id="table" class="display " style="width:100%">

          <thead>
          <tr>
            <th>#</th>
            <th>Author</th>
            <th>Author' extra information</th>
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
              $authorId = $value['befrases_author'];
              $authorExtra = $value['befrases_author_extra'];
              $quote = $value['befrases_quote'];
              $categoryId = $value['befrases_category'];
              $quoteCategory = '';
              $quoteAuthor = '';
              
              if ($authorExtra == '') {
                $authorExtra = 'No data';
              }
              
              $nameOfCategory = getCategoryNameAndIdWithCategoryId ($categoryId);
              foreach ($nameOfCategory as $key => $value) {
                $quoteCategory = $value['befrases_cat_name'];
              }
              
              $nameOfAuthor = getAuthorNameWithAuthorId ($authorId);
              foreach ($nameOfAuthor as $key => $value) {
                $quoteAuthor = $value['befrases_aut_name'];
              }
              ?>

              <tr>
                <!-- # /-->
                <td></td>

                <!-- Author /-->
                <td><?php echo $quoteAuthor; ?></td>

                <!-- Author's extra information /-->
                <td><?php echo $authorExtra; ?></td>

                <!-- Quote /-->
                <td>"<?php echo $quote; ?>"</td>

                <!-- Category /-->
                <td><?php echo $quoteCategory; ?></td>

                <!-- Edit button /-->
                <td style="text-align:center">
                  <button
                      class="btn btn-primary btn-sm"
                      id="iButtonEditQuoteRegister"
                      name="nButtonEditQuoteRegister"
                      title="Click to edit."
                      onclick='showFormEditQuote("<?php echo $quoteAuthor; ?>", "<?php echo $authorExtra; ?>", "<?php echo $quoteId; ?>", "<?php echo $authorId; ?>", "<?php echo $quote; ?>", "<?php echo $categoryId; ?>")'>
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
                      onclick='showFormDeleteQuote("<?php echo $quoteId; ?>", "<?php echo $quoteAuthor; ?>", "<?php echo $quote; ?>")'>
                    Delete
                  </button>
                </td>

              </tr>
              <?php
            }
          ?>

          </tbody>

          <tfoot>
          <th>#</th>
          <th>Author</th>
          <th>Author' extra information</th>
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

    $('#iInputAuthorErrorAdd').hide();
    $('#iTextAreaQuoteErrorAdd').hide();
    
    $('#iInputAuthorErrorEdit').hide();
    $('#iTextAreaQuoteErrorEdit').hide();


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
        "infoFiltered": "(filtered from the total _MAX_ quotes)",
        "emptyTable": "No data available in table",
        "info": "Showing _START_ to _END_ of _TOTAL_ quotes",
        "infoEmpty": "Showing 0 to 0 of 0 quotes",
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
    var data = <?php echo json_encode ($authorsList) ?>;
    $("#iInputAuthorAdd").autocomplete({
      source: data,
      minLength: 3
    });
  });

  $(function () {
    var data = <?php echo json_encode ($authorsList) ?>;
    $("#iInputAuthorEdit").autocomplete({
      source: data,
      minLength: 3
    });
  });

  $(document).ready(function () {
    $('#iInputAuthorAdd, #iTextAreaQuoteAdd').on("keyup change focus blur click", function (e) {

      let iInputAuthor = $('#iInputAuthorAdd').val();
      let iInputAuthorTrim = iInputAuthor.trim();
      let iTextAreaQuoteAdd = $('#iTextAreaQuoteAdd').val();
      let iTextAreaQuoteAddLength = iTextAreaQuoteAdd.length;
      let data = <?php echo json_encode ($authorsList) ?>;

      if ((!data.includes(iInputAuthorTrim)) || iInputAuthor == null || iInputAuthor == '') {
        $('#iButtonAcceptAdd').attr('disabled', 'disabled');
        $('#iInputAuthorErrorAdd').show();
        $('#iInputAuthorHelpAdd').hide();

      } else {
        $('#iButtonAcceptAdd').removeAttr('disabled');
        $('#iInputAuthorErrorAdd').hide();
        $('#iInputAuthorHelpAdd').show();
      }

      if (iTextAreaQuoteAdd == null || iTextAreaQuoteAdd == '' || iTextAreaQuoteAddLength > 1000) {
        $('#iButtonAcceptAdd').attr('disabled', 'disabled');

        $('#iTextAreaQuoteErrorAdd').show();
        $('#iTextAreaQuoteHelpAdd').hide();

      } else {
        $('#iButtonAcceptAdd').removeAttr('disabled');
        $('#iTextAreaQuoteErrorAdd').hide();
        $('#iTextAreaQuoteHelpAdd').show();
      }

    });
  });

  $(document).ready(function () {
    $('#iInputAuthorEdit, #iTextAreaQuoteEdit').on("keyup change focus blur click", function (e) {

      let iInputAuthor = $('#iInputAuthorEdit').val();
      let iInputAuthorTrim = iInputAuthor.trim();
      let iTextAreaQuoteEdit = $('#iTextAreaQuoteEdit').val();
      let iTextAreaQuoteEditLength = iTextAreaQuoteEdit.length;
      let data = <?php echo json_encode ($authorsList) ?>;

      if ((!data.includes(iInputAuthorTrim)) || iInputAuthor == null || iInputAuthor == '' || iTextAreaQuoteEdit == null || iTextAreaQuoteEdit == '' || iTextAreaQuoteEditLength > 1000 ) {
        $('#iButtonAcceptEdit').attr('disabled', 'disabled');
      } else {
        $('#iButtonAcceptEdit').removeAttr('disabled');
      }

      if ((!data.includes(iInputAuthor)) || iInputAuthor == null || iInputAuthor == '' ) {
        $('#iInputAuthorErrorEdit').show();
        $('#iInputAuthorHelpEdit').hide();
      } else {
        $('#iInputAuthorErrorEdit').hide();
        $('#iInputAuthorHelpEdit').show();
      }

      if (iTextAreaQuoteEdit == null || iTextAreaQuoteEdit == '' || iTextAreaQuoteEditLength > 1000) {
        $('#iTextAreaQuoteErrorEdit').show();
        $('#iTextAreaQuoteHelpEdit').hide();
      } else {
        $('#iTextAreaQuoteErrorEdit').hide();
        $('#iTextAreaQuoteHelpEdit').show();
      }

    });
  });


</script>