<!DOCTYPE html>
<html lang="lv">
<head>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="robots" content="noindex, nofollow">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <?php 
    wp_head(); 
  ?>
</head>

<body id="bootstrap-overrides" <?php body_class(); ?>>
	<?php get_template_part( 'template-parts/head-navigation' ); ?>
	<div class="intro shop-container">
		<div class="heading">
			<h2 class="section-heading"><?php _e( 'Katalogs', TD );?></h2>
		</div>
		<div class="breadcrumbs">
			<?php
			/**
			 * Hook: woocommerce_after_shop_header.
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action( 'woocommerce_after_shop_header' ); ?>
		</div>
		<div class="shop-intro">
			<h2 class="woocommerce-products-header__title page-title"><?php _e( 'Bērnu rotaļlaukumi', TD );?></h2>
			<?php
			/**
			 * Hook: woocommerce_shop_description.
			 *
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_shop_description' );
			?>
			<hr class="before-shop-line">
		</div>
	</div>
  <div class="site-content shop-container">
