<?php
  /**
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
  
  
  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined ('ABSPATH') or die("Bye bye and remember: Silence is golden!");
  
  # Save new author record from add new author form
  if (isset($_POST['nButtonNewAuthor'])) {
    $authorName = $_POST['nInputAuthorName'];
    $authorDescription = $_POST['nTextAreaAuthorDescription'];
    saveNewAuthorRecord ($authorName, $authorDescription);
  }
  
  # Delete author record from delete form
  if (isset($_POST['nButtonDeleteAuthor'])) {
    $authorId = $_POST['nInputDeleteAuthorId'];
    deleteAuthorRecord ($authorId);
  }
  
  # Update the changes from edit form
  if (isset($_POST['nButtonSaveEditAuthor'])) {
    $idAuthor = $_POST['nInputEditAuthorId'];
    $nameAuthor = $_POST['nInputEditAuthorName'];
    $descriptionAuthor = $_POST['nTextAreaEditAuthorDescription'];
    updateAuthorRecord ($idAuthor, $nameAuthor, $descriptionAuthor);
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
            En esta sección podrás añadir, editar o eliminar autores. Para editar o eliminar selecciona una autor
            de la lista.
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
            <h6 class="card-title">Añadir autor</h6>
            <p class="card-text">Escribe el nombre y la descripción de la nueva autor.</p>

            <hr>

            <!-- Categoría /-->
            <div class="mb-3">
              <label for="iInputAuthorName" class="form-label">Nombre</label>
              <input class="form-control"
                     name="nInputAuthorName"
                     id="iInputAuthorName"
                     title="Nombre del autor."
                     placeholder="Nombre"
                     required>
              <div id="iHelpAuthorName" class="form-text">Nombre del autor.</div>
            </div>

            <!-- Add button /-->
            <button class="btn btn-success btn-sm"
                    name="nButtonNewAuthor"
                    id="iButtonNewAuthor"
                    type="submit"
                    title="Clic para añadir."
            >Añadir
            </button>

          </form>

          <!-- Edit author form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormEditAuthor" name="nFormEditAuthor">

            <!-- Title and description /-->
            <h6 class="card-title">Editar autor</h6>
            <p class="card-text">Modificar el autor seleccionado.</p>

            <hr>

            <!-- Author Id /-->
            <input type="hidden"
                   class="form-control"
                   name="nInputEditAuthorId"
                   id="iInputEditAuthorId">

            <!-- Name /-->
            <div class="mb-3">
              <label for="iInputEditAuthorName" class="form-label">Nombre del autor</label>
              <input class="form-control"
                     name="nInputEditAuthorName"
                     id="iInputEditAuthorName"
                     required
                     title="Nombre del autor">
              <div id="iHelpAuthorName" class="form-text">Nombre del autor.</div>
            </div>

            <!-- Description /-->
            <div class="mb-3">
              <label for="iTextAreaEditAuthorDescription" class="form-label">Descripción</label>
              <textarea class="form-control"
                        name="nTextAreaEditAuthorDescription"
                        id="iTextAreaEditAuthorDescription"
                        placeholder="Descripción del autor"
                        required
                        title="Escribe una descripción."
                        rows="3"></textarea>
              <div id="iHelpAuthorDescription" class="form-text">Descripción del autor.
              </div>
            </div>

            <!-- Save edit /-->
            <button type="submit"
                    name="nButtonSaveEditAuthor"
                    id="iButtonSaveEditAuthor"
                    title="Clic para actualizar cambios."
                    class="btn btn-success btn-sm">Actualizar
            </button>

            <!-- Cancel edit /-->
            <button type="button"
                    name="nButtonCancelEditAuthor"
                    id="iButtonCancelEditAuthor"
                    title="Clic para cancelar."
                    class="btn btn-danger btn-sm"
                    onclick="hiddeFormEditAuthor()">Cancelar
            </button>


          </form>

          <!-- Delete author form -->
          <form method="post" class="mb-3" style="display: none;" id="iFormDeleteAuthor" name="nFormDeleteAuthor">

            <!-- Title and description /-->
            <h6 class="card-title">Eliminar autor</h6>
            <p class="card-text">¿Desea eliminar el siguiente registro?</p>

            <hr>

            <!-- Data to delete /-->
            <input type="hidden" class="form-control" name="nInputDeleteAuthorId" id="iInputDeleteAuthorId">

            <!-- Title /-->
            <p class="card-text" style="margin-bottom: 0px;">
              <b name="nTextDeleteAuthorTitleName"
                 id="iTextDeleteAuthorTitleName">Nombre</b
            </p>

            <!-- Title text /-->
            <p class="card-text"
               name="nTextDeleteAuthorName"
               id="iTextDeleteAuthorName">
            </p>

            <!-- Descriptionn title /-->
            <p class="card-text" style="margin-bottom: 0px;">
              <b name="nTextDeleteAuthorTitleDescription"
                 id="iTextDeleteAuthorTitleDescription">Descripción</b>
            </p>

            <!-- Description text /-->
            <p class="card-text"
               name="nTextDeleteAuthorDescription"
               id="iTextDeleteAuthorDescription">
            </p>

            <hr>

            <!-- Delete quote /-->
            <button type="submit"
                    class="btn btn-success btn-sm"
                    name="nButtonAcceptDeleteAuthor"
                    id="iButtonAcceptDeleteAuthor"
                    title="Clic para eliminar.">Eliminar
            </button>

            <!-- Cancel delete /-->
            <button type="button"
                    class="btn btn-danger btn-sm"
                    name="nButtonCancelDeleteAuthor"
                    id="iButtonCancelDeleteAuthor"
                    title="Clic para cancelar."
                    onclick="hiddeFormDeleteAuthor()">Cancelar
            </button>

          </form>

        </div>
      </div>
    </div>

    <!-- List of authors /-->
    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12 col-sm-12">
      <div class="border mb-3 p-3">

        <!-- Title and description /-->
        <h6 class="card-title">Lista de autores</h6>
        <p class="card-text">Selecciona una para editar o eliminar.</p>

        <hr>

        <!-- List of authors table /-->
        <div class="table-responsive">

          <table id="table" class="display " style="width:100%">

            <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Frases</th>
              <th class="text-center">Editar</th>
              <th class="text-center">Borrar</th>
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
                            id="iButtonEditAuthorRegister"
                            name="nButtonEditAuthorRegister"
                            title="Clic para editar."
                            onclick="showFormEditAuthor('<?php echo $authorId; ?>', '<?php echo $authorName; ?>', '<?php echo $authorDescription; ?>')">
                      Editar
                    </button>
                  </td>

                  <!-- Delete button /-->
                  <td style="text-align:center">
                    <button class="btn btn-danger btn-sm"
                            id="iButtonDeleteAuthorRegister"
                            name="nButtonDeleteAuthorRegister"
                            title="Clic para eliminar."
                            onclick="showFormDeleteAuthor('<?php echo $authorId; ?>', '<?php echo $authorName; ?>', '<?php echo $authorDescription; ?>' , '<?php echo $authorTotalQuotes; ?>')">
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
        "targets": [0, 3, 4]
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