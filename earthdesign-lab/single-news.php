<?php
$args = array(
	'orderby' => 'date',
	'post_status' => 'publish',
	'post_type' => 'news',
	'posts_per_page' => 10
);
$the_query = new WP_Query( $args );
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
					$previous_post = get_previous_post();
					$next_post = get_next_post();
			?>
			<article class="p-entry l-primary">
				<header class="p-entry__header">
					<h1 class="p-entry__title"><?php the_title(); ?></h1>
					<p class="p-entry__meta">
						<?php if ( $options['show_date_news'] ) : ?>
						<time class="p-entry__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
						<?php endif; ?>
					</p>
				</header>
				<?php if ( $options['show_sns_top_news'] ) { get_template_part( 'template-parts/sns-btn-top' ); } ?>
				<?php if ( $options['show_thumbnail_news'] && has_post_thumbnail() ) : ?>
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
				<?php if ( $options['show_sns_btm_news'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>
				<?php if ( $options['show_next_post_news'] && ( $previous_post || $next_post ) ) : ?>
				<ul class="p-nav01 c-nav01">
					<?php if ( $previous_post ) : ?>
    			<li class="p-nav01__item--prev c-nav01__item c-nav01__item--prev">
    		    <a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" data-prev="<?php _e( 'Previous post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $previous_post->post_title, 30, '...' ) ); ?></span></a>
    			</li>
					<?php endif; ?>
					<?php if ( $next_post ) : ?>
    			<li class="p-nav01__item--next c-nav01__item c-nav01__item--next">
    		    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" data-next="<?php _e( 'Next post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $next_post->post_title, 30, '...' ) ); ?></span></a>
    			</li>
					<?php endif; ?>
				</ul>
				<?php
				endif; 
				get_template_part( 'template-parts/advertisement' );
				if ( $options['show_recent_news'] ) :
				?>
				<section class="p-latest-news">
					<div class="p-latest-news__title">
						<h2><?php echo esc_html( $options['recent_news_headline'] ); ?></h2>
						<a class="p-latest-news__archive-link" href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>"><?php echo esc_html( $options['recent_news_link_text'] ); ?></a>
					</div>
					<?php if ( $the_query->have_posts() ) : ?>
					<ul>
						<?php
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
						?>
						<li class="p-latest-news__item">
							<a href="<?php the_permalink(); ?>">
								<?php if ( $options['show_date_news'] ) : ?>
								<time class="p-latest-news__item-date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
								<?php endif; ?>
								<h3 class="p-latest-news__item-title"><?php the_title(); ?></h3>
							</a>
						</li>
						<?php
						endwhile;
						wp_reset_postdata();
						?>
					</ul>
					<?php endif; ?>
				</section>
				<?php endif; ?>
			</article>
			<?php endwhile; endif; ?>
			<?php get_sidebar(); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
