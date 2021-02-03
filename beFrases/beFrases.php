<?php
/*
	@wordpress-plugin
	Plugin Name:       	beFrases
	Plugin URI:        	https://guillermocamarena.com/beFrases/
  Description:       	Creates an manage a list of quotes and authors. Display options for your sidebar (widget).
	Version:           	1.0
	Requires at least: 	5.0
	Author:            	Guillermo Camarena
	Author URI:        	https://guillermocamarena.com/
	License:     				GPL2
	License URI: 				https://www.gnu.org/licenses/gpl-2.0.html
	Text Domain:       	beFrases
	Domain Path:       	/languajes
*/
/*
 	Copyright 2020  Guilermo Camarena (beFrases : info@guillermocamarena.com)

	beFrases is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.
 
	beFrases is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	 
	You should have received a copy of the GNU General Public License
	along with beFrases. If not, see https://guillermocamarena.com/beFrases/
*/

// Evitar que se pueda ejecutar código PHP insertando la ruta en la barra del navegador
defined('ABSPATH') or die("Bye bye");


/*
** ----------------------------------------
** --- Declaración de rutas ---
** ----------------------------------------
*/
$urlMain = "beFrases/admin/main.php";
$urlSettings = "beFrases/admin/settings.php";
$urlEditPhrase = "beFrases/admin/edit-phrase.php";
$urlAddPhrase = "beFrases/admin/add-phrase.php";
$urlDeleteAll = "beFrases/admin/delete-all-phrases.php";
$urlAbout = "beFrases/admin/about.php";
$urlHelp = "beFrases/admin/help.php";


/*
** ----------------------------------------
** --- Hooks del plugin ---
** ----------------------------------------
*/

/*
** --- Función hook activar ---
*/
function befrases_activar() {
	global $wpdb;

	// Creación de la tabla frases
	$sqlmain = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases (
		`befrases_id` INT NOT NULL AUTO_INCREMENT, 
		`befrases_autor` VARCHAR(45) NULL, 
		`befrases_frase` VARCHAR(200) NULL, 
		PRIMARY KEY (`befrases_id`));";
	$wpdb -> query($sqlmain);

  // Creación de la tabla opciones
	$sqlopt = "CREATE TABLE IF NOT EXISTS {$wpdb -> prefix}befrases_opt (
		`befrases_ajustes_id` INT NOT NULL, 
		`befrases_ali_tex_aut` INT NULL, 
		`befrases_est_tex_aut` INT NULL, 
		`befrases_ali_tex_fra` INT NULL, 
		`befrases_est_tex_fra` INT NULL,
    PRIMARY KEY (`befrases_ajustes_id`))";
  $wpdb -> query($sqlopt);

  // Inicialización de tabla opciones
  $sqlval = "INSERT IGNORE INTO {$wpdb -> prefix}befrases_opt (befrases_ajustes_id, befrases_ali_tex_aut, befrases_est_tex_aut, befrases_ali_tex_fra, befrases_est_tex_fra) VALUES (1,3,4,4,1)";
  $wpdb -> query($sqlval);
}

/*
** --- Función hook desactivar ---
*/
function befrases_desactivar() {
	flush_rewrite_rules();
}

/*
** --- Función hook desinstalar ---
*/
function befrases_desinstalar() {
	global $wpdb;
	$wpdb -> frases = $wpdb->prefix . 'befrases';
	$wpdb -> clases = $wpdb->prefix . 'befrases_opt';
	if ( $wpdb->frases ) {
		$wpdb->query ( "DROP TABLE IF EXISTS ". $wpdb->frases );
		$wpdb->query ( "DROP TABLE IF EXISTS ". $wpdb->clases );
	}
}

/*
** --- Registro de hooks ---
*/
register_activation_hook(__FILE__,'befrases_activar');
register_deactivation_hook(__FILE__,'befrases_desactivar');
register_uninstall_hook(__FILE__,'befrases_desinstalar');


/*
** ---------------------------------------
** --- Declaración del menú del plugin ---
** ---------------------------------------
*/

/*
** --- Función crear menú ---
*/
add_action('admin_menu', 'fn_crear_menu');
function fn_crear_menu() {

	// Menú principal
	add_menu_page(
		'beFrases', // Título de la página
		'beFrases', // Título del menú
		'manage_options', // Capacidad
		plugin_dir_path(__FILE__).'admin/main.php', // Slug
		null, // 'fn_contenido_befrases', // Mostrar contenido
		'dashicons-editor-quote',
		'2'
	);

	// Submenú opción "beFrases"
	add_submenu_page(
		plugin_dir_path(__FILE__).'admin/.php',	// Parent slug	
		'beFrases', // Título de la página
		'beFrases', // Título del menú
		'manage_options', // Capacidad
		plugin_dir_path(__FILE__).'admin/main.php', // Slug
		null // Mostrar contenido en función
	);

	// Submenú opción "beFrases"
	add_submenu_page(
		plugin_dir_path(__FILE__).'admin/main.php',	// Parent slug	
		'Gestionar', // Título de la página
		'Gestionar', // Título del menú
		'manage_options', // Capability
		plugin_dir_path(__FILE__).'admin/main.php', // Slug
		null // Mostrar contenido en función
  );
  
  // Submenú opción "Añadir frase"
	add_submenu_page(
		plugin_dir_path(__FILE__).'admin/.php',	// Parent slug	
		'Añadir frase', // Título de la página
		'Añadir frase', // Título del menú
		'manage_options', // Capacidad
		plugin_dir_path(__FILE__).'admin/add-phrase.php', // Slug
		null // Mostrar contenido en función
  );

  // Submenú opción "Eliminar frase"
	add_submenu_page(
		plugin_dir_path(__FILE__).'admin/.php',	// Parent slug	
		'Eliminar frase', // Título de la página
		'Eliminar frase', // Título del menú
		'manage_options', // Capacidad
		plugin_dir_path(__FILE__).'admin/delete-phrase.php', // Slug
		null // Mostrar contenido en función
  );
  
  // Submenú opción "Editar frase"
	add_submenu_page(
		plugin_dir_path(__FILE__).'admin/.php',	// Parent slug	
		'Editar frase', // Título de la página
		'Editar frase', // Título del menú
		'manage_options', // Capacidad
		plugin_dir_path(__FILE__).'admin/edit-phrase.php', // Slug
		null // Mostrar contenido en función
  );

  // Submenú opción "Eliminar todo"
	add_submenu_page(
		plugin_dir_path(__FILE__).'admin/.php',	// Parent slug	
		'Eliminar todo', // Título de la página
		'Eliminar todo', // Título del menú
		'manage_options', // Capacidad
		plugin_dir_path(__FILE__).'admin/delete-all-phrases.php', // Slug
		null // Mostrar contenido en función
	);

	// Submenú opción "Ajustes"
	add_submenu_page(
		plugin_dir_path(__FILE__).'admin/main.php',	// Parent slug	
		'Ajustes', // Título de la página
		'Ajustes', // Título del menú
		'manage_options', // Capacidad
		plugin_dir_path(__FILE__).'admin/settings.php', // Slug
		null // Mostrar contenido en función
	);

	// Submenú opción "Ayuda"
	add_submenu_page(
		plugin_dir_path(__FILE__).'admin/main.php',	// Parent slug	
		'Ayuda', // Título de la página
		'Ayuda', // Título del menú
		'manage_options', // Capability
		plugin_dir_path(__FILE__).'admin/help.php', // Slug
		null // Mostrar contenido en función
	);

	// Submenú opción "Acerca de.."
	add_submenu_page(
		plugin_dir_path(__FILE__).'admin/main.php',	// Parent slug	
		'Acerca de..', // Título de la página
		'Acerca de..', // Título del menú
		'manage_options', // Capability
		plugin_dir_path(__FILE__).'admin/about.php', // Slug
		null // Mostrar contenido en función
  );
  
}

/*
** ------------------------------------------
** --- *.css, *.js y Ajax ---
** ------------------------------------------
*/

/*
** --- Declaración de códigos JavaScript externos ---
*/
function fn_LlamarJS($hook) {

  global $urlMain;
  global $urlSettings;
  global $urlEditPhrase;
  global $urlAddPhrase;
  global $urlDeleteAll;
  global $urlAbout;
  global $urlHelp;

  if(($hook != $urlMain) && 
  ($hook != $urlSettings) && 
  ($hook != $urlAddPhrase) &&  
  ($hook != $urlDeleteAll) && 
  ($hook != $urlEditPhrase) &&  
  ($hook != $urlAbout) && 
  ($hook != $urlHelp)) {
		return ;
	}
	wp_enqueue_script( 'script-js1', 'https://code.jquery.com/jquery-3.5.1.js' );
	wp_enqueue_script( 'script-js2', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js' );
	wp_enqueue_script( 'script-js4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js' );
	wp_enqueue_script( 'script-js5', 'https://cdn.datatables.net/v/dt/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/r-2.2.7/datatables.min.js' );
}
add_action('admin_enqueue_scripts','fn_LlamarJS');

/*
** --- Declaración de códigos CSS externos ---
*/
function fn_LlamarCSS($hook) {

  global $urlMain;
  global $urlSettings;
  global $urlEditPhrase;
  global $urlAddPhrase;
  global $urlDeleteAll;
  global $urlAbout;
  global $urlHelp;

  if(($hook != $urlMain) && 
  ($hook != $urlSettings) && 
  ($hook != $urlAddPhrase) &&  
  ($hook != $urlDeleteAll) && 
  ($hook != $urlEditPhrase) &&  
  ($hook != $urlAbout) && 
  ($hook != $urlHelp)) {
		return ;
	}
	wp_enqueue_style( 'style-css1', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' );
	wp_enqueue_style( 'style-css2', 'https://cdn.datatables.net/v/dt/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/r-2.2.7/datatables.min.css' );
}
add_action('admin_enqueue_scripts','fn_LlamarCSS');

/*
** --- Declaración de código JavaScript propio y Ajax ---
*/
function fn_LlamarMiJavaScript($hook) {

  global $urlMain;
  global $urlSettings;
  global $urlEditPhrase;
  global $urlAddPhrase;
  global $urlDeleteAll;
  global $urlAbout;
  global $urlHelp;

  if(($hook != $urlMain) && 
  ($hook != $urlSettings) && 
  ($hook != $urlAddPhrase) &&  
  ($hook != $urlDeleteAll) && 
  ($hook != $urlEditPhrase) &&  
  ($hook != $urlAbout) && 
  ($hook != $urlHelp)) {
		return ;
	}
	wp_enqueue_script('miJs',plugins_url('admin/js/beFrases.js',__FILE__),array('jquery'));
	
	// Habilitar Ajax en Wordpress
	wp_localize_script('miJs','SolicitudesAjax',[
		'url'	=> admin_url('admin-ajax.php'),
		'seguridad'	=>	wp_create_nonce('seg')
	]);
}
add_action('admin_enqueue_scripts','fn_LlamarMiJavaScript');


/*
** ------------------------------------------
** --- Declaración del widget ---
** ------------------------------------------
*/

// Llamamos la clase donde estan las funcionalidades del widget
include_once dirname( __FILE__ ) . '/includes/beFrases-widget.php';

// Accion que inicializa el widget
add_action("widgets_init","widget_carga");

if(!function_exists("widget_carga")) {
	function widget_carga() {
		// Creamos el widget y le pasamos el nombre de la clase que alamacena las funcionalidades del widget
		register_widget("beFrases_widget");
	}
}