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


/* Functions of main.php file --------------------------------------------------------------------------------------- */

/**
 * Show form edit quote
 *
 * @param {number} id Id number of the quote
 * @param {text} autor Author text of the quote
 * @param {text} quote Quote text of the quote
 * @param {number} idCategory Id number of the cateogry associated with the quote
 * @return none
 */
function showFormEditQuote(id, autor, quote, idCategory) {
  document.getElementById("iFormEditQuote").style.display = "block";
  document.getElementById("iFormAddQuote").style.display = "none";
  document.getElementById("iFormDeleteQuote").style.display = "none";
  document.getElementById('iInputEditQuoteId').value = id;
  document.getElementById('iInputEditQuoteAuthor').value = autor;
  document.getElementById('iTextAreaEditQuoteText').textContent = quote;
  let element = document.getElementById("iSelectEditCategory");
  element.value = idCategory;
}

/**
 * Hidde form edit quote
 *
 * @return none
 */
function hiddeFormEditQuote() {
  document.getElementById("iFormEditQuote").style.display = "none";
  document.getElementById("iFormDeleteQuote").style.display = "none";
  document.getElementById("iFormAddQuote").style.display = "block";
}

/**
 * Show form delete quote
 *
 * @param idQuote
 * @param authorQuote
 * @param contentQuote
 */
function showFormDeleteQuote(idQuote, authorQuote, contentQuote) {
  console.log(authorQuote);
  console.log(contentQuote);
  document.getElementById("iFormEditQuote").style.display = "none";
  document.getElementById("iFormAddQuote").style.display = "none";
  document.getElementById("iFormDeleteQuote").style.display = "block";
  document.getElementById('iInputDeleteQuoteId').value = idQuote;
  document.getElementById("iParagrahpDeleteQuoteText").textContent = "\"" + contentQuote + "\"";
  document.getElementById("iParagrahpDeleteAuthorText").textContent = "— " + authorQuote;
}

/**
 * Hidde form delete quote
 *
 * @return none
 */
function hiddeFormDeleteQuote() {
  document.getElementById("iFormEditQuote").style.display = "none";
  document.getElementById("iFormDeleteQuote").style.display = "none";
  document.getElementById("iFormAddQuote").style.display = "block";
}


/* Functions of settings.php file ----------------------------------------------------------------------------------- */

/**
 * Check RadioButton Group 1
 *
 * @param {number} alignmentAuthor Option number selected from the group of radio buttons
 */
function checkRadioButtonGroup1(alignmentAuthor) {
  if (alignmentAuthor == 0) {
    document.getElementById("author").style.textAlign = "right";
    document.getElementById('iRadioButton1-1').checked = true;
  } else if (alignmentAuthor == 1) {
    document.getElementById("author").style.textAlign = "center";
    document.getElementById('iRadioButton1-2').checked = true;
  } else if (alignmentAuthor == 2) {
    document.getElementById("author").style.textAlign = "left";
    document.getElementById('iRadioButton1-3').checked = true;
  } else {
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
  } else if (styleAuthor == 1) {
    document.getElementById("author1").style.display = "none";
    document.getElementById("author2").style.display = "block";
    document.getElementById("author3").style.display = "none";
    document.getElementById("author4").style.display = "none";
    document.getElementById('iRadioButton2-2').checked = true;
  } else if (styleAuthor == 2) {
    document.getElementById("author1").style.display = "none";
    document.getElementById("author2").style.display = "none";
    document.getElementById("author3").style.display = "block";
    document.getElementById("author4").style.display = "none";
    document.getElementById('iRadioButton2-3').checked = true;
  } else {
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
 * @param {number} alignmentQuote Option number selected from the group of radio buttons
 */
function checkRadioButtonGroup3(alignmentQuote) {
  if (alignmentQuote == 0) {
    document.getElementById("quote").style.textAlign = "right";
    document.getElementById('iRadioButton3-1').checked = true;
  } else if (alignmentQuote == 1) {
    document.getElementById("quote").style.textAlign = "center";
    document.getElementById('iRadioButton3-2').checked = true;
  } else if (alignmentQuote == 2) {
    document.getElementById("quote").style.textAlign = "left";
    document.getElementById('iRadioButton3-3').checked = true;
  } else {
    document.getElementById("quote").style.textAlign = "justify";
    document.getElementById('iRadioButton3-4').checked = true;
  }
}

/**
 * Check RadioButton Group 4
 *
 * @param {number} styleQuote Option number selected from the group of radio buttons
 */
function checkRadioButtonGroup4(styleQuote) {
  if (styleQuote == 0) {
    document.getElementById("quote1").style.display = "block";
    document.getElementById("quote2").style.display = "none";
    document.getElementById("quote3").style.display = "none";
    document.getElementById("quote4").style.display = "none";
    document.getElementById('iRadioButton4-1').checked = true;
  } else if (styleQuote == 1) {
    document.getElementById("quote1").style.display = "none";
    document.getElementById("quote2").style.display = "block";
    document.getElementById("quote3").style.display = "none";
    document.getElementById("quote4").style.display = "none";
    document.getElementById('iRadioButton4-2').checked = true;
  } else if (styleQuote == 2) {
    document.getElementById("quote1").style.display = "none";
    document.getElementById("quote2").style.display = "none";
    document.getElementById("quote3").style.display = "block";
    document.getElementById("quote4").style.display = "none";
    document.getElementById('iRadioButton4-3').checked = true;
  } else {
    document.getElementById("quote1").style.display = "none";
    document.getElementById("quote2").style.display = "none";
    document.getElementById("quote3").style.display = "none";
    document.getElementById("quote4").style.display = "block";
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
function changeAlignAuthor() {
  var element = document.getElementsByName('nRadioButton1');
  for (i = 0; i < element.length; i++) {
    if (element[i].checked) {
      if (i == 0) {
        document.getElementById("author").style.textAlign = "right";
      } else if (i == 1) {
        document.getElementById("author").style.textAlign = "center";
      } else if (i == 2) {
        document.getElementById("author").style.textAlign = "left";
      } else {
        document.getElementById("author").style.textAlign = "justify";
      }
    }
  }
}

/**
 * Change align of quote for demo section
 *
 * @type void
 * @param none
 * @return none
 */
function changeAlignQuote() {
  var element = document.getElementsByName('nRadioButton3');
  for (i = 0; i < element.length; i++) {
    if (element[i].checked) {
      if (i == 0) {
        document.getElementById("quote").style.textAlign = "right";
      } else if (i == 1) {
        document.getElementById("quote").style.textAlign = "center";
      } else if (i == 2) {
        document.getElementById("quote").style.textAlign = "left";
      } else {
        document.getElementById("quote").style.textAlign = "justify";
      }
    }
  }
}

/**
 * Change styles of author and quote text for demo section
 *
 * @type void
 * @param none
 * @return none
 */
function changeStyleAuthor() {
  var element = document.getElementsByName('nRadioButton2');
  for (i = 0; i < element.length; i++) {
    if (element[i].checked) {

      if (i == 0) {
        document.getElementById("author1").style.display = "block";
        document.getElementById("author2").style.display = "none";
        document.getElementById("author3").style.display = "none";
        document.getElementById("author4").style.display = "none";
      } else if (i == 1) {
        document.getElementById("author1").style.display = "none";
        document.getElementById("author2").style.display = "block";
        document.getElementById("author3").style.display = "none";
        document.getElementById("author4").style.display = "none";
      } else if (i == 2) {
        document.getElementById("author1").style.display = "none";
        document.getElementById("author2").style.display = "none";
        document.getElementById("author3").style.display = "block";
        document.getElementById("author4").style.display = "none";
      } else {
        document.getElementById("author1").style.display = "none";
        document.getElementById("author2").style.display = "none";
        document.getElementById("author3").style.display = "none";
        document.getElementById("author4").style.display = "block";
      }
    }
  }
}

/**
 * Change styles of quote and quote text for demo section
 *
 * @type void
 * @param none
 * @return none
 */
function changeStyleQuote() {
  var element = document.getElementsByName('nRadioButton4');
  for (i = 0; i < element.length; i++) {
    if (element[i].checked) {

      if (i == 0) {
        document.getElementById("quote1").style.display = "block";
        document.getElementById("quote2").style.display = "none";
        document.getElementById("quote3").style.display = "none";
        document.getElementById("quote4").style.display = "none";
      } else if (i == 1) {
        document.getElementById("quote1").style.display = "none";
        document.getElementById("quote2").style.display = "block";
        document.getElementById("quote3").style.display = "none";
        document.getElementById("quote4").style.display = "none";
      } else if (i == 2) {
        document.getElementById("quote1").style.display = "none";
        document.getElementById("quote2").style.display = "none";
        document.getElementById("quote3").style.display = "block";
        document.getElementById("quote4").style.display = "none";
      } else {
        document.getElementById("quote1").style.display = "none";
        document.getElementById("quote2").style.display = "none";
        document.getElementById("quote3").style.display = "none";
        document.getElementById("quote4").style.display = "block";
      }
    }
  }
}


/* Functions of categories.php file --------------------------------------------------------------------------------- */

/**
 * Show form delete
 *
 * @param {number} id of the category to delete
 * @param {string} name of the category to delete
 * @return none
 */
function showFormDeleteCategory(categoryId, categoryName, totalQuotesCategory) {
  document.getElementById("iFormEditCategory").style.display = "none";
  document.getElementById("iFormAddCategory").style.display = "none";
  document.getElementById("iFormDeleteCategory").style.display = "block";
  document.getElementById('iInputDeleteCategoryId').value = categoryId;

  if (totalQuotesCategory != 0) {
    document.getElementById("iButtonDeleteCategory").style.display = "none";
    document.getElementById("iButtonCancelDeleteCategory").style.display = "none";
    document.getElementById("iButtonAcceptDeleteCategory").style.display = "block";
    document.getElementById("iCardDeleteMessageTitleMessage").textContent = "¡Error al intentar eliminar!";
    document.getElementById("iCardDeleteMessageParagrahpMessage").textContent = "Tiene registros, no es posible eliminar la categoría: ";
    $('#iCardDeleteMessageParagrahpMessage').append('<strong>' + categoryName + '</strong>');
  }
  if (categoryId == 1) {
    document.getElementById("iButtonDeleteCategory").style.display = "none";
    document.getElementById("iButtonCancelDeleteCategory").style.display = "none";
    document.getElementById("iButtonAcceptDeleteCategory").style.display = "block";
    document.getElementById("iCardDeleteMessageTitleMessage").textContent = "¡Error al intentar eliminar!";
    document.getElementById("iCardDeleteMessageParagrahpMessage").textContent = "No es posible eliminar la categoría: ";
    $('#iCardDeleteMessageParagrahpMessage').append('<strong>' + categoryName + '</strong>');
  }

  if (totalQuotesCategory == 0) {
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
function hiddeFormDeleteCategory() {
  document.getElementById("iFormEditCategory").style.display = "none";
  document.getElementById("iFormDeleteCategory").style.display = "none";
  document.getElementById("iFormAddCategory").style.display = "block";
}

/**
 * Show form edit category
 *
 * @param {number} id of the category to edit
 * @param {string} name of the category to edit
 * @param {string} description of the category to edit
 * @return none
 */
function showFormEditCategory(id, name, description) {
  document.getElementById("iFormEditCategory").style.display = "block";
  document.getElementById("iFormAddCategory").style.display = "none";
  document.getElementById("iFormDeleteCategory").style.display = "none";
  document.getElementById('iInputEditCategoryId').value = id;
  document.getElementById('iInputEditCategoryName').value = name;
  document.getElementById('iTextAreaEditCategoryDescription').textContent = description;
}

/**
 * Hidde form edit category
 *
 * @type void
 * @param none
 * @return none
 */
function hiddeFormEditCategory() {
  document.getElementById("iFormEditCategory").style.display = "none";
  document.getElementById("iFormDeleteCategory").style.display = "none";
  document.getElementById("iFormAddCategory").style.display = "block";
}