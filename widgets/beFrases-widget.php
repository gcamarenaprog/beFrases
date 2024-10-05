<?php
  /**
   * Widget file of the plugin
   *
   * @package      beFrases
   * @version      2.0.0
   * @author       Guillermo Camarena <gcamarenaprog@outlook.com>
   * @copyright    Copyright (c) 2004 - 2023, Guillermo Camarena
   * @link         https://gcamarenaprog.com/beFrases/
   * @license      http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
   */
  
  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined ('ABSPATH') or die('Bye bye and remember: Silence is golden!');
  
  # Main class widget
  class beFrases_widget extends WP_Widget
  {
    
    /**
     * Widget constructor
     *
     * @since  1.0.0
     * @access public
     */
    public function __construct ()
    {
      $widget_ops = array(
        'classname' => 'beFrases_widget',
        'description' => 'Displays a random quote.');
      parent::__construct ('beFrases_widget', 'beFrases', $widget_ops);
    }
    
    
    /**
     * Widget form from administration
     *
     * @since  1.0.0
     * @access public
     */
    public function form ($instance): void
    {
      $quoteCategoryNameSelected = '';
      
      # Create instance
      $instance = wp_parse_args ((array)$instance,
        array('nTitle' => 'beFrases', 'nSelectCategoryName' => 1)
      );
      
      # PART 1: Extract the data from the instance variable
      $title = $instance['nTitle'];
      $quoteCategoryId = $instance['nSelectCategoryName'];
      
      # Get category name selected
      $quoteCategoryNameList = getCategoryNameAndIdWithCategoryId ($quoteCategoryId);
      
      # Get category name and category id
      foreach ($quoteCategoryNameList as $key => $value) {
        $quoteCategoryNameSelected = $value['befrases_cat_name'];
        $quoteCategoryIdSelected = $value['befrases_cat_id'];
      }
      
      # Get categories list
      $namesCategoriesList = getAllCategoriesList ();
      ?>

      <!-- Title /-->
      <p>
        <label for="<?php echo $this->get_field_id ('iTitle'); ?>">Title:</label>
        <input class="widefat"
               id="<?php echo $this->get_field_id ('iTitle'); ?>"
               name="<?php echo $this->get_field_name ('nTitle'); ?>"
               type="text"
               value="<?php echo $title; ?>"/>
      </p>

      <!-- Category /-->
      <p>
        <label for="<?php echo $this->get_field_id ('text'); ?>">
          Category: <?php echo $quoteCategoryNameSelected; ?>
        </label>
        <select class='widefat'
                id="<?php echo $this->get_field_id ('nSelectCategoryName'); ?>"
                name="<?php echo $this->get_field_name ('nSelectCategoryName'); ?>"
                type="text">
          <?php
            foreach ($namesCategoriesList as $key => $value) {
              $quoteCategoryId = $value['befrases_cat_id'];
              $quoteCategoryName = $value['befrases_cat_name'];
              if ($quoteCategoryId === $quoteCategoryIdSelected) {
                echo '<option selected value="' . $quoteCategoryId . '">' . $quoteCategoryName . '</option>';
              } else {
                echo '<option  value="' . $quoteCategoryId . '">' . $quoteCategoryName . '</option>';
              }
            }
          ?>
        </select>
      </p>
      
      <?php
    }
    
    
    /**
     * PART 2: Update to save changes
     *
     * @since  1.0.0
     * @access public
     */
    public function update ($new_instance, $old_instance)
    {
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
    function widget ($args, $instance): void
    {
      
      ## PART 1: Extracting the arguments + getting the values
      extract ($args, EXTR_SKIP);
      
      $title = empty($instance['nTitle']) ? '' : apply_filters ('widget_title', $instance['nTitle']);
      $quoteCategoryId = empty($instance['nSelectCategoryName']) ? '' : $instance['nSelectCategoryName'];
      
      ## BEFORE widget code, if any
      echo ($before_widget ?? '');
      
      ## PART 2: The title and the text output
      if (!empty($title))
        echo $before_title . $title . $after_title;
      if (!empty($quoteCategoryId))
        echo "";
      
      # Get options from database
      $listOptions = getSettings ();
      
      # Get saved styles and alignments from configuration management option
      foreach ($listOptions as $key => $value) {
        $alignmentAuthorText = $value['befrases_ali_txt_aut'];
        $styleAuthorText = $value['befrases_sty_txt_aut'];
        $alignmentQuoteText = $value['befrases_ali_txt_quo'];
        $styleQuoteText = $value['befrases_sty_txt_quo'];
      }
      
      # Get all quotes of a category or all categories
      if ($quoteCategoryId == 1) {
        $listQuotes = getAllQuotesFromAllCategories (); // Get all quotes form all categories.
      } else {
        $listQuotes = getAllQuotesFromCategoryId ($quoteCategoryId); // Get all quotes form a category
      }
      
      $author = '';
      $quote = '';
      
      # Get length array
      $length = count ($listQuotes);
      
      # Get author and quote with randomize number
      if ($length == 0) { // If there are no quotes.
        echo '<p style="text-align: center;">No hay frases para mostrar.</p>';
      } elseif ($length == 1) { // If there is a quote.
        foreach ($listQuotes as $key => $value) {
          $quote = $value['befrases_quote'];
          $author = $value['befrases_author'];
          $authorExtra = $value['befrases_author_extra'];
          $nameOfAuthor = getAuthorNameWithAuthorId ($author);
          foreach ($nameOfAuthor as $key => $value) {
            $author = $value['befrases_aut_name'];
          }
        }
        
      } else { // If there is one or more quotes
        $randomNumber = rand (0, $length - 1);
        foreach ($listQuotes as $key => $value) {
          if ($key == $randomNumber) {
            $quote = $value['befrases_quote'];
            $author = $value['befrases_author'];
            $authorExtra = $value['befrases_author_extra'];
            $nameOfAuthor = getAuthorNameWithAuthorId ($author);
            foreach ($nameOfAuthor as $key => $value) {
              $author = $value['befrases_aut_name'];
            }
          }
        }
      }
      
      # Print author and quote on widget
      printQuoteText ($alignmentQuoteText, $styleQuoteText, $quote);
      printAuthorText ($alignmentAuthorText, $styleAuthorText, $author, $authorExtra);
      
      # AFTER widget code, if any
      echo ($after_widget ?? '');
    }
  }

?>