<?php
$options = get_design_plus_option();
get_header(); 
?>
<main class="l-main">	
	<?php get_template_part( 'template-parts/page-header' ); ?>
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>
	<div class="l-contents<?php if ( $options['left_sidebar'] ) { echo ' l-contents--rev'; } ?>">
		<div class="l-contents__inner l-inner">
			<?php 
			if ( have_posts() ) : 
				while ( have_posts() ) : 
					the_post(); 
			?>
			<article class="p-entry l-primary">
				<header class="p-entry__header">
					<h1 class="p-entry__title" style="font-size: <?php echo esc_attr( $options['title_font_size'] ); ?>px;"><?php the_title(); ?></h1>
				</header>
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
			get_sidebar();
			?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
