<?php
// 設定項目と無害化用コールバックを登録
function theme_options_init() {
	register_setting( 
		'design_plus_options', 
		'dp_options', 
		'theme_options_validate'
	);
}
add_action( 'admin_init', 'theme_options_init' );

// 外観メニューにサブメニューを登録
function theme_options_add_page() {
	add_theme_page( 
		__( 'TCD Theme Options', 'tcd-w' ), 
		__( 'TCD Theme Options', 'tcd-w' ), 
		'edit_theme_options',
		'theme_options',
		'theme_options_do_page'
	);
}
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * オプション初期値
 * @var array
 */
global $dp_default_options;
$dp_default_options = array();

/**
 * Design Plus のオプションを返す
 *
 * @global array $dp_default_options
 * @return array 
 */
function get_design_plus_option() {

	global $dp_default_options;
	$dp_default_options = apply_filters( 'before_getting_design_plus_option', $dp_default_options );

	return shortcode_atts( $dp_default_options, get_option( 'dp_options', array() ) );

}

// テーマオプション画面の作成
function theme_options_do_page() {

	global $dp_upload_error, $tab_labels;
	$options = get_design_plus_option(); 

	$tab_labels = array();
	$tab_labels = apply_filters( 'tcd_tab_labels', $tab_labels );

	if ( ! isset( $_REQUEST['settings-updated'] ) ) {
		$_REQUEST['settings-updated'] = false;
	}
?>
<div class="wrap">
	<h2><?php _e( 'TCD Theme Options', 'tcd-w' ); ?></h2> 
<?php
// 更新時のメッセージ
if ( false !== $_REQUEST['settings-updated'] ) :
?>
	<div class="updated fade">
		<p><strong><?php _e( 'Updated', 'tcd-w' ); ?></strong></p>
	</div>
<?php 
endif; 

	// ファイルアップロード時のメッセージ
	if ( ! empty( $dp_upload_error['message'] ) ):
  	if ( $dp_upload_error['error'] ) :
?>
	<div id="error" class="error">
		<p><?php echo esc_html( $dp_upload_error['message'] ); ?></p>
	</div>
<?php 
		else : 
?>
	<div id="message" class="updated fade">
		<p><?php echo esc_html( $dp_upload_error['message'] ); ?></p>
	</div>
<?php 
		endif; 
	endif;
?>
	<div id="my_theme_option" class="cf">
		<div id="my_theme_left">
   		<ul id="theme_tab" class="cf">
				<?php for ( $i = 0; $i < count( $tab_labels ); $i++ ) : ?>
    		<li><a href="#tab-content<?php echo esc_attr( $i + 1 ); ?>"><?php echo esc_html( $tab_labels[$i] ); ?></a></li>
				<?php endfor; ?>
   		</ul>
  	</div>
  	<div id="my_theme_right">
			<form id="myOptionsForm" method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields( 'design_plus_options' ); ?>
				<div id="tab-panel">
					<?php do_action( 'tcd_tab_panel', $options ); ?>
				</div><!-- END #tab-panel -->
			</form>
   		<div id="saved_data"></div>
   		<div id="saving_data" style="display:none;"><p><?php _e( 'Now saving...', 'tcd-w' ); ?></p></div>
		</div><!-- END #my_theme_right -->
	</div><!-- END #my_theme_option -->
</div><!-- END #wrap -->
<?php
}

/**
 * チェック
 */
function theme_options_validate( $input ) {

	$input = apply_filters( 'theme_options_validate', $input );
 	return $input;

}

/**
 * モジュールの読み込み
 */
require get_template_directory() . '/admin/inc/basic.php';
require get_template_directory() . '/admin/inc/logo.php';
require get_template_directory() . '/admin/inc/top.php';
require get_template_directory() . '/admin/inc/blog.php';
require get_template_directory() . '/admin/inc/news.php';
require get_template_directory() . '/admin/inc/plan.php';
require get_template_directory() . '/admin/inc/header.php';
require get_template_directory() . '/admin/inc/footer.php';
require get_template_directory() . '/admin/inc/404.php';
require get_template_directory() . '/admin/inc/password.php';
