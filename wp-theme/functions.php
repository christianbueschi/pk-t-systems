<?php

// Define Default Environment
if (!defined('APP_ENV')) define('APP_ENV', 'prod');

/**
 * Returns modified time from file REVISION in repository root if present, otherwise from this file.
 * Stamp is base 36 converted to get shorter string.
 *
 * @param $path
 * @return string
 */
function getRevision() {
	$revisionFile = __DIR__ . '/../' . 'REVISION';
	if (file_exists($revisionFile)) {
		$stamp = filemtime($revisionFile);
	} else {
		$stamp = filemtime(__FILE__);
	}

	// convert base
	return base_convert($stamp, 10, 36);
}
define('RELEASE_STAMP', getRevision());


//// Paths

// Theme Paths
define('THEME_PATH', __DIR__);
define('THEME_URL', parse_url(get_bloginfo('template_url'), PHP_URL_PATH));

// Assets Paths
define('ASSETS_DIR', '/_static');
define('ASSETS_PATH', THEME_PATH . ASSETS_DIR);
define('ASSETS_URL', THEME_URL . ASSETS_DIR);

// Vendor Libs Paths
define('VENDOR_PATH', THEME_PATH . '/vendor');

// Theme src Path
define('INCLUDES_PATH', THEME_PATH . '/app/NxTheme');

// Partials Path
define('TC_PARTIALS_PATH', THEME_PATH . '/app/partials');
define('TC_MODULES_PATH',  THEME_PATH . '/app/NxModule');


//// Class Loader, PSR-0 (Symfony2 Classloader)
require_once VENDOR_PATH . '/Nx/ClassLoader.php';
$loader = new \Nx\ClassLoader();

// register classes with namespaces
$loader->addPrefix('NxTheme',  THEME_PATH . '/app');
$loader->addPrefix('NxModule', THEME_PATH . '/app');
$loader->addPrefix('Nx',        VENDOR_PATH);

// activate the autoloader
$loader->register();

// Must Use Plugins
//require WPMU_PLUGIN_DIR.'/advanced-custom-fields/acf.php';

//// Init

// Config
\Nx\Terrific::$PARTIALS_PATH = TC_PARTIALS_PATH;
\Nx\TerrificModule::$MODULES_PATH = TC_MODULES_PATH;

// Theme Init
\NxTheme\Theme::init();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Shortcut: Terrific Module, to include in templates
 *
 * @see \Nx\Terrific::module()
 * @param $name
 * @return \Nx\TerrificModule
 */
function module($name) {
	return \Nx\Terrific::module($name);
}

/**
 * Shortcut: Partial, to include in templates
 *
 * @see \Nx\Terrific::partial()
 * @param $name
 * @param $options
 *
 * @return string
 */
function partial($name, $options = array()) {
	return \Nx\Terrific::partial($name, $options);
}

/**
 * Shortcut: Debug
 *
 * @param $value
 */
function debug($value) {
	return \NxTheme\Helpers::debug($value);
}

add_filter( 'block_categories', function( $categories, $post ) {
    return array_merge(
        array(
            array(
                'slug'  => 'pk-t-systems',
                'title' => 'PK T-Systems',
            ),
		),
		$categories
    );
}, 10, 2 );

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a stage block
		acf_register_block(array(
			'name'				=> 'stage',
			'title'				=> __('Stage'),
			'description'		=> __('Stage Block. Use this as the first element of your page'),
			'render_callback'	=> 'acf_block_render_callback',
			'category'			=> 'pk-t-systems',
			'icon'				=> '',
			'keywords'			=> '',
		));

		// register a cta block
		acf_register_block(array(
			'name'				=> 'cta',
			'title'				=> __('Call to Action'),
			'description'		=> __('Call to Action Block. Add multiple CTA elements'),
			'render_callback'	=> 'acf_block_render_callback',
			'category'			=> 'pk-t-systems',
			'icon'				=> '',
			'keywords'			=> '',
		));

		// register a accordion block
		acf_register_block(array(
			'name'				=> 'accordion',
			'title'				=> __('Accordion'),
			'description'		=> __('Acordion Block. Pack multiple items inside an accordion'),
			'render_callback'	=> 'acf_block_render_callback',
			'category'			=> 'pk-t-systems',
			'icon'				=> '',
			'keywords'			=> '',
		));

		// register a downloads block
		acf_register_block(array(
			'name'				=> 'downloads',
			'title'				=> __('Downloads'),
			'description'		=> __('Downloads Block. Show files as downloads'),
			'render_callback'	=> 'acf_block_render_callback',
			'category'			=> 'pk-t-systems',
			'icon'				=> '',
			'keywords'			=> '',
		));
	}
}

function acf_block_render_callback( $block ) {

	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists(STYLESHEETPATH . "/app/NxModule/{$slug}/{$slug}.phtml") ) {
		include( STYLESHEETPATH . "/app/NxModule/{$slug}/{$slug}.phtml" );
	}
}

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_action('init', 'init_remove_support',100);

function init_remove_support(){
    $post_type = 'page';
    remove_post_type_support( $post_type, 'editor');
}

add_filter('use_block_editor_for_post', '__return_false');
add_filter('gutenberg_can_edit_post_type', '__return_false');

function digwp_disable_gutenberg($is_enabled, $post_type) {
	
	if ($post_type === 'page') return false; // change book to your post type
	
	return $is_enabled;
	
}
add_filter('use_block_editor_for_post_type', 'digwp_disable_gutenberg', 10, 2);