<?php 
$category_name = 'gallery';

$args = array(
  'posts_per_page' => -1,
  'category_name' => $category_name,
  'post_type' => 'attachment',
  'post_status'    => 'inherit'
);
$query = new WP_Query( $args );

$first_post_ID = $query->posts[0]->ID;
?>

<?php get_header(); ?>
<div class="container gallery-archive">
  <div class="heading">
    <h2><?php _e( 'Mūsu galerija', TD );?></h2>
  </div>
  <div class="big-image">
    <a class="fancy-big-img" data-fancybox="big-img" href="<?php echo wp_get_attachment_image_src( $first_post_ID, 'medium_large' )[0]  ?>">
      <img src="<?php echo wp_get_attachment_image_src( $first_post_ID, 'medium_large' )[0]  ?>" class="bigimg">
    </a>
  </div>

    <?php
      if($query -> have_posts()) : 
       echo '<div class="gallery-content">';
       $x = 0;

        while($query -> have_posts()) : $query -> the_post();
          if ($x < 9) {
            $visibility_class = "";
          } else {
            $visibility_class = " hidden";
          }
        
          $img_src = wp_get_attachment_image_src( get_the_ID(), 'medium_large' )[0];
          echo '<div  class="gallery-item' . $visibility_class . '">
          <a class="fancybox-gallery-item thumbnailLink" data-fancybox="gallery" href="' . $img_src . '">
            <img src="' . $img_src . '"></a></div>';
            $x++;
        endwhile;?>
  </div>
  <div class="pagination-dynamic">
    <div class="nav-more alignright">
      <button id="show-more" class="show-more bg-gradient-reversed"><?php _e( 'Skatīties vairāk', TD );?><span class="btn-arrow"></span></button>
    </div>
  </div>
  <?php 
  else :
     _e('Sorry, no posts matched your criteria.', TD);
  endif; 
  wp_reset_postdata();?>
  
</div>
<?php get_footer(); ?>