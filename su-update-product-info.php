/*
 * function to be called when a product needs updating*/

function update_products_stock_level($product_id){
	$terms = wp_get_post_terms($product_id,'product_cat');
	foreach($terms as $terms) $categories[] = $term->slug;
	
	if(bbloomer_check_category_in_cart() == true){
		$out_of_stock_staus = 'outofstock';

		// 1. Updating the stock quantity
		update_post_meta($product_id, '_stock', 0);
		
		// Add product to swished category for user profile. 
		wp_set_object_terms($product_id, 136, 'product_cat');
		
		// Remove product from clothing category for user profile. 
		$term = get_term_by('name', 'Clothing', 'product_cat');
		wp_remove_object_terms($product_ID, $term->term_id, 'product_cat');

		// 2. Updating the stock quantity
		update_post_meta( $product_id, '_stock_status', wc_clean( $out_of_stock_staus ) );

		// 3. Updating post term relationship
		wp_set_post_terms( $product_id, 'outofstock', 'product_visibility', true );

		// And finally (optionally if needed)
		wc_delete_product_transients( $product_id ); // Clear/refresh the variation cache
	}
	
}
