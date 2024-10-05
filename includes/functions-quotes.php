<?php
  /**
   * Quotes functions --------------------------------------------------------------------------------------------------
   */
  
  /**
   * Insert a new quote record
   *
   * @param int    $authorIdQuote   Author id of the quote
   * @param string $textQuote       Text quote of the quote
   * @param int    $categoryIdQuote Category id of the quote
   * @return void
   */
  function insertQuoteRecord (int $authorIdQuote, string $textQuote, int $categoryIdQuote, string $authorExtra): void
  {
    global $wpdb;
    $data = array(
      'befrases_author' => $authorIdQuote,
      'befrases_quote' => $textQuote,
      'befrases_category' => $categoryIdQuote,
      'befrases_author_extra' => $authorExtra
    );
    $tableName = "{$wpdb -> prefix}befrases";
    $wpdb->insert ($tableName, $data);
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