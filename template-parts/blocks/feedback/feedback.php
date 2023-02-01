<?php

  $my_current_lang = apply_filters( 'wpml_current_language', NULL );

  $postType = 'feedback';

  $quotes = get_posts([
    'post_type' => $postType,
    'post_status' => 'publish',
    'numberposts' => -1,
    'meta_query'  => array(
      array(
          'key' => 'show_on_homepage',
          'value' => '1',
          'compare' => '==',
      )
    )  
  ]);

  // $translated_object_ids = array();
  // foreach ($quotes as $quote) {
  //   $translated_object_ids[] = apply_filters( 'wpml_object_id', $quote->ID, $postType, true  );
  // }
?>

<div class="section feedback-section">
  <div class="container feedback">
    <div class="heading">
      <a href="<?php echo get_post_type_archive_link( $postType );?>"><h2 class="feedback-heading"><?php the_field('heading'); ?></h2></a>
    </div>
  </div>
  <div class="feedback-content slider-row">
    <?php if( $quotes ): ?>
      <ul id="lightSlider" class="slider">

        <?php
        // foreach($translated_object_ids as $quote) {
          foreach($quotes as $quote) {
              echo 
          '<li class="quote-item"><div class="quote-content">
            <h4>' . esc_html(get_the_title($quote)) . '</h4>
            <div class="feedback-rating">';
            for ($x = 0; $x < 5; $x++) {
              if ($x < get_post_meta($quote->ID, 'rating', true)) {
                echo '<img src="' . THEME_IMG_PATH . '/icons/star.svg' . '" height="23" width="25">';
              } else {
                echo '<img src="' . THEME_IMG_PATH . '/icons/star.svg" height="23" width="25" style="filter: gray; -webkit-filter: grayscale(1); filter: grayscale(1);">';
              }
            }
            echo '</div>
            <p class="small">' . get_post_meta($quote, 'quote_text', true)   . '</p>
            </div></li>';        
        }
        ?>
      </ul>
    <?php endif; ?>
  </div>
</div>