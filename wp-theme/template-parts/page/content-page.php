<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="l-header">
		<?php 
			$title = get_the_title(); 
			$icon = get_the_post_thumbnail_url();
		?>

		<h1 class="a-title">
			<?= $title ?>
			<img src="<?= $icon ?>" alt="">
		</h1>
		
	</header><!-- .entry-header -->
	<div class="l-section">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
