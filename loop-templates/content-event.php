<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>


		<!-- PLAY GROUND -->
		
		<div class="my-4">
			<p class="display-4">
				<a href="<?= get_field('event_website') ?>" target="_blank">
					Event Homepage
				</a>
			</p>
		</div>

		<div class="my-4">
			<h3 class="text-muted">Takes place in</h3>
			<p class="display-4">
				<a href="<?= get_permalink(get_field('country')); ?>">
					<?= get_field('country')->post_title; ?>
				</a>
			</p>
		</div>

		<div class="my-4">
			<h3 class="text-muted">Location</h3>
			<p class="display-4"><?= get_field('location') ?></p>
		</div>

		<div class="my-4">
			<h3 class="text-muted">Dates</h3>
			<p class="display-4"><?= date('d.m.', strtotime(get_field('event_from'))) ?> - <?= date('d.m.Y', strtotime(get_field('event_to'))) ?></p>
		</div>

		<!-- /PLAY GROUND -->


		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
