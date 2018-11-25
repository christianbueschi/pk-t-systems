<?
/**
 * The Template for displaying all single posts.
 *
 * @package nxtheme
 */

get_header();
?>

<? while (have_posts()) : the_post(); ?>

	<? // Load default block template page
        get_template_part('template-parts/post/content');

	?>
<? endwhile; ?>

<? get_footer(); ?>