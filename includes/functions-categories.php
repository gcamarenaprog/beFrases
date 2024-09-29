<?php
  /**
   * Categories functions ----------------------------------------------------------------------------------------------
   */
  
  /**
   * Gets list of all categories from database
   *
   * @return array $categoriesList associative array with list of all categories and his data
   */
  function getAllCategoriesList (): array
  {
    global $wpdb;
    $query = "SELECT * FROM {$wpdb -> prefix}befrases_cat";
    $categoriesList = $wpdb->get_results ($query, ARRAY_A);
    if (empty($categoriesList)) {
      return array();
    }
    return $categoriesList;
  }
  
  /**
   * Count the total quotes of a category with the id number
   *
   * @param int $idCategory Id number of the category to be counted
   * @return int Number of total records of a category
   */
  function countTotalRecordsCategory (int $idCategory): int
  {
    global $wpdb;
    return $wpdb->get_var ("SELECT COUNT(befrases_category) FROM {$wpdb -> prefix}befrases WHERE befrases_category = {$idCategory} ");
  }
  
  /**
   * Save a new category record
   *
   * @param string $categoryName        The category name of the new record
   * @param string $categoryDescription The category description of the new record
   * @return void
   */
  function insertCategoryRecord (string $categoryName, string $categoryDescription): void
  {
    global $wpdb;
    $data = array(
      'befrases_cat_name' => $categoryName,
      'befrases_cat_description' => $categoryDescription
    );
    $tableName = "{$wpdb -> prefix}befrases_cat";
    $wpdb->insert ($tableName, $data);
  }
  
  /**
   * Delete a category with id number provided
   *
   * @param int $idCategory array with the data of new record
   * @return void
   */
  function deleteCategoryRecord (int $idCategory): void
  {
    global $wpdb;
    $data = array(
      'befrases_cat_id' => $idCategory
    );
    $tableName = "{$wpdb -> prefix}befrases_cat";
    $wpdb->delete ($tableName, $data);
  }
  
  /**
   * Update data of a category record
   *
   * @param int    $idCategory          Id of category to update
   * @param string $nameCategory        Name of category to update
   * @param string $descriptionCategory Description of category to update
   * @return void
   */
  function updateCategoryRecord (int $idCategory, string $nameCategory, string $descriptionCategory): void
  {
    global $wpdb;
    $data = array(
      'befrases_cat_id' => $idCategory,
      'befrases_cat_name' => $nameCategory,
      'befrases_cat_description' => $descriptionCategory
    );
    $tableName = "{$wpdb -> prefix}befrases_cat";
    $wpdb->replace ($tableName, $data);
  }