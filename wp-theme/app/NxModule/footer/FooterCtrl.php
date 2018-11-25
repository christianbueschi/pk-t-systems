<?php

namespace NxModule\footer;

class FooterCtrl {

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
		'menu_links' => '',
		'menu_social' => '',
		'address' => ''
	);

	/**
	 * * Get Teaser Query
	 * @param array $args
	 * @return array
	 */
	public static function data(array $args = array()) {

		// Extend default args
		$ctrlArgs = array_merge(self::$DEFAULT_CTRL_ARGS, $args);

		// Set default vars for the view
		$viewData = self::$DEFAULT_VIEW_VARS;

		$viewData['contact_title'] = get_field('contact_title', 'options');
		$viewData['address_title'] = get_field('address_title', 'options');
		$viewData['address'] = get_field('address', 'options');
		$viewData['sitemap_title'] = get_field('sitemap_title', 'options');


		/* Copy of NavCtrl.php */
		
		// Define menu locations
		$map_menu_locations = array(
			'main_nav' => 'main-nav'
		);

		foreach ($map_menu_locations as $menu => $menu_location) {

			$menu_object = \NxTheme\Helpers::getMenuObject($menu_location);

			$viewData[$menu] = false;
			if(is_wp_error($menu_object) == false && $menu_object !== false) {

				$viewData[$menu] = array(
					'items' => wp_get_nav_menu_items($menu_object->term_id),
					'label' => $menu_object->name
				);
			}
		}

		$nav = [];
		$rootIndex = 0;

		foreach ($viewData['main_nav']['items'] as $key => $menu) {

			// if root element
			if($menu->menu_item_parent == '0') {

				$nav[$key] = array(
					'title' => $menu->title,
					'url' => $menu->url,
					'target' => $menu->target,
				);

				$rootIndex = $key;
			}
			// if sub element
			else {
				$nav[$rootIndex]['sub'][] = array(
					'title' => $menu->title,
					'url' => $menu->url,
					'target' => $menu->target,
				);
			}

		}

		$viewData['nav'] = $nav;

		return $viewData;
	}
}
