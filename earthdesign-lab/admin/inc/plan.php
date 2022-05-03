<?php 
/**
 * review
 */
// デフォルト変数を追加
add_filter( 'before_getting_design_plus_option', 'add_review_dp_default_options' );

// タブパネルのラベルを追加
add_action( 'tcd_tab_labels', 'add_plan_tab_label' );

// タブパネルの HTML を追加
add_action( 'tcd_tab_panel', 'add_review_tab_panel' );

// サニタイズ処理を追加
add_filter( 'theme_options_validate', 'add_review_theme_options_validate' );

global $plan_list_num_options;
for ( $i = 1; $i <= 4; $i++ ) {
	$plan_list_num_options[$i] = array( 'value' => $i, 'label' => $i );
}

global $plan_list_valign_options;
$plan_list_valign_options = array(
	't' => array( 'value' => 't', 'label' => __( 'Align top', 'tcd-w' ) ),
	'c' => array( 'value' => 'c', 'label' => __( 'Align center', 'tcd-w' ) ),
	'b' => array( 'value' => 'b', 'label' => __( 'Align bottom', 'tcd-w' ) )
);

function add_review_dp_default_options( $dp_default_options ) {

	// ページヘッダーの設定
	$dp_default_options['plan_ph_image'] = '';
	$dp_default_options['plan_ph_catchphrase'] = '';
	$dp_default_options['plan_ph_catchphrase_font_size'] = 28;
	$dp_default_options['plan_ph_color'] = '#ffffff';
	$dp_default_options['plan_ph_bg_color'] = '#222222';
	$dp_default_options['plan_ph_bg_opacity'] = 1;

	// プランリストの設定（トップページ・詳細ページ共通）
	$dp_default_options['plan_list_num'] = 3;
	$dp_default_options['plan_list_overlay'] = '#004353';
	$dp_default_options['plan_list_overlay_opacity'] = 0;
	$dp_default_options['plan_list_valign'] = 't';

	// アーカイブページの設定
	$dp_default_options['plan_archive_catchphrase'] = '';
	$dp_default_options['plan_archive_catchphrase_font_size'] = 40;
	$dp_default_options['plan_archive_desc'] = '';

	// 記事詳細の設定
	$dp_default_options['plan_content_font_size'] = 14;

	// 表示設定
	$dp_default_options['plan_breadcrumb'] = __( 'Plan', 'tcd-w' );
	$dp_default_options['plan_slug'] = 'plan';

	return $dp_default_options;

}

function add_plan_tab_label( $tab_labels ) {
	$tab_labels[] = __( 'Plan', 'tcd-w' );
	return $tab_labels;
}

function add_review_tab_panel( $options ) {

	global $plan_list_num_options, $plan_list_valign_options;
?>
<div id="tab-content6">
	<?php // ページヘッダーの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?><?php _e( '(Archive page)', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommend image size. Width:1450px, Height:600px', 'tcd-w' ); ?></p>
    <div class="image_box cf">
    	<div class="cf cf_media_field hide-if-no-js plan_ph_image">
    		<input type="hidden" value="<?php echo esc_attr( $options['plan_ph_image'] ); ?>" id="plan_ph_image" name="dp_options[plan_ph_image]" class="cf_media_id">
    		<div class="preview_field"><?php if ( $options['plan_ph_image'] ) { echo wp_get_attachment_image( $options['plan_ph_image'], 'medium' ); } ?></div>
    		<div class="button_area">
    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['plan_ph_image'] ) { echo 'hidden'; } ?>">
    		</div>
    	</div>
    </div>
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[plan_ph_catchphrase]"><?php echo esc_textarea( $options['plan_ph_catchphrase'] ); ?></textarea>
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" name="dp_options[plan_ph_catchphrase_font_size]" value="<?php echo esc_attr( $options['plan_ph_catchphrase_font_size'] ); ?>"> px</label></p>
		<p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" name="dp_options[plan_ph_color]" value="<?php echo esc_attr( $options['plan_ph_color'] ); ?>" data-default-color="<?php echo esc_attr( $options['plan_ph_color'] ); ?>" class="c-color-picker"></label></p>
		<p><label><?php _e( 'Background color', 'tcd-w' ); ?> <input type="text" name="dp_options[plan_ph_bg_color]" value="<?php echo esc_attr( $options['plan_ph_bg_color'] ); ?>" data-default-color="<?php echo esc_attr( $options['plan_ph_bg_color'] ); ?>" class="c-color-picker">
		<p><label><?php _e( 'Opacity of background color', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="0" max="1" step="0.1" name="dp_options[plan_ph_bg_opacity]" value="<?php echo esc_attr( $options['plan_ph_bg_opacity'] ); ?>"></label></p>
		<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ); ?></p>
    <input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // アーカイブページの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Archive page settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[plan_archive_catchphrase]"><?php echo esc_textarea( $options['plan_archive_catchphrase'] ); ?></textarea>
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" name="dp_options[plan_archive_catchphrase_font_size]" value="<?php echo esc_attr( $options['plan_archive_catchphrase_font_size'] ); ?>"> px</label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[plan_archive_desc]"><?php echo esc_textarea( $options['plan_archive_desc'] ); ?></textarea>
    <input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // 記事ページの設定 ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents', 'tcd-w' ); ?></h4>
  	<input class="tiny-text hankaku" type="number" min="1" name="dp_options[plan_content_font_size]" value="<?php echo esc_attr( $options['plan_content_font_size'] ); ?>"> <span>px</span>
  	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
	<?php // プランリストの設定（トップページ・詳細ページ共通） ?>
	<div class="theme_option_field cf a-plan-list-num">
  	<h3 class="theme_option_headline"><?php _e( 'Plan list settings(Front page and Singular page)', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'The number of columns', 'tcd-w' ); ?></h4>
		<p><?php _e( 'Please select the number of columns of plan list', 'tcd-w' ); ?></p>
		<select name="dp_options[plan_list_num]">
			<?php foreach ( $plan_list_num_options as $option ) : ?>
			<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['plan_list_num'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
			<?php endforeach; ?>
		</select>
  	<h4 class="theme_option_headline2"><?php _e( 'Background color of plan list on hover', 'tcd-w' ); ?></h4>
		<input type="text" class="c-color-picker" name="dp_options[plan_list_overlay]" value="<?php echo esc_attr( $options['plan_list_overlay'] ); ?>" data-default-color="<?php echo esc_attr( $options['plan_list_overlay'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Opacity of image on hover', 'tcd-w' ); ?></h4>
		<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ); ?></p>
		<input class="hankaku tiny-text" type="number" min="0" max="1" step="0.1" name="dp_options[plan_list_overlay_opacity]" value="<?php echo esc_attr( $options['plan_list_overlay_opacity'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Vertical align of texts', 'tcd-w' ); ?></h4>
		<?php foreach ( $plan_list_valign_options as $option ) : ?>
		<p><label><input type="radio" name="dp_options[plan_list_valign]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['plan_list_valign'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></p>
		<?php endforeach; ?>
    <input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // 表示設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display setting', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "Plan" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[plan_breadcrumb]" value="<?php echo esc_attr( $options['plan_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "plan" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[plan_slug]" value="<?php echo esc_attr( $options['plan_slug'] ); ?>"></p>
  	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
</div><!-- END #tab-content6 -->
<?php
}

function add_review_theme_options_validate( $input ) {

	global $plan_list_num_options, $plan_list_valign_options;

	// ページヘッダーの設定
 	$input['plan_ph_image'] = wp_filter_nohtml_kses( $input['plan_ph_image'] );
 	$input['plan_ph_catchphrase'] = wp_filter_nohtml_kses( $input['plan_ph_catchphrase'] );
 	$input['plan_ph_catchphrase_font_size'] = wp_filter_nohtml_kses( $input['plan_ph_catchphrase_font_size'] );
 	$input['plan_ph_color'] = wp_filter_nohtml_kses( $input['plan_ph_color'] );
 	$input['plan_ph_bg_color'] = wp_filter_nohtml_kses( $input['plan_ph_bg_color'] );
 	$input['plan_ph_bg_opacity'] = wp_filter_nohtml_kses( $input['plan_ph_bg_opacity'] );

	// プランリストの設定（トップページ・詳細ページ共通）
 	if ( ! isset( $input['plan_list_num'] ) ) $input['plan_list_num'] = null;
 	if ( ! array_key_exists( $input['plan_list_num'], $plan_list_num_options ) ) $input['plan_list_num'] = null;
 	$input['plan_list_overlay'] = wp_filter_nohtml_kses( $input['plan_list_overlay'] );
 	$input['plan_list_overlay_opacity'] = wp_filter_nohtml_kses( $input['plan_list_overlay_opacity'] );
 	if ( ! isset( $input['plan_list_valign'] ) ) $input['plan_list_valign'] = null;
 	if ( ! array_key_exists( $input['plan_list_valign'], $plan_list_valign_options ) ) $input['plan_list_valign'] = null;

	// アーカイブページの設定
 	$input['plan_archive_catchphrase'] = wp_filter_nohtml_kses( $input['plan_archive_catchphrase'] );
 	$input['plan_archive_catchphrase_font_size'] = wp_filter_nohtml_kses( $input['plan_archive_catchphrase_font_size'] );
 	$input['plan_archive_desc'] = wp_filter_nohtml_kses( $input['plan_archive_desc'] );

	// レビュー記事詳細の設定
 	$input['plan_content_font_size'] = wp_filter_nohtml_kses( $input['plan_content_font_size'] );

	// 表示設定
 	$input['plan_breadcrumb'] = wp_filter_nohtml_kses( $input['plan_breadcrumb'] );
 	$input['plan_slug'] = wp_filter_nohtml_kses( $input['plan_slug'] );

	return $input;

}
