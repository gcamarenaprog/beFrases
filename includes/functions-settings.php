<?php
  /**
   * Settings functions
   * --------------------------------------------------------------------------------------------------
   */
  
  /**
   * Gets settings options
   *
   * @return array
   */
  function getSettings (): array
  {
    global $wpdb;
    $tableName = "{$wpdb -> prefix}befrases_opt";
    $queryOptions = "SELECT * FROM {$tableName}";
    return $wpdb->get_results ($queryOptions, ARRAY_A);
  }
  
  /**
   * Save settings options
   *
   * @param int $alignmentTextAuthorOption The option selected for alignment text author
   * @param int $alignmentTextQuoteOption  The option selected for alignment text quote
   * @param int $styleTextAuthorOption     The option selected for style text author
   * @param int $styleTextQuoteOption      The option selected for style text quote
   * @return void
   */
  function saveSettings (int $alignmentTextAuthorOption, int $alignmentTextQuoteOption, int $styleTextAuthorOption, int $styleTextQuoteOption): void
  {
    global $wpdb;
    $idOptions = 1;
    $data = array(
      'befrases_opt_id' => $idOptions,
      'befrases_ali_txt_aut' => $alignmentTextAuthorOption,
      'befrases_sty_txt_aut' => $styleTextAuthorOption,
      'befrases_ali_txt_quo' => $alignmentTextQuoteOption,
      'befrases_sty_txt_quo' => $styleTextQuoteOption
    );
    $tableName = "{$wpdb -> prefix}befrases_opt";
    $wpdb->replace ($tableName, $data);
  }