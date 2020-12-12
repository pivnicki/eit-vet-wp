<?php

class EIT_VET_WPP_Custom_Post
{
	public function register() {
		add_action( 'init', array( $this, 'eit_vet_wpp_custom_post_type' ) );
		add_action( 'init', array( $this, 'eit_vet_wpp_custom_taxonomies' ) );
		add_shortcode( 'portfolio_shortcode', array( $this, 'portfolio_list_shortcode' ) );
	}

	/*
	 * Custom Post Type
	 */
	public function eit_vet_wpp_custom_post_type () {
		
		$labels = array(
			'name' => 'Animal',
			'singular_name' => 'Animal',
			'add_new' => 'Add Item',
			'all_items' => 'All Items',
			'add_new_item' => 'Add Item',
			'edit_item' => 'Edit Item',
			'new_item' => 'New Item',
			'view_item' => 'View Item',
			'search_item' => 'Search Animal',
			'not_found' => 'No items found',
			'not_found_in_trash' => 'No items found in trash',
			'parent_item_colon' => 'Parent Item'
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => true,
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => 'dashicons-welcome-widgets-menus',
			'supports' => array(
				'title',
				'editor', 
				'thumbnail',
				'revisions', 
			),
			//'taxonomies' => array('category', 'post_tag'),
			'menu_position' => 5,
			'exclude_from_search' => false
		);
		register_post_type('animal',$args);
	}

	public function eit_vet_wpp_custom_taxonomies() {
		
		//add new taxonomy hierarchical
		$labels = array(
			'name' => 'Categories',
			'singular_name' => 'Category',
			'search_items' => 'Search Categories',
			'all_items' => 'All Categories',
			'parent_item' => 'Parent Category',
			'parent_item_colon' => 'Parent Category:',
			'edit_item' => 'Edit Category',
			'update_item' => 'Update Category',
			'add_new_item' => 'Add New Animal Category',
			'new_item_name' => 'New Category Name',
			'menu_name' => 'Categories'
		);
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'animal-category' )
		);
		
		register_taxonomy('animal-category', array('animal'), $args);
	}


	/*
	 * Custom Post Type Portfolio Shortcode
	 */
	public function portfolio_list_shortcode($atts) {

		ob_start();

	    // Set the arguments for the query
	    extract( shortcode_atts( array (
	    'type' => 'animal',
	    'order' => 'desc',
	    'posts' => 3,

	    'category' => '',
	    ), $atts ) );
	    $args_pl = array(
	            'post_type' => $type,
	            'order' => $order,
	            'posts_per_page' => $posts,

	            'category_name' => $category,
	    );

	    // Get the posts
	    $myposts = new WP_Query($args_pl);

	    // If there are posts
	     if ( $myposts->have_posts() ) {
			while ( $myposts->have_posts() ) : $myposts->the_post(); ?>
	        	
				<div class="portfolio-list">
 

					<?php if (has_post_thumbnail()) {  the_post_thumbnail('large'); } ?>

					<div class="entry-summary">

						<?php the_excerpt(); ?>

					</div><!-- .entry-summary -->
 

				</div><!-- #post-## -->


	        <?php
	    	endwhile; wp_reset_postdata(); 

	      	$myvariable = ob_get_clean();
	   		return $myvariable;
	    }
	}
} 