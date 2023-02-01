<?php
$size = 'woocommerce_thumbnail';
$cat_args = array(
    // 'orderby'    => 'term_id',
    'orderby'    => 'name',
    'hide_empty' => false,
);

$product_categories = get_terms( 'product_cat', $cat_args );

if( !get_field('show_heading')) {
  $background_class = ' no-background';
} else {
  $background_class = '';
}

?>

<div class="section categories-section<?php echo $background_class; ?>">
  <div class="container categories">
    <?php
      if( get_field('show_heading')) {
    ?>
      <div class="heading">
        <h2 class="categories-heading"><?php the_field('heading'); ?></h2>
      </div>
    <?php } ?>
    <div class="categories-content">
      <?php
      if( !empty($product_categories) ){
        foreach ($product_categories as $key => $category) {
          $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
          $image = wp_get_attachment_image_src( $thumbnail_id, $size );

          echo '<div class="category-item">';
            echo '<a href="' . get_term_link($category) . '">';
            echo '<img src="' .  $image[0] . '" width="220" height="220">';
            echo '<div class="category-name"><h5>' . $category->name . '</h5></div>';
            echo '</a></div>';
        }
      }
      ?>
      
    </div>
    <?php
      if( get_field('show_to_catalog')) {
    ?>
    <div class="pagination-dynamic">
    <div class="nav-more alignleft">
      <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="button bg-gradient alignleft"><span class="btn-arrow"></span><?php _e( 'Apskatīt katalogu', TD );?></a>
    </div>
      </div>
  </div>
    <?php } ?>
  </div>
</div>

