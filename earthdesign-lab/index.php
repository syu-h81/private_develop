<?php
$options = get_design_plus_option();
$show_date = $options['show_date'];
$show_category = $options['show_category'];
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
		<?php // empty 擬似クラスも使用できるよう、.p-archive-header 内のタグの改行を行わない ?>
		<div class="p-archive-header"><?php if ( $options['archive_catchphrase'] ) : ?><h2 class="p-archive-header__title" style="font-size: <?php echo esc_attr( $options['archive_catchphrase_font_size'] ); ?>px;"><?php if ( is_home() ) { echo nl2br( esc_html( $options['archive_catchphrase'] ) ); } else { the_archive_title(); } ?></h2><?php endif; ?><?php if ( $options['archive_desc'] ) : ?>
			<?php if ( ( is_home() && $options['archive_desc'] ) || ! is_home() && get_the_archive_description() ) : ?>
			<div class="p-archive-header__desc"><?php if ( is_home() ) { echo nl2br( esc_html( $options['archive_desc'] ) ); } else { the_archive_description(); } ?></div><?php endif; endif; ?></div>
		<?php if ( have_posts() ) : ?>
		<div class="p-blog-list"<?php if ( ! wp_is_mobile() ) { echo ' id="js-infinitescroll"'; } ?>>
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="p-blog-list__item p-article01"<?php if ( ! wp_is_mobile() ) { echo ' style="opacity: 0;"'; } ?>>
				<a class="p-article01__thumbnail p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'size2' );
					} else {
						echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-680x450.gif" alt="">';
					}
					?>
				</a>
				<h3 class="p-article01__title"><a href="<?php the_permalink(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 28, '...' ) : wp_trim_words( get_the_title(), 30, '...' ); ?></a></h3>
				<p class="p-article01__excerpt"><?php echo is_mobile() ? wp_trim_words( get_the_excerpt(), 55, '...' ) : wp_trim_words( get_the_excerpt(), 65, '...' ); ?></p>
				<?php if ( $show_date || $show_category ) : ?>
				<p class="p-article01__meta"><?php if ( $show_date ) : ?><time class="p-article01__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time><?php endif; if ( $show_category ) : ?><span class="p-article01__category"><?php the_category( ', ' ); ?></span><?php endif; ?></p>
				<?php endif; ?>
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
			<p id="js-load-post" class="p-load-post"><?php next_posts_link( __( 'Next Blog', 'tcd-w' ) ); ?></p>
			<?php 
				endif; 
			endif;
			?>
		</div>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>
