<?php 
  $postType = 'product';

  $args = array(
    'post_type' => $postType,
    'post_status' => 'publish',
    'meta_key'  	=> 'total_sales',
    'orderby'   	=> 'meta_value_num',
    'order' 		=> 'desc',
    'posts_per_page' => 4,
    'paged' => 1,
    'lang' => $current_language
  );
  $query = new WP_Query( $args );
?>

<div class="section product-grid-section">
  <div class="container product-grid">
    <div class="heading">
      <h2 class="section-heading"><?php the_field('heading'); ?></h2>
    </div>

<?php 
    if($query -> have_posts()) : 
      echo '<div class="woocommerce columns-4 "><ul class="products columns-4">';
      $i = 0;

      while($query -> have_posts()) : $query -> the_post();

        if ($i < 4) {
          if($i == 3) {$order = ' last';}
          echo  '<li class="product type-product status-publish' . $order . '">';
          do_action( 'woocommerce_before_shop_loop_item' );
          do_action( 'woocommerce_before_shop_loop_item_title' );
          do_action( 'woocommerce_shop_loop_item_title' );
          do_action( 'woocommerce_after_shop_loop_item_title' );
          do_action( 'woocommerce_after_shop_loop_item' );
          echo '</li>';
        } else {
          return;
        }
        $i++;
      endwhile;?>
    </ul>
  </div>

  <?php 
  else :
     _e('Sorry, no posts matched your criteria.', TD);
  endif; ?>

    <div class="prod-more alignright">
      <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ) ?>"><button id="prod-more" class="bg-gradient-reversed"><?php _e( 'Skatīties vairāk', TD );?><span class="btn-arrow"></span></button></a>
    </div>
  </div>
</div>