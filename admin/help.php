<?php
/*
 * Help plugin option
 *
 * @package   				beFrases
 * @version  					2.0.0
 * @author    				Guillermo Camarena <gcamarenaprog@outlook.com>
 * @copyright 				Copyright (c) 2004 - 2023, Guillermo Camarena
 * @link      				https://gcamarenaprog.com/beFrases/
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
		<p class="lead">Aquí podrás encontrar información de ayuda sobre el uso de beFrases</p>

		<hr>

		<!-- Content -->
		<div class="row">
			<div class="col">

			<p class="be-description"><strong>¿Cómo añadir una frase?</strong> </p>
			<p class="be-description">
				La opción del menú: <strong>'Administrar' -> 'Añadir frase'</strong> 
			</p>

			<hr>

			<p class="be-description"><strong>¿Cómo editar una frase?</strong> </p>
			<p class="be-description">
				La opción del menú: <strong>'Administrar' -> 'Lista de frases' -> 'Campo Editar'</strong> 
			</p>
			</p>

			<hr>

			<p class="be-description"><strong>¿Cómo eliminar una frase?</strong> </p>
			<p class="be-description">
				La opción del menú: <strong>'Administrar' -> 'Lista de frases' -> 'Campo Eliminar'</strong> 
			</p>
			</p>

			<hr>

			<p class="be-description"><strong>¿Cómo eliminar todas las frases?</strong> </p>
			<p class="be-description">
				La opción del menú: <strong>'Administrar' -> 'Eliminar todo'</strong> 
			</p>
			</p>

			<hr>

			<p class="be-description"><strong>¿Cómo puedo buscar palabras en las frases?</strong> </p>
			<p class="be-description">
				La opción del menú: <strong>'Administrar' -> 'Lista de frases' -> 'Campo de búsqueda'</strong>, filtra los datos
				por: <strong>autor, frase y categoría.</strong> 
			</p>

			<hr>

			<p class="be-description"><strong>¿Cómo agregar una nueva categoría?</strong> </p>
			<p class="be-description">
				La opción del menú: <strong>'Categorías'</strong>, completa los campos: <strong>nombre y  descripción.</strong> 
			</p>

			<hr>

			</div>
		</div>

	</div>
<!-- HTML Code /-->