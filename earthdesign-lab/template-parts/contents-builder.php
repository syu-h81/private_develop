<?php $options = get_design_plus_option(); ?>
	<div id="js-contents-builder">
		<?php
		foreach( $options['contents_builder'] as $key => $value ) :
			if ( 'catch_and_desc' === $value['cb_content_select'] && $value['cb_catch_and_desc_display'] ) :
		?>
		<section id="cb_<?php echo esc_attr( $key ); ?>" class="p-content01 l-inner">
			<h2 class="p-content01__catch" style="font-size: <?php echo esc_attr( $value['cb_catch_and_desc_headline_font_size'] ); ?>px;"><?php echo nl2br( esc_html( $value['cb_catch_and_desc_headline'] ) ); ?></h2>
			<div class="p-content01__desc" style="font-size: <?php echo esc_attr( $value['cb_catch_and_desc_desc_font_size'] ); ?>px;"><?php echo wpautop( esc_html( $value['cb_catch_and_desc_desc'] ) ); ?></div>
		</section>
		<?php
			elseif ( 'plan' === $value['cb_content_select'] && $value['cb_plan_display'] ) :
		?>
		<div id="cb_<?php echo esc_attr( $key ); ?>">
			<?php get_template_part( 'template-parts/plan-list' ); ?>
		</div>
		<?php
			elseif ( 'main_image' === $value['cb_content_select'] && $value['cb_main_image_display'] ) :
				$hex_overlay = implode( ',', hex2rgb( $value['cb_main_image_overlay'] ) );
		?>
		<div id="cb_<?php echo esc_attr( $key ); ?>" class="p-main-image<?php if ( 'type1' === $value['cb_main_image_layout'] ) { echo ' p-main-image--rev'; } ?>">
			<div class="p-main-image__img<?php if ( 'type2' === $value['cb_main_image_size'] ) { echo ' p-main-image__img--narrow'; } ?>" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url( $value['cb_main_image_bg_image'] ) ); ?>);"></div>
			<div class="p-main-image__content" style="background: rgba(<?php echo esc_attr( $hex_overlay . ', ' . $value['cb_main_image_opacity'] ); ?>);  color: <?php echo esc_attr( $value['cb_main_image_color'] ); ?>">
				<h2 class="p-main-image__title" style="font-size: <?php echo esc_attr( $value['cb_main_image_headline_font_size'] ); ?>px;"><?php echo nl2br( esc_html( $value['cb_main_image_headline'] ) ); ?></h2>
				<p class="p-main-image__desc" style="font-size: <?php echo esc_attr( $value['cb_main_image_desc_font_size'] ); ?>px;"><?php echo nl2br( esc_html( $value['cb_main_image_desc'] ) ); ?></p>
				<?php if ( $value['cb_main_image_display_btn'] ) : ?>
				<a class="p-main-image__btn p-button" href="<?php echo esc_url( $value['cb_main_image_btn_url'] ); ?>"<?php if ( $value['cb_main_image_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $value['cb_main_image_btn_label'] ); ?></a>
				<?php endif; ?>
			</div>
		</div>
		<?php
			elseif ( 'blog_and_news' === $value['cb_content_select'] && $value['cb_blog_and_news_display'] ) :
				$blog_args = array(
					'post_status' => 'publish',
					'post_type' => 'post',
				);
				$blog_query = new WP_Query( $blog_args );
				$news_args = array(
					'posts_per_page' => 3,
					'post_status' => 'publish',
					'post_type' => 'news'
				);
				$news_query = new WP_Query( $news_args );
		?>
		<div id="cb_<?php echo esc_attr( $key ); ?>" class="p-content03<?php if ( $value['cb_blog_and_news_layout'] ) { echo ' p-content03--rev'; } ?>">
			<section class="p-content03__blog u-clearfix">
				<div class="p-content03__blog-header">
					<h2 class="p-content03__blog-catch" style="font-size: <?php echo esc_attr( $value['cb_blog_and_news_blog_catch_font_size'] ); ?>px;"><?php echo esc_html( $value['cb_blog_and_news_blog_catch'] ); ?></h2>
					<a class="p-content03__blog-archive-link" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"><?php echo esc_html( $value['cb_blog_and_news_blog_link_text'] ); ?></a>
				</div>
				<?php if ( $blog_query->have_posts() ) : ?>
				<div class="p-content03__blog-list">
					<div class="p-content03__blog-list-inner">
						<?php
						while ( $blog_query->have_posts() ) : 
							$blog_query->the_post();
						?>
						<article class="p-content03__blog-list-item p-article04">
							<a class="p-article04__thumbnail p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'size1' );
								} else {
									echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-480x320.gif" alt="">';
								}
								?>
							</a>
							<h3 class="p-article04__title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 25, '...' ); ?></a></h3>
							<p class="p-article04__excerpt"><?php echo is_mobile() ? wp_trim_words( get_the_excerpt(), 25, '...' ) : wp_trim_words( get_the_excerpt(), 40, '...' ); ?></p>
							<?php if ( $options['show_date'] || $options['show_category'] ) : ?>
							<p class="p-article04__meta"><?php if ( $options['show_date'] ) : ?><time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time><?php endif; ?><?php if ( $options['show_category'] ) : ?><span class="p-article04__category"><?php the_category( ', ' ); ?></span><?php endif; ?></p>
							<?php endif; ?>
						</article>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="p-content03__blog-arrows">
				</div>
			</section>
			<section class="p-content03__news" style="background: <?php echo esc_attr( $value['cb_blog_and_news_news_bg'] ); ?>">
				<h2 class="p-content03__news-catch" style="font-size: <?php echo esc_attr( $value['cb_blog_and_news_news_catch_font_size'] ); ?>px;"><?php echo esc_html( $value['cb_blog_and_news_news_catch'] ); ?></h2>
				<?php if ( $news_query->have_posts() ) : ?>
				<div class="p-content03__news-list">
					<?php
					while ( $news_query->have_posts() ) : 
						$news_query->the_post();
					?>
					<article class="p-content03__news-list-item p-article05">
						<a href="<?php the_permalink(); ?>">
							<?php if ( $options['show_date_news'] ) : ?>
							<time class="p-article05__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
							<?php endif; ?>
							<h3 class="p-article05__title"><?php echo wp_trim_words( get_the_title(), 30, '...' ); ?></h3>
						</a>
					</article>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
				<?php endif; ?>
				<a class="p-content03__news-archive-link" href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>"><?php echo esc_html( $value['cb_blog_and_news_news_link_text'] ); ?></a>
			</section>
		</div>
		<?php
			elseif ( 'gallery_contents' === $value['cb_content_select'] && $value['cb_gallery_contents_display'] ) :
		?>
		<div id="cb_<?php echo esc_attr( $key ); ?>" class="p-content04" style="background: <?php echo esc_attr( $value['cb_gallery_contents_bg'] ); ?>">
			<div class="p-content04__content" style="color: <?php echo esc_attr( $value['cb_gallery_contents_color'] ); ?>;">
				<h2 class="p-content04__catch" style="font-size: <?php echo esc_attr( $value['cb_gallery_contents_headline_font_size'] ); ?>px;"><?php echo esc_html( $value['cb_gallery_contents_headline'] ); ?></h2>
				<div class="p-content04__desc" style="font-size: <?php echo esc_attr( $value['cb_gallery_contents_desc_font_size'] ); ?>px;"><?php echo wpautop( esc_html( $value['cb_gallery_contents_desc'] ) ); ?></div>
				<?php if ( $value['cb_gallery_contents_display_btn'] ) : ?>
				<a class="p-content04__btn p-button" href="<?php echo esc_url( $value['cb_gallery_contents_btn_url'] ); ?>"<?php if ( $value['cb_gallery_contents_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $value['cb_gallery_contents_btn_label'] ); ?></a>
				<?php endif; ?>
			</div>
			<div class="p-content04__slider">
				<?php foreach ( $value['cb_gallery_contents_items'] as $item ) : ?>
				<div class="p-content04__slider-item" style="background-image:url(<?php echo esc_attr( wp_get_attachment_url( $item['image'] ) ); ?>);"></div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
			elseif ( 'wysiwyg' === $value['cb_content_select'] && $value['cb_wysiwyg_display'] ) :
				$cb_wysiwyg_editor = apply_filters( 'the_content', $value['cb_wysiwyg_editor'] );
				if ( $cb_wysiwyg_editor ) {
					echo '<div id="cb_' . esc_attr( $key ) . '" class="p-content05">' . $cb_wysiwyg_editor . '</div>' . "\n";
				}
			endif;
		endforeach;
		?>
	</div><!-- #js-contents-builder END -->
