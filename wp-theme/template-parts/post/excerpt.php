<a href="<? the_permalink() ?>" class="o-searchpage__item__link">
    <h1 class="o-searchpage__item__title">
	    <?= get_the_title() ?>
    </h1>

    <div class="o-searchpage__item__content">
        <?php the_excerpt(); ?>
    </div>
</a