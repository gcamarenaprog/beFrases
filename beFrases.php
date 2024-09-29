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
  
  include_once dirname (__FILE__) . '/widgets/beFrases-widget.php';
  
  include_once dirname (__FILE__) . '/includes/functions-manage.php';
  include_once dirname (__FILE__) . '/includes/functions-authors.php';
  include_once dirname (__FILE__) . '/includes/functions-categories.php';
  include_once dirname (__FILE__) . '/includes/functions-quotes.php';
  include_once dirname (__FILE__) . '/includes/functions-settings.php';
  include_once dirname (__FILE__) . '/includes/functions-widgets.php';
  
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
  $urlBaseWidget = $urlBasePlugin . "widgets/";
  
  # Plugin routes
  $urlMain = $urlBaseAdmin . "manage.php";
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
      plugin_dir_path (__FILE__) . 'admin/manage.php', // Slug
      null, // Show content
      'dashicons-editor-quote', // Icon
      '2' // Position
    );
    
    # 'Manage' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/manage.php',  // Parent slug
      'Manage', // Page title
      'Manage', // Menu title
      'manage_options', // Options
      plugin_dir_path (__FILE__) . 'admin/manage.php', // Slug
      null // Content
    );
    
    # 'Categories' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/manage.php',  // Parent slug
      'Categories', // Page title
      'Categories', // Menu title
      'manage_options', // Capability
      plugin_dir_path (__FILE__) . 'admin/categories.php', // Slug
      null // Content
    );
    
    # 'Authors' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/manage.php',  // Parent slug
      'Authors', // Page title
      'Authors', // Menu title
      'manage_options', // Capability
      plugin_dir_path (__FILE__) . 'admin/authors.php', // Slug
      null // Content
    );
    
    # 'Settings' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/manage.php',  // Parent slug
      'Settings', // Page title
      'Settings', // Menu title
      'manage_options', // Options
      plugin_dir_path (__FILE__) . 'admin/settings.php', // Slug
      null // Content
    );
    
    # 'Help' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/manage.php',  // Parent slug
      'Help', // Page title
      'Help', // Menu title
      'manage_options', // Capability
      plugin_dir_path (__FILE__) . 'admin/help.php', // Slug
      null // Content
    );
    
    # 'About..' submenu option
    add_submenu_page (
      plugin_dir_path (__FILE__) . 'admin/manage.php',  // Parent slug
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
  
  