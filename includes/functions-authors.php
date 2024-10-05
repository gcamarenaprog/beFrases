<?php
  /**
   * Authors functions -------------------------------------------------------------------------------------------------
   */
  
  /**
   * Gets list of all authors from database
   *
   * @return array $authorsList associative array with list of all authors and his data
   */
  function getAllAuthorsList (): array
  {
    global $wpdb;
    $query = "SELECT * FROM {$wpdb -> prefix}befrases_aut";
    $authorsList = $wpdb->get_results ($query, ARRAY_A);
    if (empty($authorsList)) {
      return array();
    }
    return $authorsList;
  }
  
  /**
   * Count the total quotes of an author with the id number
   *
   * @param int $idAuthor Id number of the author to be counted
   * @return int Number of total records of an author
   */
  function countTotalRecordsAuthor (int $idAuthor): int
  {
    global $wpdb;
    return $wpdb->get_var ("SELECT COUNT(befrases_author) FROM {$wpdb -> prefix}befrases WHERE befrases_author = {$idAuthor} ");
  }
  
  /**
   * Save a new author record
   *
   * @param string $authorName The author name of the new record
   * @return void
   */
  function insertAuthorRecord (string $authorName): void
  {
    global $wpdb;
    $data = array(
      'befrases_aut_name' => $authorName
    );
    $tableName = "{$wpdb -> prefix}befrases_aut";
    $wpdb->insert ($tableName, $data);
  }
  
  /**
   * Update data of an author record
   *
   * @param int    $idAuthor   Id of category to update
   * @param string $nameAuthor Name of category to update
   * @return void
   */
  function updateAuthorRecord (int $idAuthor, string $nameAuthor): void
  {
    global $wpdb;
    $data = array(
      'befrases_aut_id' => $idAuthor,
      'befrases_aut_name' => $nameAuthor
    );
    $tableName = "{$wpdb -> prefix}befrases_aut";
    $wpdb->replace ($tableName, $data);
  }
  
  /**
   * Delete an author with id number provided
   *
   * @param int $idAuthor array with the data of new record
   * @return void
   */
  function deleteAuthorRecord (int $idAuthor): void
  {
    global $wpdb;
    $data = array(
      'befrases_aut_id' => $idAuthor
    );
    $tableName = "{$wpdb -> prefix}befrases_aut";
    $wpdb->delete ($tableName, $data);
  }