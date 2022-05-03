<?php 
/**
 * header
 */

// デフォルト変数を追加
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );

// タブパネルのラベルを追加
add_action( 'tcd_tab_labels', 'add_header_tab_label' );

// タブパネルの HTML を追加
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );

// サニタイズ処理を追加
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );

// ヘッダーバーの表示位置
global $header_fix_options;
$header_fix_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Normal header', 'tcd-w' ) 
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Fix at top after page scroll', 'tcd-w' )
	),
);

function add_header_dp_default_options( $dp_default_options ) {

	// ヘッダーバーの表示位置
	$dp_default_options['header_fix'] = 'type1';
	
	// ヘッダーバーの表示位置（スマホ）
	$dp_default_options['mobile_header_fix'] = 'type1';

	// ヘッダーバーの色の設定
	$dp_default_options['header_bg'] = '#004353';
	$dp_default_options['header_opacity'] = 0.8;
	$dp_default_options['header_font_color'] = '#ffffff';	
	$dp_default_options['header_font_color_hover'] = '#7fa1a9';	

	return $dp_default_options;

}

function add_header_tab_label( $tab_labels ) {
	$tab_labels[] = __( 'Header', 'tcd-w' );
	return $tab_labels;
}

function add_header_tab_panel( $options ) {

	global $dp_default_options, $header_fix_options; 
?>
<div id="tab-content7">
	<?php // ヘッダーバーの表示位置 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Header position', 'tcd-w' ); ?></h3>
   	<fieldset class="cf select_type2">
			<?php foreach ( $header_fix_options as $option ) : ?>
     	<label class="description"><input type="radio" name="dp_options[header_fix]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $option['value'], $options['header_fix'] ); ?>><?php _e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
    </fieldset>
    <input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // ヘッダーバーの表示位置（スマホ）?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Header position for mobile device', 'tcd-w' ); ?></h3>
  	<fieldset class="cf select_type2">
			<?php foreach ( $header_fix_options as $option ) : ?>
			<label class="description"><input type="radio" name="dp_options[mobile_header_fix]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['mobile_header_fix'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
		</fieldset>
  	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // ヘッダーバーの色の設定 ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Background color settings', 'tcd-w' );  ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' );  ?></h4>
		<input type="text" name="dp_options[header_bg]" value="<?php echo esc_attr( $options['header_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_bg'] ); ?>" class="c-color-picker">
  	<h4 class="theme_option_headline2"><?php _e( 'Opacity of background', 'tcd-w' ); ?></h4>
		<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: "Opacity of background" is not applied in smartphone.', 'tcd-w' ); ?></p>
		<input class="hankaku tiny-text" type="number" min="0" max="1" step="0.1" name="dp_options[header_opacity]" value="<?php echo esc_attr( $options['header_opacity'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'Font color', 'tcd-w' ); ?></h4>
		<input type="text" name="dp_options[header_font_color]" value="<?php echo esc_attr( $options['header_font_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_font_color'] ); ?>" class="c-color-picker">
  	<h4 class="theme_option_headline2"><?php _e( 'Font color on hover', 'tcd-w' ); ?></h4>
		<input type="text" name="dp_options[header_font_color_hover]" value="<?php echo esc_attr( $options['header_font_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_font_color_hover'] ); ?>" class="c-color-picker">
  	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
</div><!-- END #tab-content7 -->
<?php
}

function add_header_theme_options_validate( $input ) {

	global $header_fix_options;

	// ヘッダーバーの表示位置
 	if ( ! isset( $input['header_fix'] ) ) $input['header_fix'] = null;
 	if ( ! array_key_exists( $input['header_fix'], $header_fix_options ) ) $input['header_fix'] = null;

	// ヘッダーバーの表示位置（スマホ）
 	if ( ! isset( $input['mobile_header_fix'] ) ) $input['mobile_header_fix'] = null;
 	if ( ! array_key_exists( $input['mobile_header_fix'], $header_fix_options ) ) $input['mobile_header_fix'] = null;

	// ヘッダーバーの色の設定
	$input['header_bg'] = wp_filter_nohtml_kses( $input['header_bg'] );
	$input['header_opacity'] = wp_filter_nohtml_kses( $input['header_opacity'] );
	$input['header_font_color'] = wp_filter_nohtml_kses( $input['header_font_color'] );
	$input['header_font_color_hover'] = wp_filter_nohtml_kses( $input['header_font_color_hover'] );

	return $input;

}
