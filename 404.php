<?php get_header(); ?>
  
  <section>
    <div class="container-404">
      <div class="error-heading">
        <h1 class="error-code">4</h1>
        <img class="error-image" src="<?php echo THEME_IMG_PATH; ?>/Bernu laukumi-134.png" alt="Bērnu laukumi" width="368px" height="340px">
        <h1 class="error-code">4</h1>
      </div>
      <h4><?php _e( 'Lappuse nav atrasta, mēģiniet vēlreiz!', TD );?></h4>
      <button class="bg-gradient" onclick="location.href='<?php echo home_url(); ?>';"><?php _e( 'Uz galveno lappusi', TD );?><span class="btn-arrow"></span></button>
    </div>
  </section>

<?php get_footer(); ?>