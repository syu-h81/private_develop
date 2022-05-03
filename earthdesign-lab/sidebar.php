<section class="l-secondary">
	<?php
	if ( is_page() ) {
		if ( is_mobile() ) {
			if ( is_active_sidebar( 'page_widget_mobile' ) ) {
				dynamic_sidebar( 'page_widget_mobile' );
			}
		} else {
			if ( is_active_sidebar( 'page_widget' ) ) {
				dynamic_sidebar( 'page_widget' );
			}
		}
	} elseif ( is_singular( 'post' ) ) {
		if ( is_mobile() ) {
			if ( is_active_sidebar( 'single_widget_mobile' ) ) {
				dynamic_sidebar( 'single_widget_mobile' );
			}
		} else {
			if ( is_active_sidebar( 'single_widget' ) ) {
				dynamic_sidebar( 'single_widget' );
			}
		}
	} elseif ( is_singular( 'news' ) ) {
		if ( is_mobile() ) {
			if ( is_active_sidebar( 'news_widget_mobile' ) ) {
				dynamic_sidebar( 'news_widget_mobile' );
			}
		} else {
			if ( is_active_sidebar( 'news_widget' ) ) {
				dynamic_sidebar( 'news_widget' );
			}
		}
	}
	?>
</section>
