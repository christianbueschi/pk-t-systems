<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package nxtheme
 */
?>
			</main>

			<?=
			module('footer')
				->tag('footer')
				->ctrl(); ?>

			<?php wp_footer(); ?>

		</div>

<!--Fancy Box-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>

	</body>
</html>
