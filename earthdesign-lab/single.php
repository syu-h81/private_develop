<?php
$options = get_design_plus_option();
$show_author = $options['show_author'];
$show_category = $options['show_category'];
$show_comment = $options['show_comment'];
$show_date = $options['show_date'];
$show_tag = $options['show_tag'];
$posts_per_page = is_mobile() ? 4 : 9;
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
					$categories = get_the_category();
					$previous_post = get_previous_post();
					$next_post = get_next_post();
					$args = array(
						'category_name' => $categories[0]->slug,
						'orderby' => 'rand',
						'post__not_in' => array( $post->ID ),
						'post_status' => 'publish',
						'post_type' => 'post',
						'posts_per_page' => $posts_per_page
					);
					$the_query = new WP_Query( $args );
			?>
			<article class="p-entry l-primary">
				<header class="p-entry__header">
					<h1 class="p-entry__title" style="font-size: <?php echo esc_attr( $options['title_font_size'] ); ?>px;"><?php the_title(); ?></h1>
					<?php if ( $show_date || $show_category ) : ?>
					<p class="p-entry__meta">
						<?php if ( $show_date ) : ?><time class="p-entry__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time><?php endif; if ( $show_category ) : ?><span class="p-entry__category"><?php the_category( ', ' ); ?></span><?php endif; ?>
					</p>
					<?php endif; ?>
				</header>
				<?php if ( $options['show_sns_top'] ) { get_template_part( 'template-parts/sns-btn-top' ); } ?>
				<?php if ( $options['show_thumbnail'] && has_post_thumbnail() ) : ?>
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
				<?php if ( $options['show_sns_btm'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>
				<?php if ( $show_author || $show_category || $show_tag || $show_comment ) : ?>
				<ul class="p-entry__meta-box c-meta-box u-clearfix">
					<?php if ( $show_author ) : ?><li class="c-meta-box__item c-meta-box__item--author"><?php _e( 'Author', 'tcd-w' ); ?>: <?php the_author_posts_link(); ?></li><?php endif; ?>
					<?php if ( $show_category ) : ?><li class="c-meta-box__item c-meta-box__item--category"><?php the_category( ', ' ); ?></li><?php endif; ?>
					<?php if ( $show_tag && get_the_tags() ) : ?><li class="c-meta-box__item c-meta-box__item--tag"><?php echo get_the_tag_list( '', ', ', '' ); ?></li><?php endif; ?>
					<?php if ( $show_comment ) : ?><li class="c-meta-box__item c-meta-box__item--comment"><?php _e( 'Comments', 'tcd-w' ); ?>: <a href="#comment_headline"><?php echo get_comments_number( '0', '1', '%' ); ?></a></li><?php endif; ?>
				</ul>
				<?php endif; ?>
				<?php if ( $options['show_next_post'] && ( $previous_post || $next_post ) ) : ?>
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
				if ( $show_comment ) { comments_template( '', true ); } 
				if ( $options['show_related_post'] ) : 
				?>
				<section>
					<h2 class="p-headline"><?php _e( 'Related posts', 'tcd-w' ); ?></h2>
					<div class="p-entry__related">
						<?php
						if ( $the_query->have_posts() ) : 
							while ( $the_query->have_posts() ) : 
								$the_query->the_post(); 
						?> 
						<article class="p-entry__related-item p-article03">
							<div class="p-article03__thumbnail p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
								<a href="<?php the_permalink(); ?>">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'size3' );
								} else {
									echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-440x290.gif" alt="">';
								}
								?>
							</div>
							<h3 class="p-article03__title"><a href="<?php the_permalink(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 25, '...' ) : wp_trim_words( get_the_title(), 28, '...' ); ?></a></h3>
						</article>
						<?php
							endwhile;
							wp_reset_postdata();
						else :
							echo '<p>' . __( 'No related posts.', 'tcd-w' ) . '</p>';
						endif;
						?>
					</div>
				</section>
				<?php endif; ?>
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
