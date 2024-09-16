/*
 *
 * @package   				beFrases
 * @version  					2.0.0
 * @author    				Guillermo Camarena <gcamarenaprog@outlook.com>
 * @copyright 				Copyright (c) 2004 - 2023, Guillermo Camarena
 * @link      				https://gcamarenaprog.com.com/beFrases/
 * @license   				http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * 
 * @wordpress-plugin
 */


/* Functions of main.php file ------------------------------------- */

	/**
	 * Show form edit
	 * 
	 * @param {number} id Id number of the phrase
	 * @param {text} autor Author text of the phrase
	 * @param {text} phrase Phrase text of the phrase
	 * @param {number} idCategory Id number of the cateogry associated with the phrase
	 */
	function showFormEditPhrase(id, autor, phrase, idCategory){
		document.getElementById("iFormEditPhrase").style.display = "block";
		document.getElementById("iFormAddPhrase").style.display = "none";
		document.getElementById("iFormDeletePhrase").style.display = "none";
		document.getElementById('iInputEditPhraseId').value= id;
		document.getElementById('iInputEditPhraseAuthor').value= autor;
		document.getElementById('iTextAreaEditPhraseText').textContent= phrase;
		let element = document.getElementById("iSelectEditCategory");
		element.value = idCategory;    
		}

	// Hidde form edit
	function hiddeFormEditPhrase(){
		document.getElementById("iFormEditPhrase").style.display = "none";
		document.getElementById("iFormDeletePhrase").style.display = "none";
		document.getElementById("iFormAddPhrase").style.display = "block";
	}

	// Show form delete
	function showFormDeletePhrase(idPhrase, authorPhrase, contentPhrase){
		console.log(authorPhrase);
		console.log(contentPhrase);
		document.getElementById("iFormEditPhrase").style.display = "none";
		document.getElementById("iFormAddPhrase").style.display = "none";
		document.getElementById("iFormDeletePhrase").style.display = "block";
		document.getElementById('iInputDeletePhraseId').value= idPhrase;
		document.getElementById("iParagrahpDeletePhraseText").textContent = "\"" + contentPhrase + "\"";
		document.getElementById("iParagrahpDeleteAuthorText").textContent = "— " + authorPhrase;
	}

	// Hidde form delete
	function hiddeFormDeletePhrase(){
		document.getElementById("iFormEditPhrase").style.display = "none";
		document.getElementById("iFormDeletePhrase").style.display = "none";
		document.getElementById("iFormAddPhrase").style.display = "block";
	}


/* Functions of settings.php file ------------------------------------- */

	/**
	 * Check RadioButton Group 1
	 * 
	 * @param {number} alignmentAuthor Option number selected from the group of radio buttons
	 */
	function checkRadioButtonGroup1(alignmentAuthor) {
		if (alignmentAuthor == 0) {
			document.getElementById("author").style.textAlign = "right";
			document.getElementById('iRadioButton1-1').checked = true;
			}
			else if (alignmentAuthor == 1) {
			document.getElementById("author").style.textAlign = "center";
			document.getElementById('iRadioButton1-2').checked = true;
			}
			else if (alignmentAuthor == 2) {
			document.getElementById("author").style.textAlign = "left";
			document.getElementById('iRadioButton1-3').checked = true;
			}
			else {
			document.getElementById("author").style.textAlign = "justify";
			document.getElementById('iRadioButton1-4').checked = true;
			}
	}

	/**
	 * Check RadioButton Group 2
	 * 
	 * @param {number} styleAuthor Option number selected from the group of radio buttons
	 */
	function checkRadioButtonGroup2(styleAuthor) {
		if (styleAuthor == 0) {
			document.getElementById("author1").style.display = "block";
			document.getElementById("author2").style.display = "none";
			document.getElementById("author3").style.display = "none";
			document.getElementById("author4").style.display = "none";		
			document.getElementById('iRadioButton2-1').checked = true;
			}
			else if (styleAuthor == 1) {
			document.getElementById("author1").style.display = "none";
			document.getElementById("author2").style.display = "block";
			document.getElementById("author3").style.display = "none";
			document.getElementById("author4").style.display = "none";
			document.getElementById('iRadioButton2-2').checked = true;
			}
			else if (styleAuthor == 2) {
			document.getElementById("author1").style.display = "none";
			document.getElementById("author2").style.display = "none";
			document.getElementById("author3").style.display = "block";
			document.getElementById("author4").style.display = "none";
			document.getElementById('iRadioButton2-3').checked = true;
			}
			else {
			document.getElementById("author1").style.display = "none";
			document.getElementById("author2").style.display = "none";
			document.getElementById("author3").style.display = "none";
			document.getElementById("author4").style.display = "block";
			document.getElementById('iRadioButton2-4').checked = true;
			}
	}

	/**
	 * Check RadioButton Group 3
	 * 
	 * @param {number} alignmentPhrase Option number selected from the group of radio buttons
	 */
	function checkRadioButtonGroup3(alignmentPhrase) {
		if (alignmentPhrase == 0) {
			document.getElementById("phrase").style.textAlign = "right";
			document.getElementById('iRadioButton3-1').checked = true;
			}
			else if (alignmentPhrase == 1) {
			document.getElementById("phrase").style.textAlign = "center";
			document.getElementById('iRadioButton3-2').checked = true;
			}
			else if (alignmentPhrase == 2) {
			document.getElementById("phrase").style.textAlign = "left";
			document.getElementById('iRadioButton3-3').checked = true;
			}
			else {
			document.getElementById("phrase").style.textAlign = "justify";
			document.getElementById('iRadioButton3-4').checked = true;
			}
	}

	/**
	 * Check RadioButton Group 4
	 * 
	 * @param {number} stylePhrase Option number selected from the group of radio buttons
	 */
	function checkRadioButtonGroup4(stylePhrase) {
		if (stylePhrase == 0) {
			document.getElementById("phrase1").style.display = "block";
			document.getElementById("phrase2").style.display = "none";
			document.getElementById("phrase3").style.display = "none";
			document.getElementById("phrase4").style.display = "none";
			document.getElementById('iRadioButton4-1').checked = true;
			}
			else if (stylePhrase == 1) {
			document.getElementById("phrase1").style.display = "none";
			document.getElementById("phrase2").style.display = "block";
			document.getElementById("phrase3").style.display = "none";
			document.getElementById("phrase4").style.display = "none";
			document.getElementById('iRadioButton4-2').checked = true;
			}
			else if (stylePhrase == 2) {
			document.getElementById("phrase1").style.display = "none";
			document.getElementById("phrase2").style.display = "none";
			document.getElementById("phrase3").style.display = "block";
			document.getElementById("phrase4").style.display = "none";
			document.getElementById('iRadioButton4-3').checked = true;
			}
			else {
			document.getElementById("phrase1").style.display = "none";
			document.getElementById("phrase2").style.display = "none";
			document.getElementById("phrase3").style.display = "none";
			document.getElementById("phrase4").style.display = "block";
			document.getElementById('iRadioButton4-4').checked = true;
			}
	}

	/**
	 * Change align of author for demo section
	 * 
	 * @type void
	 * @param none
	 * @return none
	 */
	function changeAlignAuthor(){
		var element = document.getElementsByName('nRadioButton1');     
		for (i = 0; i < element.length; i++) {
			if (element[i].checked) {
				if (i == 0) {
					document.getElementById("author").style.textAlign = "right";
				}
				else if (i == 1) {
					document.getElementById("author").style.textAlign = "center";
				}
				else if (i == 2) {
					document.getElementById("author").style.textAlign = "left";
				}
				else {
					document.getElementById("author").style.textAlign = "justify";
				}
			}      
		}
	}

	/**
	 * Change align of phrase for demo section
	 * 
	 * @type void
	 * @param none
	 * @return none
	 */
	function changeAlignPhrase(){
		var element = document.getElementsByName('nRadioButton3');     
		for (i = 0; i < element.length; i++) {
			if (element[i].checked) {
				if (i == 0) {
					document.getElementById("phrase").style.textAlign = "right";
				}
				else if (i == 1) {
					document.getElementById("phrase").style.textAlign = "center";
				}
				else if (i == 2) {
					document.getElementById("phrase").style.textAlign = "left";
				}
				else {
					document.getElementById("phrase").style.textAlign = "justify";
				}
			}      
		}
	}

	/**
	 * Change styles of author and phrase text for demo section
	 * 
	 * @type void
	 * @param none
	 * @return none
	 */
	function changeStyleAuthor(){
		var element = document.getElementsByName('nRadioButton2');   
		for (i = 0; i < element.length; i++) {
			if (element[i].checked) {

				if (i == 0) {
					document.getElementById("author1").style.display = "block";
					document.getElementById("author2").style.display = "none";
					document.getElementById("author3").style.display = "none";
					document.getElementById("author4").style.display = "none";
				}
				else if (i == 1) {
					document.getElementById("author1").style.display = "none";
					document.getElementById("author2").style.display = "block";
					document.getElementById("author3").style.display = "none";
					document.getElementById("author4").style.display = "none";
				}
				else if (i == 2) {
					document.getElementById("author1").style.display = "none";
					document.getElementById("author2").style.display = "none";
					document.getElementById("author3").style.display = "block";
					document.getElementById("author4").style.display = "none";
				}
				else {
					document.getElementById("author1").style.display = "none";
					document.getElementById("author2").style.display = "none";
					document.getElementById("author3").style.display = "none";
					document.getElementById("author4").style.display = "block";
				}
			}      
		}
	}

	/**
	 * Change styles of phrase and phrase text for demo section
	 * 
	 * @type void
	 * @param none
	 * @return none
	 */
	function changeStylePhrase(){
		var element = document.getElementsByName('nRadioButton4');     
		for (i = 0; i < element.length; i++) {
			if (element[i].checked) {

				if (i == 0) {
					document.getElementById("phrase1").style.display = "block";
					document.getElementById("phrase2").style.display = "none";
					document.getElementById("phrase3").style.display = "none";
					document.getElementById("phrase4").style.display = "none";
				}
				else if (i == 1) {
					document.getElementById("phrase1").style.display = "none";
					document.getElementById("phrase2").style.display = "block";
					document.getElementById("phrase3").style.display = "none";
					document.getElementById("phrase4").style.display = "none";
				}
				else if (i == 2) {
					document.getElementById("phrase1").style.display = "none";
					document.getElementById("phrase2").style.display = "none";
					document.getElementById("phrase3").style.display = "block";
					document.getElementById("phrase4").style.display = "none";
				}
				else {
					document.getElementById("phrase1").style.display = "none";
					document.getElementById("phrase2").style.display = "none";
					document.getElementById("phrase3").style.display = "none";
					document.getElementById("phrase4").style.display = "block";
				}
			}      
		}
	}


/* Functions of categories.php file ------------------------------------- */

	/**
	 * Show form delete
	 * 
	 * @param {number} id of the category to delete
	 * @param {string} name of the category to delete
	 * @return none
	 */
	function showFormDeleteCategory(categoryId, categoryName, totalPhrasesCategory){
		document.getElementById("iFormEditCategory").style.display = "none";
		document.getElementById("iFormAddCategory").style.display = "none";
		document.getElementById("iFormDeleteCategory").style.display = "block";
		document.getElementById('iInputDeleteCategoryId').value= categoryId;

		if(totalPhrasesCategory != 0){
			document.getElementById("iButtonDeleteCategory").style.display = "none";			
			document.getElementById("iButtonCancelDeleteCategory").style.display = "none";	
			document.getElementById("iButtonAcceptDeleteCategory").style.display = "block";					
			document.getElementById("iCardDeleteMessageTitleMessage").textContent = "¡Error al intentar eliminar!";
			document.getElementById("iCardDeleteMessageParagrahpMessage").textContent = "Tiene registros, no es posible eliminar la categoría: ";	
			$('#iCardDeleteMessageParagrahpMessage').append('<strong>' + categoryName + '</strong>');		
		}
 		if(categoryId == 1){
			document.getElementById("iButtonDeleteCategory").style.display = "none";			
			document.getElementById("iButtonCancelDeleteCategory").style.display = "none";	
			document.getElementById("iButtonAcceptDeleteCategory").style.display = "block";

			document.getElementById("iCardDeleteMessageTitleMessage").textContent = "¡Error al intentar eliminar!";
			document.getElementById("iCardDeleteMessageParagrahpMessage").textContent = "No es posible eliminar la categoría: ";
			$('#iCardDeleteMessageParagrahpMessage').append('<strong>' + categoryName + '</strong>');	
		}
		
		if(totalPhrasesCategory == 0) {
			document.getElementById("iButtonDeleteCategory").style.display = "block";			
			document.getElementById("iButtonCancelDeleteCategory").style.display = "block";	
			document.getElementById("iButtonAcceptDeleteCategory").style.display = "none";
			document.getElementById("iCardDeleteMessageTitleMessage").textContent = "¿Seguro de eliminar la categoría?";
			document.getElementById("iCardDeleteMessageParagrahpMessage").textContent = "Se eliminará de forma permanente la categoría con nombre: ";
			$('#iCardDeleteMessageParagrahpStrongMessage').append('<strong>' + categoryName + '</strong>');
		} 
	}

	/**
	 * Hidde form delete
	 * 
	 * @type void
	 * @param none
	 * @return none
	 */
	function hiddeFormDeleteCategory(){
		document.getElementById("iFormEditCategory").style.display = "none";
		document.getElementById("iFormDeleteCategory").style.display = "none";
		document.getElementById("iFormAddCategory").style.display = "block";
	}

	/**
	 * Show form edit
	 * 
	 * @param {number} id of the category to edit
	 * @param {string} name of the category to edit
	 * @param {string} description of the category to edit
	 * @return none
	 */
	function showFormEditCategory(id, name, description){
		document.getElementById("iFormEditCategory").style.display = "block";
		document.getElementById("iFormAddCategory").style.display = "none";
		document.getElementById("iFormDeleteCategory").style.display = "none";
		document.getElementById('iInputEditCategoryId').value= id;
		document.getElementById('iInputEditCategoryName').value= name;
		document.getElementById('iTextAreaEditCategoryDescription').textContent= description;
	}

	/**
	 * Hidde form edit
	 * 
	 * @type void
	 * @param none
	 * @return none
	 */
	function hiddeFormEditCategory(){
		document.getElementById("iFormEditCategory").style.display = "none";
		document.getElementById("iFormDeleteCategory").style.display = "none";
		document.getElementById("iFormAddCategory").style.display = "block";
	}