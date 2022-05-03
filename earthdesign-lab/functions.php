<?php

// Translation
load_theme_textdomain( 'tcd-w', get_template_directory() . '/languages' );

function vogue_setup() {

	// Post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Title tag
	add_theme_support( 'title-tag' );

	// Image sizes
	add_image_size( 'size1', 480, 320, true ); // x2
	add_image_size( 'size2', 680, 450, true ); // x2
	add_image_size( 'size3', 440, 290, true ); // x2
	add_image_size( 'size4', 200, 200, true ); // x2
	add_image_size( 'size5', 870, 720, true ); // x1.2
	add_image_size( 'size-card', 120, 120, true ); // For card link
	
	// Menu
	register_nav_menus( array(
		'global' => __( 'Global navigation', 'tcd-w' ),
	) );

}
add_action( 'after_setup_theme', 'vogue_setup' );

function vogue_init() {

	// Emoji
  $options = get_design_plus_option();
  if ( 0 == $options['use_emoji'] ) {
  	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );    
  	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}

	// News
	$news_labels = array(
		'name' => get_custom_post_label( 'news' )
	);
	$news_args = array(
		'has_archive' => true,
		'labels' => $news_labels,
		'menu_position' => 5,
		'public' => true,
		'supports' => array( 'editor', 'revisions', 'thumbnail', 'title' )
	);
	if ( $options['news_slug'] ) {
		$news_args['rewrite'] = array( 'slug' => $options['news_slug'] );
	}
	register_post_type( 'news', $news_args );

	// Plan
	$plan_labels = array(
		'name' => get_custom_post_label( 'plan' )
	);
	$plan_args = array(
		'has_archive' => true,
		'labels' => $plan_labels,
		'menu_position' => 5,
		'public' => true,
		'supports' => array( 'editor', 'revisions', 'title' )
	);
	if ( $options['plan_slug'] ) {
		$plan_args['rewrite'] = array( 'slug' => $options['plan_slug'] );
	}
	register_post_type( 'plan', $plan_args );
}
add_action( 'init', 'vogue_init' );

/**
 * カスタム投稿タイプのラベルを取得する
 *
 * @param  string $slug 取得したいカスタム投稿のスラッグ（news or plan） 
 * @return string       テーマオプションで設定されたカスタム投稿のラベルを返す
 *                      渡されたパラメータがnews or plan でない場合は空の文字列を返す
 */
function get_custom_post_label( $slug ) {

	$options = get_design_plus_option();

	if ( 'news' === $slug || 'plan' === $slug ) {
		
		if ( $options[$slug . '_breadcrumb'] ) {
			return esc_html( $options[$slug . '_breadcrumb'] );
		} else {
			// テーマオプションに値が設定されていない場合は、元々のラベルを返す
			return __( ucfirst( $slug ), 'tcd-w' );
		}

	} else {
		return '';
	}

}

// プラン一覧では表示設定に関係なく全てのプランを1ページで表示する
function vogue_pre_get_posts( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( 'plan' ) ) {
  	$query->set( 'posts_per_page', -1 );
	}

}
add_action( 'pre_get_posts', 'vogue_pre_get_posts' );

function vogue_scripts() {

	global $wp_query;
	$options = get_design_plus_option();

	if ( is_front_page() || is_singular( 'plan' ) ) {

		wp_enqueue_style( 'vogue-slick', get_template_directory_uri() . '/assets/css/slick.min.css' );
		wp_enqueue_style( 'vogue-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.min.css' );
		wp_enqueue_script( 'vogue-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), version_num(), true );

		if ( is_front_page() ) {
			wp_enqueue_script( 'vogue-front-script', get_template_directory_uri() . '/assets/js/front-page.min.js', array( 'jquery', 'vogue-script' ), version_num(), true );
			wp_localize_script( 'vogue-front-script', 'splash', array( 'is_splash' => esc_html( $options['display_splash'] ) ) );
		}

	} elseif ( is_search() || is_home() || ( is_archive() && ! is_post_type_archive( 'plan' ) ) ) {

		if ( ! wp_is_mobile() ) {

			wp_enqueue_script( 'vogue-imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), version_num(), true );
			wp_enqueue_script( 'vogue-jquery-infinitescroll-min', get_template_directory_uri() . '/assets/js/jquery.infinitescroll.min.js', array( 'jquery' ), version_num(), true );
			wp_enqueue_script( 'vogue-load', get_template_directory_uri() . '/assets/js/load.min.js', array( 'jquery' ), version_num(), true );
			wp_localize_script( 'vogue-load', 'infinitescroll', array( 'max_num_pages' => $wp_query->max_num_pages, 'finished_message' => __( 'No more post', 'tcd-w' ), 'image_path' => get_template_directory_uri() . '/assets/images/ajax-loader.gif' ) );

		}

	} elseif ( is_singular( 'post' ) ) {
		wp_enqueue_script( 'comment', get_template_directory_uri() . '/assets/js/comment.js', array( 'jquery' ), version_num(), true );
	}

	wp_enqueue_style( 'vogue-style', get_stylesheet_uri(), false, version_num() );
	wp_enqueue_script( 'vogue-script', get_template_directory_uri() . '/assets/js/functions.min.js', array( 'jquery' ), version_num(), true );
	wp_localize_script( 'vogue-script', 'plan', array( 'listNum' => $options['plan_list_num'] ) );
	wp_enqueue_script( 'vogue-load', get_template_directory_uri() . '/assets/js/load.min.js', array( 'jquery' ), version_num(), true );
	wp_localize_script( 'vogue-load', 'load', array( 'loadTime' => $options['load_time'] * 1000 ) ); // ミリ秒で渡す

	if ( is_mobile() && 'type3' !== $options['footer_bar_display'] && ! $options['display_request'] ) {

		wp_enqueue_style( 'vogue-footer-bar', get_template_directory_uri() . '/assets/css/footer-bar.css', false, version_num() );
		wp_enqueue_script( 'vogue-footer-bar', get_template_directory_uri() . '/assets/js/footer-bar.min.js', array( 'jquery' ), version_num(), true );

	}
}
add_action( 'wp_enqueue_scripts', 'vogue_scripts' );

function vogue_admin_scripts() {

	// For media uploading
	wp_enqueue_media(); // media uploader API
	//wp_enqueue_script( 'media-upload' ); // 以前のmedia uploader で使用. wp3.5未満
	wp_enqueue_script( 'cf-media-field', get_template_directory_uri() . '/admin/js/cf-media-field.js', '', version_num() );

	// WordPress Color Picker API
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker');

	// For Ad widget(tcd ver.)
	wp_enqueue_script( 'oops-widget-script', get_template_directory_uri() . '/admin/js/widget.min.js', array( 'jquery' ), '', version_num() );

	// For theme options
	wp_enqueue_script( 'jquery.cookieTab', get_template_directory_uri() . '/admin/js/jquery.cookieTab.js', '', version_num() );
	wp_enqueue_script( 'jquery-form' ); // submit by AJAX

	// Contents builder
	wp_enqueue_style( 'oops-cb', get_template_directory_uri() . '/admin/css/cb.min.css', '', version_num() );
	wp_enqueue_script( 'oops-cb', get_template_directory_uri() . '/admin/js/cb.min.js', '', version_num() );
	wp_enqueue_style( 'editor-buttons' ); // editor-buttons.css を常時出力

	// Footer bar
	wp_enqueue_style( 'oops-admin-footer-bar', get_template_directory_uri() . '/admin/css/footer-bar.min.css', '', version_num() );
	wp_enqueue_script( 'oops-admin-footer-bar', get_template_directory_uri() . '/admin/js/footer-bar.min.js', '', version_num() );

	wp_enqueue_style( 'my_admin_css', get_template_directory_uri() . '/admin/css/my_admin.min.css', '', version_num() );
	wp_enqueue_script( 'my_script', get_template_directory_uri() . '/admin/js/my_script.min.js', '', version_num() );
	wp_localize_script( 'my_script', 'ajax_submit', array( 'success' => __( 'Settings Saved Successfully', 'tcd-w' ), 'error' => __( 'Can not save data. Please try again.', 'tcd-w' ) ) );
	wp_localize_script( 'my_script', 'translation', array( 'word_counter' => __( 'word count:', 'tcd-w' ) ) );
?>
<script type="text/javascript">
var cfmf_text = { title:'<?php _e( 'Please Select Image', 'tcd-w' ); ?>', button:'<?php _e( 'Use this Image', 'tcd-w' ); ?>' };
</script>
<?php
}
add_action( 'admin_enqueue_scripts', 'vogue_admin_scripts' );

// Editor style
function vogue_add_editor_styles() {
	add_editor_style( 'admin/css/editor-style-02.min.css' );
}
add_action( 'admin_init', 'vogue_add_editor_styles' );

// Widget area
function vogue_widgets_init() {

	// Posts
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s">'."\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Single post pages', 'tcd-w' ),
		'id' => 'single_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s">'."\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Single post pages(mobile)', 'tcd-w' ),
		'id' => 'single_widget_mobile'
	) );

	// News
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s">'."\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Single news pages', 'tcd-w' ),
		'id' => 'news_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s">'."\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Single news pages(mobile)', 'tcd-w' ),
		'id' => 'news_widget_mobile'
	) );

	// Pages
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s">'."\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Pages', 'tcd-w' ),
		'id' => 'page_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s">'."\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Pages(mobile)', 'tcd-w' ),
		'id' => 'page_widget_mobile'
	) );

	// Footer
	register_sidebar( array(
		'before_widget' => '<div class="p-footer-widget %2$s">'."\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-footer-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Footer', 'tcd-w' ),
		'id' => 'footer_widget'
	) );
	register_sidebar( array(
		'before_widget' => '<div class="p-footer-widget %2$s">'."\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-footer-widget__title">',
		'after_title' => '</h2>',
		'name' => __( 'Footer(mobile)', 'tcd-w' ),
		'id' => 'footer_widget_mobile'
	) );

}
add_action( 'widgets_init', 'vogue_widgets_init' );

// Excerpt
function custom_excerpt_length( $length ) {
	return 75;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

// Remove wpautop from the excerpt
remove_filter( 'the_excerpt', 'wpautop' );

// Customize archive title
function vogue_archive_title( $title ) {
	global $author, $post;
	if ( is_author() ) {
		$title = get_the_author_meta( 'display_name', $author );
	} elseif ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	} elseif ( is_day() ) {
		$title = get_the_time( __( 'F jS, Y', 'tcd-w' ), $post );
	} elseif ( is_month() ) {
		$title = get_the_time( __( 'F, Y', 'tcd-w' ), $post );
	} elseif ( is_year() ) {
		$title = get_the_time( __( 'Y', 'tcd-w' ), $post );
	} elseif ( is_search() ) {
		$title = __( 'Search result', 'tcd-w' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'vogue_archive_title', 10 );

// ビジュアルエディタに表(テーブル)の機能を追加
function mce_external_plugins_table( $plugins ) {
	$plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
  return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

// tinymceのtableボタンにclass属性プルダウンメニューを追加
function mce_buttons_table( $buttons ) {
	$buttons[] = 'table';
  return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function bootstrap_classes_tinymce( $settings ) {
  $styles = array(
    array( 'title' => __( 'Default style', 'tcd-w'), 'value' => '' ),
    array( 'title' => __( 'No border', 'tcd-w'), 'value' => 'table_no_border' ),
    array( 'title' => __( 'Display only horizontal border', 'tcd-w' ), 'value' => 'table_border_horizontal' )
  );
  $settings['table_class_list'] = json_encode( $styles );
  return $settings;
}
add_filter( 'tiny_mce_before_init', 'bootstrap_classes_tinymce' );

// ビジュアルエディタにページ分割ボタンを追加 -----------------------------------------------
function add_nextpage_buttons($buttons){
	array_push($buttons, "wp_page");
	return $buttons;
}
add_filter("mce_buttons", "add_nextpage_buttons");

/**
 * クローン用のリッチエディター化処理をしないようにする
 * クローン後のリッチエディター化はjsで行う
 */
function cb_builder_tiny_mce_before_init( $mceInit, $editor_id ) { 
  if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) { 
    $mceInit['wp_skip_init'] = true;
  }
  return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'cb_builder_tiny_mce_before_init', 10, 2 );

/**
 *  Translate Hex to RGB
 */
function hex2rgb( $hex ) {

	$hex = str_replace( '#', '', $hex );

  if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
    $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
    $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
  } else {
  	$r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
   }
   $rgb = array( $r, $g, $b );

   return $rgb;
}

/**
 *  ユーザーエージェントを判定するための関数
 */
function is_mobile() {
  
	// タブレットも含める場合は wp_is_mobile()
 	$match = 0;
	$ua = array(
  	'iPhone', // iPhone
   	'iPod', // iPod touch
		'Android.*Mobile', // 1.5+ Android *** Only mobile
		'Windows.*Phone', // *** Windows Phone
		'dream', // Pre 1.5 Android
		'CUPCAKE', // 1.5+ Android
		'BlackBerry', // BlackBerry
		'BB10', // BlackBerry10
		'webOS', // Palm Pre Experimental
		'incognito', // Other iPhone browser
		'webmate' // Other iPhone browser
	);

 	$pattern = '/' . implode( '|', $ua ) . '/i';
 	$match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

 	if ( $match === 1 ) {
   		return TRUE;
 	} else {
   		return FALSE;
 	}
}

/**
 * スクリプトのバージョン管理
 */
function version_num() {
	if ( function_exists( 'wp_get_theme' ) ) {
		$theme_data = wp_get_theme();
 	} else {
   		$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
 	}
	$current_version = $theme_data['Version'];
 	return $current_version;
}

/**
 * カードリンクパーツ
 */
function get_the_custom_excerpt( $content, $length ) {
	$length = ( $length ? $length : 70 ); // デフォルトの長さを指定する
  $content =  preg_replace( '/<!--more-->.+/is', '', $content ); // moreタグ以降削除
 	$content =  strip_shortcodes( $content ); // ショートコード削除
  $content =  strip_tags( $content ); // タグの除去
  $content =  str_replace( '&nbsp;', '', $content ); // 特殊文字の削除（今回はスペースのみ）
  $content =  mb_substr( $content, 0, $length ); // 文字列を指定した長さで切り取る
  return $content.'...';
}
 
/**
 * カードリンクショートコード
 */
function clink_scode( $atts ) {
	extract( shortcode_atts( array( 'url' => '', 'title' => '', 'excerpt' => '' ), $atts ) );
  $id = url_to_postid( $url ); // URLから投稿IDを取得
  $post = get_post( $id ); // IDから投稿情報の取得
  $date = mysql2date( 'Y.m.d', $post->post_date ); // 投稿日の取得
  $img_width = 120; // 画像サイズの幅指定
  $img_height = 120; // 画像サイズの高さ指定
  $no_image = get_template_directory_uri() . '/assets/images/no-image-400x400.gif';

  // 抜粋を取得
  if ( empty( $excerpt ) ) {
  	if ( $post->post_excerpt ) {
    	$excerpt = get_the_custom_excerpt( $post->post_excerpt, 145 );
  	} else {
      $excerpt = get_the_custom_excerpt( $post->post_content , 145 );
  	}
  }
  // タイトルを取得
  if ( empty( $title ) ) {
  	$title = esc_html( get_the_title( $id ) );
  }
 	// アイキャッチ画像を取得 
  if ( has_post_thumbnail( $id ) ) {
  	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'size-card' );
    $img_tag = '<img src="' . $img[0] . '" alt="' . $title . '" width="' . $img[1] . '" height="' . $img[2] . '">';
  } else { 
		$img_tag ='<img src="' . $no_image . '" alt="" width="' . $img_width . '" height="' . $img_height . '">';
  }
  $clink = '<div class="cardlink"><a href="' . esc_url( $url ) . '"><div class="cardlink_thumbnail">' . $img_tag . '</div></a><div class="cardlink_content"><span class="cardlink_timestamp">' . esc_html( $date ) . '</span><div class="cardlink_title"><a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a></div><div class="cardlink_excerpt">' . esc_html( $excerpt ) . '</div></div><div class="cardlink_footer"></div></div>';
  
	return $clink;
}  
add_shortcode( 'clink', 'clink_scode' );

/**
 * comment
 */
function custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if ( ! $commentcount ) {
		$commentcount = 0;
	}
?>
<li id="comment-<?php comment_ID(); ?>" class="c-comment__list-item comment">
	<div class="c-comment__item-header u-clearfix">
		<div class="c-comment__item-meta u-clearfix">
<?php 
	if ( function_exists( 'get_avatar' ) && get_option( 'show_avatars' ) ) { 
		echo get_avatar( $comment, 35, '', false, array( 'class' => 'c-comment__item-avatar' ) ); 
	} 
	if ( get_comment_author_url() ) {
		echo '<a id="commentauthor-' . get_comment_ID() . '" class="c-comment__item-author" rel="nofollow">' . get_comment_author() . '</a>' . "\n";
	} else {
		echo '<span id="commentauthor-' . get_comment_ID() . '" class="c-comment__item-author">' . get_comment_author() . '</span>' . "\n";
	}
?>
			<time class="c-comment__item-date" datetime="<?php comment_time( 'Y-m-d' ); ?>"><?php comment_time( __( 'F jS, Y', 'tcd-w' ) ); ?></time>
		</div>
		<ul class="c-comment__item-act">
<?php 
	if ( 1 == get_option( 'thread_comments' ) ) :
?>
			<li><?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __( 'REPLY', 'tcd-w' ) . '' ) ) ); ?></li>
<?php
	else :
?>
    	<li><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'js-comment__textarea');"><?php _e( 'REPLY', 'tcd-w' ); ?></a></li>
<?php
	endif;
?>
    	<li><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'js-comment__textarea');"><?php _e( 'QUOTE', 'tcd-w' ); ?></a></li>
    	<?php edit_comment_link( __( 'EDIT', 'tcd-w' ), '<li>', '</li>'); ?>
		</ul>
	</div>
	<div id="comment-content-<?php comment_ID() ?>" class="c-comment__item-body">
<?php
	if ( 0 == $comment->comment_approved ) {
		echo '<span class="c-comment__item-note">' . __( 'Your comment is awaiting moderation.', 'tcd-w' ) . '</span>' . "\n"; 
	} else {
		comment_text();
	}
?>
	</div>
<?php
}

//メールフォームの textarea にひらがなが無ければ送信できない（contact form7）
add_filter('wpcf7_validate_textarea', 'wpcf7_validation_textarea_hiragana', 10, 2);
add_filter('wpcf7_validate_textarea*', 'wpcf7_validation_textarea_hiragana', 10, 2);

function wpcf7_validation_textarea_hiragana($result, $tag)
{
    $name = $tag['name'];
    $value = (isset($_POST[$name])) ? (string) $_POST[$name] : '';

    if ($value !== '' && !preg_match('/[ぁ-ん]/u', $value)) {
        $result['valid'] = false;
        $result['reason'] = array($name => 'エラー / この内容は送信できません。');
    }

    return $result;
}

// Theme options
require get_template_directory() . '/admin/theme-options.php';

// Add custom columns
require get_template_directory() . '/inc/admin_column.php';

// Add quicktags to the visual editor
require get_template_directory() . '/inc/custom_editor.php';

// Hook wp_head
require get_template_directory() . '/inc/head.php';

// Hook wp_footer
require get_template_directory() . '/inc/footer.php';

// OGP
require get_template_directory() . '/inc/ogp.php';

// Page builder
require get_template_directory() . '/pagebuilder/pagebuilder.php';

// Show custom fields in quick edit
require get_template_directory() . '/inc/quick_edit.php';

// Shortcode
require get_template_directory() . '/inc/short_code.php';

// Update notifier
require get_template_directory() . '/inc/update_notifier.php';

/**
 * Add meta boxes
 */
require get_template_directory() . '/inc/class-tcd-meta-box.php';

// Custom CSS
require get_template_directory() . '/inc/custom_css.php';

// Password protected pages
require get_template_directory() . '/inc/password_form.php';

// Page header
require get_template_directory() . '/inc/ph_cf.php';

// Plan list
require get_template_directory() . '/inc/plan_list_cf.php';

// Plan archive
require get_template_directory() . '/inc/plan_archive_cf.php';

// Splash page
require get_template_directory() . '/inc/splash.php';

// Recommend post
require get_template_directory() . '/inc/recommend.php';

// Meta title and description
require get_template_directory() . '/inc/seo.php';
 
/**
 * Register widgets
 */
require get_template_directory() . '/inc/widget/ad.php';
require get_template_directory() . '/inc/widget/archive_list.php';
require get_template_directory() . '/inc/widget/category_list.php';
require get_template_directory() . '/inc/widget/google_search.php';
require get_template_directory() . '/inc/widget/styled_post_list.php';
