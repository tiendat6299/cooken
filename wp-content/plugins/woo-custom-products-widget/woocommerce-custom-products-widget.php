<?php
/*
Plugin Name: WooCommerce Custom Products Widget
Description: Display a custom selection of WooCommerce products in any widget area, set by IDs.
Author: Christoph Rado
Version: 1.0.2
Author URI: https://christophrado.de/
WC requires at least: 2.5
WC tested up to: 4.8
*/

defined( 'ABSPATH' ) || exit;

require_once WP_PLUGIN_DIR . '/woocommerce/includes/abstracts/abstract-wc-widget.php';

class WC_Widget_Custom_Products extends WC_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_products widget_custom_products';
		$this->widget_description = __( 'A custom list of products.', 'woo-custom-products-widget' );
		$this->widget_id          = 'woocommerce_custom_products';
		$this->widget_name        = __( 'Custom products', 'woo-custom-products-widget' );
		$this->settings           = array(
			'title'       => array(
				'type'  => 'text',
				'std'   => __( 'Products', 'woo-custom-products-widget' ),
				'label' => __( 'Title', 'woo-custom-products-widget' ),
			),
			'ids'       => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Product IDs', 'woo-custom-products-widget' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Query the products and return them.
	 *
	 * @param  array $args     Arguments.
	 * @param  array $instance Widget instance.
	 * @return WP_Query
	 */
	public function get_products( $args, $instance ) {
		$ids		= $instance['ids'];
		$id_array	= explode( ',', $ids );

		$query_args = array(
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'no_found_rows'  => 1,
			'meta_query'     => array(),
			'tax_query'      => array(
				'relation' => 'AND',
			),
    		'post__in'		 => $id_array,
			'orderby'        => 'post__in',
		);

		return new WP_Query( apply_filters( 'woocommerce_products_widget_query_args', $query_args ) );
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		$products = $this->get_products( $args, $instance );
		if ( $products && $products->have_posts() ) {
			$this->widget_start( $args, $instance );

			echo wp_kses_post( apply_filters( 'woocommerce_before_widget_product_list', '<ul class="product_list_widget custom_product_list_widget">' ) );

			$template_args = array(
				'widget_id'   => $args['widget_id'],
				'show_rating' => true,
			);

			while ( $products->have_posts() ) {
				$products->the_post();
				wc_get_template( 'content-widget-product.php', $template_args );
			}

			echo wp_kses_post( apply_filters( 'woocommerce_after_widget_product_list', '</ul>' ) );

			$this->widget_end( $args );
		}

		wp_reset_postdata();

		echo $this->cache_widget( $args, ob_get_clean() );
	}
}

function wccpw_register_widget() {
	if( class_exists( 'WooCommerce' ) )
		register_widget( 'WC_Widget_Custom_Products' );
}
add_action( 'widgets_init', 'wccpw_register_widget' );