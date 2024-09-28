<?php
  /*
  @wordpress-plugin
  
  Plugin Name: beFrases
  Plugin URI:  https://guillermocamarena.com/beFrases/
  Description: Creates a manage a list of quotes and authors with category option. Display options for your sidebar
  (widget).
  Version:     2.0.0
  Author:      Guillermo Camarena
  Author URI:  https://gcamarenaprog.com/
  Text Domain: beFrases Domain
  Path: /languages
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
   */
  
  include_once dirname (__FILE__) . '/includes/beFrases-widget.php';
  
  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined ('ABSPATH') or die("Bye bye");
  
  
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
  $urlAuthors = $urlBaseAdmin . "authors.php";
  $urlHelp = $urlBaseAdmin . "help.php";
  $urlAbout = $urlBaseAdmin . "about.php";
  $urlWidget = $urlBaseWidget . "beFrases-widget.php";
  $urlBeFrases = $urlBasePlugin . "beFrases.php";
  
  
  /**
   * Hooks -------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * Activate hook function, create and insert initial data
   *
   * @return void
   */
  function beFrases_active (): void
  {
    global $wpdb;
    
    # Create the befrases table
    $sqlMain = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases (
    `befrases_id` INT NOT NULL AUTO_INCREMENT,
    `befrases_author` INT(10) NULL,
    `befrases_quote` VARCHAR(200) NULL,
    `befrases_category` INT(10) NULL,
    PRIMARY KEY (`befrases_id`));";
    $wpdb->query ($sqlMain);
    
    # Create the category table
    $sqlCategories = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases_cat (
    `befrases_cat_id` INT NOT NULL AUTO_INCREMENT,
    `befrases_cat_name` VARCHAR(45) NULL,
    `befrases_cat_description` VARCHAR(300) NULL,
    PRIMARY KEY (`befrases_cat_id`));";
    $wpdb->query ($sqlCategories);
    
    # Create the author table
    $sqlAuthors = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases_aut (
    `befrases_aut_id` INT NOT NULL AUTO_INCREMENT,
    `befrases_aut_name` VARCHAR(50) NULL,
    PRIMARY KEY (`befrases_aut_id`));";
    $wpdb->query ($sqlAuthors);
    
    # Create the options table
    $sqlOptions = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases_opt (
    `befrases_opt_id` INT NOT NULL,
    `befrases_ali_txt_aut` INT NULL,
    `befrases_sty_txt_aut` INT NULL,
    `befrases_ali_txt_quo` INT NULL,
    `befrases_sty_txt_quo` INT NULL,
    PRIMARY KEY (`befrases_opt_id`))";
    $wpdb->query ($sqlOptions);
    
    # Insert default values on befrases table
    $sqlDefaultValuesBeFrasesTable = "INSERT IGNORE INTO {$wpdb -> prefix}befrases (befrases_id, befrases_author, befrases_quote, befrases_category) VALUES (1, 1, 'Vivimos una grandiosa novela, en un gran teatro, montado por gente inteligente que le gusta jugar a las marionetas', '1'), (2, 2, 'La ciencia no es más que perversión en sí misma a menos que tenga como objetivo último mejorar la humanidad', '1')";
    $wpdb->query ($sqlDefaultValuesBeFrasesTable);
    
    # Insert default values on authors table
    $sqlDefaultValuesAuthorsTable = "INSERT IGNORE INTO {$wpdb -> prefix}befrases_aut (befrases_aut_id, befrases_aut_name) VALUES (1, 'Guillermo Camarena'), (2, 'Nikola Tesla')";
    $wpdb->query ($sqlDefaultValuesAuthorsTable);
    
    # Insert default values on categories table
    $sqlDefaultValuesCategoriesTable = "INSERT IGNORE INTO {$wpdb -> prefix}befrases_cat (befrases_cat_id, befrases_cat_name, befrases_cat_description) VALUES (1, 'Uncategorized', 'Default category if none is chosen.')";
    $wpdb->query ($sqlDefaultValuesCategoriesTable);
    
    # Insert default values on options table
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
   * Uninstall hook function, drop tables of plugin
   *
   * @return void
   */
  function beFrases_uninstall (): void
  {
    global $wpdb;
    
    $wpdb->plugin = $wpdb->prefix . 'befrases';
    $wpdb->authors = $wpdb->prefix . 'befrases_aut';
    $wpdb->categories = $wpdb->prefix . 'befrases_cat';
    $wpdb->configure = $wpdb->prefix . 'befrases_opt';
    
    if ($wpdb->plugin) {
      $wpdb->query ("DROP TABLE IF EXISTS $wpdb->plugin");
      $wpdb->query ("DROP TABLE IF EXISTS $wpdb->authors");
      $wpdb->query ("DROP TABLE IF EXISTS $wpdb->categories");
      $wpdb->query ("DROP TABLE IF EXISTS $wpdb->configure");
    }
  }
  
  # Hooks registers
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
      'Manage', // Page title
      'Manage', // Menu title
      'manage_options', // Options
      plugin_dir_path (__FILE__) . 'admin/main.php', // Slug
      null // Content
    );
    
    # 'Categories' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'Categories', // Page title
      'Categories', // Menu title
      'manage_options', // Capability
      plugin_dir_path (__FILE__) . 'admin/categories.php', // Slug
      null // Content
    );
    
    # 'Authors' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'Authors', // Page title
      'Authors', // Menu title
      'manage_options', // Capability
      plugin_dir_path (__FILE__) . 'admin/authors.php', // Slug
      null // Content
    );
    
    # 'Settings' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'Settings', // Page title
      'Settings', // Menu title
      'manage_options', // Options
      plugin_dir_path (__FILE__) . 'admin/settings.php', // Slug
      null // Content
    );
    
    # 'Help' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'Help', // Page title
      'Help', // Menu title
      'manage_options', // Capability
      plugin_dir_path (__FILE__) . 'admin/help.php', // Slug
      null // Content
    );
    
    # 'About..' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/main.php',  // Parent slug
      'About', // Page title
      'About', // Menu title
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
    global $urlAuthors;
    global $urlHelp;
    global $urlAbout;
    global $urlWidget;
    global $urlBeFrases;
    
    if (($hook != $urlMain)
      && ($hook != $urlBeFrases)
      && ($hook != $urlSettings)
      && ($hook != $urlCategories)
      && ($hook != $urlAuthors)
      && ($hook != $urlAbout)
      && ($hook != $urlWidget)
      && ($hook != $urlHelp)) {
      return;
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
    global $urlAuthors;
    global $urlHelp;
    global $urlAbout;
    global $urlWidget;
    global $urlBeFrases;
    
    if (($hook != $urlMain)
      && ($hook != $urlBeFrases)
      && ($hook != $urlSettings)
      && ($hook != $urlCategories)
      && ($hook != $urlAuthors)
      && ($hook != $urlAbout)
      && ($hook != $urlWidget)
      && ($hook != $urlHelp)) {
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
  
  
  /**
   * Widget ------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * Widget initialization
   *
   * @return mixed
   */
  function beFrases_register_widget ()
  {
    return register_widget ('beFrases_widget');
  }
  
  add_action ('widgets_init', 'beFrases_register_widget');
  
  
  /**
   * Widget functions --------------------------------------------------------------------------------------------------
   */
  
  /**
   * Gets the beFrases plugin option settings from the databases
   *
   * @return array $listQuotes List of the all quotes with his data
   */
  function getAllQuotesFromIdCategory ($quoteCategoryId): array
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT * FROM  {$wpdb -> prefix}befrases	WHERE	befrases_category = {$quoteCategoryId}", ARRAY_A);
  }
  
  /**
   * Print the quote text
   *
   * @param int    $alignmentQuoteText Option number of the alignement quote text
   * @param int    $styleQuoteText     Option number of the style quote text
   * @param string $quoteText          Text of the selected quote
   * @return void
   */
  function printQuoteText ($alignmentQuoteText, $styleQuoteText, $quoteText): void
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
   * @param int    $alignmentAuthorText Option number of the alignement author text
   * @param int    $styleAuthorText     Option number of the style author text
   * @param string $authorText          Text of the selected author
   * @return void
   */
  function printAuthorText ($alignmentAuthorText, $styleAuthorText, string $authorText): void
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
    
    <?php echo "� " . $authorText;
  
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
   * General functions -------------------------------------------------------------------------------------------------
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
   * Add a new quote record
   *
   * @param int    $authorIdQuote   Author id of the quote
   * @param string $textQuote       Text quote of the quote
   * @param int    $categoryIdQuote Category id of the quote
   * @return void
   */
  function addQuoteRecord (int $authorIdQuote, string $textQuote, int $categoryIdQuote): void
  {
    global $wpdb;
    $data = array(
      'befrases_author' => $authorIdQuote,
      'befrases_quote' => $textQuote,
      'befrases_category' => $categoryIdQuote
    );
    $tableName = "{$wpdb -> prefix}befrases";
    $wpdb->insert ($tableName, $data);
  }
  
  /**
   * Delete a quote with id number quote provided
   *
   * @param int $idQuote Quote id for delete record
   * @return void
   */
  function deleteQuoteRecord (int $idQuote): void
  {
    global $wpdb;
    $data = array(
      'befrases_id' => $idQuote
    );
    $tableName = "{$wpdb -> prefix}befrases";
    $wpdb->delete ($tableName, $data);
  }
  
  /**
   * Update data of a quote record.
   *
   * @param int    $idQuote         Id of the quote to update
   * @param string $authorQuote     Name of the quote to update
   * @param string $textQuote       Description of the quote to update
   * @param int    $categoryIdQuote Id number of the category of the quote to update
   * @return void
   */
  function updateQuoteRecord (int $idQuote, string $authorQuote, string $textQuote, int $categoryIdQuote): void
  {
    global $wpdb;
    $data = array(
      'befrases_id' => $idQuote,
      'befrases_author' => $authorQuote,
      'befrases_quote' => $textQuote,
      'befrases_category' => $categoryIdQuote
    );
    $tableName = "{$wpdb -> prefix}befrases";
    $wpdb->replace ($tableName, $data);
  }
  
  /**
   * Get all categories list
   *
   * @return array $categoriesList List of all categories and his data
   */
  function getAllDataCategoriesList (): array
  {
    global $wpdb;
    $query = "SELECT befrases_cat_id, befrases_cat_name FROM {$wpdb -> prefix}befrases_cat";
    return $wpdb->get_results ($query, ARRAY_A);
  }
  
  /**
   * Get all authors list
   *
   * @return array $authorsList List of all authors and his data
   */
  function getAllDataAuthorsList (): array
  {
    global $wpdb;
    $query = "SELECT befrases_aut_id, befrases_aut_name FROM {$wpdb -> prefix}befrases_aut";
    return $wpdb->get_results ($query, ARRAY_A);
  }
  
  /**
   * Get category name from category id
   *
   * @param int $CategoryId Id number of the category
   * @return array $categoryName Name of category
   */
  function getCategoryName (int $CategoryId): array
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT befrases_cat_name FROM  {$wpdb -> prefix}befrases_cat	WHERE	befrases_cat_id = {$CategoryId}", ARRAY_A);
  }
  
  /**
   * Get author name from author id
   *
   * @param int $authorId Id number of the author
   * @return array $authorName Name of author
   */
  function getAuthorName (int $authorId): array
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT befrases_aut_name FROM  {$wpdb -> prefix}befrases_aut	WHERE	befrases_aut_id = {$authorId}", ARRAY_A);
  }
  
  /**
   * Get all authors without repeat
   *
   * @param array $listQuotes
   * @return array
   */
  function getAllAuthorsWithoutRepeat (array $listQuotes): array
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
  
  /**
   * @param $listQuotes
   * @return array
   */
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
  
  /**
   * Gets the plugin options settings
   *
   * @return array
   */
  function getSettings (): array
  {
    global $wpdb;
    $tableName = "{$wpdb -> prefix}befrases_opt";
    $queryOptions = "SELECT * FROM {$tableName}";
    return $wpdb->get_results ($queryOptions, ARRAY_A);
  }
  
  /**
   * Save the beFrases plugin option settings on the databases
   *
   * @param int $alignmentTextAuthorOption The option selected for alignment text author
   * @param int $alignmentTextQuoteOption  The option selected for alignment text quote
   * @param int $styleTextAuthorOption     The option selected for style text author
   * @param int $styleTextQuoteOption      The option selected for style text quote
   * @return void
   */
  function saveSettings (int $alignmentTextAuthorOption, int $alignmentTextQuoteOption, int $styleTextAuthorOption, int $styleTextQuoteOption): void
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
    $wpdb->replace ($tableName, $data);
  }
  
  /**
   * Gets list of all categories from database
   *
   * @return array $categoriesList associative array with list of all categories and his data
   */
  function getAllCategoriesList (): array
  {
    global $wpdb;
    $query = "SELECT * FROM {$wpdb -> prefix}befrases_cat";
    $categoriesList = $wpdb->get_results ($query, ARRAY_A);
    if (empty($categoriesList)) {
      return array();
    }
    return $categoriesList;
  }
  
  /**
   * Save a new category record
   *
   * @param string $categoryName        The category name of the new record
   * @param string $categoryDescription The category description of the new record
   * @return void
   */
  function saveNewCategoryRecord (string $categoryName, string $categoryDescription): void
  {
    global $wpdb;
    $data = array(
      'befrases_cat_name' => $categoryName,
      'befrases_cat_description' => $categoryDescription
    );
    $tableName = "{$wpdb -> prefix}befrases_cat";
    $wpdb->insert ($tableName, $data);
  }
  
  /**
   * Delete a category with id number provided
   *
   * @param int $idCategory array with the data of new record
   * @return void
   */
  function deleteCategoryRecord (int $idCategory): void
  {
    global $wpdb;
    $data = array(
      'befrases_cat_id' => $idCategory
    );
    $tableName = "{$wpdb -> prefix}befrases_cat";
    $wpdb->delete ($tableName, $data);
  }
  
  /**
   * Update data of a category record
   *
   * @param int    $idCategory          Id of category to update
   * @param string $nameCategory        Name of category to update
   * @param string $descriptionCategory Description of category to update
   * @return void
   */
  function updateCategoryRecord (int $idCategory, string $nameCategory, string $descriptionCategory): void
  {
    global $wpdb;
    $data = array(
      'befrases_cat_id' => $idCategory,
      'befrases_cat_name' => $nameCategory,
      'befrases_cat_description' => $descriptionCategory
    );
    $tableName = "{$wpdb -> prefix}befrases_cat";
    $wpdb->replace ($tableName, $data);
  }
  
  /**
   * Count the total quotes of a category with the id number
   *
   * @param int $idCategory Id number of the category to be counted
   * @return int Number of total records of a category
   */
  function countTotalRecordsCategory (int $idCategory): int
  {
    global $wpdb;
    return $wpdb->get_var ("SELECT COUNT(befrases_category) FROM {$wpdb -> prefix}befrases WHERE befrases_category = {$idCategory} ");
  }
  
  
  /**
   * Authors section functions -----------------------------------------------------------------------------------------
   */
  
  /**
   * Gets list of all authors from database
   *
   * @return array $authorsList associative array with list of all authors and his data
   */
  function getAllAuthorsList (): array
  {
    global $wpdb;
    $query = "SELECT * FROM {$wpdb -> prefix}befrases_aut";
    $authorsList = $wpdb->get_results ($query, ARRAY_A);
    if (empty($authorsList)) {
      return array();
    }
    return $authorsList;
  }
  
  /**
   * Count the total quotes of an author with the id number
   *
   * @param int $idAuthor Id number of the author to be counted
   * @return int Number of total records of an author
   */
  function countTotalRecordsAuthor (int $idAuthor): int
  {
    global $wpdb;
    return $wpdb->get_var ("SELECT COUNT(befrases_author) FROM {$wpdb -> prefix}befrases WHERE befrases_author = {$idAuthor} ");
  }
  
  /**
   * Save a new author record
   *
   * @param string $authorName The author name of the new record
   * @return void
   */
  function saveNewAuthorRecord (string $authorName): void
  {
    global $wpdb;
    $data = array(
      'befrases_aut_name' => $authorName
    );
    $tableName = "{$wpdb -> prefix}befrases_aut";
    $wpdb->insert ($tableName, $data);
  }
  
  /**
   * Update data of an author record
   *
   * @param int    $idAuthor   Id of category to update
   * @param string $nameAuthor Name of category to update
   * @return void
   */
  function updateAuthorRecord (int $idAuthor, string $nameAuthor): void
  {
    global $wpdb;
    $data = array(
      'befrases_aut_id' => $idAuthor,
      'befrases_aut_name' => $nameAuthor
    );
    $tableName = "{$wpdb -> prefix}befrases_aut";
    $wpdb->replace ($tableName, $data);
  }
  
  /**
   * Delete an author with id number provided
   *
   * @param int $idAuthor array with the data of new record
   * @return void
   */
  function deleteAuthorRecord (int $idAuthor): void
  {
    global $wpdb;
    $data = array(
      'befrases_aut_id' => $idAuthor
    );
    $tableName = "{$wpdb -> prefix}befrases_aut";
    $wpdb->delete ($tableName, $data);
  }