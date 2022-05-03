<?php 
/**
 * logo
 */
// デフォルト変数を追加
add_filter( 'before_getting_design_plus_option', 'add_logo_dp_default_options' );

// タブパネルのラベルを追加
add_action( 'tcd_tab_labels', 'add_logo_tab_label' );

// タブパネルの HTML を追加
add_action( 'tcd_tab_panel', 'add_logo_tab_panel' );

// サニタイズ処理を追加
add_filter( 'theme_options_validate', 'add_logo_theme_options_validate' );

global $use_logo_image_options;
$use_logo_image_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Use text for logo', 'tcd-w' ) ),
	'type2' => array( 'value' => 'type2', 'label' => __( 'Use image for logo', 'tcd-w' ) )
);

function add_logo_dp_default_options( $dp_default_options ) {

	// ヘッダーのロゴ
	$dp_default_options['header_use_logo_image'] = 'type1';
	$dp_default_options['header_logo_font_size'] = 26;
	$dp_default_options['header_logo_image'] = '';
	$dp_default_options['header_logo_image_retina'] = '';

	// フッターのロゴ
	$dp_default_options['footer_use_logo_image'] = 'type1';
	$dp_default_options['footer_logo_font_size'] = 26;
	$dp_default_options['footer_logo_image'] = '';
	$dp_default_options['footer_logo_image_retina'] = '';

	return $dp_default_options;

}

function add_logo_tab_label( $tab_labels ) {
	$tab_labels[] = __( 'Logo', 'tcd-w' );
	return $tab_labels;
}

function add_logo_tab_panel( $options ) {

	global $use_logo_image_options;
?>
<div id="tab-content2">
	<?php // ヘッダーのロゴ ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Header logo', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Logo type', 'tcd-w' ); ?></h4>
		<ul>
			<?php foreach ( $use_logo_image_options as $option ) : ?>
			<li><label id="header_use_logo_image_<?php echo esc_attr( $option['value'] ); ?>"><input type="radio" value="<?php echo esc_attr( $option['value'] ); ?>" name="dp_options[header_use_logo_image]" <?php checked( $options['header_use_logo_image'], $option['value'] ); ?>> <?php echo esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
			<?php endforeach; ?>
		</ul>
		<div id="header-logo-text-area"<?php if ( 'type2' === $options['header_use_logo_image'] ) { echo ' style="display: none;"'; } ?>>
    	<h4 class="theme_option_headline2"><?php _e( 'Font size for text logo', 'tcd-w' ); ?></h4>
    	<input class="hankaku tiny-text" type="number" min="1" name="dp_options[header_logo_font_size]" value="<?php esc_attr_e( $options['header_logo_font_size'] ); ?>"> <span>px</span>
    </div>
		<div id="header-logo-image-area"<?php if ( 'type1' === $options['header_use_logo_image'] ) { echo ' style="display: none;"'; } ?>>
   		<h4 class="theme_option_headline2"><?php _e( 'Image for logo', 'tcd-w' ); ?></h4>
    	<div class="image_box cf">
    		<div class="cf cf_media_field hide-if-no-js header_logo_image">
    			<input type="hidden" value="<?php echo esc_attr( $options['header_logo_image'] ); ?>" id="header_logo_image" name="dp_options[header_logo_image]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $options['header_logo_image'] ) { echo wp_get_attachment_image( $options['header_logo_image'], 'full' ); } ?></div>
      		<div class="button_area">
      	 		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      	 		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_logo_image'] ) { echo 'hidden'; } ?>">
      		</div>
				</div>
    	</div>
    	<p><label><input name="dp_options[header_logo_image_retina]" type="checkbox" value="1" <?php checked( 1, $options['header_logo_image_retina'] ); ?>><?php _e( 'Use retina display logo image', 'tcd-w' ); ?></label></p>
		</div>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // フッターのロゴ ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Footer logo', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Logo type', 'tcd-w' ); ?></h4>
		<ul>
			<?php foreach ( $use_logo_image_options as $option ) : ?>
			<li><label id="footer_use_logo_image_<?php echo esc_attr( $option['value'] ); ?>"><input type="radio" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $options['footer_use_logo_image'], $option['value'] ); ?> name="dp_options[footer_use_logo_image]"> <?php echo esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
			<?php endforeach; ?>
		</ul>
		<div id="footer-logo-text-area"<?php if ( 'type2' === $options['footer_use_logo_image'] ) { echo ' style="display: none;"'; } ?>>
    	<h4 class="theme_option_headline2"><?php _e( 'Font size for text logo', 'tcd-w' ); ?></h4>
    	<input class="tiny-text hankaku" type="number" min="1" name="dp_options[footer_logo_font_size]" value="<?php esc_attr_e( $options['footer_logo_font_size'] ); ?>"> <span>px</span>
    </div>
		<div id="footer-logo-image-area"<?php if ( 'type1' === $options['footer_use_logo_image'] ) { echo ' style="display: none;"'; } ?>>
   		<h4 class="theme_option_headline2"><?php _e( 'Image for logo', 'tcd-w' ); ?></h4>
    	<div class="image_box cf">
    		<div class="cf cf_media_field hide-if-no-js footer_logo_image">
    			<input type="hidden" value="<?php echo esc_attr( $options['footer_logo_image'] ); ?>" id="footer_logo_image" name="dp_options[footer_logo_image]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $options['footer_logo_image'] ) { echo wp_get_attachment_image( $options['footer_logo_image'], 'full' ); } ?></div>
      		<div class="button_area">
      	 		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      	 		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['footer_logo_image'] ) { echo 'hidden'; } ?>">
      		</div>
				</div>
    	</div>
    	<p><label><input name="dp_options[footer_logo_image_retina]" type="checkbox" value="1" <?php checked( 1, $options['footer_logo_image_retina'] ); ?>><?php _e( 'Use retina display logo image', 'tcd-w' ); ?></label></p>
		</div>
   	<input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
</div><!-- END #tab-content2 -->
<?php
}

function add_logo_theme_options_validate( $input ) {

	global $use_logo_image_options;

 	// ヘッダーのロゴ
 	if ( ! isset( $input['header_use_logo_image'] ) ) $input['header_use_logo_image'] = null;
 	if ( ! array_key_exists( $input['header_use_logo_image'], $use_logo_image_options ) ) $input['header_use_logo_image'] = null;
 	$input['header_logo_font_size'] = wp_filter_nohtml_kses( $input['header_logo_font_size'] );
 	$input['header_logo_image'] = wp_filter_nohtml_kses( $input['header_logo_image'] );
 	if ( ! isset( $input['header_logo_image_retina'] ) ) $input['header_logo_image_retina'] = null;
  $input['header_logo_image_retina'] = ( $input['header_logo_image_retina'] == 1 ? 1 : 0 );

	// フッターのロゴ
 	if ( ! isset( $input['footer_use_logo_image'] ) ) $input['footer_use_logo_image'] = null;
 	if ( ! array_key_exists( $input['footer_use_logo_image'], $use_logo_image_options ) ) $input['footer_use_logo_image'] = null;
 	$input['footer_logo_font_size'] = wp_filter_nohtml_kses( $input['footer_logo_font_size'] );
 	$input['footer_logo_image'] = wp_filter_nohtml_kses( $input['footer_logo_image'] );
 	if ( ! isset( $input['footer_logo_image_retina'] ) ) $input['footer_logo_image_retina'] = null;
  $input['footer_logo_image_retina'] = ( $input['footer_logo_image_retina'] == 1 ? 1 : 0 );

	return $input;

}
