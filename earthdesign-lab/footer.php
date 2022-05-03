<?php
$options = get_design_plus_option();

// ブログ一覧、ニュース一覧では、フッター上にボーダーを付ける
if ( is_home() || ( is_archive() && ! is_post_type_archive( 'plan' ) ) ) {
	$is_footer_border = true;
} else {
	$is_footer_border = false;
}

// フッターの背景色
$footer_bg_upper = is_mobile() ? $options['footer_bg_upper_mobile'] : $options['footer_bg_upper'];
$footer_bg_lower = is_mobile() ? $options['footer_bg_lower_mobile'] : $options['footer_bg_lower'];
?>
<footer class="l-footer<?php if ( $is_footer_border ) { echo ' l-footer--border'; } ?>" style="background: <?php echo esc_attr( $footer_bg_lower ); ?>;">
	<div id="js-pagetop" class="p-pagetop"><a href="#"></a></div>
	<section class="p-widget-area" style="background: <?php echo esc_attr( $footer_bg_upper ); ?>;">
		<div class="p-widget-area__inner l-inner u-clearfix">
			<?php
			if ( is_mobile() ) {
				if ( is_active_sidebar( 'footer_widget_mobile' ) ) {
					dynamic_sidebar( 'footer_widget_mobile' );
				}
			} else {
				if ( is_active_sidebar( 'footer_widget' ) ) {
					dynamic_sidebar( 'footer_widget' );
				}
			}
			?>
		</div>
	</section>
	<div class="l-inner">
		<div class="l-footer__logo c-logo<?php if ( $options['footer_logo_image_retina'] ) { echo ' c-logo--retina'; } ?>">
			<?php if ( 'type1' === $options['footer_use_logo_image'] ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="font-size: <?php echo esc_attr( $options['footer_logo_font_size'] ); ?>px;"><?php bloginfo( 'name' ); ?></a>
			<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_attr( wp_get_attachment_url( $options['footer_logo_image'] ) ); ?>" alt="<?php bloginfo( 'name' ); ?>">
			</a>
			<?php endif; ?>
		</div>
		<p class="p-address"><?php echo nl2br( esc_html( $options['footer_company_address'] ) ); ?></p>
		<ul class="p-social-nav">
			<?php if ( $options['facebook_url'] ) : ?>
			<li class="p-social-nav__item p-social-nav__item--facebook">
				<a href="<?php echo esc_url( $options['facebook_url'] ); ?>"></a>
			</li>
			<?php endif; ?>
			<?php if ( $options['twitter_url'] ) : ?>
			<li class="p-social-nav__item p-social-nav__item--twitter">
				<a href="<?php echo esc_url( $options['twitter_url'] ); ?>"></a>
			</li>
			<?php endif; ?>
			<?php if ( $options['insta_url'] ) : ?>
			<li class="p-social-nav__item p-social-nav__item--instagram">
				<a href="<?php echo esc_url( $options['insta_url'] ); ?>"></a>
			</li>
			<?php endif; ?>
			<?php if ( $options['show_rss'] ) : ?>
			<li class="p-social-nav__item p-social-nav__item--rss">
				<a href="<?php bloginfo( 'rss_url' ); ?>"></a>
			</li>
			<?php endif; ?>
		</ul>
		<p class="p-copyright"><small>Copyright &copy; <?php bloginfo( 'name' ); ?>. All rights reserved.</small></p>
	</div>
	<?php
	if ( $options['display_request'] ) {
		if ( ( is_front_page() && ! $options['hide_request_on_front'] ) || ! is_front_page() ) {
			get_template_part( 'template-parts/footer-request' );
		}			
	} else {
		if ( is_mobile() && 'type3' !== $options['footer_bar_display'] ) {
			get_template_part( 'template-parts/footer-bar' );
		}
	}
	?>
</footer>
<?php 
// ロード画面を使う場合は </div> を差し込む
// ロード画面を使わず、スプラッシュページを表示する場合は、inc/splash.phpで差し込む
if ( $options['use_load_icon'] ) {
	echo '</div>' . "\n";
}
?>
<?php wp_footer(); ?>
</body>
</html>
