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

<? /*
	<header class="entry-header">

		<a href="<?php //echo get_the_permalink( get_field('id') ); ?>">
			<?php //the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</a>

	</header><!-- .entry-header -->
*/ ?>

	<?php //echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>

	<div class="entry-content flex">

		<?php the_content(); ?>


		<!-- PLAY GROUND -->

		<?php //echo var_dump(get_field('country')); ?>

		<a href="<?php echo get_the_permalink( get_field('id') ); ?>">
		<div class="card" style="width: 18rem;">
			<img src="<?= get_field('country_flag') ?>" class="card-img-top" alt="<?= get_field('name_english') ?> Flag">
			<div class="card-body">
				<p class="card-text"><?php the_title( '<h2 class="entry-title">', '</h2>' ); ?></p>
			</div>
		</div>
		</a>

		<br>
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
