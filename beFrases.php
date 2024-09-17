<?php
  /*
  @wordpress-plugin
  
  Plugin Name: beFrases
  Plugin URI:  https://guillermocamarena.com/beFrases/
  Version:     2.0.0
  Author:      Guillermo Camarena
  Author URI:  https://gcamarenaprog.com/
  Description: Creates a manage a list of quotes and authors with category option. Display options for your sidebar (widget).
  Text Domain: beFrases
  Domain Path: /languages
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  */
  
  /* Copyright 2024  Guillermo Camarena (beFrases : gcamarenaprog@outlook.com)
   *
   * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
   * General Public License as published by the Free Software Foundation; either version 2 of the License,
   * or (at your option) any later version.
   *
   * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
   * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
   *
   * You should have received a copy of the GNU General Public License along with this program; if not,
   * write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
   *
   * You should have received a copy of the GNU General Public License
   * along with beFrases. If not, see https://guillermocamarena.com/beFrases/
   *
   * @package   				beFrases
   * @version  					2.0.0
   * @author    				Guillermo Camarena <gcamarenaprog@outlook.com>
   * @copyright 				Copyright (c) 2004 - 2024, Guillermo Camarena
   * @link      				https://gcamarenaprog.com.com/beFrases/
   * @license   				http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
   *
   * @wordpress-plugin
   *
   */
  
  
  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined('ABSPATH') or die("Bye bye");
  
  /**
   * Routes definition -------------------------------------------------------------------------------------------------
   */
  
  # URL base plugin
  $urlBasePlugin = "beFrases/";
  
  # URL base admin
  $urlBaseAdmin = $urlBasePlugin . "admin/";
  
  # URL base widget
  $urlBaseWidget = $urlBasePlugin . "includes/";
  
  # Plugin routes
  $urlMain = $urlBaseAdmin . "main.php";
  $urlSettings = $urlBaseAdmin . "settings.php";
  $urlCategories = $urlBaseAdmin . "categories.php";
  $urlHelp = $urlBaseAdmin . "help.php";
  $urlAbout = $urlBaseAdmin . "about.php";
  $urlWidget = $urlBaseWidget . "beFrases-widget.php";
  $urlBeFrases = $urlBasePlugin . "beFrases.php";
  
  
  /**
   * Hooks -------------------------------------------------------------------------------------------------------------
   */
  
  
  /**
   * Activate hook function
   *
   * @return void
   */
  function beFrases_active (): void
  {
    
    global $wpdb;
    
    # CREATE the befrases table
    $sqlMain = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases (
    `befrases_id` INT NOT NULL AUTO_INCREMENT,
    `befrases_author` INT(10) NULL,
    `befrases_quote` VARCHAR(200) NULL,
    `befrases_category` INT(10) NULL,
    PRIMARY KEY (`befrases_id`));";
    $wpdb->query ($sqlMain);
    
    # CREATE the category table
    $sqlCategories = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases_cat (
    `befrases_cat_id` INT NOT NULL AUTO_INCREMENT,
    `befrases_cat_name` VARCHAR(45) NULL,
    `befrases_cat_description` VARCHAR(300) NULL,
    PRIMARY KEY (`befrases_cat_id`));";
    $wpdb->query ($sqlCategories);
    
    # CREATE the author table
    $sqlAuthors = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases_aut (
    `befrases_aut_id` INT NOT NULL AUTO_INCREMENT,
    `befrases_aut_name` VARCHAR(50) NULL,
    PRIMARY KEY (`befrases_aut_id`));";
    $wpdb->query ($sqlAuthors);
    
    # CREATE the options table
    $sqlOptions = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases_opt (
    `befrases_opt_id` INT NOT NULL,
    `befrases_ali_txt_aut` INT NULL,
    `befrases_sty_txt_aut` INT NULL,
    `befrases_ali_txt_quo` INT NULL,
    `befrases_sty_txt_quo` INT NULL,
    PRIMARY KEY (`befrases_opt_id`))";
    $wpdb->query ($sqlOptions);
    
    # INSERT default values on befrases table
    $sqlDefaultValuesBeFrasesTable = "INSERT IGNORE INTO {$wpdb -> prefix}befrases (befrases_id, befrases_author, befrases_quote, befrases_category) VALUES (1, 0, 'Vivimos una grandiosa novela, en un gran teatro, montado por gente inteligente que le gusta jugar a las marionetas', '1'), (2, 1, 'La ciencia no es más que perversión en sí misma a menos que tenga como objetivo último mejorar la humanidad', '1')";
    $wpdb->query ($sqlDefaultValuesBeFrasesTable);
    
    # INSERT default values on authors table (0, 'Guillermo Camarena')
    $sqlDefaultValuesAuthorsTable = "INSERT IGNORE INTO {$wpdb -> prefix}befrases_aut (befrases_cat_id, befrases_cat_name) VALUES (0, 'Guillermo Camarena'), (1, 'Nikola Tesla')";
    $wpdb->query ($sqlDefaultValuesAuthorsTable);
    
    # INSERT default values on categories table (0, 'Default')
    $sqlDefaultValuesCategoriesTable = "INSERT IGNORE INTO {$wpdb -> prefix}befrases_cat (befrases_cat_id, befrases_cat_name, befrases_cat_description) VALUES (1, 'Uncategorized', 'Default category if none is chosen.')";
    $wpdb->query ($sqlDefaultValuesCategoriesTable);
    
    # INSERT default values on options table (1,3,4,4,1)
    $sqlDefaultValuesOptionsTable = "INSERT IGNORE INTO {$wpdb -> prefix}befrases_opt (befrases_opt_id, befrases_ali_txt_aut, befrases_sty_txt_aut, befrases_ali_txt_quo, befrases_sty_txt_quo) VALUES (1,3,4,4,1)";
    $wpdb->query ($sqlDefaultValuesOptionsTable);
    
  }
  
  /**
   * Deactivate hook function
   *
   * @return void
   */
  function beFrases_deactivate (): void
  {
    flush_rewrite_rules ();
  }
  
  /**
   * Uninstall hook function
   *
   * @return void
   */
  function beFrases_uninstall (): void
  {
    
    global $wpdb;
    $wpdb->plugin = $wpdb->prefix . 'befrases';
    $wpdb->options = $wpdb->prefix . 'befrases_opt';
    $wpdb->categories = $wpdb->prefix . 'befrases_cat';
    
    if ($wpdb->plugin) {
      $wpdb->query ("DROP TABLE IF EXISTS " . $wpdb->plugin);
      $wpdb->query ("DROP TABLE IF EXISTS " . $wpdb->options);
      $wpdb->query ("DROP TABLE IF EXISTS " . $wpdb->categories);
    }
    
  }
  
  # Hooks register
  register_activation_hook (__FILE__, 'beFrases_active');
  register_deactivation_hook (__FILE__, 'beFrases_deactivate');
  register_uninstall_hook (__FILE__, 'beFrases_uninstall');
  
  
  /**
   * Main menu ---------------------------------------------------------------------------------------------------------
   */
  
  /**
   * Create menu of the plugin
   *
   * @since  1.0.0
   * @access public
   */
  function fn_createMenu (): void
  {
    
    # Main menu definition
    add_menu_page (
      'beFrases', // Page title
      'beFrases', // Menu title
      'manage_options', // Options
      plugin_dir_path (__FILE__) . 'admin/main.php', // Slug
      null, // Show content
      'dashicons-editor-quote', // Icon
      '2' // Position
    );
    
    # 'Manage' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'Administrar', // Page title
      'Administrar', // Menu title
      'manage_options', // Options
      plugin_dir_path (__FILE__) . 'admin/main.php', // Slug
      null // Content
    );
    
    # 'Categories' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'Categorías', // Page title
      'Categorías', // Menu title
      'manage_options', // Capability
      plugin_dir_path (__FILE__) . 'admin/categories.php', // Slug
      null // Content
    );
    
    # 'Settings' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'Ajustes', // Page title
      'Ajustes', // Menu title
      'manage_options', // Options
      plugin_dir_path (__FILE__) . 'admin/settings.php', // Slug
      null // Content
    );
    
    # 'Help' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'Ayuda', // Page title
      'Ayuda', // Menu title
      'manage_options', // Capability
      plugin_dir_path (__FILE__) . 'admin/help.php', // Slug
      null // Content
    );
    
    # 'About..' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'Acerca de..', // Page title
      'Acerca de..', // Menu title
      'manage_options', // Capability
      plugin_dir_path (__FILE__) . 'admin/about.php', // Slug
      null // Content
    );
    
  }
  
  add_action ('admin_menu', 'fn_createMenu');
  
  
  /**
   * Scripts and styles files register ---------------------------------------------------------------------------------
   */
  
  /**
   * Declaration and call of external JavaScript codes and Ajax functions
   *
   * @since  1.0.0
   * @access public
   */
  function fn_CallMyJS ($hook): void
  {
    
    global $urlMain;
    global $urlSettings;
    global $urlCategories;
    global $urlHelp;
    global $urlAbout;
    global $urlWidget;
    global $urlBeFrases;
    
    if (($hook != $urlMain) &&
      ($hook != $urlBeFrases) &&
      ($hook != $urlSettings) &&
      ($hook != $urlCategories) &&
      ($hook != $urlAbout) &&
      ($hook != $urlWidget) &&
      ($hook != $urlHelp)
    ) {
      return;;
    }
    
    
    // JQuery 3.7.1
    wp_enqueue_script ('script-jquery', plugins_url ('/js/jquery.min-3.7.1.js', __FILE__), array('jquery'));
    
    // JQuery UI 1.14.0
    wp_enqueue_script ('script-jquery-ui', plugins_url ('/js/jquery-ui.1.14.0.js', __FILE__), array('jquery'));
    
    // DataTables 2.1.6
    wp_enqueue_script ('script-jquery-datatables', plugins_url ('/js/dataTables.2.1.6.js', __FILE__), array('jquery'));
    wp_enqueue_script ('script-responsive-datatables', plugins_url ('/js/responsive.dataTables.js', __FILE__), array('jquery'));
    wp_enqueue_script ('script-datatables-responsive', plugins_url ('/js/dataTables.responsive.js', __FILE__), array('jquery'));
    
    // Bootstrap 5.3.3
    wp_enqueue_script ('script-jquery-bootstrap-bundle', plugins_url ('/js/bootstrap.bundle.min.5.3.3.js', __FILE__), array('jquery'));
    
    // Personalized script
    wp_enqueue_script ('be-js-personalized', plugins_url ('/js/script.js', __FILE__), array('jquery'), '2.0.0');
    
  }
  
  add_action ('admin_enqueue_scripts', 'fn_CallMyJS');
  
  
  /**
   * Declaration and call of external CSS styles
   *
   * @since  1.0.0
   * @access public
   */
  function fn_CallMyCSS ($hook): void
  {
    
    global $urlMain;
    global $urlSettings;
    global $urlCategories;
    global $urlHelp;
    global $urlAbout;
    global $urlWidget;
    global $urlBeFrases;
    
    if (($hook != $urlMain) && ($hook != $urlBeFrases) && ($hook != $urlSettings) && ($hook != $urlCategories) && ($hook != $urlAbout) && ($hook != $urlWidget) && ($hook != $urlHelp)) {
      return;
    }
    // Bootstrap 5.3.3
    wp_enqueue_style ('be-css-bootstrap', plugins_url ('/css/bootstrap.5.3.3.css', __FILE__));
    
    // DataTables 2.1.6
    wp_enqueue_style ('be-css-jquery-datatables', plugins_url ('/css/jquery.dataTables.2.1.6.css', __FILE__));
    wp_enqueue_style ('be-css-responsive-datatables', plugins_url ('/css/responsive.dataTables.css', __FILE__));
    
    // Personalized styles
    wp_enqueue_style ('be-css-style', plugins_url ('/css/style.css', __FILE__));

  }
  
  add_action ('admin_enqueue_scripts', 'fn_CallMyCSS');
  
  
  # Widget declaration
  
  // We call the class where the widget's functionalities are
  include_once dirname (__FILE__) . '/includes/beFrases-widget.php';
  
  // Widget initialization
  add_action ("widgets_init", "chargeWidget");
  
  if (!function_exists ("chargeWidget")) {
    function chargeWidget ()
    {
      
      // Create the widget and pass the name of the widget class as a parameter
      register_widget ("beFrases_widget");
      
    }
  }
  
  # Functions of beFrases-widget.php
  /**
   * Gets the beFrases plugin option settings from the databases
   *
   * @return array $listQuotes List of the all quotes with his data
   */
  function getAllQuotesFromIdCategory ($quoteCategoryId): array
  {
    global $wpdb;
    $listQuotes = $wpdb->get_results ("SELECT * FROM  {$wpdb -> prefix}befrases	WHERE	befrases_category = {$quoteCategoryId}", ARRAY_A);
    return $listQuotes;
  }
  
  # Functions of bFrases-widget.php
  /**
   * Print the quote text
   *
   * @param number $alignmentQuoteText Option number of the alignement quote text
   * @param number $styleQuoteText     Option number of the style quote text
   * @param string $quoteText          Text of the selected quote
   * @return
   */
  function printQuoteText ($alignmentQuoteText, $styleQuoteText, $quoteText)
  {
    if ($alignmentQuoteText == 0): ?>
      <p style="display:block;text-align:right; padding: 0px;">
    <?php
    elseif ($alignmentQuoteText == 1): ?>
      <p style="display:block;text-align:center; padding: 0px;">
    <?php
    elseif ($alignmentQuoteText == 2): ?>
      <p style="display:block;text-align:left; padding: 0px;">
    <?php
    else: ?>
      <p style="display:block;text-align:justify; padding: 0px;">
    <?php
    endif; ?>
    
    
    <?php
  if ($styleQuoteText == 0): ?>
  
  <?php
  elseif ($styleQuoteText == 1): ?>
    <em>
    <?php
      elseif ($styleQuoteText == 2): ?>
    <b>
    <?php
      else: ?>
    <b><em>
  <?php
  endif; ?>
    
    <?php echo "\"" . $quoteText . "\""; ?>
    
    <?php
  if ($styleQuoteText == 0): ?>
  <?php
  elseif ($styleQuoteText == 1): ?>
    </em>
    <?php
      elseif ($styleQuoteText == 2): ?>
    </b>
  <?php
    else: ?>
    <b></em>
  <?php
  endif; ?>
    </p> <?php
  }
  
  /**
   * Print the author text
   *
   * @param number $alignmentAuthorText Option number of the alignement author text
   * @param number $styleAuthorText     Option number of the style author text
   * @param string $authorText          Text of the selected author
   * @return
   */
  function printAuthorText ($alignmentAuthorText, $styleAuthorText, $authorText)
  {
    if ($alignmentAuthorText == 0): ?>
      <p style="display:block;text-align: right;padding: 0px; margin: 0px;">
    <?php
    elseif ($alignmentAuthorText == 1): ?>
      <p style="display:block;text-align: center;padding: 0px; margin: 0px;">
    <?php
    elseif ($alignmentAuthorText == 2): ?>
      <p style="display:block;text-align: left;padding: 0px; margin: 0px;">
    <?php
    else: ?>
      <p style="display:block;text-align: justify;padding: 0px; margin: 0px;">
    <?php
    endif; ?>
    
    <?php
  if ($styleAuthorText == 0): ?>
  <?php
  elseif ($styleAuthorText == 1): ?>
    <em>
    <?php
      elseif ($styleAuthorText == 2): ?>
    <b>
    <?php
      else: ?>
    <b><em>
  <?php
  endif; ?>
    
    <?php echo "— " . $authorText;
  
  if ($styleAuthorText == 0): ?>
  
  <?php
  elseif ($styleAuthorText == 1): ?>
    </em>
    <?php
      elseif ($styleAuthorText == 2): ?>
    </b>
  <?php
    else: ?>
    <b><em>
  <?php
  endif; ?>
    </p> <?php
  }
  
  
  /**
   * Functions of main.php file ----------------------------------------------------------------------------------------
   */
  
  /**
   * Get all quotes.
   *
   * @return array
   */
  function getAllQuotes (): array
  {
    global $wpdb;
    $tableName = "{$wpdb -> prefix}befrases";
    $query = "SELECT * FROM {$tableName}";
    return $wpdb->get_results ($query, ARRAY_A);
  }
  
  /**
   * Update data of a quote record.
   *
   * @param number $idQuote         Id of the quote to update
   * @param string $authorQuote     Name of the quote to update
   * @param string $textQuote       Description of the quote to update
   * @param number $categoryIdQuote Id number of the category of the quote to update
   * @return void
   */
  function updateQuoteRecord ($idQuote, string $authorQuote, string $textQuote, $categoryIdQuote): void
  {
    global $wpdb;
    $data = array(
      'befrases_id' => $idQuote,
      'befrases_author' => $authorQuote,
      'befrases_quote' => $textQuote,
      'befrases_category' => $categoryIdQuote
    );
    $tableName = "{$wpdb -> prefix}befrases";
    $replace = $wpdb->replace ($tableName, $data);
  }
  
  /**
   * Get all categories list
   *
   * @return array $categoriesList List of all categories and his data
   */
  function getAllDataCategoriesList ()
  {
    global $wpdb;
    $query = "SELECT befrases_cat_id, befrases_cat_name FROM {$wpdb -> prefix}befrases_cat";
    $categoriesList = $wpdb->get_results ($query, ARRAY_A);
    return $categoriesList;
  }
  
  /**
   * Get all authors list
   *
   * @return array $authorsList List of all authors and his data
   */
  function getAllDataAuthorsList ()
  {
    global $wpdb;
    $query = "SELECT befrases_aut_id, befrases_aut_name FROM {$wpdb -> prefix}befrases_aut";
    $authorsList = $wpdb->get_results ($query, ARRAY_A);
    return $authorsList;
  }
  
  /**
   * Add a new quote record
   *
   * @param number $authorQuote     Author of the quote for new record
   * @param number $textQuote       Text quote of the quote for new record
   * @param number $categoryIdQuote Category Id of the quote for new record
   * @return void
   */
  function addQuoteRecord ($authorIdQuote, $textQuote, $categoryIdQuote): void
  {
    global $wpdb;
    $data = array(
      'befrases_author' => $authorIdQuote,
      'befrases_quote' => $textQuote,
      'befrases_category' => $categoryIdQuote
    );
    $tableName = "{$wpdb -> prefix}befrases";
    $replace = $wpdb->insert ($tableName, $data);
  }
  
  /**
   * Delete a quote with id number quote provided
   *
   * @param number $idQuote Quote id for delete record
   * @return
   */
  function deleteQuoteRecord ($idQuote)
  {
    global $wpdb;
    $data = array(
      'befrases_id' => $idQuote
    );
    $tableName = "{$wpdb -> prefix}befrases";
    $replace = $wpdb->delete ($tableName, $data);
  }
  
  /**
   * Get category name from category id
   *
   * @param number $CategoryId Id number of the category
   * @return string $categoryName Name of category
   */
  function getCategoryName ($CategoryId)
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT befrases_cat_name FROM  {$wpdb -> prefix}befrases_cat	WHERE	befrases_cat_id = {$CategoryId}", ARRAY_A);
  }
  
  /**
   * Get author name from author id
   *
   * @param number $authorId Id number of the author
   * @return string $authorName Name of author
   */
  function getAuthorName ($authorId)
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT befrases_aut_name FROM  {$wpdb -> prefix}befrases_aut	WHERE	befrases_aut_id = {$authorId}", ARRAY_A);
  }
  
  
  /**
   * Get all authors without repeat
   *
   * @param $listQuotes
   * @return array
   */
  function getAllAuthorsWithoutRepeat ($listQuotes): array
  {
    global $wpdb;
    $listAuthors = array();
    $lenghtArray = count ($listQuotes);
    //echo $lenghtArray;
    for ($i = 0; $i < $lenghtArray; ++$i) {
      $extractedRecord = $listQuotes[$i];
      $authorExtractedRecord = $extractedRecord['befrases_author'];
      array_push ($listAuthors, $authorExtractedRecord);
    }
    
    $listAuthorsNoRepeat = array_values (array_unique ($listAuthors));
    return $listAuthorsNoRepeat;
  }
  
  function getAllQuotesNoRepeat ($listQuotes)
  {
    //print_r($listQuotes);
    global $wpdb;
    $listQuotes = array();
    $lenghtArray1 = count ($listQuotes);
    echo $lenghtArray1;
    
    for ($i = 0; $i < $lenghtArray; ++$i) {
      $extractedRecord = $listQuotes[$i];
      $quoteExtractedRecord = $extractedRecord['befrases_quote'];
      array_push ($listQuotes, $quoteExtractedRecord);
    }
    
    print_r ($listQuotes);
    $listQuotesNoRepeat = array_values (array_unique ($listQuotes));
    return $listQuotesNoRepeat;
  }
  
  # Functions of settings.php file
  
  /**
   * Gets the beFrases plugin option settings from the databases
   *
   * @return array $listOptions
   */
  function getSettings ()
  {
    global $wpdb;
    $tableName = "{$wpdb -> prefix}befrases_opt";
    $queryOptions = "SELECT * FROM {$tableName}";
    $listOptions = $wpdb->get_results ($queryOptions, ARRAY_A);
    return $listOptions;
  }
  
  /**
   * Save the beFrases plugin option settings on the databases
   *
   * @param string $alignmentTextAuthorOption The option selected for alignment text author
   * @param string $alignmentTextQuoteOption The option selected for alignment text quote
   * @param string $styleTextAuthorOption     The option selected for style text author
   * @param string $styleTextQuoteOption     The option selected for style text quote
   * @return none
   */
  function saveSettings ($alignmentTextAuthorOption, $alignmentTextQuoteOption, $styleTextAuthorOption, $styleTextQuoteOption)
  {
    global $wpdb;
    $idOptions = 1;
    $data = array(
      'befrases_opt_id' => $idOptions,
      'befrases_ali_txt_aut' => $alignmentTextAuthorOption,
      'befrases_sty_txt_aut' => $styleTextAuthorOption,
      'befrases_ali_txt_quo' => $alignmentTextQuoteOption,
      'befrases_sty_txt_quo' => $styleTextQuoteOption
    );
    $tableName = "{$wpdb -> prefix}befrases_opt";
    $replace = $wpdb->replace ($tableName, $data);
  }
  
  # Functions of categories.php file
  
  /**
   * Gets list of all categories from database
   *
   * @param
   * @return array $categoriesList associative array with list of all categories and his data
   */
  function getAllCategoriesList ()
  {
    global $wpdb;
    $query = "SELECT * FROM {$wpdb -> prefix}befrases_cat";
    $categoriesList = $wpdb->get_results ($query, ARRAY_A);
    if (empty($categoriesList)) {
      $categoriesList = array();
      return $categoriesList;
    }
    return $categoriesList;
  }
  
  /**
   * Save a new category record
   *
   * @param string $categoryName        The category name of the new record
   * @param string $categoryDescription The category description of the new record
   * @return
   */
  function saveNewCategoryRecord ($categoryName, $categoryDescription)
  {
    global $wpdb;
    $data = array(
      'befrases_cat_name' => $categoryName,
      'befrases_cat_description' => $categoryDescription
    );
    $tableName = "{$wpdb -> prefix}befrases_cat";
    $replace = $wpdb->insert ($tableName, $data);
  }
  
  /**
   * Delete a category with id number provided
   *
   * @param array $id array with the data of new record
   * @return
   */
  function deleteCategoryRecord ($id)
  {
    global $wpdb;
    $data = array(
      'befrases_cat_id' => $id
    );
    $tableName = "{$wpdb -> prefix}befrases_cat";
    $replace = $wpdb->delete ($tableName, $data);
  }
  
  /**
   * Update data of a category record
   *
   * @param string $idCategory          Id of category to update
   * @param string $nameCategory        Name of category to update
   * @param string $descriptionCategory Description of category to update
   * @return void
   */
  function updateCategoryRecord ($idCategory, $nameCategory, $descriptionCategory)
  {
    global $wpdb;
    $data = array(
      'befrases_cat_id' => $idCategory,
      'befrases_cat_name' => $nameCategory,
      'befrases_cat_description' => $descriptionCategory
    );
    $tableName = "{$wpdb -> prefix}befrases_cat";
    $replace = $wpdb->replace ($tableName, $data);
  }
  
  /**
   * Count the total quotes of a category with the id number
   *
   * @param number $idCategory Id number of the category to be counted
   * @return number $totalQuotes Number of total records of a category
   */
  function countTotalRecordsCategory ($idCategory)
  {
    global $wpdb;
    $totalQuotes = $wpdb->get_var ("SELECT COUNT(befrases_category) FROM {$wpdb -> prefix}befrases WHERE befrases_category = {$idCategory} ");
    return $totalQuotes;
  }

?>