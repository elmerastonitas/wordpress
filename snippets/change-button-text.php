<?php

/**
 * Change button text in WooCommerce
 *
 * This code snippet changes the default button texts in WooCommerce.
 * 
 * To use this snippet:
 * Add the list of cities to the `functions.php` file or use the Code Snippets plugin (https://wordpress.org/plugins/code-snippets/)
 */

/* Change the "Add to cart" text on the single product page */
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single' ); 
function woocommerce_add_to_cart_button_text_single() {
    return __( 'Add', 'woocommerce' );
}

/* Change the "Add to cart" text on the product archives page */
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_add_to_cart_button_text_archives' );  
function woocommerce_add_to_cart_button_text_archives() {
    return __( 'Add', 'woocommerce' ); 
}

/* Change the "Proceed to checkout" text */
add_filter('woocommerce_order_button_text', function () {
    return 'Checkout'; 
});
