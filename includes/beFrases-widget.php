<?php
/**
 * Widget file of the plugin
 *
 * @package     beFrases
 * @version  	  2.0.0
 * @author      Guillermo Camarena <gcamarenaprog@outlook.com>
 * @copyright   Copyright (c) 2004 - 2023, Guillermo Camarena
 * @link      	https://gcamarenaprog.com/beFrases/
 * @license   	http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>

<?php

  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined('ABSPATH') or die("Bye bye and remember: Silence is golden!");


  # Main class widget
  class beFrases_widget extends WP_Widget {

    /**
     * Widget constructor
     * 
     * @since  1.0.0
     * @access public
     */
    public function __construct() {
      $widget_ops = array('classname' => 'beFrases_widget', 'description' => "A random phrase from the phrase repository" );
      parent::__construct('css_id'  , 'beFrases', $widget_ops);
    }


    /**
     * PART 1: Widget elements start and extract data form instance
     * 
     * @since  1.0.0
     * @access public
     */
    public function form($instance) {

      // PART 1: Extract the data from the instance variable
      $instance = wp_parse_args( (array) $instance, array( 'nTitle' => 'beFrases', 'nSelectCategoryName' => 1) );
      $title = $instance['nTitle'];
      $phraseCategory = $instance['nSelectCategoryName'];
      ?>

      <!-- Widget title show and start -->
      <p>
        <label for="<?php echo $this->get_field_id('iTitle'); ?>">Title: 
          <input  class="widefat" id="<?php echo $this->get_field_id('iTitle'); ?>" 
                  name="<?php echo $this->get_field_name('nTitle'); ?>" type="text" 
                  value="<?php echo $title; ?>" />
        </label>
      </p>

      <!-- Widget select category shor and start-->
      <p>
        <label for="<?php echo $this->get_field_id('text'); ?>">Categoría: <?php echo $phraseCategory; ?>
          <select class='widefat' id="<?php echo $this->get_field_id('nSelectCategoryName'); ?>" name="<?php echo $this->get_field_name('nSelectCategoryName'); ?>" type="text">
            <?php         
              $namesCategoriesList = getAllCategoriesList();
              
              foreach ($namesCategoriesList as $key => $value) {
                $phraseCategoryId = $value['befrases_cat_id'];
                $phraseCategoryName = $value['befrases_cat_name']; 

                if($phraseCategoryId === $phraseCategory){
                  echo '<option selected value="'.$phraseCategoryId.'">'.$phraseCategoryName.'</option>';
                }else {
                  echo '<option  value="'.$phraseCategoryId.'">'.$phraseCategoryName.'</option>';  
                }                                           
              }

            ?>
          </select>                
        </label>
      </p>   
      <?php      
    }

    
    /*
    ** --- Función para actualizar los cambios al guardar ---
    */

    /**
     * PART 2: Update to save changes
     * 
     * @since  1.0.0
     * @access public
     */
    public function update($new_instance,$old_instance) {    
      $instance = $old_instance;
      $instance['nTitle'] = $new_instance['nTitle'];
      $instance['nSelectCategoryName'] = $new_instance['nSelectCategoryName'];
      return $instance;
    }


    /**
     * Widget content to be displayed on the Sidebar (Front-End)
     * 
     * @since  1.0.0
     * @access public
     */
    function widget($args, $instance) {
      
      // PART 1: Extracting the arguments + getting the values
      extract($args, EXTR_SKIP);
      $title = empty($instance['nTitle']) ? ' ' : apply_filters('widget_title', $instance['nTitle']);
      $phraseCategoryId = empty($instance['nSelectCategoryName']) ? '' : $instance['nSelectCategoryName'];
  
      // Before widget code, if any
      echo (isset($before_widget)?$before_widget:'');
  
      // PART 2: The title and the text output
      if (!empty($title))
        echo $before_title . $title . $after_title;
      if (!empty($phraseCategoryId))
        echo "";

        // Get all phrases of a category for su id
        $listPhrases = getAllPhrasesFromIdCategory($phraseCategoryId);

        // Get lenght array
        $lenght = count($listPhrases);
 
        // Get random number for use to choice some prhase
        $randomNumber = rand(0, $lenght-1);

        # Get options from database
        $listOptions = getSettings();

        // Get saved styles and alignments from configuration management option
        foreach ($listOptions as $key => $value) {
          $alignmentAuthorText = $value['befrases_ali_txt_aut']; 
          $styleAuthorText = $value['befrases_sty_txt_aut'];
          $alignmentPhraseText = $value['befrases_ali_txt_phr']; 
          $stylePhraseText = $value['befrases_sty_txt_phr'];         
        }
        
        // Get only one phrase with the random number of the list obtained
        foreach ($listPhrases as $key => $value) {
          $authorText = $value['befrases_author']; 
          $phraseText = $value['befrases_phrase'];

          if( $key == $randomNumber ) {
            printPhraseText($alignmentPhraseText, $stylePhraseText, $phraseText);
            printAuthorText($alignmentAuthorText, $styleAuthorText, $authorText);            
          }          
        } ?>

      <?php
      // After widget code, if any  
      echo (isset($after_widget)?$after_widget:'');
    }
  }
?>