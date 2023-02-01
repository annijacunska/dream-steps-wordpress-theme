</div>
    <footer class="site-footer">
      <div class="container footer">
        <div class="row footer-upper-row default">
          <div class="col col-menu">
            <h4><?php _e( 'Navigācija', TD );?></h4>
            <?php
              wp_nav_menu(
                array(
                'menu' => 'footer-nav',
                'container' => '',
                'theme_location' => 'footer-nav',
                'items_wrap' => '<ul class = "footer-menu">%3$s</ul>'
                )
              );
            ?>
          </div>
          <div class="col col-categories">
            <h4><?php _e( 'Produkti', TD );?></h4>
            <?php
              wp_nav_menu(
                array(
                'menu' => 'products-nav',
                'container' => '',
                'theme_location' => 'footer-nav-prod',
                'items_wrap' => '<ul class = "footer-products-menu">%3$s</ul>'
                )
              );
            ?>
          </div>
          <div class="col col-info right">
            <div class="col col-logo">
              <img src="<?php echo THEME_IMG_PATH; ?>/DreamSteps_logo.svg" alt="DreamSteps logo" width="157" height="85">
            </div>
            <p><?php _e( 'Adrese: ', TD );?>Rīgas iela 1a Rīga, Latvija</p>
            <p><?php _e( 'Tālrunis: ', TD );?><a href="tel:+37126404768">+371 26404768</a></p>
            <p><?php _e( 'E-pasts: ', TD );?><a href="mailto: info@dreamsteps.lv">info@dreamsteps.lv</a></p>
            <div class="social">
              <span class='icon facebook'>
                <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"></a>
              </span>
              <span class='icon instagram'>
                <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"></a>
              </span>
            </div>
          </div>
        </div>

        <div class="row footer-upper-row checkout">
          <div class="col col-contacts">
            <h4><?php _e( 'Sazinies ar mums', TD );?></h4>
            <p><a href="mailto: info@dreamsteps.lv">info@dreamsteps.lv</a></p>
            <p><a href="tel:+37126404768">+371 26404768</a></p>
          </div>
          <div class="col col-address">
            <h4><?php _e( 'Mēs atrodamies', TD );?></h4>
            <p>Rīgas iela 1a Rīga, Latvija</p>
            <p><a href="https://goo.gl/maps/TyGxq6xUL1LYA8LQ6"><?php _e( 'Skatīt kartē', TD );?></a></p>
          </div>
          <div class="col col-info right">
            <div class="col col-logo">
              <img src="<?php echo THEME_IMG_PATH; ?>/DreamSteps_logo.svg" alt="DreamSteps logo" width="157" height="85">
            </div>
            <div class="social">
              <span class='icon facebook'>
                <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"></a>
              </span>
              <span class='icon instagram'>
                <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"></a>
              </span>
            </div>
          </div>
        </div>

        <div class="footer-lower-row">
          <p class="left">© 
            <?php 
            _e( 'Bērnu laukumiņi', TD );
            echo ' ' . date('Y') . '. ';
            _e( 'Visas tiesības aizsargātas', TD );?>.</p>
          <a class="right" href="<?php echo esc_url( get_permalink( get_option( 'wp_page_for_privacy_policy' ) ) ); ?>"><?php _e( 'Privātuma politika', TD );?></a>
        </div>
      </div>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>