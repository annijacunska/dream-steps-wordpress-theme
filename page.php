<?php get_header(); ?>
  
  <section>
    <div class="container default">
      <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ): the_post(); ?>
          <div class="editor"><?php the_content(); ?></div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </section>

<?php get_footer(); ?>