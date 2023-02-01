<div class="section blobs-section">
  <div class="container">
    <div class="heading">
      <h2 class="blobs-heading"><?php the_field('heading'); ?></h2>
    </div>
    <div class="blobs-content">
      <div class="blobs-element element1">
        <img  id="blob-1" src="<?php echo THEME_IMG_PATH?>/blob1.svg" alt="Color figure" width="489" height="408">
        <div class="text">
          <h4><?php the_field('figure_1_heading'); ?></h4>
          <p class="medium"><?php the_field('figure_1_text'); ?></p>
        </div>
      </div>
      <div class="blobs-element element2">
        <img  id="blob-2" src="<?php echo THEME_IMG_PATH?>/blob2.svg" alt="Color figure" width="509" height="486">
        <div class="text">
          <h4><?php the_field('figure_2_heading'); ?></h4>
          <p class="medium"><?php the_field('figure_2_text'); ?></p>
        </div>
      </div>
      <div class="blobs-element element3">
        <img  id="blob-3" src="<?php echo THEME_IMG_PATH?>/blob3.svg" alt="Color figure" width="474" height="414">
        <div class="text">
          <h4><?php the_field('figure_3_heading'); ?></h4>
          <p class="medium"><?php the_field('figure_3_text'); ?></p>
        </div>
      </div>
    </div>
  </div>
</div>