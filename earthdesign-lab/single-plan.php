<?php get_header();?>
<main class="l-main">	
	<?php get_template_part( 'template-parts/page-header' ); ?>
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
	?>
	<div class="p-entry__body l-inner">
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
