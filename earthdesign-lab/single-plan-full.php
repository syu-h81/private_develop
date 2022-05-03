<?php
/**
 * Template Name: Full width
 * Template Post Type: plan
 */
__( 'Full width', 'tcd-w' );
$args = array(
	'post_status' => 'publish',
	'post_type' => 'plan',
	'posts_per_page' => -1
);
$the_query = new WP_Query( $args );
get_header();
?>
<main class="l-main">	
	<?php get_template_part( 'template-parts/page-header' ); ?>
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
	?>
	<div class="p-entry__body">
		<?php
		the_content();
		wp_link_pages( array( 
			'before' => '<div class="p-page-links">', 
			'after' => '</div>', 
			'link_before' => '<span>', 
			'link_after' => '</span>' 
		) ); 
		?>
	</div>
	<?php
		endwhile;
	endif;
	get_template_part( 'template-parts/plan-list' );
	?>
</main>
<?php get_footer(); ?>
