<?php

class EIT_VET_WPP_Main
{
	public function __construct( $post, $metaBoxClass ) {
		$post->register();
		$metaBoxClass->register();
	}

	public function activate() {
		// flush rewrite rules
		flush_rewrite_rules();
		//echo "The plugin was activated";
	}

	public function deactivate() {
		// flush rewrite rules
		flush_rewrite_rules();
	}

	public function uninstall() {
		if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
			die;
		}

		// Clear Database stored data
		$animals = get_posts( array( 'post_type' => 'animal', 'numberposts' => -1 ) );

		foreach( $animals as $animal ) {
		wp_delete_post( $animal->ID, true );
		}
	}

	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles') );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts') );
	}

	public function enqueue_styles() {

		$screen = get_current_screen();
		if( 'animal' != $screen->id ) {
			return;
		}

		wp_enqueue_style( 'eit-wpp-custom-post-admin', plugins_url( '/assets/css/my-admin.css', __FILE__ ), array(), '1.0.0' );
	}

	public function enqueue_scripts() {

		$screen = get_current_screen();
		if( 'animal' != $screen->id ) {
			return;
		}

		
		wp_enqueue_script( 'TweenMax', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', null, null, true );
		wp_enqueue_script( 'jquery-1.12.4.js', 'https://code.jquery.com/jquery-1.12.4.js', null, null, true );
		wp_enqueue_script( 'jquery-ui.js', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', null, null, true );
		wp_enqueue_script( 'ldwpd-custom-post-admin', plugins_url( '/assets/js/my-admin.js', __FILE__ ), array( 'jquery' ), '1.0.0',true ); 
	}
}