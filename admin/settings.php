<?php
/*
 * Settings plugin option
 *
 * @package   				beFrases
 * @version  					2.0.0
 * @author    				Guillermo Camarena <gcamarenaprog@outlook.com>
 * @copyright 				Copyright (c) 2004 - 2023, Guillermo Camarena
 * @link      				https://gcamarenaprog.com.com/beFrases/
 * @license   				http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * 
 */
?>


<!-- PHP Code -->
	<?php
  
		# Prevent PHP code from being executed by inserting the path in the browser bar
		defined('ABSPATH') or die("Bye bye and remember: Silence is golden!");

    # Save options settings selected
    if ($_POST) {
      $alignmentTextAuthorOption =  $_POST['nRadioButton1'];
      $styleTextAuthorOption =  $_POST['nRadioButton2'];
      $alignmentTextPhraseOption =  $_POST['nRadioButton3'];
      $styleTextPhraseOption =  $_POST['nRadioButton4'];
      saveSettings($alignmentTextAuthorOption, $alignmentTextPhraseOption, $styleTextAuthorOption, $styleTextPhraseOption);
    }
    
    # Get options from database
    $listOptions = getSettings();
    
    # Assign values on the vars
    foreach ($listOptions as $key => $value) {
      $alignmentAuthor = $value['befrases_ali_txt_aut'];
      $styleAuthor = $value['befrases_sty_txt_aut']; 
      $alignmentPhrase = $value['befrases_ali_txt_phr'];
      $stylePhrase= $value['befrases_sty_txt_phr'];
    }  

  ?>
<!-- PHP Code /-->


<!-- HTML Code -->
  <div class="container-fluid">

    <!-- Title and description -->
    <h1 class="display-6"><?php echo get_admin_page_title(); ?></h1>
    <p class="lead">Selecciona el tipo de alineación y estilo de fuente para los textos de: autor y frase.</p>
    
    <hr>

    <!-- Main form -->
    <form name="form" method="post">
      
      <!-- Styles and aligns -->
      <div class="row">

        <p class="be-title"><strong>Alineación y estilo</strong> </p>

        <!-- Author text alignment options /-->
        <div class="col-sm">
          <div class="form-check">          
            <fieldset>
              <legend>Autor / Alineación</legend>
              <label for="nRadioButton1">
                <input type="radio" id="iRadioButton1-1" name="nRadioButton1" value="0" onclick="changeAlignAuthor()"> Derecha
              </label>
              <br>
              <label for="nRadioButton1">
                <input type="radio" id="iRadioButton1-2" name="nRadioButton1" value="1" onclick="changeAlignAuthor()"> Centrar
              </label>
              <br>
              <label for="nRadioButton1">
                <input type="radio" id="iRadioButton1-3" name="nRadioButton1" value="2" onclick="changeAlignAuthor()"> Izquierda
              </label>
              <br>
              <label for="nRadioButton1">
                <input type="radio" id="iRadioButton1-4" name="nRadioButton1" value="3" onclick="changeAlignAuthor()"> Justificado
              </label>
            </fieldset>
          </div>
        </div>

        <!-- Author font style options /-->
        <div class="col-sm">
          <div class="form-check">
            <fieldset>
              <legend>Autor / Estilo</legend>
              <label for="nRadioButton2">
                <input type="radio" id="iRadioButton2-1" name="nRadioButton2" value="0" onclick="changeStyleAuthor()"> Normal
              </label>
              <br>
              <label for="nRadioButton2">
                <input type="radio" id="iRadioButton2-2" name="nRadioButton2" value="1" onclick="changeStyleAuthor()"> Cursiva
              </label>
              <br>
              <label for="nRadioButton2">
                <input type="radio" id="iRadioButton2-3" name="nRadioButton2" value="2" onclick="changeStyleAuthor()"> Negrita
              </label>
              <br>
              <label for="nRadioButton2">
                <input type="radio" id="iRadioButton2-4" name="nRadioButton2" value="3" onclick="changeStyleAuthor()"> Cursiva / Negrita
              </label>
            </fieldset>
          </div>
        </div>

        <!-- Phrase text alignment options /-->
        <div class="col-sm">
          <div class="form-check">
            <fieldset>
              <legend>Frase / Alineación</legend>
              <label for="nRadioButton3">
                <input type="radio" id="iRadioButton3-1" name="nRadioButton3" value="0" onclick="changeAlignPhrase()"> Derecha
              </label>
              <br>
              <label for="nRadioButton3">
                <input type="radio" id="iRadioButton3-2" name="nRadioButton3" value="1" onclick="changeAlignPhrase()"> Centrar
              </label>
              <br>
              <label for="nRadioButton3">
                <input type="radio" id="iRadioButton3-3" name="nRadioButton3" value="2" onclick="changeAlignPhrase()"> Izquierda
              </label>
              <br>
              <label for="nRadioButton3">
                <input type="radio" id="iRadioButton3-4" name="nRadioButton3" value="3" onclick="changeAlignPhrase()"> Justificado
              </label>
            </fieldset>
          </div>
        </div>

        <!-- Phrase font style options /-->
        <div class="col-sm">
          <div class="form-check">
            <fieldset>
              <legend>Frase / Estilo</legend>
              <label for="nRadioButton4">
                <input type="radio" id="iRadioButton4-1" name="nRadioButton4" value="0" onclick="changeStylePhrase()"> Normal
              </label>
              <br>
              <label for="nRadioButton4">
                <input type="radio" id="iRadioButton4-2" name="nRadioButton4" value="1" onclick="changeStylePhrase()"> Cursiva
              </label>
              <br>
              <label for="nRadioButton4">
                <input type="radio" id="iRadioButton4-3" name="nRadioButton4" value="2" onclick="changeStylePhrase()"> Negrita
              </label>
              <br>
              <label for="nRadioButton4">
                <input type="radio" id="iRadioButton4-4" name="nRadioButton4" value="3" onclick="changeStylePhrase()"> Curisva / Negrita
              </label>
            </fieldset>
          </div>
        </div>

      </div>

      <hr>

      <!-- Save button -->
      <div class="col-auto">
        <button type="submit" class="btn btn-dark">Guardar</button>
      </div>

    </form>

    <hr>

    <!-- Demo -->
    <div class="row">
        
        <p class="be-title"><strong>Demo</strong> </p>

        <div class="col-lg-3 col-md-3 col-sd-12">    
  
          <div id="phrase">            
            <p id="phrase1" style="display:none;">"Estar solo, ese es el secreto de la invención; estando solo es cuando nacen las ideas".</p>
            <p id="phrase2" style="display:block;"><em>"Estar solo, ese es el secreto de la invención; estando solo es cuando nacen las ideas".</em></p>
            <p id="phrase3" style="display:none;"><b>"Estar solo, ese es el secreto de la invención; estando solo es cuando nacen las ideas".</b></p>
            <p id="phrase4" style="display:none;"><b><em>"Estar solo, ese es el secreto de la invención; estando solo es cuando nacen las ideas".</em></b></p>
          </div>
        
          <div id="author">
            <p id="author1" style="display:none;">— Nikola Tesla</p>
            <p id="author2" style="display:none;"><em>— Nikola Tesla</em></p>
            <p id="author3" style="display:none;"><b>— Nikola Tesla</b></p>
            <p id="author4" style="display:block;"><b><em>— Nikola Tesla</em></b></p>     
          </div>
        
        </div>

      </div>

    <hr>

  </div>
<!-- HTML Code /-->


<!-- JS Code -->
  <script>

    let alignmentPhrase  = '<?php echo $alignmentPhrase;?>';
    let stylePhrase = '<?php echo $stylePhrase;?>';
    let alignmentAuthor  = '<?php echo $alignmentAuthor;?>';
    let styleAuthor = '<?php echo $styleAuthor;?>';

    // Check option number selected from the group 1 of RadioButtons
    checkRadioButtonGroup1(alignmentAuthor);

    // Check option number selected from the group 2 of RadioButtons
    checkRadioButtonGroup2(styleAuthor);

    // Check option number selected from the group 3 of RadioButtons
    checkRadioButtonGroup3(alignmentPhrase);

    // Check option number selected from the group 4 of RadioButtons
    checkRadioButtonGroup4(stylePhrase);

  </script>
<!-- JS Code /-->