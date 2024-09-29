<?php
  /**
   * Widget ------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * Widget initialization
   *
   * @return mixed
   */
  function beFrases_register_widget ()
  {
    return register_widget ('beFrases_widget');
  }
  
  add_action ('widgets_init', 'beFrases_register_widget');
  
  
  /**
   * Widget functions --------------------------------------------------------------------------------------------------
   */
  
  /**
   * Gets the beFrases plugin option settings from the databases
   *
   * @return array $listQuotes List of the all quotes with his data
   */
  function getAllQuotesFromIdCategory ($quoteCategoryId): array
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT * FROM  {$wpdb -> prefix}befrases	WHERE	befrases_category = {$quoteCategoryId}", ARRAY_A);
  }
  
  /**
   * Print the quote text
   *
   * @param int    $alignmentQuoteText Option number of the alignement quote text
   * @param int    $styleQuoteText     Option number of the style quote text
   * @param string $quoteText          Text of the selected quote
   * @return void
   */
  function printQuoteText ($alignmentQuoteText, $styleQuoteText, $quoteText): void
  {
    if ($alignmentQuoteText == 0): ?>
      <p style="display:block;text-align:right; padding: 0px;">
    <?php
    elseif ($alignmentQuoteText == 1): ?>
      <p style="display:block;text-align:center; padding: 0px;">
    <?php
    elseif ($alignmentQuoteText == 2): ?>
      <p style="display:block;text-align:left; padding: 0px;">
    <?php
    else: ?>
      <p style="display:block;text-align:justify; padding: 0px;">
    <?php
    endif; ?>
    
    
    <?php
  if ($styleQuoteText == 0): ?>
  
  <?php
  elseif ($styleQuoteText == 1): ?>
    <em>
    <?php
      elseif ($styleQuoteText == 2): ?>
    <b>
    <?php
      else: ?>
    <b><em>
  <?php
  endif; ?>
    
    <?php echo "\"" . $quoteText . "\""; ?>
    
    <?php
  if ($styleQuoteText == 0): ?>
  <?php
  elseif ($styleQuoteText == 1): ?>
    </em>
    <?php
      elseif ($styleQuoteText == 2): ?>
    </b>
  <?php
    else: ?>
    <b></em>
  <?php
  endif; ?>
    </p> <?php
  }
  
  /**
   * Print the author text
   *
   * @param int    $alignmentAuthorText Option number of the alignement author text
   * @param int    $styleAuthorText     Option number of the style author text
   * @param string $authorText          Text of the selected author
   * @return void
   */
  function printAuthorText ($alignmentAuthorText, $styleAuthorText, string $authorText): void
  {
    if ($alignmentAuthorText == 0): ?>
      <p style="display:block;text-align: right;padding: 0px; margin: 0px;">
    <?php
    elseif ($alignmentAuthorText == 1): ?>
      <p style="display:block;text-align: center;padding: 0px; margin: 0px;">
    <?php
    elseif ($alignmentAuthorText == 2): ?>
      <p style="display:block;text-align: left;padding: 0px; margin: 0px;">
    <?php
    else: ?>
      <p style="display:block;text-align: justify;padding: 0px; margin: 0px;">
    <?php
    endif; ?>
    
    <?php
  if ($styleAuthorText == 0): ?>
  <?php
  elseif ($styleAuthorText == 1): ?>
    <em>
    <?php
      elseif ($styleAuthorText == 2): ?>
    <b>
    <?php
      else: ?>
    <b><em>
  <?php
  endif; ?>
    
    <?php echo "? " . $authorText;
  
  if ($styleAuthorText == 0): ?>
  
  <?php
  elseif ($styleAuthorText == 1): ?>
    </em>
    <?php
      elseif ($styleAuthorText == 2): ?>
    </b>
  <?php
    else: ?>
    <b><em>
  <?php
  endif; ?>
    </p> <?php
  }