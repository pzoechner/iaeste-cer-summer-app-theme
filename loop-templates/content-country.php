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
		
		<?php //echo var_dump(get_field('country')); ?>

		<div class="container">
  			<div class="row">
			  	<div class="col jumbotron py-0">

					<div class="my-5">
						<h2>Country Information</h2>
					</div>

					<div class="my-4">
						<h3 class="text-muted">Country Flag</h3>
						<img class="rounded responsive" src="<?= get_field('country_flag') ?>">
					</div>

					<div class="my-4">
						<h3 class="text-muted">Capital City</h3>
						<p class="display-4"><?= get_field('capital_city') ?></p>
					</div>

					<div class="my-4">
						<h3 class="text-muted">Population</h3>
						<p class="display-4"><?= get_field('population') ?></p>
					</div>

				</div>
				<div class="col">

					<?php
						// TODO add sorting, maybe also filtering by splitting upcoming and past events.
						$events = get_posts(array(
							'post_type' => 'event',
							'meta_query' => array(
								array(
									'key' => 'country',
									'value' => get_the_ID(),
									'compare' => '='
								)
							)
						));
					?>

					<?php if( $events ): ?>
						<div class="mt-5 mb-2">
							<h2>Events</h2>

							<ul class="list-group">
							<?php foreach( $events as $event ): ?>
								<a href="<?php echo get_permalink( $event->ID ); ?>">
									<li class="list-group-item"><?php echo get_the_title( $event->ID ); ?></li>
								</a>
							<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

				</div>
			</div>
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
