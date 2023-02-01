<?php

  $category_name = 'show-on-homepage';
  $category_name_parent = 'gallery';

  $gallery_imgs = get_posts(
      array(
        'category_name' => $category_name,
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'post_status'    => 'inherit',
        'posts_per_page' => - 1,
        'fields'         => 'ids',
    )
  );

  $category_url = get_category_link(get_cat_ID($category_name_parent));

  $images = array();
  foreach ( $gallery_imgs as $image ) {
      $images[] = wp_get_attachment_image_src( $image, array('580', '580') )[0];
  }
?>

<div class="section gallery-section slider-gallery">
  <div class="container gallery">
    <div class="heading">
      <a href="<?php echo $category_url; ?>"><h2 class="gallery-heading"><?php the_field('heading'); ?></h2></a>
    </div>
  </div>
  <div class="gallery-content slider-row">
    <?php if( count($images) > 2 ) { ?>
      <ul id="lightSlider-gallery" class="slider">
        <?php
        foreach($images as $image) {
          echo 
          '<li class="gallery-item">
            <div>
              <img src="' . $image . '" alt="Gallery item" height="580" width="580">
            </div>
          </li>';
        }
        ?>
      </ul>
    <?php } else {
      echo '<h6 class="gallery-slider-error">No items to show</h6>';
    } ?>
  </div>
</div>