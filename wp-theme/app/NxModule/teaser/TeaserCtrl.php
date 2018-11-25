<?php

namespace NxModule\teaser;

class TeaserCtrl {

	/**
	 * Define default args for the controller
	 *
	 * @var array
	 */
	protected static $DEFAULT_CTRL_ARGS = array();

	/**
	 * Define default vars for the view
	 * In the view, test with empty() if a value is set
	 *
	 * @var array
	 */
	protected static $DEFAULT_VIEW_VARS = array(
		'title' => '',
		'date' => '',
		'permalink' => '',
		'category_link_list' => '',
		'excerpt' => '',
		'thumbnail_id' => '',
		'social_info_ctrl' => 'data'
	);

	/**
	 * Get data for a teaser
	 *
	 * @param $args
	 * @return array
	 */
	public static function data(array $args = array()) {

		// Extend default args
		$ctrlArgs = array_merge(self::$DEFAULT_CTRL_ARGS, $args);

		// Set default vars for the view
		$viewData = self::$DEFAULT_VIEW_VARS;

		$post = $ctrlArgs['post'];

		$id = $post->ID;
		$viewData['link'] = get_permalink($id);
		$viewData['title'] = $post->post_title;
		$viewData['date'] = get_the_date('j F Y', $id);
		$viewData['image'] = get_the_post_thumbnail($id);
		$viewData['content'] = wp_trim_words( $post->post_content, $num_words = 30, $more = null);

		return $viewData;
	}

}