=== WooCommerce Custom Products Widget ===
Contributors: christophrado
Donate link: https://www.paypal.me/christophrado
Tags: woocommerce, ecommerce, product, widget, sidebar, custom, id, list, extension
Requires at least: 4.7
Tested up to: 5.6
Stable tag: 1.0.2
Requires PHP: 5.2.4
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Display a custom selection of WooCommerce products in any widget area, set by IDs.

== Description ==

WooCommerce Custom Products Widget allows you to display a custom selection of products. It uses the same styling as the WooCommerce built-in Product List widget. The products are being displayed in the order they are entered in the ID input field.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/woocommerce-custom-products-widget` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Add the widget using the Design->Widgets screen

== Frequently Asked Questions ==

= Where do I find the product ID? =

In the Products->All Products screen, hover over a product to reveal its ID below its name. Do not use the SKU, but the WordPress internal product ID.

= Can I add custom styling to the widget? =

Yes, but only via CSS. The widget is constructed with the custom class custom_product_list_widget, which you can target.

= Can I modify the widget output?

Yes, it implements the same filters as the original WooCommerce Product List widget, namely woocommerce_products_widget_query_args, woocommerce_before_widget_product_list and woocommerce_after_widget_product_list. It also uses the WooCommerce built-in template content-widget-product.php, which you can overwrite.

== Screenshots ==

1. Widget settings

== Changelog ==

= 1.0.2 =
* Declare WC support
* WP tested up to 5.6
* WC tested up to 4.8

= 1.0.1 =
* Set correct text domain for translations.

= 1.0 =
* Initial release.