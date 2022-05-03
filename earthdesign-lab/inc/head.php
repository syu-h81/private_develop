<?php
function tcd_head() {
	global $post;
	$options = get_design_plus_option();
	$sidebar_bg = $options['sidebar_bg'];
	$primary_color = $options['primary_color'];
	$secondary_color = $options['secondary_color'];
	$hex_color1 = esc_html( implode( ', ', hex2rgb( $primary_color ) ) ); // keyframe の記述が長くなるため、ここでエスケープ
  $hex_color2 = esc_html( implode( ', ', hex2rgb( $secondary_color ) ) ); // keyframe の記述が長くなるため、ここでエスケープ
?>
<?php if ( $options['favicon'] ) : ?>
<link rel="shortcut icon" href="<?php echo esc_html( wp_get_attachment_url( $options['favicon'] ) ); ?>">
<?php endif; ?>
<style>
/* primary color */
.p-widget-search__submit:hover, .slick-arrow:hover, .p-tab__content-pager-item.is-active a, .p-tab__content-pager-item a:hover, .p-content04__slider .slick-arrow:hover, .p-hero-header__link:hover, .c-comment__form-submit:hover, .p-page-links a span, .p-pager__item span, .p-pager__item a:hover, .p-global-nav .sub-menu a:hover, .p-button:hover, .c-pw__btn--submit, .p-content02 .slick-arrow:hover { background: <?php echo esc_html( $primary_color ); ?>; }
.p-article04__category a:hover, .p-article04__title a:hover, .p-content03__blog-archive-link:hover, .p-content03__news-archive-link:hover, .p-latest-news__archive-link:hover, .p-article01__title a:hover, .p-article01__category a:hover, .widget_nav_menu a:hover, .p-breadcrumb__item a:hover, .p-social-nav__item a:hover, .p-article03__title a:hover, .p-widget-post-list__item-title a:hover { color: <?php echo esc_html( $primary_color ); ?>; }
/* secondary color */
.p-widget-search__submit, .p-latest-news__title, .p-tab__nav-item.is-active a, .p-tab__nav-item a:hover, .slick-arrow, .slick-arrow:focus, .p-tab__content-pager-item a, .p-content04__slider .slick-arrow, .p-hero-header__link, .p-hero-header .slick-arrow, .c-comment__form-submit, .p-page-links span, .p-page-links a span:hover, .p-pager__item a, .p-pager__item .dots, .p-widget__title, .p-global-nav .sub-menu a, .p-content02 .slick-arrow { background: <?php echo esc_html( $secondary_color ); ?>; }
.p-tab__content-img-nav { background: rgba(34, 34, 34, 0.7); }
.p-tab__nav-item.is-active a, .p-tab__nav-item a:hover { border-color: <?php echo esc_html( $secondary_color ); ?> }

/* font type */
<?php if ( 'type1' == $options['font_type'] ) : ?>
body { font-family: Verdana, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
<?php elseif ( 'type2' == $options['font_type'] ) : ?>
body { font-family: "Segoe UI", Verdana, "游ゴシック", YuGothic, "Hiragino Kaku Gothic ProN", Meiryo, sans-serif; }
<?php else : ?>
body { font-family: "Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif; }
<?php endif; ?>

/* headline font type */
.p-page-header__title, .p-archive-header__title, .p-article01__title, .p-article02__title, .p-entry__title, .p-main-image__title, .c-nav01__item, .p-article03__title, .p-widget-post-list__item-title, .p-content02__item-title, .p-content01__catch, .p-content04__catch, .p-article04__title, .p-content03__blog-catch, .p-content03__news-catch, .p-hero-header__nav-item-title, .p-hero-header__slider-item-title {
<?php if ( 'type1' == $options['headline_font_type'] ) : ?>
font-family: "Segoe UI", "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif;
<?php elseif ( 'type2' == $options['headline_font_type'] ) : ?>
font-family: "Segoe UI", Verdana, "游ゴシック", YuGothic, "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
<?php else : ?>
font-family: "Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif; font-weight: 500;
<?php endif; ?>
}

/* sidebar */
.l-contents { background: linear-gradient(to right, #fff 0%, #fff 50%, <?php echo esc_html( $sidebar_bg ); ?> 50%, <?php echo esc_html( $sidebar_bg ); ?> 100%); }
.l-contents--rev { background: linear-gradient(to left, #fff 0%, #fff 50%, <?php echo esc_html( $sidebar_bg ); ?> 50%, <?php echo esc_html( $sidebar_bg ); ?> 100%); }
.l-secondary { background: <?php echo esc_html( $sidebar_bg ); ?>; }

/* load */
<?php
if ( $options['use_load_icon'] ) :
	if ( 'type2' === $options['load_icon'] ) :
?>
@-webkit-keyframes loading-square-loader {
  0% { box-shadow: 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px 0 rgba(<?php echo $hex_color1; ?>, 0), 0 -16px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  5% { box-shadow: 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px 0 rgba(<?php echo $hex_color1; ?>, 0), 0 -16px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  10% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -16px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  15% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -24px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  20% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -24px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  25% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -24px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  30% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -50px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  35% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -50px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  40% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -50px rgba(242, 205, 123, 0); }
  45%, 55% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  60% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  65% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  70% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  75% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  80% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  85% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -24px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  90% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -24px rgba(<?php echo $hex_color1; ?>, 0), 16px -24px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  95%, 100% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -24px rgba(<?php echo $hex_color1; ?>, 0), 16px -24px rgba(<?php echo $hex_color1; ?>, 0), 32px -24px rgba(<?php echo $hex_color2; ?>, 0); }
}
@keyframes loading-square-loader {
  0% { box-shadow: 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px 0 rgba(<?php echo $hex_color1; ?>, 0), 0 -16px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  5% { box-shadow: 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px 0 rgba(<?php echo $hex_color1; ?>, 0), 0 -16px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  10% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -16px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  15% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -24px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  20% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -24px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  25% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -24px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  30% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -50px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  35% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -50px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
  40% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -50px rgba(242, 205, 123, 0); }
  45%, 55% { box-shadow: 16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  60% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  65% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -16px rgba(<?php echo $hex_color1; ?>, 1), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  70% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -16px rgba(<?php echo $hex_color1; ?>, 1), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  75% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -16px rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  80% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  85% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -24px rgba(<?php echo $hex_color1; ?>, 0), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  90% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -24px rgba(<?php echo $hex_color1; ?>, 0), 16px -24px rgba(<?php echo $hex_color1; ?>, 0), 32px -32px rgba(<?php echo $hex_color2; ?>, 1); }
  95%, 100% { box-shadow: 16px 8px rgba(<?php echo $hex_color1; ?>, 0), 32px 8px rgba(<?php echo $hex_color1; ?>, 0), 0 -8px rgba(<?php echo $hex_color1; ?>, 0), 16px -8px rgba(<?php echo $hex_color1; ?>, 0), 32px -8px rgba(<?php echo $hex_color1; ?>, 0), 0 -24px rgba(<?php echo $hex_color1; ?>, 0), 16px -24px rgba(<?php echo $hex_color1; ?>, 0), 32px -24px rgba(<?php echo $hex_color2; ?>, 0); }
}

.c-load--type2:before { box-shadow: 16px 0 0 rgba(<?php echo $hex_color1; ?>, 1), 32px 0 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -16px 0 rgba(<?php echo $hex_color1; ?>, 1), 16px -16px 0 rgba(<?php echo $hex_color1; ?>, 1), 32px -16px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -32px rgba(<?php echo $hex_color1; ?>, 1), 16px -32px rgba(<?php echo $hex_color1; ?>, 1), 32px -32px rgba(<?php echo $hex_color2; ?>, 0); }
.c-load--type2:after { background-color: rgba(<?php echo $hex_color2; ?>, 1); }
<?php elseif ( 'type1' === $options['load_icon'] ) : ?>
.c-load--type1 { border: 3px solid rgba(<?php echo esc_html( $hex_color1 ); ?>, 0.2); border-top-color: <?php echo esc_html( $primary_color ); ?>; }
<?php else : ?>
#site_loader_animation.c-load--type3 i { background: <?php echo esc_html( $options['primary_color'] ); ?>; }
<?php
	endif;
endif; ?>

/* hover effect */
.p-hover-effect--type1:hover img { -webkit-transform: scale(<?php echo esc_html( $options['hover1_zoom'] ); ?>); transform: scale(<?php echo esc_html( $options['hover1_zoom'] ); ?>); }
<?php if ( 'type1' == $options['hover2_direct'] ) : ?>
.p-hover-effect--type2 img { margin-left: 15px; -webkit-transform: scale(1.3) translate3d(-15px, 0, 0); transform: scale(1.3) translate3d(-15px, 0, 0); }
<?php else : ?>
.p-hover-effect--type2 img { margin-left: -15px; -webkit-transform: scale(1.3) translate3d(15px, 0, 0); transform: scale(1.3) translate3d(15px, 0, 0); }
<?php endif; ?>
.p-hover-effect--type2:hover img { opacity: <?php echo esc_html( $options['hover2_opacity'] ); ?> }
.p-hover-effect--type3 { background: <?php echo esc_html( $options['hover3_bgcolor'] ); ?>; }
.p-hover-effect--type3:hover img { opacity: <?php echo esc_html( $options['hover3_opacity'] ); ?>; }

/* splash */
<?php
if ( is_front_page() ) {
	$splash_bg_opacity = $options['splash_bg_opacity'];
	$splash_display_time = $options['splash_display_time'];
} elseif ( is_page() || is_singular( 'plan' ) ) {
	$splash_bg_opacity = $post->splash_bg_opacity;
	$splash_display_time = $post->splash_display_time;
}
if ( false && $options['use_load_icon'] ) :
/*?>
.p-splash { -webkit-animation: fadeOut 1s ease <?php echo esc_html( $options['load_time'] + $splash_display_time ); ?>s forwards; animation: fadeOut 1s ease <?php echo esc_html( $options['load_time'] + $splash_display_time ); ?>s forwards; }
.p-splash__catch { -webkit-animation: fadeInUp 1.0s ease <?php echo esc_html( $options['load_time'] + 2 ); ?>s forwards; animation: fadeInUp 1.0s ease <?php echo esc_html( $options['load_time'] + 2 ); ?>s forwards; }
.p-splash__desc { -webkit-animation: fadeInUp 1.0s ease <?php echo esc_html( $options['load_time'] + 3.0 ); ?>s forwards; animation: fadeInUp 1.0s ease <?php echo esc_html( $options['load_time'] + 3.0 ); ?>s forwards; }
<?php else : ?>
.p-splash { -webkit-animation: fadeOut 1s ease <?php echo esc_html( $splash_display_time ); ?>s forwards; animation: fadeOut 1s ease <?php echo esc_html( $splash_display_time ); ?>s forwards; }
<?php */ endif; ?>
@-webkit-keyframes splashImageFadeIn { from { opacity: 0; } to { opacity: <?php echo esc_html( $splash_bg_opacity ); ?>; } }
@keyframes splashImageFadeIn { from { opacity: 0; } to { opacity: <?php echo esc_html( $splash_bg_opacity ); ?>; } }

/* contents builder */
<?php
foreach ( $options['contents_builder'] as $key => $value ) :
	if ( 'main_image' === $value['cb_content_select'] ) :
?>
#cb_<?php echo $key; ?> .p-main-image__btn { background: <?php echo esc_html( $value['cb_main_image_btn_bg'] ); ?>; }
#cb_<?php echo $key; ?> .p-main-image__btn:hover { background: <?php echo esc_html( $value['cb_main_image_btn_bg_hover'] ); ?>; }
<?php elseif ( 'blog_and_news' === $value['cb_content_select'] ) : ?>
#cb_<?php echo $key; ?> .p-content03__news-list-item a:hover { background: <?php echo esc_html( $value['cb_blog_and_news_news_bg_hover'] ); ?>; }
@media only screen and (max-width: 767px) { .p-content03__news-list { background: <?php echo esc_html( $value['cb_blog_and_news_news_bg'] ); ?>; } }
<?php elseif ( 'gallery_contents' === $value['cb_content_select'] ) : ?>
#cb_<?php echo $key; ?> .p-content04__btn { background: <?php echo esc_html( $value['cb_gallery_contents_btn_bg'] ); ?>; }
#cb_<?php echo $key; ?> .p-content04__btn:hover { background: <?php echo esc_html( $value['cb_gallery_contents_btn_bg_hover'] ); ?>; }
<?php
	endif;
endforeach;
?>

/* entry body */
<?php if ( is_page() || is_singular( 'post' ) ) : ?>
.p-entry__body, .p-entry__body p { font-size: <?php echo esc_html( $options['content_font_size'] ); ?>px; }
<?php elseif ( is_singular( 'news' ) ) : ?>
.p-entry__body, .p-entry__body p { font-size: <?php echo esc_html( $options['news_content_font_size'] ); ?>px; }
<?php elseif ( is_singular( 'plan' ) ) : ?>
.p-entry__body, .p-entry__body p { font-size: <?php echo esc_html( $options['plan_content_font_size'] ); ?>px; }
<?php endif; ?>
.p-entry__body a { color: <?php echo esc_html( $options['content_link_color'] ); ?>; }

/* plan */
.p-content02__item { width: <?php echo esc_html( 100 / $options['plan_list_num'] ); ?>%; }
.p-content02__item a:hover .p-content02__item-img { opacity: <?php echo esc_html( $options['plan_list_overlay_opacity'] ); ?>; }

/* header */
.l-header { background: rgba(<?php echo esc_html( implode( ', ', hex2rgb( $options['header_bg'] ) ) ); ?>, <?php echo esc_html( $options['header_opacity'] ); ?>); }
.l-header__logo a, .p-global-nav > li > a, .c-menu-button { color: <?php echo esc_html( $options['header_font_color'] ); ?>; }
.l-header__logo a:hover, .p-global-nav > li > a:hover { color: <?php echo esc_html( $options['header_font_color_hover'] ); ?>; }
<?php
if(is_mobile()):
  if ( is_front_page() && $options['display_splash_mobile'] ) {
  	// スプラッシュページを表示するフロントページの場合
  	$animation_delay = 0;
  } elseif ( ( is_page() || is_singular( 'plan' ) ) && $post->splash_display_mobile ) {
  	$animation_delay = 0;
  } elseif ( $options['use_load_icon'] )  {
  	$animation_delay = 0.8;
  } else {
  	$animation_delay = 0;
  }
else:
  if ( is_front_page() && $options['display_splash'] ) {
    // スプラッシュページを表示するフロントページの場合
    $animation_delay = 0;
  } elseif ( ( is_page() || is_singular( 'plan' ) ) && $post->splash_display ) {
    $animation_delay = 0;
  } elseif ( $options['use_load_icon'] )  {
    $animation_delay = 0.8;
  } else {
    $animation_delay = 0;
  }
endif;
?>
.l-header { -webkit-animation: slideDown 1.5s ease-in-out <?php echo esc_html( $animation_delay ); ?>s forwards; animation: slideDown 1.5s ease-in-out <?php echo esc_html( $animation_delay ); ?>s forwards;
}
.p-hero-header__link { -webkit-animation: slideUp 1.5s ease-in-out <?php echo esc_html( $animation_delay ); ?>s forwards; animation: slideUp 1.5s ease-in-out <?php echo esc_html( $animation_delay ); ?>s forwards; }


/* footer */
.p-request__btn { background: <?php echo esc_html( $options['request_btn_bg'] ); ?>; }
.p-request__btn:hover { background: <?php echo esc_html( $options['request_btn_bg_hover'] ); ?>; }

/* password protected pages */
.c-pw .c-pw__btn--register { background: <?php echo esc_html( $primary_color ); ?>; color: #fff; }
.c-pw__btn--register:hover { background: <?php echo esc_html( $secondary_color ); ?>; }

/* responsive */
@media only screen and (max-width: 991px) {
.p-pagetop a { background: <?php echo esc_html( $secondary_color ); ?> }
}
@media only screen and (max-width: 767px) {
.l-header { background: <?php echo esc_html( $options['header_bg'] ) ?>; animation: none; -webkit-animation: none; }
.p-request > a::after { color: <?php echo esc_html( $options['request_catch_color'] ); ?>; }
.p-content02__item { width: 100%; }
.p-tab .slick-arrow:hover, .p-content04 .slick-arrow:hover { background: <?php echo esc_html( $secondary_color ); ?>; }
}

<?php if(wp_is_mobile()): ?>
/* front page plan contents */
.p-content02__item-content{ opacity: 1; }
<?php endif; ?>

<?php if(is_mobile()): ?>
/* footer bar */
.c-footer-bar{ border-top: 1px solid <?php echo esc_html($options['footer_bar_border']); ?>; background: rgba(<?php echo esc_html( implode( ', ', hex2rgb( $options['footer_bar_bg'] ) ) ); ?>, <?php echo esc_html($options['footer_bar_tp']); ?>); }
.c-footer-bar__item + .c-footer-bar__item{ border-left: 1px solid <?php echo esc_html($options['footer_bar_border']); ?>; }
.c-footer-bar a{ color: <?php echo esc_html($options['footer_bar_color']); ?>; }
<?php endif; ?>

/* custom CSS */
<?php if ( $options['css_code'] ) { echo $options['css_code']; } ?>
</style>
<?php
}
add_action( 'wp_head', 'tcd_head' );

// Custom head/script
function tcd_custom_head() {
  $options = get_design_plus_option();

  if ( $options['custom_head'] ) {
    echo $options['custom_head'] . "\n";
  }
}
add_action( 'wp_head', 'tcd_custom_head', 9999 );
