<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

// if ( ! $product_attributes ) {
// 	return;
// }

function compareOrderNo($elem1, $elem2) {
	return strcmp($elem1['menu_order'], $elem2['menu_order']);
}


$fields = get_field_objects();
if( $fields ): 
uasort($fields,'compareOrderNo');?>
	<div class="attributes">
		<?php foreach( $fields as $field ):
			if ($field['value']) {
				$src = THEME_IMG_PATH . '/icons';
				$label = $field['name'];
				switch ($label) {
					case 'height':
						$src .= '/H.svg';
						$alt = "Produkta laukums";
						break;
					case 'width':
						$src .= '/W.svg';
						$alt = "Produkta laukums";
						break;
					case 'length':
						$src .= '/L.svg';
						$alt = "Produkta laukums";
						break;
					case 'area':
						$src .= '/lauk.svg';
						$alt = "Produkta laukums";
						break;
					case 'safety_area':
						$src .= '/safety_area.svg';
						$alt = "Dro分入bas zona";
						break;
					case 'age':
						$src .= '/age.svg';
						$alt = "Ieteicamas vecums";
						break;
					default:
						continue 2;
					}?>
				<div class="attribute-item <?php echo $field['name']; ?>">
					<img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" width="84" height="84">
					<p class="woocommerce-product-attributes-item__value small"><?php echo $field['value'] . $field['append']; ?></p>
				</div>
		
			<?php }
		endforeach; ?>
	</div>
<?php endif;?>