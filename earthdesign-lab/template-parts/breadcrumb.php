<?php
global $author, $post;
?>
	<div class="p-breadcrumb c-breadcrumb">
		<ul class="p-breadcrumb__inner l-inner" itemscope itemtype="http://schema.org/BreadcrumbList">
			<li class="p-breadcrumb__item c-breadcrumb__item c-breadcrumb__item--home" itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="item"><span itemprop="name">HOME</span></a>
				<meta itemprop="position" content="1" />
			</li>
			<?php if ( is_author() ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php echo esc_html( get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ); ?></li>
			<?php elseif ( is_category() ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" itemprop="item">
					<span itemprop="name"><?php _e( 'BLOG', 'tcd-w' ); ?></span>
				</a>
				<meta itemprop="position" content="2" />
			</li>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php echo esc_html( single_cat_title( '', false ) ); ?></li>
			<?php elseif ( is_search() ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php _e( 'Search result', 'tcd-w' ); ?></li>
			<?php elseif ( is_year() ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php echo esc_html( get_the_time( __( 'Y', 'tcd-w' ), $post ) ); ?></li>
			<?php elseif ( is_month() ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php echo esc_html( get_the_time( __( 'F, Y', 'tcd-w' ), $post ) ); ?></li>
			<?php elseif ( is_day() ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php echo esc_html( get_the_time( __( 'F jS, Y', 'tcd-w' ), $post ) ); ?></li>
			<?php elseif ( is_home() ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php _e( 'BLOG', 'tcd-w' ); ?></li>
			<?php elseif ( is_post_type_archive( 'news' ) || is_singular( 'news' ) ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" itemprop="item">
					<span itemprop="name"><?php echo esc_html( get_custom_post_label( 'news' ) ); ?></span>
				</a>
				<meta itemprop="position" content="2" />
			</li>
			<?php if ( is_singular( 'news' ) ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php echo strip_tags( get_the_title( $post->ID ) ); ?></li>
			<?php endif; ?>
			<?php elseif ( is_post_type_archive( 'plan' ) || is_singular( 'plan' ) ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'plan' ) ); ?>" itemprop="item">
					<span itemprop="name"><?php echo esc_html( get_custom_post_label( 'plan' ) ); ?></span>
				</a>
				<meta itemprop="position" content="2" />
			</li>
			<?php if ( is_singular( 'plan' ) ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php echo strip_tags( get_the_title( $post->ID ) ); ?></li>
			<?php endif; ?>
			<?php elseif ( is_page() ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php echo strip_tags( get_the_title( $post->ID ) ); ?></li>
			<?php elseif ( is_singular( 'post' ) ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" itemprop="item">
					<span itemprop="name"><?php _e( 'BLOG', 'tcd-w' ); ?></span>
				</a>
				<meta itemprop="position" content="2" />
			</li>
			<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<?php 
				$categories = get_the_category();
				foreach ( $categories as $key => $category ) :
					if ( 0 !== $key ) {
						echo ', ';
					}
				?>
				<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" itemprop="item">
					<span itemprop="name"><?php echo esc_html( $category->name ); ?></span>
				</a>
				<?php endforeach; ?>
				<meta itemprop="position" content="3" />
			</li>
			<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo strip_tags( get_the_title( $post->ID ) ); ?></span><meta itemprop="position" content="4" /></li>
			<?php elseif ( is_404() ) : ?>
			<li class="p-breadcrumb__item c-breadcrumb__item"><?php _e( "Sorry, but you are looking for something that isn't here.", 'tcd-w' ); ?></li>
			<?php endif; ?>
		</ul>	
	</div>	
