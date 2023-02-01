<?php
define( 'TD', 'dreamsteps' );

function my_styles() {
  wp_enqueue_style( 'child-style', URL_THEME . '/assets/css/style.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'my_styles' );

function register_theme_nav() {
  register_nav_menus(
    array(
      'header-nav'  => __( 'Header Navigation', TD ),
      'footer-nav' => __( 'Footer Navigation', TD ),
      'footer-nav-prod' => __( 'Footer Navigation - Products', TD ),
      'lng-nav' => __( 'Language Navigation', TD )
    )
  );
}

add_image_size('shop-single-image', 600, 600, true);
add_image_size('shop-thumb-image', 188, 140, true);

function theme_widgets_init() {
	register_sidebar( array(
		'name'          => 'Products left sidebar',
		'id'            => 'prod_left_sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

  register_sidebar( array(
		'name'          => 'Single product after area',
		'id'            => 'prod_after',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'theme_widgets_init' );

//Show admin bar
function admin_bar(){

  if(is_user_logged_in()){
    add_filter( 'show_admin_bar', '__return_true' , 1000 );
  }
}
// add_action('init', 'admin_bar' );

//Define defalt image path
if( !defined('THEME_IMG_PATH')){
  define( 'THEME_IMG_PATH', get_stylesheet_directory_uri() . '/assets/img' );
}

function pandago_theme_support(){
  // Adds dynamic title tag support
  add_theme_support('title-tag');
  add_theme_support( 'woocommerce' );
}
add_action('after_setup_theme','pandago_theme_support');
 
function dreamsteps_project_scripts_include(){
  // wp_enqueue_style('bootstraps_css',   '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
  // wp_enqueue_script('bootstraps_script', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
  wp_enqueue_style( 'awesome.css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('style', get_stylesheet_directory_uri() . '/assets/css/style.css');
  wp_enqueue_style('style_theme', get_stylesheet_directory_uri() . '/style.css');
  wp_enqueue_script('scripts_theme', get_stylesheet_directory_uri() . '/assets/theme.js',   array(), '20151215', true);
}

add_action('wp_enqueue_scripts', 'dreamsteps_project_scripts_include');

//Register custom post type - Feedback
function wp_post_type_init() {
  $labels = array(
      'name'                  => _x( 'Feedback', 'Post type general name', 'feedback' ),
      'singular_name'         => _x( 'Quote', 'Post type singular name', 'feedback' ),
      'menu_name'             => _x( 'Feedback', 'Admin Menu text', 'feedback' ),
      'name_admin_bar'        => _x( 'Feedback', 'Add New on Toolbar', 'feedback' ),
      'add_new'               => __( 'Add New', 'feedback' ),
      'add_new_item'          => __( 'Add New quote', 'feedback' ),
      'new_item'              => __( 'New quote', 'feedback' ),
      'edit_item'             => __( 'Edit quote', 'feedback' ),
      'view_item'             => __( 'View quote', 'feedback' ),
      'all_items'             => __( 'All quotes', 'feedback' ),
      'search_items'          => __( 'Search quotes', 'feedback' ),
      'parent_item_colon'     => __( 'Parent quotes:', 'feedback' ),
      'not_found'             => __( 'No quotes found.', 'feedback' ),
      'not_found_in_trash'    => __( 'No quotes found in Trash.', 'feedback' ),
      'archives'              => _x( 'Quote archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'feedback' ),
      'insert_into_item'      => _x( 'Insert into quote', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'feedback' ),
      'uploaded_to_this_item' => _x( 'Uploaded to this quote', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'feedback' ),
      'filter_items_list'     => _x( 'Filter quotes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'feedback' ),
      'items_list_navigation' => _x( 'Quotes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'feedback' ),
      'items_list'            => _x( 'Quotes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'feedback' ),
  );     
  $args = array(
      'labels'             => $labels,
      'description'        => 'Individual feedback quotes from customers.',
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'exclude_from_search'=> false,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'feedback' ),
      'has_archive'        => true,
      'menu_position'      => 20,
      'menu_icon'          => 'dashicons-format-quote',
      'supports'           => array( 'title'),
      // 'taxonomies'         => array( 'category', 'post_tag' ),
      'show_in_rest'       => true
  );
    
  register_post_type( 'feedback', $args );
}
add_action( 'init', 'wp_post_type_init' );

function is_language($current_lang){
  global $sitepress;
  if ($current_lang==$sitepress->get_current_language()){
    return true;
  }
}

add_action( 'pre_get_posts', 'cpt_archive_pagination' );
function cpt_archive_pagination( $query ) {
if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'feedback' ) ) {
		$query->set( 'posts_per_page', '8' );
	}
}

//Register ACF blocks
function register_acf_block_types(){
  acf_register_block_type(
    array(
      'name' => 'bestProducts',
      'title' => __('DreamSteps - Best selling product grid'),
      'description' => __('Simple grid with best selling products.'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('heading', 'products', 'grid', 'layout'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/productgrid/productgrid.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/productgrid/style.css',
    )
  );
  acf_register_block_type(
    array(
      'name' => 'homepageCover',
      'title' => __('DreamSteps - Homepage cover'),
      'description' => __('Homepage cover section with two button links.'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('homepage', 'cover', 'layout'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/homepageCover/homepageCover.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/homepageCover/style.css',
    )
  );
  acf_register_block_type(
    array(
      'name' => 'aboutUs',
      'title' => __('DreamSteps - About us'),
      'description' => __('Short about us section.'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('aboutus', 'layout'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/aboutUs/aboutUs.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/aboutUs/style.css',
    )
  );
  acf_register_block_type(
    array(
      'name' => 'blobs',
      'title' => __('DreamSteps - Blobs'),
      'description' => __('Section with 3 information blobs.'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('blob', 'layout'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/blobs/blobs.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/blobs/style.css',
    )
  );
  acf_register_block_type(
    array(
      'name' => 'image',
      'title' => __('DreamSteps - Image'),
      'description' => __('Section with image.'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('image', 'layout'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/image/image.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/image/style.css',
    )
  );
  acf_register_block_type(
    array(
      'name' => 'categories',
      'title' => __('DreamSteps - Categories'),
      'description' => __('Categories with images.'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('categories', 'layout', 'cards'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/categories/categories.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/categories/style.css',
    )
  );
  acf_register_block_type(
    array(
      'name' => 'feedback',
      'title' => __('DreamSteps - Feedback'),
      'description' => __('Slider with feedback quotes on cards.'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('quotes', 'layout', 'cards', 'slider'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/feedback/feedback.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/feedback/style.css',
    )
  );
  acf_register_block_type(
    array(
      'name' => 'gallery',
      'title' => __('DreamSteps - Gallery Slider'),
      'description' => __('Gallery slider with images.'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('image', 'layout', 'slider'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/gallery/gallery.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/gallery/style.css',
    )
  );
  acf_register_block_type(
    array(
      'name' => 'form',
      'title' => __('DreamSteps - Contact form'),
      'description' => __('Simple contact form with image.'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('form', 'layout'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/form/form.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/form/style.css',
    )
  );
  acf_register_block_type(
    array(
      'name' => 'contacts',
      'title' => __('DreamSteps - Contacts block'),
      'description' => __('Simple contact display (phone, address, email and socials).'),
      'category' => 'layout',
      'icon' => file_get_contents( THEME_IMG_PATH . '/DreamSteps_logo.svg' ),
      'keywords' => array('contacts', 'layout'),
      'align' => 'full',
      'render_template' => 'template-parts/blocks/contacts/contacts.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/contacts/style.css',
    )
  );
}

if (function_exists('acf_register_block_type')) {
  add_action('acf/init', 'register_acf_block_types');
}

/**
*
* WooCommerce single product content customization
* - deafault function switches & changed order
*/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 28 );

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


if ( ! function_exists( 'woocommerce_product_description' ) ) {
	/**
	 * Output the description content.
	 */
	function woocommerce_product_description() {
		wc_get_template( 'single-product/product-description.php' );
	}
}

if ( ! function_exists( 'woocommerce_product_attributes' ) ) {
	/**
	 * Output the atribute content.
	 */
	function woocommerce_product_attributes() {
		wc_get_template( 'single-product/tabs/additional-information.php' );
	}
}

add_action( 'woocommerce_single_product_summary', 'woocommerce_product_description', 25 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_product_attributes', 22 );

//Add default functions to single product page
add_action( 'woocommerce_before_main_content_single', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content_single', 'woocommerce_breadcrumb', 20, 0 );

//Add shop breadcrumbs to the header
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'woocommerce_after_shop_header', 'woocommerce_breadcrumb', 20, 0 );

//Add shop page description to the site
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
add_action( 'woocommerce_shop_description', 'woocommerce_product_archive_description', 10 );

add_action( 'woocommerce_shop_description', 'woocommerce_catalog_filter', 20 );

if ( ! function_exists( 'woocommerce_catalog_filter' ) ) {
	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function woocommerce_catalog_filter() {
	  echo '<div class="product-filter-btn"><p>' . __( 'Produktu filtri', TD ) . '</p></div>'; 
	}
}

//Put order by element after shop page description
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_shop_description', 'woocommerce_catalog_ordering', 30 );

remove_action( 'woocommerce_product_additional_information', 'wc_display_product_attributes', 10 );
add_action( 'woocommerce_product_additional_information', 'dreamsteps_template_product_add_info', 10 );

function dreamsteps_template_product_add_info( $product ) {
  /**
  * Outputs a list of product attributes for a product.
  * Edit - removed dimension concatenation
  *
  * @since  3.0.0
  * @param  WC_Product $product Product Object.
  */
	$product_attributes = array();

	// Display weight and dimensions before attribute list.
	$display_dimensions = apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() );

	// Add product attributes to list.
	$attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );

	foreach ( $attributes as $attribute ) {
		$values = array();

		if ( $attribute->is_taxonomy() ) {
			$attribute_taxonomy = $attribute->get_taxonomy_object();
			$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

			foreach ( $attribute_values as $attribute_value ) {
				$value_name = esc_html( $attribute_value->name );

				if ( $attribute_taxonomy->attribute_public ) {
					$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
				} else {
					$values[] = $value_name;
				}
			}
		} else {
			$values = $attribute->get_options();

			foreach ( $values as &$value ) {
				$value = make_clickable( esc_html( $value ) );
			}
		}

		$product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
			'label' => wc_attribute_label( $attribute->get_name() ),
			'value' => apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ),
		);
	}

	/**
	 * Hook: woocommerce_display_product_attributes.
	 *
	 * @since 3.6.0.
	 * @param array $product_attributes Array of atributes to display; label, value.
	 * @param WC_Product $product Showing attributes for this product.
	 */
	$product_attributes = apply_filters( 'woocommerce_display_product_attributes', $product_attributes, $product );

	wc_get_template(
		'single-product/product-attributes.php',
		array(
			'product_attributes' => $product_attributes,
			// Legacy params.
			'product'            => $product,
			'attributes'         => $attributes,
			'display_dimensions' => $display_dimensions,
		)
	);
}

//Override woocommerce order by function
if ( ! function_exists( 'woocommerce_catalog_ordering' ) ) {

	/**
	 * Output the product sorting options.
	 */
	function woocommerce_catalog_ordering() {
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}
		$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
		$catalog_orderby_options = apply_filters(
			'woocommerce_catalog_orderby',
			array(
				'menu_order' => __( 'Noklusētā kārtošana', TD ),
				'popularity' => __( 'Populārie', TD ),
				'rating'     => __( 'Augstāk novērtētie', TD ),
				'date'       => __( 'Jaunākie', TD ),
				'price'      => __( 'Cenas, sākot no zemākās', TD ),
				'price-desc' => __( 'Cenas, sākot no augstākās', TD ),
			)
		);

		$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$orderby = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby;
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		if ( wc_get_loop_prop( 'is_search' ) ) {
			$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Atbilstošie', 'woocommerce' ) ), $catalog_orderby_options );

			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! $show_default_orderby ) {
			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! wc_review_ratings_enabled() ) {
			unset( $catalog_orderby_options['rating'] );
		}

		if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
			$orderby = current( array_keys( $catalog_orderby_options ) );
		}

		wc_get_template(
			'loop/orderby.php',
			array(
				'catalog_orderby_options' => $catalog_orderby_options,
				'orderby'                 => $orderby,
				'show_default_orderby'    => $show_default_orderby,
			)
		);
	}
}

//Swap breadcrumb home link to icon 
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
function wcc_change_breadcrumb_home_text( $defaults ) {
    $defaults['delimiter'] = '&nbsp;&#65310;&nbsp;';
    $defaults['before'] = '<span class="crumb-item">';
    $defaults['after'] = '</span>';
    $defaults['home'] = ' ';
    return $defaults;
}

//Add product excerpt to product archive page items 
if ( ! function_exists( 'woocommerce_template_loop_product_excerpt' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function woocommerce_template_loop_product_excerpt() {
    if (has_excerpt()) {
	  	echo '<p class="' . esc_attr( apply_filters( 'woocommerce_product_loop_excerpt_classes', 'woocommerce-loop-product__excerpt' ) ) . '">' . get_the_excerpt() . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    } 
	}
}

add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_excerpt', 20 );
add_filter( 'woocommerce_product_loop_excerpt_classes', 'custom_woocommerce_product_loop_excerpt_classes' );

function custom_woocommerce_product_loop_excerpt_classes( $class ) {
	return 'product-loop-excerpt';
}

//Bring add to cart button within the product loop item
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 8 );

//Change thumbnale size in single product page
add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
  return 'woocommerce_thumbnail';
});

add_filter( 'woocommerce_single_product_image_gallery_classes', 'bbloomer_3_columns_product_gallery' );
 
function bbloomer_3_columns_product_gallery( $wrapper_classes ) {
   $columns = 3; // change this to 2, 3, 5, etc. Default is 4.
   $wrapper_classes[2] = 'woocommerce-product-gallery--columns-' . absint( $columns );
   return $wrapper_classes;
}

//Checkout - bring payments outide of order review block
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_order_review_payment', 'woocommerce_checkout_payment', 10 );

// Adds facetWP labels to facets
function fwp_add_facet_labels() {
  ?>
    <script>
      (function($) {
        $(document).on('facetwp-loaded', function() {
          $('.facetwp-facet').each(function() {
            var facet = $(this);
            var facet_name = facet.attr('data-name');
            var facet_type = facet.attr('data-type');
            var facet_label = FWP.settings.labels[facet_name];
            if (facet_type !== 'pager' && facet_type !== 'sort') {
              if (facet.closest('.facet-wrap').length < 1 && facet.closest('.facetwp-flyout').length < 1) {
                facet.wrap('<div class="facet-wrap"></div>');
                facet.before('<h3 class="facet-label">' + facet_label + '</h3>');
              }
            }
          });
        });
      })(jQuery);
    </script>
  <?php
}

add_action( 'wp_head', 'fwp_add_facet_labels', 100 );

if(class_exists('WooCommerce')){
  // add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
}

remove_action( 'projects_before_main_content', 'projects_output_content_wrapper', 10 );
remove_action( 'projects_after_main_content', 'projects_output_content_wrapper_end', 10 );

add_action( 'projects_before_main_content', 'my_projects_output_content_wrapper', 10 );
add_action( 'projects_after_main_content', 'my_projects_output_content_wrapper_end', 10 );

function my_projects_output_content_wrapper() {
  echo '<section class="content">';
}

function my_projects_output_content_wrapper_end() {
  echo '</section>';
}


add_action( 'wp_footer', 'cart_update_qty_script', 1000);
function cart_update_qty_script() {
  if (is_cart()) :
    ?>
    <script type="text/javascript">
      jQuery(document).ready(function( $ ) {
      // Enable update cart button upon successful ajax call
      $(document).ajaxSuccess(function() {
      $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
    });
    // Enable update cart button on initial page load
    $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );

    // Update cart when quantity pulldown is changed
    $('body').on('change', '#quantity_pulldown', function () {
      var quantity_selected = $("#quantity_pulldown option:selected").val();
      $('#product_quantity').val(quantity_selected);

      jQuery("[name='update_cart']").removeAttr('disabled');
      jQuery("[name='update_cart']").trigger("click");

    });

  });

    </script>
      <?php
  endif;
}


add_action( 'woocommerce_after_shop_container', 'get_single_prod_sidebar');
// function get_additional_product_blocks() {
//   // wc_get_template( 'template-parts/blocks/image/image.php');

//   $src = wp_upload_dir()[baseurl] . '/2022/03/rotallaukums_sarkans.png';

//   echo 
//   '<div class="section image-section-single">
//     <div class="image-content">
//       <img src="' . $src . '" width="100%" height="623">
//     </div>
//   </div>';
// }

function get_single_prod_sidebar() {
  get_sidebar( 'product' );
}

// Create Shortcode for WooCommerce Cart Menu Item
add_shortcode ('woo_cart_but', 'woo_cart_but' );

function woo_cart_but() {
	ob_start();
  $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
  $cart_url = wc_get_cart_url();  // Set Cart URL ?>
  <div class="menu-item cart-contents xoo-wsc-cart-trigger">
  <a title="My Basket"></a>
  <?php
  if ( $cart_count > 0 ) { ?>
    <span class="cart-contents-count"><?php echo $cart_count; ?></span>
  <?php } ?>
  </div>
  <?php
  return ob_get_clean();
}

//Add AJAX Shortcode when cart contents update
add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );

function woo_cart_but_count( $fragments ) {
  ob_start();
  $cart_count = WC()->cart->cart_contents_count;
  $cart_url = wc_get_cart_url();
  ?>
  <a class="cart-contents menu-item xoo-wsc-cart-trigger" title="<?php _e( 'View your shopping cart', TD); ?>">
	<?php
    if ( $cart_count > 0 ) {
      ?>
      <span class="cart-contents-count"><?php echo $cart_count; ?></span>
      <?php            
    }
  ?></a>
  <?php
  $fragments['a.cart-contents'] = ob_get_clean();
  return $fragments;
}

add_filter( 'dgwt/wcas/form/magnifier_ico', function ( $html, $class ) {
  $html = '<img class="' . $class . '" src="' . THEME_IMG_PATH . '/icons/search.svg" alt="Search icon" width="35" height="35" />';
  return $html;
}, 10, 2 );

//Custom text on cart empty page
remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
add_action( 'woocommerce_cart_is_empty', 'custom_empty_cart_message', 10 );

function custom_empty_cart_message() {
  $html  = '<p class="cart-empty woocommerce-info">';
  $html .= wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Grozs ir tukšs.', 'woocommerce' ) ) );
  echo $html . '</p>';
}

add_action( 'woocommerce_before_checkout_billing_form', 'add_switch_field' );

function add_switch_field() {
  $html =   '<div id="field-sort">
              <div class="field-radio">
                <input type="radio" id="fiz-persona" name="fields" value="fiz-persona"
                      checked>
                <label for="fiz-persona">' . __( 'Fiziska persona', TD ) . '</label>
              </div>

              <div class="field-radio">
                <input type="radio" id="jur-persona" name="fields" value="jur-persona">
                <label for="jur-persona">' . __( 'Juridiska persona', TD ) . '</label>
              </div>
            </div>';
  echo $html;
}

add_action( 'woocommerce_checkout_after_details', 'add_next_tab_button' );

function add_next_tab_button() {
  $html =   '<div id="next-tab">
              <button class="btn bg-gradient next-tab-btn" type="button">' . __( 'Turpināt noformēšanu', TD ) . '<span class="btn-arrow"></span></button>
            </div>';
echo $html;
}

remove_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'facetwp_pagination', 10 );



if ( ! function_exists( 'facetwp_pagination' ) ) {
	function facetwp_pagination() {
    echo facetwp_display('facet','pager_numbers');

    if (is_language('lv')) {
      echo facetwp_display('facet','pager_load');
    } else if (is_language('en')){
      echo facetwp_display('facet','pager_load_en');
    } 
	}
}
?>
