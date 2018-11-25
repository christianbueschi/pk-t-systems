<?
/**
 * Template name: Landing Page
 *
 * @package nxtheme
 */
get_header(); ?>
<section>

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

			<?php endwhile; ?>

		<?php endif; ?>

	<? endwhile; ?>

</section>
<?php get_footer(); ?>