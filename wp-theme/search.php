<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package nxtheme
 */

get_header(); ?>

<div class="o-searchpage l-content">



<header class="o-searchpage__header">
	<?php if ( have_posts() ) : ?>
		<h1 class="o-searchpage__title"><?php printf( __( 'Suchresultate für: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	<?php else : ?>
		<h1 class="o-searchpage__title o-searchpage__title--noresults"><?php _e( 'Keine Suchresultate gefunden'); ?></h1>
	<?php endif; ?>
</header><!-- .page-header -->

<div id="primary" class="o-searchpage__content">
	<main id="main" role="main">

	<?php
	if ( have_posts() ) : ?>

		<ul class="o-searchpage__list">
		<? /* Start the Loop */
		while ( have_posts() ) : the_post(); ?>

			<li class="o-searchpage__item">
		
			<? /**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'template-parts/post/excerpt' ); ?>
			</li> 
		<? endwhile; // End of the loop. ?>
		</ul>
	<? else : ?>

		<p class="o-searchpage__noresults"><?php _e( 'Entschuldigung, aber nichts stimmte mit Ihren Suchbegriffen überein. Bitte versuchen Sie es erneut mit verschiedenen Schlüsselwörtern.'); ?></p>
		<?php
			get_search_form();
	endif;
	?>

	</main><!-- #main -->
</div><!-- #primary -->

</div>



<? get_footer(); ?>
