<?php 

$postType = 'feedback';

$args = array(
  'post_type' => $postType,
  'post_status' => 'publish',
  'posts_per_page' => -1,
);
$query = new WP_Query( $args );
?>

<?php get_header(); ?>
<div class="container feedback-archive">
  <div class="heading">
    <h2><?php _e( 'Atsauksmes par mums', TD );?></h2>
  </div>

    <?php
      if($query -> have_posts()) : 
        echo '<div class="feedback-content">';
        $i = 0;

        while($query -> have_posts()) : $query -> the_post();

          if ($i < 8) {
            $visibility_class = "";
          } else {
            $visibility_class = " hidden";
          }

          echo '<div class="quote-item' . $visibility_class . '"><div class="quote-content"><h4>' . get_the_title() . '</h4>
                <div class="feedback-rating">';
            for ($x = 0; $x < 5; $x++) {
              if ($x < get_post_meta(get_the_ID(), 'rating', true)) {
                echo '<img src="' . THEME_IMG_PATH . '/icons/star.svg' . '" height="23" width="25">';
              } else {
                echo '<img src="' . THEME_IMG_PATH . '/icons/star.svg" height="23" width="25" style="filter: gray; -webkit-filter: grayscale(1); filter: grayscale(1);">';
              }
            }
          echo '</div><p class="small">' . get_post_meta(get_the_ID(), 'quote_text', true) . '</p></div></div>';
          $i++;
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
  endif; ?>
</div>
<?php get_footer(); ?>