<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" class="l-content o-article">
	
	<header class="o-article__header">
		<span class="o-article__date">
			<?= get_the_date() ?>
		</span>
		<h1 class="o-article__title">
			<?= get_the_title() ?>
		</h1>
	</header><!-- .entry-header -->

	

	<div class="o-article__content">
		<?php
		/* translators: %s: Name of current post */

			the_content();
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
