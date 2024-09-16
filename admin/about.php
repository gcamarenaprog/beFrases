<?php
/*
 * About plugin option
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
  ?>
<!-- PHP Code /-->


<!-- HTML Code -->
  <div class="container-fluid">

    <!-- Title and description -->
    <h1 class="display-6"><?php echo get_admin_page_title(); ?></h1>
    <p class="lead">
      ¡beFrases, un plugin simple y fácil de usar que te permitirá frases con sus autores y asignarles una categoría. 
      Con la opción de mostrarlas en un widget de manera aleatoria!
    </p>

    <hr>

    <!-- Content -->
    <div class="row">
      <div class="col-md-2">

        <p class="be-description"><strong>Autor:</strong></p>
        <p class="be-description"><strong>Correo:</strong></p>
        <p class="be-description"><strong>Sito Web:</strong></p>
        <p class="be-description"><strong>Facebook:</strong></p>
        <p class="be-description"><strong>Twitter:</strong></p>
        <p class="be-description"><strong>Linkedin:</strong></p>
        <p class="be-description"><strong>Github:</strong></p>

      </div>

      <div class="col-md-10">

        <p class="be-description">Guillermo Camarena.</p>
        <p class="be-description"><a href="mailto:gcamarenaprog@outlook.com">gcamarenaprog@outlook.com</a></p>
        <p class="be-description"><a href="https://gacamarenaprog.com/" target="_blank">gacamarenaprog.com</a></p>
        <p class="be-description"><a href="https://www.facebook.com/guillermocamarenaprog/" target="_blank">facebook.com/guillermocamarenaprog</a></p>
        <p class="be-description"><a href="https://twitter.com/GCamarenaProg" target="_blank">@GCamarenaProg</a></p>
        <p class="be-description"><a href="https://github.com/gcamarenaprog" target="_blank">github.com/gcamarenaprog</a></p>
        <p class="be-description"><a href="https://www.linkedin.com/in/guillermo-camarena-57a25b134/" target="_blank">linkedin.com/in/guillermo-camarena</a></p>

      </div>
    </div>

    <hr>

    <!-- Phrase -->
    <figure class="text-center">
      <blockquote class="blockquote">
      <p class="be-quote">"Vivimos una grandiosa novela, en un gran teatro, montado por gente inteligente que le gusta jugar a las marionetas".</p>
      </blockquote>
      <figcaption class="blockquote-footer">
        Guillermo Camarena<cite title="Source Title"> / Desarrollador Full-Stack, Investigador, Pódcaster y Bloguero de Fenómenos Forteanos</cite>
      </figcaption>
    </figure>

  </div>
<!-- HTML Code /-->