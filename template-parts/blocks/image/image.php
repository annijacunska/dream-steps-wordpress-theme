<?php
  if(get_field('image')) {
    $src = get_field('image');
  } else {
    $src = 'https://upload.wikimedia.org/wikivoyage/zh/6/6a/Default_Banner.jpg';
  }

  if(is_product()) {
    $additional_class = ' image-section-single';
  } else {
    $additional_class = ' image-section';
  }
?>

<div class="section <?php echo $additional_class; ?>">
  <div class="image-content">
    <img src="<?php echo $src; ?>" width="100%" height="623">
  </div>
</div>