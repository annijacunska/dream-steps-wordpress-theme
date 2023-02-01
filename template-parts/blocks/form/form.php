<?php
if (!get_field('image')) {
  $section_class = ' no-image';
} 
?>

<div id="pieteikties-konsultacijai" class="section form-section<?php echo $section_class; ?>">
  <div class="container form">
    <div class="heading">
      <h2 class="form-heading"><?php the_field('heading'); ?></h2>
    </div>
    <div class="form-content">
      <?php 
        // if (is_language('lv')) {
          echo do_shortcode('[contact-form-7 id="278" title="Kontaktforma - pieteikties konsultācijai"]');
        // } else if (is_language('en')){
        //   echo do_shortcode('[contact-form-7 id="378" title="Kontaktforma - pieteikties konsultācijai_EN"]');
        // } 
       ?>
    </div>

    <?php
    if (get_field('image')) { ?>

    <div class="form-image">
      <img src="<?php the_field('image'); ?>" height="649" width="640">
    </div>

    <?php } ?>

  </div>
</div>