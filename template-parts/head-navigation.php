<section>
		<div class="container nav-container">
			<nav class="menu">
				<div class="menu-upper">

					<div class="hamburger-icon" id="icon">
						<div class="icon-1" id="a"></div>
						<div class="icon-2" id="b"></div>
						<div class="icon-3" id="c"></div>
						<div class="clear"></div>
					</div>
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<img class="logo-img" src="<?php echo THEME_IMG_PATH; ?>/DreamSteps_logo.svg" alt="DreamSteps logo" width="157" height="85">
							<!-- <img class="logo-img" src="/dream_steps/wp-content/uploads/2022/01/DreamSteps_logo.png" alt="DreamSteps logo"> -->
						</a>
					</div>
					<div class="consult-info">
						<p><?php _e( 'Konsultācija pa telefonu', TD );?><br><a href="tel:+37126404768">+371 26404768</a></p>
					</div>
					<div class="nav-options">
						<?php 
						// echo get_search_form();
						echo do_shortcode('[fibosearch]');
						echo do_shortcode("[woo_cart_but]"); 
						?>
						<?php
							wp_nav_menu(
								array(
									'menu' => 'lng-nav',
									'container' => '',
									'theme_location' => 'lng-nav',
									'items_wrap' => '<ul class = "lng-select">%3$s</ul>'
								)
							);
						?>
					</div>
				</div>
				<div class="menu-lower">
					<?php
						wp_nav_menu(
							array(
							'menu' => 'header-nav',
							'container' => '',
							'theme_location' => 'header-nav',
							'items_wrap' => '<ul class = "menu-item-list">%3$s</ul>'
							)
							);
					?>
				</div>
			</nav>
		</div>
	</section>