<?php
$options = get_design_plus_option();
$header_fix = is_mobile() ? $options['mobile_header_fix'] : $options['header_fix'];
$args = array(
	'container' => 'nav',
	'menu_class' => 'p-global-nav u-clearfix',
	'menu_id' => 'js-global-nav',
	'link_after' => '<span></span>',
	'theme_location' => 'global'
);

// スプラッシュページ関連の処理
// cookie から tcd_referrer を取得
$tcd_referrer = isset( $_COOKIE['tcd_referrer'] ) ? $_COOKIE['tcd_referrer'] : '';

// TCD_Splash_Page クラスのオブジェクトを初期化
$tcd_splash_page = new TCD_Splash_Page( $tcd_referrer );

// 現在のURLを取得する
$current_url = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// cookie の処理
if ( $tcd_referrer ) {
	// delete cookie
	setcookie( 'tcd_referrer', '', time() - 3600 );
}
// set cookie
setcookie( 'tcd_referrer', $current_url, 0, '/' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="description" content="<?php seo_description(); ?>">
<meta name="viewport" content="width=device-width">
<?php if ( $options['use_ogp'] ) { ogp(); } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
// スプラッシュページを読み込む
// スプラッシュページ以外でロード画面がONの時は、ロード画面を表示
// フロントページの遷移元がサイト内の場合、スプラッシュページを表示しない
if ( $tcd_splash_page->is_splash_page() ) {
	get_template_part( 'template-parts/splash' ); 
	echo '<div id="site_wrap">' . "\n";
} elseif ( $options['use_load_icon'] ) {
?>
<div id="site_loader_overlay">
	<div id="site_loader_animation" class="c-load--<?php echo esc_attr( $options['load_icon'] ); ?>">
		<?php if ( 'type3' === $options['load_icon'] ) : ?>
  	<i></i><i></i><i></i><i></i>
		<?php endif; ?>
 	</div>
</div>
<div id="site_wrap">
<?php } // endif ?>
<header id="js-header" class="l-header<?php if ( 'type2' === $header_fix ) { echo ' l-header--fixed'; } ?><?php if ( ! $options['use_load_icon'] ) { echo ' is-active'; } ?>">
	<div class="l-header__inner">
		<?php if ( is_front_page() ) : ?>
		<h1 class="l-header__logo c-logo<?php if ( $options['header_logo_image_retina'] ) { echo ' c-logo--retina'; } ?>">
		<?php else : ?>
		<div class="l-header__logo c-logo<?php if ( $options['header_logo_image_retina'] ) { echo ' c-logo--retina'; } ?>">
		<?php endif; ?>
			<?php if ( 'type1' === $options['header_use_logo_image'] ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="font-size: <?php echo esc_attr( $options['header_logo_font_size'] ); ?>px;"><?php bloginfo( 'name' ); ?></a>
			<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_attr( wp_get_attachment_url( $options['header_logo_image'] ) ); ?>" alt="<?php bloginfo( 'name' ); ?>">
			</a>
			<?php endif; ?>
		<?php if ( is_front_page() ) : ?></h1><?php else : ?></div><?php endif; ?>
		<a href="#" id="js-menu-button" class="p-menu-button c-menu-button"></a>
		<?php wp_nav_menu( $args ); ?>
	</div>
</header>
