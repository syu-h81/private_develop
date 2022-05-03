<?php get_header(); ?>
<main class="l-main">	
	<?php get_template_part( 'template-parts/page-header' ); ?>
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>
	<div class="l-inner">
		<div class="p-archive-header">
			<h2 class="p-archive-header__title" style="font-size: <?php echo esc_attr( $options['plan_archive_catchphrase_font_size'] ); ?>px;"><?php echo nl2br( esc_html( $options['plan_archive_catchphrase'] ) ); ?></h2>
			<?php if ( $options['plan_archive_desc'] ) : ?>
			<div class="p-archive-header__desc"><?php echo nl2br( esc_html( $options['plan_archive_desc'] ) ); ?></div>
			<?php endif; ?>
		</div>
	</div>
	<?php 
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
	?>
	<div class="p-main-image<?php if ( 0 !== $wp_query->current_post % 2 ) { echo ' p-main-image--rev'; } ?>">
		<div class="p-main-image__img p-main-image__img--narrow" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url( $post->plan_archive_image, 'full' ) ); ?>);"></div>
		<div class="p-main-image__content">
			<h2 class="p-main-image__title"><?php echo esc_html( $post->plan_archive_catch ); ?></h2>
			<p class="p-main-image__desc"><?php echo nl2br( esc_html( $post->plan_archive_desc ) ); ?></p>
			<a class="p-main-image__btn p-button" href="<?php the_permalink(); ?>"><?php echo esc_html( $post->plan_archive_btn_label ); ?></a>
		</div>
	</div>
	<?php
		endwhile;
	endif; 
	?>
</main>
<?php get_footer(); ?>
