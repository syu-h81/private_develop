<?php 
/**
 * 404
 */
// デフォルト変数を追加
add_filter( 'before_getting_design_plus_option', 'add_404_dp_default_options' );

// タブパネルのラベルを追加
add_action( 'tcd_tab_labels', 'add_404_tab_label' );

// タブパネルの HTML を追加
add_action( 'tcd_tab_panel', 'add_404_tab_panel' );

// サニタイズ処理を追加
add_filter( 'theme_options_validate', 'add_404_theme_options_validate' );

function add_404_dp_default_options( $dp_default_options ) {

	// ページヘッダーの設定
	$dp_default_options['ph_404_image'] = '';
	$dp_default_options['ph_404_catchphrase'] = '';
	$dp_default_options['ph_404_catchphrase_font_size'] = 28;
	$dp_default_options['ph_404_color'] = '#ffffff';
	$dp_default_options['ph_404_bg_color'] = '#222222';
	$dp_default_options['ph_404_bg_opacity'] = 1;

	return $dp_default_options;

}

function add_404_tab_label( $tab_labels ) {
	$tab_labels[] = __( '404 page', 'tcd-w' );
	return $tab_labels;
}

function add_404_tab_panel( $options ) {

	global $dp_default_options;
?>
<div id="tab-content9">
	<?php // ページヘッダーの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommend image size. Width:1450px, Height:600px', 'tcd-w' ); ?></p>
    <div class="image_box cf">
    	<div class="cf cf_media_field hide-if-no-js ph_404_image">
    		<input type="hidden" value="<?php echo esc_attr( $options['ph_404_image'] ); ?>" id="ph_404_image" name="dp_options[ph_404_image]" class="cf_media_id">
    		<div class="preview_field"><?php if ( $options['ph_404_image'] ) { echo wp_get_attachment_image( $options['ph_404_image'], 'medium' ); } ?></div>
    		<div class="button_area">
    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ph_404_image'] ) { echo 'hidden'; } ?>">
    		</div>
    	</div>
    </div>
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[ph_404_catchphrase]"><?php echo esc_textarea( $options['ph_404_catchphrase'] ); ?></textarea>
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input id="dp_options[ph_404_catchphrase_font_size]" class="hankaku tiny-text" type="number" min="1" name="dp_options[ph_404_catchphrase_font_size]" value="<?php echo esc_attr( $options['ph_404_catchphrase_font_size'] ); ?>"> <span>px</span></label></p>
		<p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" name="dp_options[ph_404_color]" value="<?php echo esc_attr( $options['ph_404_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['ph_404_color'] ); ?>" class="c-color-picker"></label></p>
		<p><label><?php _e( 'Background color', 'tcd-w' ); ?> <input type="text" name="dp_options[ph_404_bg_color]" value="<?php echo esc_attr( $options['ph_404_bg_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['ph_404_bg_color'] ); ?>" class="c-color-picker">
		<p><label><?php _e( 'Opacity of background color', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="0" max="1" step="0.1" name="dp_options[ph_404_bg_opacity]" value="<?php echo esc_attr( $options['ph_404_bg_opacity'] ); ?>"></label></p>
		<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ); ?></p>
    <input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div><!-- END #tab-content9 -->
<?php
}

function add_404_theme_options_validate( $input ) {

 	// ページヘッダーの設定
 	$input['ph_404_image'] = wp_filter_nohtml_kses( $input['ph_404_image'] );
 	$input['ph_404_catchphrase'] = wp_filter_nohtml_kses( $input['ph_404_catchphrase'] );
 	$input['ph_404_catchphrase_font_size'] = wp_filter_nohtml_kses( $input['ph_404_catchphrase_font_size'] );
 	$input['ph_404_color'] = wp_filter_nohtml_kses( $input['ph_404_color'] );
 	$input['ph_404_bg_color'] = wp_filter_nohtml_kses( $input['ph_404_bg_color'] );
 	$input['ph_404_bg_opacity'] = wp_filter_nohtml_kses( $input['ph_404_bg_opacity'] );

	return $input;
}
