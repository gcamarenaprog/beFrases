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


/* Functions of manage.php file --------------------------------------------------------------------------------------- */

/**
 * Show form edit quote
 *
 * @param {string} nameOfAuthor Name of author
 * @param {string} authorExtra Author extra information
 * @param {string} quoteId Id number of the quote
 * @param {string} autorId Author name
 * @param {string} quoteText Quote text of the quote
 * @param {string} categoryId Id category
 * @return none
 */
function showFormEditQuote(nameOfAuthor, authorExtra, quoteId, autorId, quoteText, categoryId) {
  document.getElementById("iFormEditQuote").style.display = "block";
  document.getElementById("iFormAddQuote").style.display = "none";
  document.getElementById("iFormDeleteQuote").style.display = "none";
  document.getElementById('iInputQuoteIdEdit').value = quoteId;
  document.getElementById('iInputAuthorEdit').value = nameOfAuthor;
  document.getElementById('iTextAreaQuoteEdit').textContent = quoteText;
  document.getElementById("iSelectCategoryEdit").value = categoryId;
  document.getElementById("iInputAuthorExtraEdit").value = authorExtra;
}

/**
 * Hidde form edit quote
 *
 * @return none
 */
function hideFormEditQuote() {
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
  document.getElementById('iInputQuoteIdDelete').value = idQuote;
  document.getElementById("iTextQuoteDelete").textContent = "\"" + contentQuote + "\"";
  document.getElementById("iTextAuthorDelete").textContent = "— " + authorQuote;
}

/**
 * Hidde form delete quote
 *
 * @return none
 */
function hideFormDeleteQuote() {
  document.getElementById("iFormEditQuote").style.display = "none";
  document.getElementById("iFormDeleteQuote").style.display = "none";
  document.getElementById("iFormAddQuote").style.display = "block";
}


/* Functions of categories.php file --------------------------------------------------------------------------------- */

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
  if (totalQuotesCategory != 0) {
    document.getElementById("iFormEditCategory").style.display = "none";
    document.getElementById("iFormAddCategory").style.display = "none";
    document.getElementById("iFormDeleteCategory").style.display = "block";
    document.getElementById('iInputCategoryIdDelete').value = categoryId;
    document.getElementById('iTitleQuestionDelete').textContent = "Error deleting!";
    document.getElementById('iTitleQuestionDelete').classList.add('text-danger');
    document.getElementById('iTextDescriptionDelete').textContent = "This category cannot be deleted, it has: " + totalQuotesCategory + ' associated phrase(s).';
    document.getElementById('iTextNameOfCategoryDelete').textContent = categoryName;
    document.getElementById('iTextDeleteCategoryDescription').textContent = categoryDescription;
    document.getElementById('iButtonAcceptDelete').classList.add('disabled');
  } else {
    document.getElementById("iFormEditCategory").style.display = "none";
    document.getElementById("iFormAddCategory").style.display = "none";
    document.getElementById("iFormDeleteCategory").style.display = "block";
    document.getElementById('iInputCategoryIdDelete').value = categoryId;
    document.getElementById('iTitleQuestionDelete').textContent = "Delete Category";
    document.getElementById('iTitleQuestionDelete').classList.remove('text-danger');
    document.getElementById('iTextDescriptionDelete').textContent = "Do you want to delete the following category?";
    document.getElementById('iTextNameOfCategoryDelete').textContent = categoryName;
    document.getElementById('iTextDeleteCategoryDescription').textContent = categoryDescription;
    document.getElementById('iButtonAcceptDelete').classList.remove('disabled');
  }
}

/**
 * Hidde form delete
 *
 * @type void
 * @param none
 * @return none
 */
function hideFormDeleteCategory() {
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
  iInputCurrentCategoryEdit = categoryName;
  console.log(iInputCurrentCategoryEdit)
  document.getElementById("iFormEditCategory").style.display = "block";
  document.getElementById("iFormAddCategory").style.display = "none";
  document.getElementById("iFormDeleteCategory").style.display = "none";
  document.getElementById('iInputCategoryIdEdit').value = categoryId;
  document.getElementById('iInputCategoryEdit').value = categoryName;
  document.getElementById('iTextAreaDescriptionEdit').textContent = categoryDescription;
}

/**
 * Hidde form edit category
 *
 * @type void
 * @param none
 * @return none
 */
function hideFormEditCategory() {
  document.getElementById("iFormEditCategory").style.display = "none";
  document.getElementById("iFormDeleteCategory").style.display = "none";
  document.getElementById("iFormAddCategory").style.display = "block";
}


/* Functions of authors.php file ------------------------------------------------------------------------------------ */

/**
 * Show form delete
 *
 * @return none
 * @param {string} authorId
 * @param {string} authorName
 * @param {string} totalQuotesAuthor
 * @param {string} authorDescription
 */
function showFormDeleteAuthor(authorId, authorName, totalQuotesAuthor) {
  if (totalQuotesAuthor != 0) {
    document.getElementById("iFormEditAuthor").style.display = "none";
    document.getElementById("iFormAddAuthor").style.display = "none";
    document.getElementById("iFormDeleteAuthor").style.display = "block";
    document.getElementById('iInputAuthorIdDelete').value = authorId;
    document.getElementById('iTitleQuestionDelete').textContent = "Error deleting!";
    document.getElementById('iTitleQuestionDelete').classList.add('text-danger');
    document.getElementById('iTextDescriptionDelete').textContent = "This author cannot be deleted, it has: " + totalQuotesAuthor + ' associated phrase(s).';
    document.getElementById('iTextNameOfAuthorDelete').textContent = authorName;
    document.getElementById('iButtonAcceptDelete').classList.add('disabled');
  } else {
    document.getElementById("iFormEditAuthor").style.display = "none";
    document.getElementById("iFormAddAuthor").style.display = "none";
    document.getElementById("iFormDeleteAuthor").style.display = "block";
    document.getElementById('iInputAuthorIdDelete').value = authorId;
    document.getElementById('iTitleQuestionDelete').textContent = "Delete Author";
    document.getElementById('iTitleQuestionDelete').classList.remove('text-danger');
    document.getElementById('iTextDescriptionDelete').textContent = "Do you want to delete the following author?";
    document.getElementById('iTextNameOfAuthorDelete').textContent = authorName;
    document.getElementById('iButtonAcceptDelete').classList.remove('disabled');
  }
}

/**
 * Hidde form delete
 *
 * @type void
 * @param none
 * @return none
 */
function hideFormDeleteAuthor() {
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
function showFormEditAuthor(authorId, authorName) {
  document.getElementById("iFormEditAuthor").style.display = "block";
  document.getElementById("iFormAddAuthor").style.display = "none";
  document.getElementById("iFormDeleteAuthor").style.display = "none";
  document.getElementById('iInputAuthorIdEdit').value = authorId;
  document.getElementById('iInputAuthorEdit').value = authorName;
}

/**
 * Hidde form edit author
 *
 * @type void
 * @param none
 * @return none
 */
function hideFormEditAuthor() {
  document.getElementById("iFormEditAuthor").style.display = "none";
  document.getElementById("iFormDeleteAuthor").style.display = "none";
  document.getElementById("iFormAddAuthor").style.display = "block";
}


/* Functions of settings.php file ----------------------------------------------------------------------------------- */

/**
 * Change author alignment
 *
 * @param {string} alignmentAuthor Option number selected from the group of radio buttons
 */
function changeAuthorAlignment(alignmentAuthor) {
  if (alignmentAuthor == 0) {
    document.getElementById("authorDemo").style.textAlign = "right";
    document.getElementById('iRadioButton1-1').checked = true;
  } else if (alignmentAuthor == 1) {
    document.getElementById("authorDemo").style.textAlign = "center";
    document.getElementById('iRadioButton1-2').checked = true;
  } else if (alignmentAuthor == 2) {
    document.getElementById("authorDemo").style.textAlign = "left";
    document.getElementById('iRadioButton1-3').checked = true;
  } else {
    document.getElementById("authorDemo").style.textAlign = "justify";
    document.getElementById('iRadioButton1-4').checked = true;
  }
}

/**
 * Change author style
 *
 * @param {string} styleAuthor Option number selected from the group of radio buttons
 */
function changeAuthorStyle(styleAuthor) {
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
 * @param {string} alignmentQuote Option number selected from the group of radio buttons
 */
function changeQuoteAlignment(alignmentQuote) {
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
 * @param {string} styleQuote Option number selected from the group of radio buttons
 */
function changeQuoteStyle(styleQuote) {
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
  const element = document.getElementsByName('nRadioButton1');
  for (i = 0; i < element.length; i++) {
    if (element[i].checked) {
      if (i == 0) {
        document.getElementById("authorDemo").style.textAlign = "right";
      } else if (i == 1) {
        document.getElementById("authorDemo").style.textAlign = "center";
      } else if (i == 2) {
        document.getElementById("authorDemo").style.textAlign = "left";
      } else {
        document.getElementById("authorDemo").style.textAlign = "justify";
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
  const element = document.getElementsByName('nRadioButton3');
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
  const element = document.getElementsByName('nRadioButton2');
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
  const element = document.getElementsByName('nRadioButton4');
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