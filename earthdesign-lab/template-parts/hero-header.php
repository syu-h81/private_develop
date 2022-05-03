<?php $options = get_design_plus_option(); ?>
	<div id="js-hero-header" class="p-hero-header">
		<?php if ( wp_is_mobile() ) : // TB, SP ?>
		<div id="js-hero-header__slider" class="p-hero-header__slider">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
			<div class="p-hero-header__slider-item" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url( $options['hero_header_image_sp' . $i], 'full' ) ); ?>); ">
				<a href="<?php echo esc_url( $options['hero_header_url' . $i] ); ?>"><span class="p-hero-header__slider-item-title" style="font-size: <?php echo esc_attr( $options['hero_header_catch_font_size' . $i] ); ?>px;"><?php echo esc_html( $options['hero_header_catch' . $i] ); ?></span></a>
			</div>
			<?php endfor; ?>
		</div>
		<?php else : // PC ?>
		<ul class="p-hero-header__nav u-clearfix">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
			<li class="p-hero-header__nav-item<?php if ( 1 === $i ) { echo ' is-active'; } ?>"><a href="<?php echo esc_url( $options['hero_header_url' . $i] ); ?>" data-target="#js-hero-header__content<?php echo esc_attr( $i ); ?>"><span class="p-hero-header__nav-item-title" style="font-size: <?php echo esc_attr( $options['hero_header_catch_font_size' . $i] ); ?>px;"><?php echo esc_html( $options['hero_header_catch' . $i] ); ?></span></a></li>
			<?php endfor; ?>
		</ul>
		<?php
		for ( $i = 1; $i <= 4; $i++ ) : 
			$style = '';
			if ( $options['hero_header_image' . $i] ) { 
				$style .= 'background-image: url(' . wp_get_attachment_url( $options['hero_header_image' . $i], 'full' ) . ');';
			}
			// 1つ目以外は最初は非表示にする
			if ( 1 !== $i ) {
				$style .= ' display: none;';
			}
		?>
		<div id="js-hero-header__content<?php echo $i; ?>" class="p-hero-header__content<?php if ( 1 === $i ) { echo ' is-active'; } ?>" style="<?php echo esc_attr( $style ); ?>">
			<?php
			// video の場合、<video>タグを出力する
			if ( 'type2' === $options['hero_header_type' . $i] ) :
			?>
			<div class="p-hero-header__content-video">
				<video loop muted>
					<source src="<?php echo esc_attr( wp_get_attachment_url( $options['hero_header_video' . $i] ) ); ?>">
				</video>
			</div>
			<?php 
			// YouTube の場合、<iframe>タグを出力する
			elseif ( 'type3' === $options['hero_header_type' . $i] ) :
				$origin = ( empty( $_SERVER['HTTPS'] ) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'];
			?>
			<div class="p-hero-header__content-youtube">
				<iframe id="player<?php echo $i; ?>" class="p-hero-header__content-youtube-iframe" type="text/html" src="https://www.youtube.com/embed/<?php echo esc_attr( $options['hero_header_yt' . $i] ); ?>?enablejsapi=1&origin=<?php echo esc_attr( $origin ); ?>&loop=1&playlist=<?php echo esc_attr( $options['hero_header_yt' . $i] ); ?>&controls=0&rel=0" frameborder="0"></iframe>
			</div>
			<?php endif; ?>
		</div>
		<?php endfor; ?>
		<?php endif; ?>
		<a id="js-hero-header__link" href="#js-contents-builder" class="p-hero-header__link"><?php echo esc_html( $options['hero_header_link_text'] ); ?></a>
	</div>
