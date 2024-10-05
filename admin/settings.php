<?php
  /**
   * Settings plugin option
   *
   * @package            beFrases
   * @version            2.0.0
   * @author             Guillermo Camarena <gcamarenaprog@outlook.com>
   * @copyright          Copyright (c) 2004 - 2023, Guillermo Camarena
   * @link               https://gcamarenaprog.com.com/beFrases/
   * @license            http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
   *
   */
  
  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined ('ABSPATH') or die("Bye bye and remember: Silence is golden!");
  
  # Save options settings selected
  if ($_POST) {
    $alignmentTextAuthorOption = $_POST['nRadioButton1'];
    $styleTextAuthorOption = $_POST['nRadioButton2'];
    $alignmentTextQuoteOption = $_POST['nRadioButton3'];
    $styleTextQuoteOption = $_POST['nRadioButton4'];
    saveSettings ($alignmentTextAuthorOption, $alignmentTextQuoteOption, $styleTextAuthorOption, $styleTextQuoteOption);
  }
  
  # Get options from database
  $listOptions = getSettings ();
  
  # Assign values on radio buttons
  foreach ($listOptions as $key => $value) {
    $alignmentAuthor = $value['befrases_ali_txt_aut'];
    $styleAuthor = $value['befrases_sty_txt_aut'];
    $alignmentQuote = $value['befrases_ali_txt_quo'];
    $styleQuote = $value['befrases_sty_txt_quo'];
  }

?>

<form name="form" method="post">
  <div class="container" style="max-width: 100%">
    <div class="row g-2" style="margin-right: 10px;">

      <!-- Title and description /-->
      <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <h5 class="card-header"><?php echo get_admin_page_title (); ?></h5>
          <div class="card-body">
            <p class="card-text"> Select the alignment type and font style for the author and phrase texts. </p>
          </div>
        </div>
      </div>

      <!-- Quote alignment /-->
      <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12">
        <div class="border mb-3 p-3">
          <div class="card-body">

            <!-- Author align options /-->
            <div class="mb-4" style="display: block;">

              <!-- Title /-->
              <h6 class="card-title">Quote alignment</h6>
              <hr>

              <div class="col-sm">
                <div class="form-check">
                  <fieldset>
                    <label for="nRadioButton3">
                      <input type="radio" id="iRadioButton3-1" name="nRadioButton3" value="0"
                             onclick="changeAlignQuote()">
                      Derecha
                    </label>
                    <br>
                    <label for="nRadioButton3">
                      <input type="radio" id="iRadioButton3-2" name="nRadioButton3" value="1"
                             onclick="changeAlignQuote()">
                      Centrar
                    </label>
                    <br>
                    <label for="nRadioButton3">
                      <input type="radio" id="iRadioButton3-3" name="nRadioButton3" value="2"
                             onclick="changeAlignQuote()">
                      Izquierda
                    </label>
                    <br>
                    <label for="nRadioButton3">
                      <input type="radio" id="iRadioButton3-4" name="nRadioButton3" value="3"
                             onclick="changeAlignQuote()">
                      Justificado
                    </label>
                  </fieldset>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>

      <!-- Quote style /-->
      <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12">
        <div class="border mb-3 p-3">
          <div class="card-body">

            <!-- Author align options /-->
            <div class="mb-4" style="display: block;">

              <!-- Title /-->
              <h6 class="card-title">Quote style</h6>
              <hr>

              <div class="col-sm">
                <div class="form-check">
                  <fieldset>
                    <label for="nRadioButton4">
                      <input type="radio" id="iRadioButton4-1" name="nRadioButton4" value="0"
                             onclick="changeStyleQuote()">
                      Normal
                    </label>
                    <br>
                    <label for="nRadioButton4">
                      <input type="radio" id="iRadioButton4-2" name="nRadioButton4" value="1"
                             onclick="changeStyleQuote()">
                      Cursiva
                    </label>
                    <br>
                    <label for="nRadioButton4">
                      <input type="radio" id="iRadioButton4-3" name="nRadioButton4" value="2"
                             onclick="changeStyleQuote()">
                      Negrita
                    </label>
                    <br>
                    <label for="nRadioButton4">
                      <input type="radio" id="iRadioButton4-4" name="nRadioButton4" value="3"
                             onclick="changeStyleQuote()">
                      Curisva / Negrita
                    </label>
                  </fieldset>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>

      <!-- Author alignment /-->
      <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12">
        <div class="border mb-3 p-3">
          <div class="card-body">

            <div class="mb-4" style="display: block;">

              <!-- Title /-->
              <h6 class="card-title">Author alignment</h6>
              <hr>

              <div class="form-check">
                <fieldset>
                  <label for="nRadioButton1">
                    <input type="radio" id="iRadioButton1-1" name="nRadioButton1" value="0"
                           onclick="changeAlignAuthor()">
                    Derecha
                  </label>
                  <br>
                  <label for="nRadioButton1">
                    <input type="radio" id="iRadioButton1-2" name="nRadioButton1" value="1"
                           onclick="changeAlignAuthor()">
                    Centrar
                  </label>
                  <br>
                  <label for="nRadioButton1">
                    <input type="radio" id="iRadioButton1-3" name="nRadioButton1" value="2"
                           onclick="changeAlignAuthor()">
                    Izquierda
                  </label>
                  <br>
                  <label for="nRadioButton1">
                    <input type="radio" id="iRadioButton1-4" name="nRadioButton1" value="3"
                           onclick="changeAlignAuthor()">
                    Justificado
                  </label>
                </fieldset>
              </div>


            </div>

          </div>
        </div>
      </div>

      <!-- Author style /-->
      <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12">
        <div class="border mb-3 p-3">
          <div class="card-body">

            <!-- Author align options /-->
            <div class="mb-4" style="display: block;">

              <!-- Title /-->
              <h6 class="card-title">Author style</h6>
              <hr>

              <div class="form-check">
                <fieldset>

                  <label for="nRadioButton2">
                    <input type="radio" id="iRadioButton2-1" name="nRadioButton2" value="0"
                           onclick="changeStyleAuthor()">
                    Normal
                  </label>
                  <br>
                  <label for="nRadioButton2">
                    <input type="radio" id="iRadioButton2-2" name="nRadioButton2" value="1"
                           onclick="changeStyleAuthor()">
                    Cursiva
                  </label>
                  <br>
                  <label for="nRadioButton2">
                    <input type="radio" id="iRadioButton2-3" name="nRadioButton2" value="2"
                           onclick="changeStyleAuthor()">
                    Negrita
                  </label>
                  <br>
                  <label for="nRadioButton2">
                    <input type="radio" id="iRadioButton2-4" name="nRadioButton2" value="3"
                           onclick="changeStyleAuthor()">
                    Cursiva / Negrita
                  </label>
                </fieldset>
              </div>


            </div>

          </div>
        </div>
      </div>

      <!-- Demo /-->
      <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card" style="margin-top: -15px;">
         
          <div class="card-body">

            <!-- Author align options /-->
            <div class="mb-4" style="display: block;">

              <!-- Title /-->
              <h6 class="card-title">Demo</h6>
              <hr>

              <!-- Quote /-->
              <div id="quote">
                <p class="card-text" id="quote1" style="display:none;">"Nuestras virtudes y nuestros defectos son
                  inseparables, como la fuerza y la materia. Cuando se separan, el hombre ya no existe". "Si quieres
                  encontrar los secretos del universo, piensa en términos de energía, frecuencia y vibración".</p>

                <p class="card-text" id="quote2" style="display:block;"><em>"Nuestras virtudes y nuestros defectos son
                    inseparables, como la fuerza y la materia. Cuando se separan, el hombre ya no existe". "Si quieres
                    encontrar los secretos del universo, piensa en términos de energía, frecuencia y vibración".</em>
                </p>
                <p class="card-text" id="quote3" style="display:none;"><b>"Nuestras virtudes y nuestros defectos son
                    inseparables, como la fuerza y la materia. Cuando se separan, el hombre ya no existe". "Si quieres
                    encontrar los secretos del universo, piensa en términos de energía, frecuencia y vibración".</b>
                </p>
                <p class="card-text" id="quote4" style="display:none;"><b><em>"Nuestras virtudes y nuestros defectos son
                      inseparables, como la fuerza y la materia. Cuando se separan, el hombre ya no existe". "Si quieres
                      encontrar los secretos del universo, piensa en términos de energía, frecuencia y
                      vibración".</em></b></p>
              </div>

              <!-- Author /-->
              <div id="authorDemo">
                <p class="card-text" id="author1" style="display:none;">— Nikola Tesla / 1856 - 1943</p>
                <p class="card-text" id="author2" style="display:none;"><em>— Nikola Tesla / 1856 - 1943</em></p>
                <p class="card-text" id="author3" style="display:none;"><b>— Nikola Tesla / 1856 - 1943</b></p>
                <p class="card-text" id="author4" style="display:block;"><b><em>— Nikola Tesla / 1856 - 1943</em></b></p>
              </div>
            
            </div>
          
          </div>
        </div>
      </div>

      <!-- Save button -->
      <div class="col-auto">
        <button type="submit"
                title="Click to save"
                class="btn btn-primary btn-sm">Save
        </button>
      </div>

    </div>
  </div>
</form>

<script>

  let alignmentQuote = '<?php echo $alignmentQuote;?>';
  let styleQuote = '<?php echo $styleQuote;?>';
  let alignmentAuthor = '<?php echo $alignmentAuthor;?>';
  let styleAuthor = '<?php echo $styleAuthor;?>';

  // Check option number selected from the group 1 of RadioButtons
  changeAuthorAlignment(alignmentAuthor);

  // Check option number selected from the group 2 of RadioButtons
  changeAuthorStyle(styleAuthor);

  // Check option number selected from the group 3 of RadioButtons
  changeQuoteAlignment(alignmentQuote);

  // Check option number selected from the group 4 of RadioButtons
  changeQuoteStyle(styleQuote);

</script>