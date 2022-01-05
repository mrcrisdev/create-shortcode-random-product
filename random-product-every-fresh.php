<?php

add_shortcode( 'random_products', 'cris_random_products' );

function cris_random_products(  ) {


	$meta_query = WC()->query->get_meta_query();

	$args = array(
		'post_type'				=> 'product',
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' 		=> '24',
		'orderby'               => 'rand',
		'meta_query' 			=> $meta_query
	);

	ob_start();

	$products = new WP_Query( $args );

	$columns = '4';
	$woocommerce_loop['columns'] = $columns;
	if ( $products->have_posts() ) : ?>

		<?php woocommerce_product_loop_start(); ?>

		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	<?php endif;

	wp_reset_postdata();

	return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
}

?>