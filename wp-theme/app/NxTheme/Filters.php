<?php

namespace NxTheme;

/**
 * Class Filters
 *
 * Filter definitions.
 * Register in: @see Theme::filters()
 *
 * @see Theme::filters()
 * @package NxTheme
 */
class Filters
{

	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	public static function wp_title($title, $sep)
	{
		global $page, $paged;

		if (is_feed()) {
			return $title;
		}

		// Add the blog name
		$title .= get_bloginfo('name');

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo('description', 'display');
		if ($site_description && (is_home() || is_front_page())) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ($paged >= 2 || $page >= 2) {
			$title .= " $sep " . sprintf(__('Page %s', 'nxtheme'), max($paged, $page));
		}

		return trim($title);
	}

	/**
	 * Extend the default WordPress body classes.
	 *
	 * @param array $classes A list of existing body class values.
	 * @return array The filtered body class list.
	 */
	public static function theme_body_classes($classes)
	{

		$classes[] = 'mod mod-layout';

		if (APP_ENV == 'dev') {
			$classes[] = 'skin-layout-dev';
		}

		return $classes;
	}


	/**
	 * Tiny MCE customisations
	 *
	 * @link http://www.kathyisawesome.com/506/custom-styles-for-wordpress-3-9
	 */

	public static function tiny_mce_before_init(array $opts)
	{

		// Add "richtext" aka "base" aka "text" class to tiny mce
		$opts['body_class'] = 'richtext';

		// Define Styles in Dropdown
		$opts['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3';

		return $opts;
	}


	/**
	 * Replace [more] with ...
	 */
	public static function excerpt_more($more)
	{
		// Return empty (we don't need any additions)
		return '...';
	}


	/**
	 * Custom caption output
	 * - adds all classes from the <img> to the <figure> tag when using captions
	 * - allows responsive styling (float, margin) depending on image size
	 * - from: http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
	 */
	public static function custom_caption($output, $attr, $content)
	{

		/* We're not worried abut captions in feeds, so just return the output here. */
		if (is_feed())
			return $output;

		/* Set up the default arguments. */
		$defaults = array(
			'id' => '',
			'align' => 'alignnone',
			'width' => '',
			'caption' => ''
		);

		/* Merge the defaults with user input. */
		$attr = shortcode_atts($defaults, $attr);

		/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
		if (1 > $attr['width'] || empty($attr['caption']))
			return $content;

		/* Get image size */
		preg_match('/<img.*class[ \t]*=[ \t]*["\']([^"\']*)["\'][^>]+>/', $content, $matches);
		$class_attr = isset($matches[1]) && $matches[1] ? $matches[1] : false;

		/* Set up the attributes for the caption <div>. */
		$attributes = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '');
		$attributes .= ' class="wp-caption ' . esc_attr($attr['align']) . ' ' . esc_attr($class_attr) . '"';

		/* Open the caption <div>. */
		$output = '<figure' . $attributes . '>';

		/* Allow shortcodes for the content the caption was created for. */
		$output .= do_shortcode($content);

		/* Append the caption text. */
		$output .= '<figcaption class="wp-caption-text">' . $attr['caption'] . '</figcaption>';

		/* Close the caption </div>. */
		$output .= '</figure>';

		/* Return the formatted, clean caption. */
		return $output;
	}

	public static function editor_buttons($buttons)
	{
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}

	/*
	* Callback function to filter the MCE settings
	*/
	public static function my_mce_before_init_insert_formats($init_array)
	{

	// Define the style_formats array

		$style_formats = array(
			/*
			* Each array child is a format with it's own settings
			* Notice that each array has title, block, classes, and wrapper arguments
			* Title is the label which will be visible in Formats menu
			* Block defines whether it is a span, div, selector, or inline style
			* Classes allows you to define CSS classes
			* Wrapper whether or not to add a new block-level element around any selected elements
			*/
			array(
				'title' => 'Icon Checkmark',
				'block' => 'span',
				'classes' => 'a-title__icon a-title__icon--checkmark',
				'wrapper' => true,
			),
			array(
				'title' => 'Icon Exclamationmark',
				'block' => 'span',
				'classes' => 'a-title__icon a-title__icon--exclamationmark',
				'wrapper' => true,
			),
			array(
				'title' => 'Icon Fire',
				'block' => 'span',
				'classes' => 'a-title__icon a-title__icon--fire',
				'wrapper' => true,
			),
			array(
				'title' => 'Icon Flash',
				'block' => 'span',
				'classes' => 'a-title__icon a-title__icon--flash',
				'wrapper' => true,
			),
			array(
				'title' => 'Primary Button',
				'selector' => 'a',
				'classes' => 'a-button',
			),
		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode($style_formats);

		return $init_array;

	}

	/*
	 * Filter to remove WYSIWYG Editor on Posts and Pages
	 */
	public static function init_remove_support(){
		$post_type = 'page';
		//remove_post_type_support( $post_type, 'editor');
	}

}
