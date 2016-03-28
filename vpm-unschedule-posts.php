<?php
/*
Plugin Name: Unschedule Posts
Description: Adds a UI to unschedule any post type.
Version: 1.0
Author: Van Patten Media Inc.
Author URI: https://www.vanpattenmedia.com/
License: GPLv2
Text Domain: vpm
*/

$vpm_unschedule_posts = new Vpm_Unschedule_Posts();

class Vpm_Unschedule_Posts {

	public $plugin_url;
	public $plugin_dir;

	public function __construct() {
		$this->plugin_dir = dirname( __FILE__ );
		$this->plugin_url = plugins_url( 'vpm-unschedule-posts' );

		// Add all our hooks.
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Any WP actions we need to hook into for our plugin, we'll do so here.
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_js' ) );

		add_action( 'post_submitbox_misc_actions', array( $this, 'add_unschedule_ui' ) );
	}

	public function add_admin_js() {
		$screen = get_current_screen();

		if ( in_array( $screen->base, array( 'post', 'edit' ) ) ) {

			wp_enqueue_script(
				'vpm-unschedule-script',
				$this->plugin_url . '/assets/javascripts/vpm-unschedule-posts.js',
				array( 'jquery' ),
				false,
				true
			);
		}
	}

	/**
	 * Add the unschedule UI, if the current post has a date in the future or a scheduled post status.
	 *
	 * @param $post WP_Post
	 */
	public function add_unschedule_ui($post) {
		if ( time() < get_post_time( 'U', true, $post->ID ) || 'future' == $post->post_status ) {
			?>
			<div class="misc-pub-section">
				<a href="#" id="vpm-js-unschedule-post">Unschedule</a>
			</div>
			<?php
		}
	}

}
