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
 * @param {string} quoteId Id number of the quote
 * @param {string} autorId Author text of the quote
 * @param {string} quoteText Quote text of the quote
 * @param {string} idCategory Id number of the category associated with the quote
 * @return none
 */
function showFormEditQuote(quoteId, autorId, quoteText, categoryId) {
  document.getElementById("iFormEditQuote").style.display = "block";
  document.getElementById("iFormAddQuote").style.display = "none";
  document.getElementById("iFormDeleteQuote").style.display = "none";
  document.getElementById('iInputEditQuoteId').value = quoteId;
  document.getElementById('iTextAreaEditQuoteText').textContent = quoteText;
  document.getElementById("iSelectEditAuthor").value = autorId;
  document.getElementById("iSelectEditCategory").value = categoryId;
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
  document.getElementById("iFormEditQuote").style.display = "none";
  document.getElementById("iFormAddQuote").style.display = "none";
  document.getElementById("iFormDeleteQuote").style.display = "block";
  document.getElementById('iInputDeleteQuoteId').value = idQuote;
  document.getElementById("iDeleteQuoteText").textContent = "\"" + contentQuote + "\"";
  document.getElementById("iDeleteAuthorText").textContent = "— " + authorQuote;
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


/* Categories functions --------------------------------------------------------------------------------------------- */

/**
 * Show form delete
 *
 * @return none
 * @param {string} categoryId
 * @param {string} categoryName
 * @param {string} totalQuotesCategory
 * @param {string} categoryDescription
 */
function showFormDeleteCategory(categoryId, categoryName, categoryDescription, totalQuotesCategory) {

  if (totalQuotesCategory != 0  && categoryId != 1) {
    console.log('1')
    document.getElementById("iFormEditCategory").style.display = "none";
    document.getElementById("iFormAddCategory").style.display = "none";
    document.getElementById("iFormDeleteCategory").style.display = "block";
    document.getElementById('iInputDeleteCategoryId').value = categoryId;
    document.getElementById('iTextDeleteCategoryTitleName').textContent = "¡Error al intentar eliminar!";
    document.getElementById('iTextDeleteCategoryName').textContent = "La categoría tiene frases asociadas.";
    document.getElementById('iTextDeleteCategoryDescription').style.display = "none";
    document.getElementById('iTextDeleteCategoryTitleDescription').style.display = "none";
  }

  if (categoryId == 1) {
    console.log('2')
    document.getElementById("iFormEditCategory").style.display = "none";
    document.getElementById("iFormAddCategory").style.display = "none";
    document.getElementById("iFormDeleteCategory").style.display = "block";
    document.getElementById('iInputDeleteCategoryId').value = categoryId;
    document.getElementById('iTextDeleteCategoryTitleName').textContent = "¡Error al intentar eliminar!";
    document.getElementById('iTextDeleteCategoryName').textContent = "No es posible eliminar esta categoría.";
    document.getElementById('iTextDeleteCategoryDescription').style.display = "none";
    document.getElementById('iTextDeleteCategoryTitleDescription').style.display = "none";
  }

  if (totalQuotesCategory == 0 && categoryId != 1) {
    console.log('3')
    document.getElementById("iFormEditCategory").style.display = "none";
    document.getElementById("iFormAddCategory").style.display = "none";
    document.getElementById("iFormDeleteCategory").style.display = "block";
    document.getElementById('iInputDeleteCategoryId').value = categoryId;
    document.getElementById('iTextDeleteCategoryTitleName').textContent = "Nombre";
    document.getElementById('iTextDeleteCategoryName').textContent = categoryName;
    document.getElementById('iTextDeleteCategoryTitleDescription').style.display = "Descripción";
    document.getElementById('iTextDeleteCategoryDescription').textContent = categoryDescription;
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
 * @param {string} categoryId Id number of the category
 * @param {string} categoryName of the category to edit
 * @param {string} categoryDescription of the category to edit
 * @return none
 */
function showFormEditCategory(categoryId, categoryName, categoryDescription) {
  console.log(categoryId)
  console.log(categoryName)
  console.log(categoryDescription)

  document.getElementById("iFormEditCategory").style.display = "block";
  document.getElementById("iFormAddCategory").style.display = "none";
  document.getElementById("iFormDeleteCategory").style.display = "none";
  document.getElementById('iInputEditCategoryId').value = categoryId;
  document.getElementById('iInputEditCategoryName').value = categoryName;
  document.getElementById('iTextAreaEditCategoryDescription').textContent = categoryDescription;
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


/* Authors functions ------------------------------------------------------------------------------------------------ */

/**
 * Show form delete
 *
 * @return none
 * @param {string} authorId
 * @param {string} authorName
 * @param {string} totalQuotesAuthor
 * @param {string} authorDescription
 */
function showFormDeleteAuthor(authorId, authorName, authorDescription, totalQuotesAuthor) {

  if (totalQuotesAuthor != 0  && authorId != 1) {
    document.getElementById("iFormEditAuthor").style.display = "none";
    document.getElementById("iFormAddAuthor").style.display = "none";
    document.getElementById("iFormDeleteAuthor").style.display = "block";
    document.getElementById('iInputDeleteAuthorId').value = authorId;
    document.getElementById('iTextDeleteAuthorTitleName').textContent = "¡Error al intentar eliminar!";
    document.getElementById('iTextDeleteAuthorName').textContent = "La categoría tiene frases asociadas.";
    document.getElementById('iTextDeleteAuthorDescription').style.display = "none";
    document.getElementById('iTextDeleteAuthorTitleDescription').style.display = "none";
    document.getElementById('iButtonAcceptDeleteAuthor').style.display = "none";
    document.getElementById("iButtonCancelDeleteAuthor").innerHTML = 'Aceptar';
    document.getElementById("iButtonCancelDeleteAuthor").title = 'Clic para aceptar.';
  }

  if (authorId == 1) {
    document.getElementById("iFormEditAuthor").style.display = "none";
    document.getElementById("iFormAddAuthor").style.display = "none";
    document.getElementById("iFormDeleteAuthor").style.display = "block";
    document.getElementById('iInputDeleteAuthorId').value = authorId;
    document.getElementById('iTextDeleteAuthorTitleName').textContent = "¡Error al intentar eliminar!";
    document.getElementById('iTextDeleteAuthorName').textContent = "No es posible eliminar esta categoría.";
    document.getElementById('iTextDeleteAuthorDescription').style.display = "none";
    document.getElementById('iTextDeleteAuthorTitleDescription').style.display = "none";
    document.getElementById('iButtonAcceptDeleteAuthor').style.display = "none";
    document.getElementById("iButtonCancelDeleteAuthor").innerHTML = 'Aceptar';
    document.getElementById("iButtonCancelDeleteAuthor").title = 'Clic para aceptar.';
  }

  if (totalQuotesAuthor == 0 && authorId != 1) {
    document.getElementById("iFormEditAuthor").style.display = "none";
    document.getElementById("iFormAddAuthor").style.display = "none";
    document.getElementById("iFormDeleteAuthor").style.display = "block";
    document.getElementById('iInputDeleteAuthorId').value = authorId;
    document.getElementById('iTextDeleteAuthorTitleName').textContent = "Nombre";
    document.getElementById('iTextDeleteAuthorName').textContent = authorName;
    document.getElementById('iTextDeleteAuthorTitleDescription').style.display = "Descripción";
    document.getElementById('iTextDeleteAuthorDescription').textContent = authorDescription;
    document.getElementById("iButtonCancelDeleteAuthor").innerHTML = 'Cancelar';
    document.getElementById('iButtonAcceptDeleteAuthor').style.display = "inline";
    document.getElementById("iButtonCancelDeleteAuthor").title = 'Clic para cancelar.';
  }

}

/**
 * Hidde form delete
 *
 * @type void
 * @param none
 * @return none
 */
function hiddeFormDeleteAuthor() {
  document.getElementById("iFormEditAuthor").style.display = "none";
  document.getElementById("iFormDeleteAuthor").style.display = "none";
  document.getElementById("iFormAddAuthor").style.display = "block";
}

/**
 * Show form edit author
 *
 * @param {string} authorId Id number of the author
 * @param {string} authorName of the author to edit
 * @param {string} authorDescription of the author to edit
 * @return none
 */
function showFormEditAuthor(authorId, authorName, authorDescription) {
  document.getElementById("iFormEditAuthor").style.display = "block";
  document.getElementById("iFormAddAuthor").style.display = "none";
  document.getElementById("iFormDeleteAuthor").style.display = "none";
  document.getElementById('iInputEditAuthorId').value = authorId;
  document.getElementById('iInputEditAuthorName').value = authorName;
  document.getElementById('iTextAreaEditAuthorDescription').textContent = authorDescription;
}

/**
 * Hidde form edit author
 *
 * @type void
 * @param none
 * @return none
 */
function hiddeFormEditAuthor() {
  document.getElementById("iFormEditAuthor").style.display = "none";
  document.getElementById("iFormDeleteAuthor").style.display = "none";
  document.getElementById("iFormAddAuthor").style.display = "block";
}