<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package nxtheme
 */

get_header(); ?>
<?php

$title = get_the_archive_title();
$backgroundImageBlog = get_the_post_thumbnail_url(get_option('page_for_posts', true));


?>


<?=
module('stage')
	->tag('section')
	->classes('o-stage--small')
	->ctrl(array('Title' => $title, 'BackgroundImage' => $backgroundImageBlog)) ?>


<?=
module('teaserlist')
	->ctrl(); ?>

<? get_footer(); ?>
