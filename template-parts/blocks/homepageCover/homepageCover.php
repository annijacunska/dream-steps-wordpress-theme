<div class="section homepageCover-section">
  <div class="homepageCover-content">  
    <div class="homepageCover-text">
      <h1 class="homepageCover-heading"><?php the_field('heading'); ?></h1>
      <p class="large"><?php the_field('text'); ?></p>
      <button class="btn btn-goto bg-gradient" data-url="<?php the_field('link_1'); ?>" ><?php the_field('button_1_text'); ?></button>
      <button class="btn btn-goto bg-gradient" data-url="<?php the_field('link_2'); ?>" ><?php the_field('button_2_text'); ?></button>
    </div>
    <div class="homepageCover-image">
      <img src="<?php the_field('image'); ?>" height="693" width="698">
    </div>
  </div>
</div>
