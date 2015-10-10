<?php
/*
Plugin Name: Lille Perle Reorder Single Product Template
Plugin URI: https://github.com/ohsoren/lilleperle-single-product-template-reorder-plugin
Description: Includes functions to reorder WooCommerce single product content hooks.
Version: 0.1
Author: @ohsoren
Author URI: https://github.com/ohsoren
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

add_action( 'get_header', 'lilleperle_reorder_single_product_template' );

function lilleperle_reorder_single_product_template () {
  /*
   * basic reorder of shop and single product template
   * still being refactored
  */

  /**
   * woocommerce_single_product_summary hook
   *
   * @hooked woocommerce_template_single_title - 5
   * @hooked woocommerce_template_single_rating - 10
   * @hooked woocommerce_template_single_price - 10
   * @hooked woocommerce_template_single_excerpt - 20
   * @hooked woocommerce_template_single_add_to_cart - 30
   * @hooked woocommerce_template_single_meta - 40
   * @hooked woocommerce_template_single_sharing - 50
   */

  // Remove product category/tag meta from its original loaction
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
  // Add product meta in new location
  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );

  // Remove product title from its original loaction
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
  // Add product title in new location
  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );

  // Remove product price from its original loaction
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
  // Add product price in new location
  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );

  /**
   * woocommerce_after_single_product_summary hook
   *
   * @hooked woocommerce_output_product_data_tabs - 10
   * @hooked woocommerce_upsell_display - 15
   * @hooked woocommerce_output_related_products - 20
   */

  // Remove product tabs (description, additional information, reviews)
  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

  // Add product description tab content in new location
  function woocommerce_template_product_description() {
	  woocommerce_get_template( 'single-product/tabs/description.php' );
  }
  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 20 );

  // Add product additional information tab content in new location
  function woocommerce_template_product_additional() {
	  woocommerce_get_template( 'single-product/tabs/additional-information.php' );
  }
  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_additional', 30 );

  // Remove product cart from it original loaction
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
  // Add product cart in new location
  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40 );

  // Remove product "Related Products"
  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

  // Remove shop breadcrumb
  remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

  // Remove main shop page "Showing X results" text
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

  // Remove main shop page product filter
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

}
