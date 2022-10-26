<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */


function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

add_action( 'edited_terms', function() {

    wp_cache_delete('mkb_menu_categories');

});


add_shortcode('mkb-menu-desktop', function () {
    ob_start();
    require 'templates/menu_new_desktop.php';
    $contents = ob_get_contents();
    ob_clean();

    return $contents;
});

add_shortcode('mkbws-mobile-menu', function () {
    ob_start();
    require 'templates/menu_new_tabmob.php';
    $contents = ob_get_contents();
    ob_clean();
    return $contents;
});

function get_mkb_term_image_src($term_id, $size = 'woocommerce_gallery_thumbnail', $icon = false)
{
    $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );

    return wp_get_attachment_image_src( $thumbnail_id, $size, $icon);
}

function get_mkb_wc_grouped_product_categories() {

    $categories = get_transient('mkb_menu_categories');

    if ($categories && ! empty($categories) && ! is_user_logged_in()) {
        return $categories;
    }

    $parents = get_categories([
        'taxonomy' => 'product_cat',
        'order' => 'ASC',
        'meta_key' => 'order',
        'orderby' => 'meta_value_num',
        'parent' => 0,
    ]);

    $categories = [];
    foreach ($parents as $parent) {

        $children = get_categories([
            'taxonomy' => 'product_cat',
            'order' => 'ASC',
            'meta_key' => 'order',
            'orderby' => 'meta_value_num',
            'parent' => $parent->term_id,
        ]);

        if (! count($children)) {
            continue;
        }

        $categories[$parent->term_id] ??= $parent;
        $categories[$parent->term_id]->categories = [];
        $parent->image = get_mkb_term_image_src($parent->term_id);

        foreach ($children as $child) {
            $child->image = get_mkb_term_image_src($child->term_id);

            $categories[$parent->term_id]->categories[] = $child;
        }
    }

    set_transient('mkb_menu_categories', $categories);

    return $categories;
}

function mkb_get_current_customer()
{
    if (! wp_get_current_user()?->ID) {
        return null;
    }

    return new WC_Customer(wp_get_current_user()->ID);
}

function mkb_build_cat_link($category, $alt = null)
{
    return sprintf(
        '<a href="%1$s" alt="%2$s">%3$s</a>',
        esc_url(get_category_link($category->term_id)),
        esc_attr($alt ?: sprintf(__('Bekijk producten van categorie %s', 'hell-theme-child-master'), $category->name)),
        esc_html($category->name)
    );
}


add_filter( 'woocommerce_checkout_fields', function ( $checkout_fields ) {
        $checkout_fields['billing']['billing_email']['priority'] = 4;
        return $checkout_fields;
});

function mkbws_ajax_add_to_cart() 
{
    wp_send_json([
        'data' => WC()->cart->add_to_cart(
            intval( $_POST['product_id'] ),
            intval( $_POST['quantity'] ),
	    intval( $_POST['variation_id'] ?? null ),
        )
    ]);

    wp_die();
}

// Script door MKB Watersport en UTeq voor Crocoblock Woo Page Builder: custom WooCommerce Checkout template, vanaf versie V2.0
/** Shortcode is in snippet */
add_action( 'wp_ajax_add_to_cart', 'mkbws_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_add_to_cart', 'mkbws_ajax_add_to_cart' );

function mkbws_checkout_cart_totals()
{
	global $woocommerce;

	$subtotaal = number_format((double) (WC()->cart->get_subtotal() + WC()->cart->get_subtotal_tax()), 2, ',', '');
	$totaal = number_format((double) WC()->cart->total , 2, ',', ' ');
	$verzendkosten = WC()->cart->get_shipping_total();
	$verzendbtw = WC()->cart->get_shipping_tax();

	// Verzendkosten incl BTW
	$verzendTotaal = number_format((double)$verzendkosten + $verzendbtw, 2, ',', ' ');

	$subtotaal_ex = number_format((double)WC()->cart->subtotal_ex_tax, 2, ',', '');
	$btw = number_format((double)WC()->cart->get_taxes_total(), 2, ',', '');
	$kortingen = WC()->cart->get_coupon_discount_totals();
	$kortingenTax = WC()->cart->get_coupon_discount_tax_totals();

	$shippingMethod = WC()->session->get( 'chosen_shipping_methods' )[0];

	if (str_contains($shippingMethod, 'local_pickup')) {
		$verzendkosten = '<b style="color: var(--e-global-color-accent);">Afhalen</b>';
	} else if ($verzendkosten == "0.00") {
		$verzendkosten = '<b style="color: var(--e-global-color-accent);">Gratis</b>';
	} else {
		$verzendkosten = '€ ' . $verzendTotaal;
	}

	// Toon producten in checkout lijst

	$items = $woocommerce->cart->get_cart();

	echo '<div class="mkbws_checkout">

		<div class="checkout_total_items"> 
	';
		foreach($items as $item => $values) {
			$_product =  wc_get_product( $values['data']->get_id() );
			$getProductDetail = wc_get_product( $values['product_id'] );
			$price = wc_get_price_including_tax($values['data']);
			$meta = wc_get_formatted_cart_item_data( $values, true );

			echo '
			<div class="checkout_totals_item">
				<div class="checkout_totals_image">' . $getProductDetail->get_image() . '</div>' . '
				<div class="checkout_totals_title">
					<div class="checkout_product_title">' . $values['data']->get_name() . ' <span class="product-quantity">x ' . $values['quantity'] .'</span></div>
					<div class="checkout_product_price">€ '. number_format($price * $values['quantity'], 2, ',', '') . '</div>
				</div>
			</div>';
		}

		echo '
		</div>
		<div class="mkbws_checkout_totals">
			<div class="mkbws_checkout_totals_row">
				<div class="mkbws_checkout_totals_label">
					<b>Subtotaal incl. BTW: </b>
				</div>
				<div class="mkbws_checkout_totals_num">
					<span> € ' . $subtotaal . '</span>
				</div>
			</div>

			<div class="mkbws_checkout_totals_row">
				<div class="mkbws_checkout_totals_label">
					<b>Verzendkosten: </b>
				</div>
				<div class="mkbws_checkout_totals_num">
					<span> ' . $verzendkosten .'</span>
				</div>
			</div>';

			if (count($kortingen)) {
			echo '
			<div class="mkbws_checkout_totals_row">
				<div class="mkbws_checkout_totals_label">
					<b>Waardebon korting: </b>
				</div>
				<div class="mkbws_checkout_totals_num">';
					foreach ($kortingen as $code => $korting) {
						echo '
						<div class="mkbws_checkout_code_block">
							<div class="mkbws_checkout_code">' . $code . '</div> 
							<div class="mkbws_checkout_code_bedrag">&euro; -' . number_format($korting + $kortingenTax[$code], 2, ',', '') . '</div>
						</div>';
					}
				echo '
				</div>
			</div>';
			}

			echo '
			<div class="mkbws_checkout_totals_row">
				<div class="mkbws_checkout_totals_label">
					<b>Je betaalt in totaal: </b>
				</div>
				<div class="mkbws_checkout_totals_num mkbws_totals_final">
					<span>€ '. $totaal .'</span>
				</div>
			</div>

			<div class="mkbws_checkout_totals_row">
				<div class="mkbws_checkout_totals_btw_label">
					<span>Waarvan BTW: € '. $btw .'</span>
				</div>
			</div>

		</div>
	';

	exit();
}

add_action( 'wp_ajax_mkbws_checkout_cart_totals', 'mkbws_checkout_cart_totals');
add_action( 'wp_ajax_nopriv_mkbws_checkout_cart_totals', 'mkbws_checkout_cart_totals');
// Einde Custom Woo Checkout script

// Geeft terug hoeveel video's de productpagina heeft
//  Dit is gekoppeld met Advanced Custom Fields (ACF)
function mkbws_count_product_page_product_videos() {

    global $product;

    $items = get_field('ss_product_videos', $product->get_id());

    return count($items);
}

/**
 * FIX Woocommerce - Checkout
 * Disables the cache of the shipping methods on the checkout page.
 *
 * New users would see all the shipping methods possible.
 * Woocommerce Restrictions plugin should prevent his.
 * Kinsta's Object Cache is the problem here.
 */
add_action('woocommerce_checkout_update_order_review', function() {
        $packages = WC()->cart->get_shipping_packages();
        foreach ($packages as $package_key => $package ) {
                WC()->session->set( 'shipping_for_package_' . $package_key, false ); // Or true
        }
}, 10, 1);

