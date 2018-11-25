<?php get_header(); ?>


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
    while (have_posts()) : the_post(); ?>

    <?php if (have_rows('page')): ?>


        <?php while (have_rows('page')): the_row(); ?>

            <!--STAGE-->
            <?php if (get_row_layout() === 'stage') : ?>

                <?=
                module('stage')
                    ->tag('section')
                    ->ctrl(); ?>

            <?php endif; ?>

            <!--CTA-->
            <?php if (get_row_layout() === 'cta') : ?>

                <?=
                module('cta')
                    ->tag('section')
                    ->ctrl(); ?>

            <?php endif; ?>

            <!--NEWS-->
            <?php if (get_row_layout() === 'news_teaser') : ?>

                <? $count = get_sub_field('number_of_news_teaser');
                echo module('teaserlist')
                    ->tag('section')
                    ->ctrl(array('count' => $count)); ?>

            <?php endif; ?>

            <!--CONTENT-->
            <?php if (get_row_layout() === 'content') : ?>

                <?= module('content')
                        ->tag('section')
                        ->ctrl(); ?>

                <?php endif; ?>

             <!--ACCORDION-->
             <?php if (get_row_layout() === 'accordion') : ?>

                <?= module('accordion')
                        ->tag('section')
                        ->ctrl()
                        ->classes('js-accordion') ?>

                <?php endif; ?>

        <?php endwhile; ?>

    <?php endif; ?>

    <? endwhile; ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

<?php get_footer(); ?>