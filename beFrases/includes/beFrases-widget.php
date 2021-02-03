<?php
/*
** ==========================================
** ### beFrases                           ###
** ### Version: 1.0                       ###
** ### Clase widget para beFrases         ###
** ==========================================
*/

// Evitar que se pueda ejecutar código PHP insertando la ruta en la barra del navegador
defined('ABSPATH') or die("Bye bye");

/*
** ------------------------------------------
** --- Clase para administrar el Widget   ---
** ------------------------------------------
*/
class beFrases_widget extends WP_Widget {

  /*
  ** --- Función constructor de la clase ---
  */
  public function __construct() {      
    // $this->WP_Widget($id_base,   $name             ,$widget_options);
    parent::__construct('css_id'  , 'beFrases', array("classname" => "clase-del-widget", "description" => "Una frase aleatoria del repositorio de frases."));
  }

  /*
  ** --- Función para crear el cuerpo del widget ---
  */
  public function form($instance) {      
    $defaults = array("titulo" => "Frase del día");      
    // A la variable instance le agregamos el array $defaults el cual contiene el titulo
    $instance = wp_parse_args((array)$instance,$defaults);
    $tituloWidget = esc_attr($instance["titulo"]);
    ?>
    <!--Dibujamos el cuerpo del widget-->
    <p>Título : <input type="text" name="<?php echo $this->get_field_name("titulo");?>" value="<?php echo $tituloWidget;?>" class="widefat" /></p>
    <?php
  }
   
  /*
  ** --- Función para actualizar los cambios al guardar ---
  */
  public function update($new_instance,$old_instance) {
  
    // Inicializamos la instancia con el valor anterior
    $instance = $old_instance;
  
    // Actualizamos la instancia con el nuevo valor
    $instance["titulo"] = strip_tags($new_instance["titulo"]);
  
    // Retornamos la instancia con el nuevo valor
    return $instance;
  }

  /*
  ** --- Función para mostrar el Widget en el Frontend ---
  */
  public function widget($args,$instance) {

    global $wpdb;

    // Extraemos los argumentos before_widget, after_widget, before_title, after_title
    extract($args);
      
    // Extraemos el valor previamente gurdado en titulo
    $tituloWidget = apply_filters('widget_title',$instance['titulo']);
            
    // Obtenemos la lista de frases de la base de datos
    $queryFrases = "SELECT * FROM {$wpdb -> prefix}befrases";
    $listaFrases = $wpdb -> get_results($queryFrases,ARRAY_A);

    // Si no hay registros
    if(empty($listaFrases)) {      

      // Dibujamos como queremos que se muestre el widget
      echo $before_widget;
      echo $before_title.$tituloWidget.$after_title;
      echo "<p>No hay registros para mostrar.</p>";
      echo $after_widget;
    }

    // Si hay registros
    else {

      //Extraemos los argumentos before_widget,after_widget,before_title,after_title
      extract($args);
        
      // Extraemos el valor previamente gurdado en titulo
      $tituloWidget = apply_filters('widget_title',$instance['titulo']);

      // Número máximo de elementos
      $maxElementos = count($listaFrases, 0);

      // Valor random
      $valorRandom = random_int( 0 , $maxElementos-1);

      // Obtención de un registro de manera aleatoria
      $registroExtraido = $listaFrases[$valorRandom];

      // Obtención de frase y autor del registro extraído
      $autorRegistroExtraido = $registroExtraido['befrases_autor'];
      $fraseRegistroExtraido = $registroExtraido['befrases_frase'];
    
      // Dibujamos como queremos que se muestre el widget
      echo $before_widget;
      echo $before_title.$tituloWidget.$after_title; 

      // Obtención de opciones de la base de datos
      $queryOpciones = "SELECT * FROM {$wpdb -> prefix}befrases_opt";
      $listaOpciones = $wpdb -> get_results($queryOpciones,ARRAY_A);

      $alineacionTextoAutor;
      $estiloTextoAutor;
      $alienacionTextoFrase;
      $estiloTextoFrase;

      // Si hay opciones con valor null
      if( ( $listaOpciones[0]['befrases_ali_tex_aut'] == null ) || ( $listaOpciones[0]['befrases_est_tex_aut'] == null ) || ( $listaOpciones[0]['befrases_ali_tex_fra'] == null )  || ( $listaOpciones[0]['befrases_est_tex_fra'] == null ) ) {
        
        // Inicializamos los valores predeterminados
        $alineacionTextoAutor =  3;
        $estiloTextoAutor =  1;
        $alienacionTextoFrase =  1;
        $estiloTextoFrase =  1;
 
        // Guardamos valores predeterminados en la base de datos
        $datos = [
          'befrases_ajustes_id' => 1,
          'befrases_ali_tex_aut' => $alineacionTextoAutor,
          'befrases_est_tex_aut' => $estiloTextoAutor,
          'befrases_ali_tex_fra' => $alienacionTextoFrase,
          'befrases_est_tex_fra' => $estiloTextoFrase,
        ];
        $tablaOpciones = "{$wpdb -> prefix}befrases_opt";
        $wpdb -> replace($tablaOpciones, $datos);

        echo "<div style=\"text-align: right;\">"; echo $fraseRegistroExtraido; echo "</div>";
        echo "<div style=\"text-align: right;\">"; echo "<b><em> — "; echo $autorRegistroExtraido; echo "</em></b> </div>";
        echo $after_widget; 
      }
      
      // Si hay opciones
      else {
        // Obtenermos los valores de opciones de la base de datos
        $alineacionTextoAutor =  $listaOpciones[0]['befrases_ali_tex_aut'];
        $estiloTextoAutor =  $listaOpciones[0]['befrases_est_tex_aut'];
        $alienacionTextoFrase =  $listaOpciones[0]['befrases_ali_tex_fra'];
        $estiloTextoFrase =  $listaOpciones[0]['befrases_est_tex_fra'];
        
        // Si la opción personalizar estilo de texto está habilitada
      
        if($alineacionTextoAutor == 1) {     
          $ata = "right";
        }elseif ($alineacionTextoAutor == 2) {
          $ata = "center";
        }elseif ($alineacionTextoAutor == 3) {
          $ata = "left";
        }else{
          $ata = "justify";
        } 
  
        if($alienacionTextoFrase == 1){     
          $atf = "right";
        }elseif ($alienacionTextoFrase == 2) {
          $atf = "center";
        }elseif ($alienacionTextoFrase == 3) {
          $atf = "left";
        }else{
          $atf = "justify";
        }
            
        if($estiloTextoAutor == 1){     
          $eta1 = "—";
          $eta2 = "";
        }elseif ($estiloTextoAutor == 2) {
          $eta1 = "<em>— ";
          $eta2 = "</em>";
        }elseif ($estiloTextoAutor == 3) {
          $eta1 = "<b>— ";
          $eta2 = "</b>";
        }else{
          $eta1 = "<b><em>— ";
          $eta2 = "</em></b>";
        }
  
        if($estiloTextoFrase == 1){     
          $etf1 = "<p style=\"padding: 0px;word-wrap: break-word;line-height: 22px;font-weight: 300;color: #000000;text-shadow: 0px 0px 0px #000000;font-size: 1.15rem;font-style: italic;\">";
          $etf2 = "</p>";
        }elseif ($estiloTextoFrase == 2) {
          $etf1 = "<p style=\"padding-bottom: 0px;\"><em>";
          $etf2 = "</em></p>";
        }elseif ($estiloTextoFrase == 3) {
          $etf1 = "<b style=\"padding-bottom: 0px;line-height: 22px;font-weight: 400;text-align: justify;margin-bottom: 20px;color: #000000;text-shadow: 0px 0px 0px #000000;font-size: 1.19rem;\">";
          $etf2 = "</b>";
        }else{
          $etf1 = "<b style=\"padding-bottom: 0px;\"><em>";
          $etf2 = "</em></b>";
        }

        

        echo "<div style=\"text-align:"; echo $atf; echo "\">";
        echo $etf1; echo $fraseRegistroExtraido; echo $etf2;
        echo "</div>";            
        echo "<div style=\"text-align:"; echo $ata; echo "\">";
        echo $eta1; echo $autorRegistroExtraido; echo $eta2;
        echo "</div>";         
        echo $after_widget; 
      }
    }         
  }
}