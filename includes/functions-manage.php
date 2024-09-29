<?php
  /**
   * Get all data functions --------------------------------------------------------------------------------------------
   */
  
  /**
   * Get all data quotes.
   *
   * @return array
   */
  function getAllDataQuotes (): array
  {
    global $wpdb;
    $query = "SELECT * FROM {$wpdb -> prefix}befrases";
    $categoriesList = $wpdb->get_results ($query, ARRAY_A);
    if (empty($categoriesList)) {
      return array();
    }
    return $categoriesList;
  }
  
  /**
   * Get all data authors
   *
   * @return array $authorsList List of all authors and his data
   */
  function getAllDataAuthors (): array
  {
    global $wpdb;
    $query = "SELECT befrases_aut_id, befrases_aut_name FROM {$wpdb -> prefix}befrases_aut";
    return $wpdb->get_results ($query, ARRAY_A);
  }
  
  /**
   * Get all data categories
   *
   * @return array $categoriesList List of all categories and his data
   */
  function getAllDataCategories (): array
  {
    global $wpdb;
    $query = "SELECT befrases_cat_id, befrases_cat_name FROM {$wpdb -> prefix}befrases_cat";
    return $wpdb->get_results ($query, ARRAY_A);
  }
  
  
  /**
   * Get names functions -----------------------------------------------------------------------------------------------
   */
  
  /**
   * Get category name from category id
   *
   * @param int $CategoryId Id number of the category
   * @return array $categoryName Name of category
   */
  function getCategoryNameAndIdWithCategoryId (int $CategoryId): array
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT befrases_cat_name, befrases_cat_id FROM  {$wpdb -> prefix}befrases_cat	WHERE	befrases_cat_id = {$CategoryId}", ARRAY_A);
  }
  
  /**
   * Get author name from author id
   *
   * @param int $authorId Id number of the author
   * @return array $authorName Name of author
   */
  function getAuthorNameWithAuthorId (int $authorId): array
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT befrases_aut_name FROM  {$wpdb -> prefix}befrases_aut	WHERE	befrases_aut_id = {$authorId}", ARRAY_A);
  }
