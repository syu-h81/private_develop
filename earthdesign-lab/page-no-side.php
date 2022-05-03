<?php 
/*
Template Name: No side
*/
__( 'No side', 'tcd-w' );
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
	<article class="p-entry l-inner">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="p-entry__thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
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
	</article>
	<?php
		endwhile; 
	endif; 
	?>
</main>
<?php get_footer(); ?>
