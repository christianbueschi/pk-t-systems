<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package nxtheme
 */
?><!doctype html>
	<!--[if lt IE 9]>      <html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 9]>         <html class="no-js ie9 lt-ie10" <?php language_attributes(); ?>> <![endif]-->
	<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-title" content=“<?php bloginfo('name'); ?>”>

		<title><?php wp_title('|', true, 'right'); ?></title>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?=ASSETS_URL?>/images/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?=ASSETS_URL?>/images/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?=ASSETS_URL?>/images/favicon-16x16.png">
		<link rel="shortcut icon" type="image/x-icon" href="<?=ASSETS_URL?>/images/favicon.ico"/>
		<link rel="apple-touch-icon" href="<?=ASSETS_URL?>/images/apple-icon.png"/>

		<?php wp_head(); ?>

		<script>var assetsUrl = '<?=ASSETS_URL?>';</script>
		
		<!--Ionicons-->
		<link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet">

		<!-- Open Graph !-->
		<?= partial('opengraph') ?>

		

	</head>

	<body>

		<div class="l-page">

		<?= module('header')
			->tag('header')
			->attrib('role', 'banner')
			->ctrl() ?>

		<main id="content" role="main">
