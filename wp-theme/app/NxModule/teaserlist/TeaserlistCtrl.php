<?php

namespace NxModule\teaserlist;

class TeaserlistCtrl {

	/**
	 * Define default args for the controller
	 *
	 * @var array
	 */
	protected static $DEFAULT_CTRL_ARGS = array(
		'count' => ''
	);

	/**
	 * Define default vars for the view
	 * In the view, test with empty() if a value is set
	 *
	 * @var array
	 */
	protected static $DEFAULT_VIEW_VARS = array(
		
	);

	/**
	 * Get data for a TeaserList
	 *
	 * @param array $args
	 * @return array
	 */
	public static function data(array $args = array()) {

		global $wp_query;

		// Extend default args
		$ctrlArgs = array_merge(self::$DEFAULT_CTRL_ARGS, $args);

		// Set default vars for the view
		$viewData = self::$DEFAULT_VIEW_VARS;

		$viewData['count'] = $ctrlArgs['count'];

		$args = array(
			'numberposts' => -1,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type'        => 'post',
			'suppress_filters' => true,
			'category__not_in' => 3 ,
		);


		$viewData['posts'] = get_posts( $args );
		$viewData['title'] = get_sub_field('title');

		$viewData['buttonText'] = 'Alle News';
		$viewData['buttonLink'] = '/news';

		return $viewData;
	}
}