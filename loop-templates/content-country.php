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


		<!-- PLAY GROUND --><br><br><br>
		
		<?php //echo var_dump(get_field('country')); ?>
		Flag: <img style="height: 150px;" src="<?= get_field('country_flag') ?>">
		
		<br><br>
		
		Events in this country:
		<?php
		$events = get_posts(array(
							'post_type' => 'event',
							'meta_query' => array(
								array(
									'key' => 'country', // name of custom field
									'value' => get_the_ID(),
									'compare' => '='
								)
							)
						));
		?>
		<?php if( $events ): ?>
			<ul>
			<?php foreach( $events as $event ): ?>
				<li>
					<a href="<?php echo get_permalink( $event->ID ); ?>">
						<?php echo get_the_title( $event->ID ); ?>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<br><br><br><!-- /PLAY GROUND -->


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
