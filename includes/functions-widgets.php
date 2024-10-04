<?php
  
  
  /**
   * Widget functions --------------------------------------------------------------------------------------------------
   */
  
  /**
   * Get all quotes from category id
   *
   * @return array $listQuotes List of the all quotes with his data
   */
  function getAllQuotesFromAllCatgories (): array
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT * FROM  {$wpdb -> prefix}befrases", ARRAY_A);
  }
  
  /**
   * Get all quotes from category id
   *
   * @return array $listQuotes List of the all quotes with his data
   */
  function getAllQuotesFromCategoryId ($quoteCategoryId): array
  {
    global $wpdb;
    return $wpdb->get_results ("SELECT * FROM  {$wpdb -> prefix}befrases	WHERE	befrases_category = {$quoteCategoryId}", ARRAY_A);
  }
  
  /**
   * Print the quote text
   *
   * @param int    $alignmentQuoteText Option number of the alignment quote text
   * @param int    $styleQuoteText     Option number of the style quote text
   * @param string $quoteText          Text of the selected quote
   * @return void
   */
  function printQuoteText (int $alignmentQuoteText, int $styleQuoteText, string $quoteText): void
  {
    ?>

    <p style="margin-bottom: 0px; padding-bottom: 0px; margin-top: 5px;; margin-right: 5px; margin-left: 5px;
    
    <?php if ($alignmentQuoteText == 0): ?>
        text-align: right;">
      <?php endif; ?>
      
      <?php if ($alignmentQuoteText == 1): ?>
        text-align: center;">
      <?php endif; ?>
      
      <?php if ($alignmentQuoteText == 2): ?>
        text-align: left;">
      <?php endif; ?>
      
      <?php if ($alignmentQuoteText == 3): ?>
        text-align: justify;">
      <?php endif; ?>
      
      
      <?php if ($styleQuoteText == 0): ?>
      
      <?php endif; ?>
      
      <?php if ($styleQuoteText == 1): ?>
      <em>
        <?php endif; ?>
        
        <?php if ($styleQuoteText == 2): ?>
        <b>
          <?php endif; ?>
          
          <?php if ($styleQuoteText == 3): ?>
          <em><b>
              <?php endif; ?>
              
              <?php echo '"' . $quoteText . '"'; ?>
              
              <?php if ($styleQuoteText == 0): ?>
              
              <?php endif; ?>
              
              <?php if ($styleQuoteText == 1): ?>
          </em>
        <?php endif; ?>
          
          <?php if ($styleQuoteText == 2): ?>
        </b>
      <?php endif; ?>
        
        <?php if ($styleQuoteText == 3): ?>
      </em></b>
    <?php endif; ?>
    </p>
    
    <?php
  }
  
  /**
   * Print the author text
   *
   * @param int    $alignmentAuthorText Option number of the alignment author text
   * @param int    $styleAuthorText     Option number of the style author text
   * @param string $authorText          Text of the selected author
   * @return void
   */
  function printAuthorText (int $alignmentAuthorText, int $styleAuthorText, string $authorText): void
  { ?>

    <p style=" margin-bottom: 0px; margin-top: 0px; margin-right: 5px;
    <?php if ($alignmentAuthorText == 0): ?>
        text-align: right;">
      <?php endif; ?>
      
      <?php if ($alignmentAuthorText == 1): ?>
        text-align: center;">
      <?php endif; ?>
      
      <?php if ($alignmentAuthorText == 2): ?>
        text-align: left;">
      <?php endif; ?>
      
      <?php if ($alignmentAuthorText == 3): ?>
        text-align: justify;">
      <?php endif; ?>
      
      
      <?php if ($styleAuthorText == 0): ?>
      
      <?php endif; ?>
      
      <?php if ($styleAuthorText == 1): ?>
      <em>
        <?php endif; ?>
        
        <?php if ($styleAuthorText == 2): ?>
        <b>
          <?php endif; ?>
          
          <?php if ($styleAuthorText == 3): ?>
          <em><b>
              <?php endif; ?>
              
              <?php echo "— " . $authorText; ?>
              
              <?php if ($styleAuthorText == 0): ?>
              
              <?php endif; ?>
              
              <?php if ($styleAuthorText == 1): ?>
          </em>
        <?php endif; ?>
          
          <?php if ($styleAuthorText == 2): ?>
        </b>
      <?php endif; ?>
        
        <?php if ($styleAuthorText == 3): ?>
      </em></b>
    <?php endif; ?>
    </p>
    
    <?php
  }

?>