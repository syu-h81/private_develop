<?php
/**
 * ページビルダーウィジェット登録
 */
add_page_builder_widget( array(
	'id' => 'pb-widget-main-image',
	'form' => 'form_page_builder_widget_main_image',
	'form_rightbar' => 'form_rightbar_page_builder_widget_main_image',
	'display' => 'display_page_builder_widget_main_image',
	'title' => __( 'Main image', 'tcd-w' ),
	'priority' => 11,
) );

/**
 * フォーム
 */
function form_page_builder_widget_main_image( $values = array() ) {

	// デフォルト値
	$default_values = apply_filters( 'page_builder_widget_main_image_default_values', array(
		'widget_index' => '',
		'layout' => 'type1',
		'headline' => '',
		'headline_font_size' => 40,
		'desc' => '',
		'desc_font_size' => 14,
		'color' => '#ffffff',
		'display_btn' => null,
		'btn_label' => '',
		'btn_url' => '',
		'btn_target' => '',
		'btn_bg' => '#222222',
		'btn_bg_hover' => '#004353',
		'overlay' => '#222222',
		'opacity' => 0.5,
		'size' => 'type1',
		'bg_image' => ''
	), 'form' );

	// デフォルト値に入力値をマージ
	$values = array_merge( $default_values, (array) $values );
?>

<div class="form-field">
	<h4><?php _e( 'Layout', 'tcd-w' ); ?></h4>
	<?php
	$layout_options = array(
		'type1' => __( 'Type1 (display text contents on the left side)', 'tcd-w' ),
		'type2' => __( 'Type2 (display text contents on the right side)', 'tcd-w' )
	);
	$layout_html = array();
	foreach( $layout_options as $key => $value ) {
		$attr = $values['layout'] === $key ? ' checked="checked"' : '';
		$layout_html[] = '<label><input type="radio" name="pagebuilder[widget]['.esc_attr( $values['widget_index'] ) . '][layout]" value="' . esc_attr( $key ) . '"' . $attr . '>' . esc_html( $value ) . '</label>';
	}
	echo implode( "<br>\n\t", $layout_html );
	?>
</div>

<div class="form-field">
	<h4><?php _e( 'Headline', 'tcd-w' ); ?></h4>
	<textarea name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][headline]" class="large-text pb-input-overview"><?php echo esc_textarea( $values['headline'] ); ?></textarea>
	<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index']); ?>][headline_font_size]" value="<?php echo esc_attr( $values['headline_font_size']); ?>" class="pb-input-narrow hankaku"> px</label></p>
</div>

<div class="form-field">
	<h4><?php _e( 'Description', 'tcd-w' ); ?></h4>
	<textarea name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][desc]" class="large-text"><?php echo esc_textarea( $values['desc'] ); ?></textarea>
	<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index']); ?>][desc_font_size]" value="<?php echo esc_attr( $values['desc_font_size']); ?>" class="pb-input-narrow hankaku"> px</label></p>
</div>

<div class="form-field">
	<h4><?php _e( 'Font color', 'tcd-w' ); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][color]" value="<?php echo esc_attr( $values['color'] ); ?>" class="pb-input-narrow pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_values['color'] ); ?>">
</div>

<div class="form-field">
	<h4><?php _e( 'Button settings', 'tcd-w' ); ?></h4>
	<p><label><?php _e( 'Display button', 'tcd-w' ); ?> <input type="checkbox" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][display_btn]" value="1" <?php checked( 1, $values['display_btn'] ); ?>></label></p>
	<p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][btn_label]" value="<?php echo esc_attr( $values['btn_label'] ); ?>"></label></p>
	<p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][btn_url]" value="<?php echo esc_attr( $values['btn_url'] ); ?>"></label></p>
	<p><label><input type="checkbox" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][btn_target]" value="1" <?php checked( 1, $values['btn_target'] ); ?>> <?php _e( 'Open a URL in a new window', 'tcd-w' ); ?></label></p>
	<div><?php _e( 'Background color', 'tcd-w' ); ?> <input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][btn_bg]" value="<?php echo esc_attr( $values['btn_bg'] ); ?>" class="pb-input-narrow pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_values['btn_bg'] ); ?>"></div>
	<div><?php _e( 'Background color on hover', 'tcd-w' ); ?> <input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][btn_bg_hover]" value="<?php echo esc_attr( $values['btn_bg_hover'] ); ?>" class="pb-input-narrow pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_values['btn_bg_hover'] ); ?>"></div>
</div>

<div class="form-field">
	<h4><?php _e( 'Background color of text contents', 'tcd-w' ); ?></h4>
	<div><input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][overlay]" value="<?php echo esc_attr( $values['overlay'] ); ?>" class="pb-input-narrow pb-wp-color-picker" data-default-color="<?php echo esc_attr( $default_values['overlay'] ); ?>"></div>
	<p><label><?php _e( 'Opacity', 'tcd-w' ); ?> <input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index']); ?>][opacity]" value="<?php echo esc_attr( $values['opacity']); ?>" class="pb-input-narrow hankaku"></label></p>
	<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ); ?></p>
</div>

<div class="form-field">
	<h4><?php _e( 'Background image', 'tcd-w' ); ?></h4>
	<p><?php _e( 'Please select the size of background image', 'tcd-w' ); ?></p>
	<?php
	$size_options = array(
		'type1' => __( 'Full width(Recommended size: width:1450px, height:600px)', 'tcd-w' ),
		'type2' => __( '50%(Recommended size: width:725px, height:600px)', 'tcd-w' )
	);
	$size_html = array();
	foreach( $size_options as $key => $value ) {
		$attr = $values['size'] === $key ? ' checked="checked"' : '';
		$size_html[] = '<label><input type="radio" name="pagebuilder[widget]['.esc_attr( $values['widget_index'] ) . '][size]" value="' . esc_attr( $key ) . '"' . $attr . '>' . esc_html( $value ) . '</label>';
	}
	echo implode( "<br>\n\t", $size_html );
	$input_name = 'pagebuilder[widget]['. $values['widget_index'] . '][bg_image]';
	$media_id = $values['bg_image'];
	pb_media_form( $input_name, $media_id );
	?>
</div>

<?php
}

/**
 * フォーム 右サイドバー
 */
function form_rightbar_page_builder_widget_main_image( $values = array() ) {
	// デフォルト値
	$default_values = apply_filters( 'page_builder_widget_main_image_default_values', array(
		'widget_index' => '',
		'margin_bottom' => 30,
		'margin_bottom_mobile' => 30
	), 'form_rightbar' );

	// デフォルト値に入力値をマージ
	$values = array_merge( $default_values, (array) $values );
?>

<h3><?php _e( 'Margin setting', 'tcd-w' ); ?></h3>
<div class="form-field">
	<label><?php _e( 'Margin bottom', 'tcd-w' ); ?></label>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][margin_bottom]" value="<?php echo esc_attr( $values['margin_bottom'] ); ?>" class="pb-input-narrow hankaku"> px
	<p class="pb-description"><?php _e( 'Space below the content.<br />Default is 30px.', 'tcd-w' ); ?></p>
</div>
<div class="form-field">
	<label><?php _e( 'Margin bottom for mobile', 'tcd-w' ); ?></label>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr( $values['widget_index'] ); ?>][margin_bottom_mobile]" value="<?php echo esc_attr( $values['margin_bottom_mobile'] ); ?>" class="pb-input-narrow hankaku"> px
	<p class="pb-description"><?php _e( 'Space below the content.<br />Default is 30px.', 'tcd-w' ); ?></p>
</div>
<?php
}

/**
 * フロント出力
 */
function display_page_builder_widget_main_image( $values = array(), $widget_index ) {

	if ( empty($values['bg_image']) ) return;

	$hex_overlay = implode( ',', hex2rgb( $values['overlay'] ) );
?>
<div class="p-main-image<?php if ( 'type1' === $values['layout'] ) { echo ' p-main-image--rev'; } ?> pb-main-image<?php echo esc_attr( $widget_index ); ?>">
	<div class="p-main-image__img<?php if ( 'type2' === $values['size'] ) { echo ' p-main-image__img--narrow'; } ?>" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url( $values['bg_image'] ) ); ?>);"></div>
	<div class="p-main-image__content" style="background: rgba(<?php echo esc_attr( $hex_overlay . ', ' . $values['opacity'] ); ?>); color: <?php echo esc_attr( $values['color'] ); ?>">
		<h2 class="p-main-image__title" style="font-size: <?php echo esc_attr( $values['headline_font_size'] ); ?>px;"><?php echo nl2br( esc_html( $values['headline'] ) ); ?></h2>
		<p class="p-main-image__desc" style="font-size: <?php echo esc_attr( $values['desc_font_size'] ); ?>px;"><?php echo nl2br( esc_html( $values['desc'] ) ); ?></p>
		<?php if ( isset( $values['display_btn'] ) && $values['display_btn'] ) : ?>
		<a class="p-main-image__btn p-button" href="<?php echo esc_url( $values['btn_url'] ); ?>"<?php if ( isset( $values['btn_target'] ) ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $values['btn_label'] ); ?></a>
		<?php endif; ?>
	</div>
</div>
<?php
}

function page_builder_widget_main_image_css() {

	if ( is_singular() && is_page_builder() && page_builder_has_widget( 'pb-widget-main-image' ) ) {

		// 現記事で使用しているメインイメージコンテンツデータを取得
		$post_widgets = get_page_builder_post_widgets( get_the_ID(), 'pb-widget-main-image' );

		if ( $post_widgets ) {

			foreach ( $post_widgets as $post_widget ) {
				echo $post_widget['css_class'] . ' .p-button { background-color: '.esc_html( $post_widget['widget_value']['btn_bg'] ) . '; }' . "\n";
				echo $post_widget['css_class'] . ' .p-button:hover { background-color: ' . esc_html($post_widget['widget_value']['btn_bg_hover'] ) . '; }' . "\n";
			}

		}
	}
}
add_action( 'page_builder_css', 'page_builder_widget_main_image_css' );
