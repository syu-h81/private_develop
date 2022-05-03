<?php
$options = get_design_plus_option();
$args = array( 
	'current' => max( 1, get_query_var( 'paged' ) ), 
	'prev_next' => false,
	'total' => $wp_query->max_num_pages,
	'type' => 'array'
); 
get_header(); 
?>
<main class="l-main">	
	<?php get_template_part( 'template-parts/page-header' ); ?>
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>
	<div class="l-inner">
		<?php if ( have_posts() ) : ?>
		<div class="p-news-list"<?php if ( ! wp_is_mobile() ) { echo ' id="js-infinitescroll"'; } ?>>
			<?php
			while ( have_posts() ) :
				the_post();
			?>
			<article class="p-news-list__item p-article02"<?php if ( ! wp_is_mobile() ) { echo ' style="opacity: 0;"'; } ?>>
				<a class="p-article02__inner" href="<?php the_permalink(); ?>">
					<?php if ( $options['show_thumbnail_news'] ) : ?>
					<div class="p-article02__thumbnail p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'size2' );
						} else {
							echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-680x450.gif" alt="">';
						}
						?>
			    </div>
					<?php endif; ?>
					<div class="p-article02__content">
						<?php if ( $options['show_date_news'] ) : ?>
			    	<time class="p-article02__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
						<?php endif; ?>
						<h2 class="p-article02__title"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 28, '...' ) : wp_trim_words( get_the_title(), 40, '...' ); ?></h2>
						<p class="p-article02__excerpt"><?php echo is_mobile() ? wp_trim_words( get_the_excerpt(), 55, '...' ) : wp_trim_words( get_the_excerpt(), 80, '...' ); ?></p>
					</div>
				</a>
			</article>
			<?php endwhile; ?>
			<?php 
			if ( wp_is_mobile() ) :
				if ( paginate_links( $args ) ) : // TB, SP
			?>
			<ul class="p-pager">
				<?php foreach ( paginate_links( $args ) as $page_numbers ) : ?>
			  <li class="p-pager__item"><?php echo $page_numbers; ?></li>  
				<?php endforeach; ?>
			</ul>
			<?php
				endif;
			else : // PC
				if ( get_next_posts_link() ) : 
			?>
			<p id="js-load-post" class="p-load-post"><?php next_posts_link( __( 'Next News', 'tcd-w' ) ); ?></p>
			<?php 
				endif; 
			endif;
			?>
		</div>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>
