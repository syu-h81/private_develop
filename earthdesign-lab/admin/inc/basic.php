<?php
/**
 * basic
 */

// デフォルト変数を追加
add_filter( 'before_getting_design_plus_option', 'add_basic_dp_default_options' );

// タブパネルのラベルを追加
add_action( 'tcd_tab_labels', 'add_basic_tab_label' );

// タブパネルの HTML を追加
add_action( 'tcd_tab_panel', 'add_basic_tab_panel' );

// サニタイズ処理を追加
add_filter( 'theme_options_validate', 'add_basic_theme_options_validate' );

// フォントタイプ
global $font_type_options;
$font_type_options = array(
 	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Meiryo', 'tcd-w' )
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'YuGothic', 'tcd-w' )
	),
 	'type3' => array(
		'value' => 'type3',
		'label' => __( 'YuMincho', 'tcd-w' )
	)
);

// 大見出しのフォントタイプ
global $headline_font_type_options;
$headline_font_type_options = array(
 	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Meiryo', 'tcd-w' )
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'YuGothic', 'tcd-w' )
	),
 	'type3' => array(
		'value' => 'type3',
		'label' => __( 'YuMincho', 'tcd-w' )
	)
);

// ローディングアイコンの種類の設定
global $load_icon_options;
$load_icon_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Circle', 'tcd-w' ) ),
	'type2' => array( 'value' => 'type2', 'label' => __( 'Square', 'tcd-w' ) ),
 	'type3' => array( 'value' => 'type3', 'label' => __( 'Dot', 'tcd-w' ) )
);

// ロード画面の設定
global $load_time_options;
for ( $i = 3; $i <= 10; $i++) {
	//$load_time_options[$i] = array( 'value' => $i * 1000, 'label' => $i );
	$load_time_options[$i] = array( 'value' => $i, 'label' => $i );
}

// ホバーエフェクトの設定
global $hover_type_options;
$hover_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Zoom', 'tcd-w' )
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Slide', 'tcd-w' )
	),
 	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Fade', 'tcd-w' )
	)
);
global $hover2_direct_options;
$hover2_direct_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Left to Right', 'tcd-w' )
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Right to Left', 'tcd-w' )
	)
);

// 記事上ボタンタイプ
global $sns_type_top_options;
$sns_type_top_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'style1', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'style2', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'style3', 'tcd-w' )
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'style4', 'tcd-w' )
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'style5', 'tcd-w' )
	)
);

// 記事下ボタンタイプ
global $sns_type_btm_options;
$sns_type_btm_options = $sns_type_top_options;

// Google Maps
global $gmap_marker_type_options;
$gmap_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Use default marker', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Use custom marker', 'tcd-w' ) )
);

global $gmap_custom_marker_type_options;
$gmap_custom_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Text', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Image', 'tcd-w' ) )
);

function add_basic_dp_default_options( $dp_default_options ) {

	// 色の設定
	$dp_default_options['primary_color'] = '#004353';
	$dp_default_options['secondary_color'] = '#222222';
	$dp_default_options['content_link_color'] = '#004353';

	// ファビコンの設定
	$dp_default_options['favicon'] = '';

	// フォントタイプ
	$dp_default_options['font_type'] = 'type1';

	// 大見出しのフォントタイプ
	$dp_default_options['headline_font_type'] = 'type2';

	// 絵文字の設定
	$dp_default_options['use_emoji'] = 1;

	// サイドバーの設定
	$dp_default_options['left_sidebar'] = 0;
	$dp_default_options['sidebar_bg'] = '#f6f6f6';

	// ロード画面の設定
	$dp_default_options['use_load_icon'] = '';
	$dp_default_options['load_icon'] = 'type1';
	$dp_default_options['load_time'] = 3;

	// ホバーエフェクトの設定
	$dp_default_options['hover_type'] = 'type1';
	$dp_default_options['hover1_zoom'] = 1.2;
	$dp_default_options['hover2_direct'] = 'type1';
	$dp_default_options['hover2_opacity'] = 0.5;
	$dp_default_options['hover3_opacity'] = 0.5;
	$dp_default_options['hover3_bgcolor'] = '#ffffff';

	// Facebook OGPの設定
	$dp_default_options['use_ogp'] = 0;
	$dp_default_options['fb_admin_id'] = '';
	$dp_default_options['ogp_image'] = '';

	// Twitter Cardsの設定
	$dp_default_options['use_twitter_card'] = 0;
	$dp_default_options['twitter_account_name'] = '';

	// ソーシャルボタンの表示設定
	$dp_default_options['sns_type_top'] = 'type1';
	$dp_default_options['show_twitter_top'] = 1;
	$dp_default_options['show_fblike_top'] = 1;
	$dp_default_options['show_fbshare_top'] = 1;
	$dp_default_options['show_google_top'] = 1;
	$dp_default_options['show_hatena_top'] = 1;
	$dp_default_options['show_pocket_top'] = 1;
	$dp_default_options['show_feedly_top'] = 1;
	$dp_default_options['show_rss_top'] = 1;
	$dp_default_options['show_pinterest_top'] = 1;
	$dp_default_options['sns_type_btm'] = 'type1';
	$dp_default_options['show_twitter_btm'] = 1;
	$dp_default_options['show_fblike_btm'] = 1;
	$dp_default_options['show_fbshare_btm'] = 1;
	$dp_default_options['show_google_btm'] = 1;
	$dp_default_options['show_hatena_btm'] = 1;
	$dp_default_options['show_pocket_btm'] = 1;
	$dp_default_options['show_feedly_btm'] = 1;
	$dp_default_options['show_rss_btm'] = 1;
	$dp_default_options['show_pinterest_btm'] = 1;
	$dp_default_options['twitter_info'] = '';

  // Google Map
	$dp_default_options['gmap_api_key'] = '';
	$dp_default_options['gmap_marker_type'] = 'type1';
	$dp_default_options['gmap_custom_marker_type'] = 'type1';
	$dp_default_options['gmap_marker_text'] = '';
	$dp_default_options['gmap_marker_color'] = '#ffffff';
	$dp_default_options['gmap_marker_img'] = '';
	$dp_default_options['gmap_marker_bg'] = '#000000';

	// カスタムCSS
	$dp_default_options['css_code'] = '';

  // Custom head/script
	$dp_default_options['custom_head'] = '';

	return $dp_default_options;

}

function add_basic_tab_label( $tab_labels ) {
	$tab_labels[] = __( 'Basic', 'tcd-w' );
	return $tab_labels;
}

function add_basic_tab_panel( $options ) {

	global $dp_default_options, $font_type_options, $headline_font_type_options, $load_icon_options, $load_time_options, $hover_type_options, $hover2_direct_options, $sns_type_top_options, $sns_type_btm_options, $gmap_marker_type_options, $gmap_custom_marker_type_options;

?>
<div id="tab-content1">
	<?php // 色の設定 ?>
	<div id="color_pattern">
		<div class="theme_option_field cf">
			<h3 class="theme_option_headline"><?php _e( 'Color setting', 'tcd-w' ); ?></h3>
			<h4 class="theme_option_headline2"><?php _e( 'Primary color setting', 'tcd-w' ); ?></h4>
			<input type="text" name="dp_options[primary_color]" value="<?php echo esc_attr( $options['primary_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['primary_color'] ); ?>" class="c-color-picker">
			<h4 class="theme_option_headline2"><?php _e( 'Secondary color setting', 'tcd-w' ); ?></h4>
			<input type="text" name="dp_options[secondary_color]" value="<?php echo esc_attr( $options['secondary_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['secondary_color'] ); ?>" class="c-color-picker">
  		<h4 class="theme_option_headline2"><?php _e( 'Link color of post contents', 'tcd-w' ); ?></h4>
			<input type="text" name="dp_options[content_link_color]" value="<?php echo esc_attr( $options['content_link_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['content_link_color'] ); ?>" class="c-color-picker">
			<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
		</div>
	</div>
	<?php // ファビコンの設定 ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Favicon setup', 'tcd-w' ); ?></h3>
		<p><?php _e( 'Setting for the favicon displayed at browser address bar or tab.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Favicon file', 'tcd-w' ); ?><?php _e( ' (Recommended size: width:16px, height:16px)', 'tcd-w' ); ?></p>
		<p><?php _e( 'You can use .ico, .png or .gif file, and we recommed you to use .ico file.', 'tcd-w' ); ?></p>
    <div class="image_box cf">
    	<div class="cf cf_media_field hide-if-no-js favicon">
    		<input type="hidden" value="<?php echo esc_attr( $options['favicon'] ); ?>" id="favicon" name="dp_options[favicon]" class="cf_media_id">
    		<div class="preview_field"><?php if ( $options['favicon'] ) { echo wp_get_attachment_image($options['favicon'], 'medium' ); } ?></div>
    		<div class="button_area">
    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['favicon'] ) { echo 'hidden'; } ?>">
    		</div>
    	</div>
    </div>
    <input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // フォントタイプ ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Font type', 'tcd-w' ); ?></h3>
		<p><?php _e( 'Please set the font type of all text except for headline.', 'tcd-w' ); ?></p>
  	<fieldset class="cf select_type2">
			<?php foreach ( $font_type_options as $option ) : ?>
			<label class="description"><input type="radio" name="dp_options[font_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['font_type'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
		</fieldset>
		<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // 大見出しのフォントタイプ ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Font type of headline', 'tcd-w' ); ?></h3>
  	<fieldset class="cf select_type2">
			<?php foreach ( $headline_font_type_options as $option ) : ?>
			<label class="description"><input type="radio" name="dp_options[headline_font_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $option['value'], $options['headline_font_type'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
    </fieldset>
		<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // 絵文字の設定 ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Emoji setup', 'tcd-w' ); ?></h3>
  	<p><?php _e( 'We recommend to checkoff this option if you dont use any Emoji in your post content.', 'tcd-w' );  ?></p>
  	<p><label><input name="dp_options[use_emoji]" type="checkbox" value="1" <?php checked( 1, $options['use_emoji'] ); ?>><?php _e( 'Use emoji', 'tcd-w' ); ?></label></p>
		<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  </div>
	<?php // サイドバーの設定 ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Sidebar settings', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Layout', 'tcd-w' ); ?></h4>
  	<p><?php _e( 'The sidebar is displayed on the right side. If you want to change the sidebar to be displayed on the left side, please check the box below.', 'tcd-w' );  ?></p>
  	<p><label><input name="dp_options[left_sidebar]" type="checkbox" value="1" <?php checked( 1, $options['left_sidebar'] ); ?>><?php _e( 'Display the sidebar on the left side', 'tcd-w' ); ?></label></p>
		<h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
		<input type="text" name="dp_options[sidebar_bg]" value="<?php echo esc_attr( $options['sidebar_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['sidebar_bg'] ); ?>" class="c-color-picker">
		<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  </div>
	<?php // ロード画面の設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Loading screen setting', 'tcd-w' ); ?></h3>
  	<p><label><input id="dp_options[use_load_icon]" name="dp_options[use_load_icon]" type="checkbox" value="1" <?php checked( 1, $options['use_load_icon'] ); ?>><?php _e( 'Use load icon.', 'tcd-w' ); ?></label></p>
		<h4 class="theme_option_headline2"><?php _e( 'Type of loader', 'tcd-w' ); ?></h4>
    <select id="load_icon_type" name="dp_options[load_icon]">
    	<?php foreach ( $load_icon_options as $option ) : ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['load_icon'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
      <?php endforeach; ?>
    </select>
    <h4 class="theme_option_headline2"><?php _e( 'Maximum display time', 'tcd-w' ); ?></h4>
  	<p><?php _e( 'Please set the maximum display time of the loading screen.<br />Even if all the content is not loaded, loading screen will disappear automatically after a lapse of time you have set at follwing.', 'tcd-w' ); ?></p>
  	<select name="dp_options[load_time]">
			<?php foreach ( $load_time_options as $option ) : ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['load_time'] ); ?>><?php echo esc_html( $option['label'] ); ?><?php _e( ' seconds', 'tcd-w' ); ?></option>
			<?php endforeach; ?>
		</select>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // ホバーエフェクトの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Hover effect settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Hover effect type', 'tcd-w' ); ?></h4>
  	<p><?php _e( 'Please set the hover effect for thumbnail images.', 'tcd-w' ); ?></p>
  	<fieldset class="cf select_type2">
			<?php foreach ( $hover_type_options as $option ) : ?>
			<input type="radio" id="tab-<?php echo $option['value']; ?>" name="dp_options[hover_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['hover_type'] ); ?>><label for="tab-<?php echo $option['value']; ?>" class="description" style="display: inline;"><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label><br>
			<?php endforeach; ?>
			<div class="tab-box">
				<div id="tabView1">
		  		<h4 class="theme_option_headline2"><?php _e( 'Settings for Zoom effect', 'tcd-w' ); ?></h4>
		  		<p><?php _e( 'Please set the rate of magnification.', 'tcd-w' ); ?></p>
		  		<input class="tiny-text" type="number" min="1" step="0.1" name="dp_options[hover1_zoom]" value="<?php echo esc_attr( $options['hover1_zoom'] ); ?>">
		  		<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	    	</div>
    		<div id="tabView2">
		  		<h4 class="theme_option_headline2"><?php _e( 'Settings for Slide effect', 'tcd-w' ); ?></h4>
		  		<p><?php _e( 'Please set the direction of slide.', 'tcd-w' ); ?></p>
		  		<fieldset class="cf select_type2">
						<?php foreach ( $hover2_direct_options as $option ) : ?>
		    	 	<label class="description" style="display:inline-block;margin-right:15px;"><input type="radio" name="dp_options[hover2_direct]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['hover2_direct'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label>
						<?php endforeach; ?>
		    	</fieldset>
					<p><?php _e( 'Please set the opacity. (0 - 1.0, e.g. 0.7)', 'tcd-w' ); ?></p>
		    	<input class="tiny-text" type="number" min="0" max="1" step="0.1" name="dp_options[hover2_opacity]" value="<?php echo esc_attr( $options['hover2_opacity'] ); ?>">
		    	<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	    	</div>
    		<div id="tabView3">
		    	<h4 class="theme_option_headline2"><?php _e( 'Settings for Fade effect', 'tcd-w' ); ?></h4>
		    	<p><?php _e( 'Please set the opacity. (0 - 1.0, e.g. 0.7)', 'tcd-w' ); ?></p>
		    	<input id="dp_options[hover3_opacity]" class="hankaku tiny-text" type="number" min="0" max="1" step="0.1" name="dp_options[hover3_opacity]" value="<?php echo esc_attr( $options['hover3_opacity'] ); ?>">
		    	<p><?php _e( 'Please set the background color.', 'tcd-w' ); ?></p>
					<input type="text" name="dp_options[hover3_bgcolor]" value="<?php echo esc_attr( $options['hover3_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker">
		  		<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	    	</div>
    	</div>
    </fieldset>
  </div>
	<?php // Use OGP tag ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Facebook OGP setting', 'tcd-w' ); ?></h3>
  	<div class="theme_option_input">
  		<p><label><input id="dp_options[use_ogp]" name="dp_options[use_ogp]" type="checkbox" value="1" <?php checked( '1', $options['use_ogp'] ); ?>><?php _e( 'Use OGP', 'tcd-w' );  ?></label></p>
  		<p><?php _e( 'Your fb:admins ID', 'tcd-w' );  ?> <input id="dp_options[fb_admin_id]" class="regular-text" type="text" name="dp_options[fb_admin_id]" value="<?php esc_attr_e( $options['fb_admin_id'] ); ?>"></p>
  		<p><?php _e( '<a href="http://design-plus1.com/tcd-w/2016/07/facebook-3.html" target="_blank">Information about Facebook OGP and fb:admins ID</a>', 'tcd-w' ); ?></p>
  	</div>
		<h4 class="theme_option_headline2"><?php _e( 'OGP image', 'tcd-w' ); ?></h4>
		<p><?php _e( 'This image is displayed for OGP if the page does not have a thumbnail.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Recommend image size. Width:1200px, Height:630px', 'tcd-w' ); ?></p>
		<div class="image_box cf">
			<div class="cf cf_media_field hide-if-no-js">
				<input type="hidden" value="<?php echo esc_attr( $options['ogp_image'] ); ?>" id="ogp_image" name="dp_options[ogp_image]" class="cf_media_id">
				<div class="preview_field"><?php if ( $options['ogp_image'] ) { echo wp_get_attachment_image( $options['ogp_image'], 'medium'); } ?></div>
				<div class="button_area">
					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ogp_image'] ) { echo 'hidden'; } ?>">
				</div>
			</div>
		</div>
  	<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  </div>
	<?php // Use twitter card ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Twitter Cards setting', 'tcd-w' );  ?></h3>
  	<div class="theme_option_input">
  		<p><label><input id="dp_options[use_twitter_card]" name="dp_options[use_twitter_card]" type="checkbox" value="1" <?php checked( '1', $options['use_twitter_card'] ); ?>> <?php _e( 'Use Twitter Cards', 'tcd-w' );  ?></label></p>
		<p><?php _e( 'Your Twitter account name (exclude @ mark)', 'tcd-w' ); ?><input id="dp_options[twitter_account_name]" class="regular-text" type="text" name="dp_options[twitter_account_name]" value="<?php esc_attr_e( $options['twitter_account_name'] ); ?>"></p>
  		<p><a href="http://design-plus1.com/tcd-w/2016/11/twitter-cards.html" target="_blank"><?php _e( 'Information about Twitter Cards.', 'tcd-w' ); ?></a></p>
  	</div>
  	<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  </div>
	<?php // ソーシャルボタンの表示設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Social button Setup', 'tcd-w' ); ?></h3>
     <p><?php _e( 'You can set share buttons on single page.', 'tcd-w' ); ?></p>
     <p><?php _e( 'You can select whether to show or hide buttons with the theme options of blog and news.', 'tcd-w' ); ?></p>
  	<div class="theme_option_input">
  		<h4 class="theme_option_headline2"><?php _e( 'Type of button on article top', 'tcd-w' ); ?></h4>
  		<fieldset class="cf">
  			<ul class="cf">
					<?php foreach ( $sns_type_top_options as $option ) : ?>
     			<li><label><input type="radio" name="dp_options[sns_type_top]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['sns_type_top'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
					<?php endforeach; ?>
    		</ul>
			</fieldset>
    	<h4 class="theme_option_headline2"><?php _e( 'Select the social button to show on article top', 'tcd-w' ); ?></h4>
      <ul>
      	<li><label><input id="dp_options[show_twitter_top]" name="dp_options[show_twitter_top]" type="checkbox" value="1" <?php checked( '1', $options['show_twitter_top'] ); ?>><?php _e( 'Display twitter button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_fblike_top]" name="dp_options[show_fblike_top]" type="checkbox" value="1" <?php checked( '1', $options['show_fblike_top'] ); ?> /><?php _e( 'Display facebook like button -Button type 5 (Default button) only', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_fbshare_top]" name="dp_options[show_fbshare_top]" type="checkbox" value="1" <?php checked( '1', $options['show_fbshare_top'] ); ?> /><?php _e( 'Display facebook share button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_google_top]" name="dp_options[show_google_top]" type="checkbox" value="1" <?php checked( '1', $options['show_google_top'] ); ?> /><?php _e( 'Display google+ button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_hatena_top]" name="dp_options[show_hatena_top]" type="checkbox" value="1" <?php checked( '1', $options['show_hatena_top'] ); ?> /><?php _e( 'Display hatena button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_pocket_top]" name="dp_options[show_pocket_top]" type="checkbox" value="1" <?php checked( '1', $options['show_pocket_top'] ); ?>><?php _e( 'Display pocket button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_feedly_top]" name="dp_options[show_feedly_top]" type="checkbox" value="1" <?php checked( '1', $options['show_feedly_top'] ); ?>><?php _e( 'Display feedly button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_rss_top]" name="dp_options[show_rss_top]" type="checkbox" value="1" <?php checked( '1', $options['show_rss_top'] ); ?>><?php _e( 'Display rss button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_pinterest_top]" name="dp_options[show_pinterest_top]" type="checkbox" value="1" <?php checked( '1', $options['show_pinterest_top'] ); ?> /><?php _e( 'Display pinterest button', 'tcd-w' ); ?></label></li>
      </ul>
    	<h4 class="theme_option_headline2"><?php _e( 'Type of button on article bottom', 'tcd-w' ); ?></h4>
    	<fieldset class="cf">
    		<ul class="cf">
					<?php foreach ( $sns_type_btm_options as $option ) : ?>
     			<li><label><input type="radio" name="dp_options[sns_type_btm]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $option['value'], $options['sns_type_btm'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
					<?php endforeach; ?>
				</ul>
    	</fieldset>
			<h4 class="theme_option_headline2"><?php _e( 'Select the social button to show on article bottom', 'tcd-w' ); ?></h4>
      <ul>
      	<li><label><input id="dp_options[show_twitter_btm]" name="dp_options[show_twitter_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_twitter_btm'] ); ?>><?php _e( 'Display twitter button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_fblike_btm]" name="dp_options[show_fblike_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fblike_btm'] ); ?>><?php _e( 'Display facebook like button-Button type 5 (Default button) only', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_fbshare_btm]" name="dp_options[show_fbshare_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fbshare_btm'] ); ?>><?php _e( 'Display facebook share button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_google_btm]" name="dp_options[show_google_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_google_btm'] ); ?> /><?php _e( 'Display google+ button', 'tcd-w' ); ?></label></li>
				<li><label><input id="dp_options[show_hatena_btm]" name="dp_options[show_hatena_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_hatena_btm'] ); ?>><?php _e( 'Display hatena button', 'tcd-w' ); ?></label></li>
      	<li><label><input id="dp_options[show_pocket_btm]" name="dp_options[show_pocket_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pocket_btm'] ); ?>><?php _e( 'Display pocket button', 'tcd-w' ); ?></label></li>
        <li><label><input id="dp_options[show_feedly_btm]" name="dp_options[show_feedly_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_feedly_btm'] ); ?>><?php _e( 'Display feedly button', 'tcd-w' ); ?></label></li>
        <li><label><input id="dp_options[show_rss_btm]" name="dp_options[show_rss_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_rss_btm'] ); ?>><?php _e( 'Display rss button', 'tcd-w' ); ?></label></li>
        <li><label><input id="dp_options[show_pinterest_btm]" name="dp_options[show_pinterest_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pinterest_btm'] ); ?>><?php _e( 'Display pinterest button', 'tcd-w' ); ?></label></li>
      </ul>
    	<h4 class="theme_option_headline2"><?php _e( 'Setting for the twitter button', 'tcd-w' ); ?></h4>
      	<label style="margin-top:20px;"><?php _e( 'Set of twitter account. (ex.designplus)', 'tcd-w' ); ?></label>
      	<input style="display:block; margin:.6em 0 1em;" id="dp_options[twitter_info]" class="regular-text" type="text" name="dp_options[twitter_info]" value="<?php esc_attr_e( $options['twitter_info'] ); ?>">
     	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
	</div>
	<?php // Google Maps ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Google Maps settings', 'tcd-w' );  ?></h3>
     <h4 class="theme_option_headline2"><?php _e( 'API key', 'tcd-w' ); ?></h4>
     <input type="text" class="regular-text" name="dp_options[gmap_api_key]" value="<?php echo esc_attr( $options['gmap_api_key'] ); ?>">
     <h4 class="theme_option_headline2"><?php _e( 'Marker type', 'tcd-w' ); ?></h4>
     <?php foreach ( $gmap_marker_type_options as $option ) : ?>
     <p><label id="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>"><input type="radio" name="dp_options[gmap_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['gmap_marker_type'] ); ?>> <?php echo esc_html_e( $option['label'] ); ?></label></p>
     <?php endforeach; ?>
     <div id="gmap_marker_type2_area" style="<?php if($options['gmap_marker_type'] == 'type1'){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e( 'Custom marker type', 'tcd-w' ); ?></h4>
      <?php foreach ( $gmap_custom_marker_type_options as $option ) : ?>
      <p><label id="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>"><input type="radio" name="dp_options[gmap_custom_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['gmap_custom_marker_type'] ); ?>> <?php echo esc_html_e( $option['label'] ); ?></label></p>
      <?php endforeach; ?>
      <div id="gmap_custom_marker_type1_area" style="<?php if ( $options['gmap_custom_marker_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker text', 'tcd-w' ); ?></h4>
       <input type="text" name="dp_options[gmap_marker_text]" value="<?php echo esc_attr( $options['gmap_marker_text'] ); ?>" class="regular-text">
       <p><label for="gmap_marker_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[gmap_marker_color]" data-default-color="<?php echo esc_attr( $dp_default_options['gmap_marker_color'] ); ?>" value="<?php echo esc_attr( $options['gmap_marker_color'] ); ?>" id="gmap_marker_color"></p>
      </div>
      <div id="gmap_custom_marker_type2_area" style="<?php if ( $options['gmap_custom_marker_type'] == 'type1') { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker image', 'tcd-w' ); ?></h4>
       <p><?php _e( 'Recommended size: width:60px, height:20px', 'tcd-w' ); ?></p>
       <div class="image_box cf">
      	<div class="cf cf_media_field hide-if-no-js gmap_marker_img">
         <input type="hidden" value="<?php echo esc_attr( $options['gmap_marker_img'] ); ?>" id="gmap_marker_img" name="dp_options[gmap_marker_img]" class="cf_media_id">
         <div class="preview_field"><?php if ( $options['gmap_marker_img'] ) { echo wp_get_attachment_image($options['gmap_marker_img'], 'medium' ); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['gmap_marker_img'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>
      </div>
     <h4 class="theme_option_headline2"><?php _e( 'Marker style', 'tcd-w' ); ?></h4>
     <p><label for=""> <?php _e( 'Background color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[gmap_marker_bg]" data-default-color="<?php echo esc_attr( $dp_default_options['gmap_marker_bg'] ); ?>" value="<?php echo esc_attr( $options['gmap_marker_bg'] ); ?>"></p>
     </div>
  	<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // カスタムCSS ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Free input area for user definition CSS.', 'tcd-w' );  ?></h3>
  	<p><?php _e( 'Code example:<br /><strong>.example { font-size:12px; }</strong>', 'tcd-w' );  ?></p>
  	<textarea id="dp_options[css_code]" class="large-text" cols="50" rows="10" name="dp_options[css_code]"><?php echo esc_textarea( $options['css_code'] ); ?></textarea>
  	<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	</div>

  <?php // Custom head/script ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Free input area for user definition scripts.', 'tcd-w' ); ?></h3>
  	<p><?php esc_html_e( 'Custom Script will output the end of the <head> tag. Please insert scripts (i.e. Google Analytics script), including <script>tag.', 'tcd-w' ); ?></p>
  	<textarea id="dp_options[custom_head]" class="large-text" cols="50" rows="10" name="dp_options[custom_head]"><?php echo esc_textarea( $options['custom_head'] ); ?></textarea>
  	<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	</div>

</div><!-- END #tab-content1 -->
<?php
}

function add_basic_theme_options_validate( $input ) {

	global $font_type_options, $headline_font_type_options, $load_icon_options, $load_time_options, $hover_type_options, $hover2_direct_options, $sns_type_top_options, $sns_type_btm_options, $gmap_custom_marker_type_options, $gmap_marker_type_options;

	// 色の設定
 	$input['primary_color'] = wp_filter_nohtml_kses( $input['primary_color'] );
 	$input['secondary_color'] = wp_filter_nohtml_kses( $input['secondary_color'] );
 	$input['content_link_color'] = wp_filter_nohtml_kses( $input['content_link_color'] );

	// ファビコン
 	$input['favicon'] = wp_filter_nohtml_kses( $input['favicon'] );

	// フォントの種類
 	if ( ! isset( $input['font_type'] ) ) $input['font_type'] = null;
 	if ( ! array_key_exists( $input['font_type'], $font_type_options ) ) $input['font_type'] = null;

	// 大見出しのフォントタイプ
 	if ( ! isset( $input['headline_font_type'] ) ) $input['headline_font_type'] = null;
 	if ( ! array_key_exists( $input['headline_font_type'], $headline_font_type_options ) ) $input['headline_font_type'] = null;

 	// 絵文字の設定
	if ( ! isset( $input['use_emoji'] ) ) $input['use_emoji'] = null;
  $input['use_emoji'] = ( $input['use_emoji'] == 1 ? 1 : 0 );

 	// サイドバーの設定
 	if ( ! isset( $input['left_sidebar'] ) ) $input['left_sidebar'] = null;
 	$input['left_sidebar'] = ( $input['left_sidebar'] == 1 ? 1 : 0 );
 	$input['sidebar_bg'] = wp_filter_nohtml_kses( $input['sidebar_bg'] );

 	// ロード画面の設定
	//$load_time_flag = false;
 	if ( ! isset( $input['use_load_icon'] ) ) $input['use_load_icon'] = null;
  $input['use_load_icon'] = ( $input['use_load_icon'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['load_icon'] ) ) $input['load_icon'] = null;
 	if ( ! array_key_exists( $input['load_icon'], $load_icon_options ) ) $input['load_icon'] = null;

 	if ( ! isset( $input['load_time'] ) ) $input['load_time'] = null;
	/*
	foreach ( $load_time_options as $load_time_option ) {
		if ( $input['load_time'] === $load_time_option['value'] ) {
			$load_time_flag = true;
		}
	}
	if ( ! $load_time_flag ) $input['load_time'] = null;
	*/
 	if ( ! array_key_exists( $input['load_time'], $load_time_options ) ) $input['load_time'] = null;

	// ホバーエフェクトの設定
	$hover_type_flag = false;
 	if ( ! isset( $input['hover_type'] ) ) $input['hover_type'] = null;
	foreach ( $hover_type_options as $hover_type_option ) {
		if ( $input['hover_type'] === $hover_type_option['value'] ) {
			$hover_type_flag = true;
		}
	}
	if ( ! $hover_type_flag ) $input['hover_type'] = false;
 	$input['hover1_zoom'] = wp_filter_nohtml_kses( $input['hover1_zoom'] );
 	if ( ! isset( $input['hover2_direct'] ) ) $input['hover2_direct'] = null;
 	if ( ! array_key_exists( $input['hover2_direct'], $hover2_direct_options ) ) $input['hover2_direct'] = null;
 	$input['hover2_opacity'] = wp_filter_nohtml_kses( $input['hover2_opacity'] );
 	$input['hover3_opacity'] = wp_filter_nohtml_kses( $input['hover3_opacity'] );
 	$input['hover3_bgcolor'] = wp_filter_nohtml_kses( $input['hover3_bgcolor'] );

	// Facebook OGPの設定
 	if ( ! isset( $input['use_ogp'] ) ) $input['use_ogp'] = null;
  $input['use_ogp'] = ( $input['use_ogp'] == 1 ? 1 : 0 );
 	$input['fb_admin_id'] = wp_filter_nohtml_kses( $input['fb_admin_id'] );
	$input['ogp_image'] = wp_filter_nohtml_kses( $input['ogp_image'] );

	// Twitter Cardsの設定
	if ( ! isset( $input['use_twitter_card'] ) ) $input['use_twitter_card'] = null;
  $input['use_twitter_card'] = ( $input['use_twitter_card'] == 1 ? 1 : 0 );
 	$input['twitter_account_name'] = wp_filter_nohtml_kses( $input['twitter_account_name'] );

 	// ソーシャルボタンの表示設定
 	if ( ! isset( $input['sns_type_top'] ) ) $input['sns_type_top'] = null;
 	if ( ! array_key_exists( $input['sns_type_top'], $sns_type_top_options ) ) $input['sns_type_top'] = null;
 	if ( ! isset( $input['show_twitter_top'] ) ) $input['show_twitter_top'] = null;
  $input['show_twitter_top'] = ( $input['show_twitter_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_fblike_top'] ) ) $input['show_fblike_top'] = null;
  $input['show_fblike_top'] = ( $input['show_fblike_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_fbshare_top'] ) ) $input['show_fbshare_top'] = null;
  $input['show_fbshare_top'] = ( $input['show_fbshare_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_google_top'] ) ) $input['show_google_top'] = null;
  $input['show_google_top'] = ( $input['show_google_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_hatena_top'] ) ) $input['show_hatena_top'] = null;
  $input['show_hatena_top'] = ( $input['show_hatena_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_pocket_top'] ) ) $input['show_pocket_top'] = null;
  $input['show_pocket_top'] = ( $input['show_pocket_top'] == 1 ? 1 : 0 );
	if ( ! isset( $input['show_feedly_top'] ) ) $input['show_feedly_top'] = null;
  $input['show_feedly_top'] = ( $input['show_feedly_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_rss_top'] ) ) $input['show_rss_top'] = null;
  $input['show_rss_top'] = ( $input['show_rss_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_pinterest_top'] ) ) $input['show_pinterest_top'] = null;
  $input['show_pinterest_top'] = ( $input['show_pinterest_top'] == 1 ? 1 : 0 );

 	if ( ! isset( $input['sns_type_btm'] ) ) $input['sns_type_btm'] = null;
 	if ( ! array_key_exists( $input['sns_type_btm'], $sns_type_btm_options ) ) $input['sns_type_btm'] = null;
 	if ( ! isset( $input['show_twitter_btm'] ) ) $input['show_twitter_btm'] = null;
  $input['show_twitter_btm'] = ( $input['show_twitter_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_fblike_btm'] ) ) $input['show_fblike_btm'] = null;
  $input['show_fblike_btm'] = ( $input['show_fblike_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_fbshare_btm'] ) ) $input['show_fbshare_btm'] = null;
  $input['show_fbshare_btm'] = ( $input['show_fbshare_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_google_btm'] ) ) $input['show_google_btm'] = null;
  $input['show_google_btm'] = ( $input['show_google_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_hatena_btm'] ) ) $input['show_hatena_btm'] = null;
  $input['show_hatena_btm'] = ( $input['show_hatena_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_pocket_btm'] ) ) $input['show_pocket_btm'] = null;
  $input['show_pocket_btm'] = ( $input['show_pocket_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_feedly_btm'] ) ) $input['show_feedly_btm'] = null;
  $input['show_feedly_btm'] = ( $input['show_feedly_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_rss_btm'] ) ) $input['show_rss_btm'] = null;
  $input['show_rss_btm'] = ( $input['show_rss_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_pinterest_btm'] ) ) $input['show_pinterest_btm'] = null;
  $input['show_pinterest_btm'] = ( $input['show_pinterest_btm'] == 1 ? 1 : 0 );

  // Google Maps
 	$input['gmap_api_key'] = wp_filter_nohtml_kses( $input['gmap_api_key'] );
 	if ( ! isset( $input['gmap_marker_type'] ) ) $input['gmap_marker_type'] = null;
 	if ( ! array_key_exists( $input['gmap_marker_type'], $gmap_marker_type_options ) ) $input['gmap_marker_type'] = null;
 	if ( ! isset( $input['gmap_custom_marker_type'] ) ) $input['gmap_custom_marker_type'] = null;
 	if ( ! array_key_exists( $input['gmap_custom_marker_type'], $gmap_custom_marker_type_options ) ) $input['gmap_custom_marker_type'] = null;
 	$input['gmap_marker_text'] = wp_filter_nohtml_kses( $input['gmap_marker_text'] );
 	$input['gmap_marker_color'] = wp_filter_nohtml_kses( $input['gmap_marker_color'] );
 	$input['gmap_marker_img'] = wp_filter_nohtml_kses( $input['gmap_marker_img'] );

 	// オリジナルスタイルの設定
 	$input['css_code'] = $input['css_code'];

  // Custom CSS
 	$input['custom_head'] = $input['custom_head'];

	return $input;

}
