<?php 
/**
 * footer
 */

// デフォルト変数を追加
add_filter( 'before_getting_design_plus_option', 'add_footer_dp_default_options' );

// タブパネルのラベルを追加
add_action( 'tcd_tab_labels', 'add_footer_tab_label' );

// タブパネルの HTML を追加
add_action( 'tcd_tab_panel', 'add_footer_tab_panel' );

// サニタイズ処理を追加
add_filter( 'theme_options_validate', 'add_footer_theme_options_validate' );

// フッターの固定メニュー 表示タイプ
global $footer_bar_display_options;
$footer_bar_display_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Fade In', 'tcd-w' ) ),
	'type2' => array( 'value' => 'type2', 'label' => __( 'Slide In', 'tcd-w' ) ),
	'type3' => array( 'value' => 'type3', 'label' => __( 'Hide', 'tcd-w' ) )
);

// フッターバーボタンのタイプ
global $footer_bar_button_options;
$footer_bar_button_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Default', 'tcd-w' ) ),
 	'type2' => array( 'value' => 'type2', 'label' => __( 'Share', 'tcd-w' ) ),
 	'type3' => array( 'value' => 'type3', 'label' => __( 'Telephone', 'tcd-w' ) )
);

// フッターバーボタンのアイコン
global $footer_bar_icon_options;
$footer_bar_icon_options = array(
	'file-text' => array( 
		'value' => 'file-text', 
		'label' => __( 'Document', 'tcd-w' )
	),
	'share-alt' => array( 
		'value' => 'share-alt', 
		'label' => __( 'Share', 'tcd-w' )
	),
	'phone' => array( 
		'value' => 'phone', 
		'label' => __( 'Telephone', 'tcd-w' )
	),
	'envelope' => array( 
		'value' => 'envelope', 
		'label' => __( 'Envelope', 'tcd-w' )
	),
	'tag' => array( 
		'value' => 'tag', 
		'label' => __( 'Tag', 'tcd-w' )
	),
	'pencil' => array( 
		'value' => 'pencil', 
		'label' => __( 'Pencil', 'tcd-w' )
	)
);

function add_footer_dp_default_options( $dp_default_options ) {

	// 背景色の設定
	$dp_default_options['footer_bg_upper'] = '#f6f6f6';
	$dp_default_options['footer_bg_upper_mobile'] = '#ffffff';
	$dp_default_options['footer_bg_lower'] = '#eee';
	$dp_default_options['footer_bg_lower_mobile'] = '#f6f6f6';

	// SNSボタンの設定
	$dp_default_options['twitter_url'] = '';
	$dp_default_options['facebook_url'] = '';
	$dp_default_options['insta_url'] = '';
	$dp_default_options['show_rss'] = 1;

	// フッターに表示する会社情報
	$dp_default_options['footer_company_address'] = '';

	// 資料請求ボタンの設定
	$dp_default_options['display_request'] = '';
	$dp_default_options['hide_request_on_front'] = '';
	$dp_default_options['request_bg'] = '#000000';
	$dp_default_options['request_catch'] = '';
	$dp_default_options['request_catch_color'] = '#ffffff';
	$dp_default_options['request_btn_url'] = '';
	$dp_default_options['request_btn_label'] = '';
	$dp_default_options['request_btn_label_color'] = '#ffffff';
	$dp_default_options['request_btn_bg'] = '#004353';
	$dp_default_options['request_btn_bg_hover'] = '#666666';

	// スマホ用固定フッターバーの設定
	$dp_default_options['footer_bar_display'] = 'type3';
	$dp_default_options['footer_bar_tp'] = 0.8;
	$dp_default_options['footer_bar_bg'] = '#ffffff';
	$dp_default_options['footer_bar_border'] = '#dddddd';
	$dp_default_options['footer_bar_color'] = '#000000';
	$dp_default_options['footer_bar_btns'] = array(
		array(
			'type' => 'type1',
			'label' => '',
			'url' => '',
			'number' => '',
			'target' => 0,
			'icon' => 'file-text'
		)
	);

	return $dp_default_options;

}

function add_footer_tab_label( $tab_labels ) {
	$tab_labels[] = __( 'Footer', 'tcd-w' );
	return $tab_labels;
}

function add_footer_tab_panel( $options ) {

	global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options;
?>
<div id="tab-content8">
	<?php // 背景色の設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Background color setting', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'The upper part of the footer', 'tcd-w' ); ?></h4>
		<input type="text" class="c-color-picker" name="dp_options[footer_bg_upper]" value="<?php echo esc_attr( $options['footer_bg_upper'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_bg_upper'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'The lower part of the footer', 'tcd-w' ); ?></h4>
		<input type="text" class="c-color-picker" name="dp_options[footer_bg_lower]" value="<?php echo esc_attr( $options['footer_bg_lower'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_bg_lower'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'The upper part of the footer', 'tcd-w' ); ?><?php _e( '(mobile)', 'tcd-w' ); ?></h4>
		<input type="text" class="c-color-picker" name="dp_options[footer_bg_upper_mobile]" value="<?php echo esc_attr( $options['footer_bg_upper_mobile'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_bg_upper_mobile'] ); ?>">
  	<h4 class="theme_option_headline2"><?php _e( 'The lower part of the footer', 'tcd-w' ); ?><?php _e( '(mobile)', 'tcd-w' ); ?></h4>
		<input type="text" class="c-color-picker" name="dp_options[footer_bg_lower_mobile]" value="<?php echo esc_attr( $options['footer_bg_lower_mobile'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['footer_bg_lower_mobile'] ); ?>">
  	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // SNSボタンの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'SNS button setting', 'tcd-w' ); ?></h3>
  	<p><?php _e( 'Enter URL of your SNS pages. If it is blank SNS button will not be shown.', 'tcd-w' ); ?></p>
  	<ul>
  		<li><label><?php _e( 'your Twitter URL', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[twitter_url]" value="<?php esc_attr_e( $options['twitter_url'] ); ?>"></label></li>
  		<li><label><?php _e( 'your Facebook URL', 'tcd-w' ); ?> <input id="dp_options[facebook_url]" class="regular-text" type="text" name="dp_options[facebook_url]" value="<?php esc_attr_e( $options['facebook_url'] ); ?>"></label></li>
  		<li><label style="display:inline-block; min-width:140px;"><?php _e( 'your instagram URL', 'tcd-w' ); ?> <input id="dp_options[insta_url]" class="regular-text" type="text" name="dp_options[insta_url]" value="<?php esc_attr_e( $options['insta_url'] ); ?>"></label></li>
		</ul>
 		<hr>
  	<p><label><input id="dp_options[show_rss]" name="dp_options[show_rss]" type="checkbox" value="1" <?php checked( '1', $options['show_rss'] ); ?>><?php _e( 'Display RSS button', 'tcd-w' ); ?></label></p>
  	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // フッターに表示する会社情報 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Company information on footer', 'tcd-w' ); ?></h3>
  	<ul>
  		<li>
				<p><?php _e( 'Phone number, Address, and miscs', 'tcd-w' ); ?></p>
				<textarea rows="4" id="dp_options[footer_company_address]" class="large-text" name="dp_options[footer_company_address]"><?php echo esc_textarea( $options['footer_company_address'] ); ?></textarea>
			</li>
  	</ul>
  	<input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
	<?php // 資料請求ボタンの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Footer sticky ad settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Display settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'Note: when the footer sticky ad is displayed, the footer bar is hidden.', 'tcd-w' ); ?></p>
		<p><label><input type="checkbox" name="dp_options[display_request]" value="1" <?php checked( 1, $options['display_request'] ); ?>> <?php _e( 'Display the footer sticky ad', 'tcd-w' ); ?></p>
		<p><label><input type="checkbox" name="dp_options[hide_request_on_front]" value="1" <?php checked( 1, $options['hide_request_on_front'] ); ?>> <?php _e( 'Hide the footer sticky ad on front page', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
		<input type="text" name="dp_options[request_bg]" value="<?php echo esc_attr( $options['request_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['request_bg'] ); ?>" class="c-color-picker">
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
		<textarea class="large-text" name="dp_options[request_catch]"><?php echo esc_textarea( $options['request_catch'] ); ?></textarea>
		<p><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[request_catch_color]" value="<?php echo esc_attr( $options['request_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['request_catch_color'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Button settings', 'tcd-w' ); ?></h4>
		<p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" name="dp_options[request_btn_url]" value="<?php echo esc_attr( $options['request_btn_url'] ); ?>" class="regular-text"></label></p>
		<p><label><?php _e( 'Label', 'tcd-w' ); ?> <input type="text" name="dp_options[request_btn_label]" value="<?php echo esc_attr( $options['request_btn_label'] ); ?>" class="regular-text"></label></p>
		<p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" name="dp_options[request_btn_label_color]" value="<?php echo esc_attr( $options['request_btn_label_color'] ); ?>" class="c-color-picker" data-default-color="<?php echo esc_attr( $dp_default_options['request_btn_label_color'] ); ?>"></label></p>
		<p><label><?php _e( 'Background color', 'tcd-w' ); ?> <input type="text" name="dp_options[request_btn_bg]" value="<?php echo esc_attr( $options['request_btn_bg'] ); ?>" class="c-color-picker" data-default-color="<?php echo esc_attr( $dp_default_options['request_btn_bg'] ); ?>"></label></p>
		<p><label><?php _e( 'Background color on hover', 'tcd-w' ); ?> <input type="text" name="dp_options[request_btn_bg_hover]" value="<?php echo esc_attr( $options['request_btn_bg_hover'] ); ?>" class="c-color-picker" data-default-color="<?php echo esc_attr( $dp_default_options['request_btn_bg_hover'] ); ?>"></label></p>
  	<input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // フッターバーの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Setting of the footer bar for smart phone', 'tcd-w' ); ?></h3>
		<p><?php _e( 'Please set the footer bar which is displayed with smart phone.', 'tcd-w' ); ?>
		<p><?php _e( 'Note: The footer bar is not displayed when the footer sticky ad is displayed.', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Display type of the footer bar', 'tcd-w' ); ?></h4>
    <fieldset class="cf select_type2">
     <?php foreach ( $footer_bar_display_options as $option ) : ?>
     <label class="description"><input type="radio" name="dp_options[footer_bar_display]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $options['footer_bar_display'], $option['value'] ); ?>><?php echo esc_html_e( $option['label'], 'tcd-w' ); ?></label>
     <?php endforeach; ?>
    </fieldset>
    <h4 class="theme_option_headline2"><?php _e( 'Settings for the appearance of the footer bar', 'tcd-w' ); ?></h4>
    <p>
     	<?php _e( 'Background color', 'tcd-w' ); ?>
			<input type="text" name="dp_options[footer_bar_bg]" value="<?php echo esc_attr( $options['footer_bar_bg'] ); ?>" data-default-color="#ffffff" class="c-color-picker">
		</p>
    <p>
    	<?php _e( 'Border color', 'tcd-w' ); ?>
			<input type="text" name="dp_options[footer_bar_border]" value="<?php echo esc_attr( $options['footer_bar_border'] ); ?>" data-default-color="#dddddd" class="c-color-picker">
		</p>
    <p>
     	<?php _e( 'Font color', 'tcd-w' ); ?>
			<input type="text" name="dp_options[footer_bar_color]" value="<?php echo esc_attr( $options['footer_bar_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
		</p>
		<p>
     	<?php _e( 'Opacity of background', 'tcd-w' ); ?>
     	<input class="tiny-text hankaku" type="number" min="0" max="1" step="0.1" name="dp_options[footer_bar_tp]" value="<?php echo esc_attr( $options['footer_bar_tp'] ); ?>"><br><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.8)', 'tcd-w' ); ?>
		</p>
    <h4 class="theme_option_headline2"><?php _e('Settings for the contents of the footer bar', 'tcd-w'); ?></h4>
   	<p><?php _e( 'You can display the button with icon in footer bar. (We recommend you to set max 4 buttons.)', 'tcd-w' ); ?><br><?php _e( 'You can select button types below.', 'tcd-w' ); ?></p>
		<table class="table-border">
			<tr>
				<th><?php _e( 'Default', 'tcd-w' ); ?></th>
				<td><?php _e( 'You can set link URL.', 'tcd-w' ); ?></td>
			</tr>
			<tr>
				<th><?php _e( 'Share', 'tcd-w' ); ?></th>
				<td><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-w' ); ?></td>
			</tr>
			<tr>
				<th><?php _e( 'Telephone', 'tcd-w' ); ?></th>
				<td><?php _e( 'You can call this number.', 'tcd-w' ); ?></td>
			</tr>
		</table>
		<p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-w' ); ?></p>
		<div class="repeater-wrapper">
			<div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
				<?php 
				if ( $options['footer_bar_btns'] ) :
					foreach ( $options['footer_bar_btns'] as $key => $value ) :  
				?>
				<div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
     			<h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
					<div class="sub_box_content">
    				<p class="footer-bar-target" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><label><input name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>><?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
    				<table class="table-repeater">
     					<tr class="footer-bar-type">
								<th><label><?php _e( 'Button type', 'tcd-w' ); ?></label></th>
								<td>
									<select name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
										<?php foreach( $footer_bar_button_options as $option ) : ?>
										<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
     					<tr>
								<th><label for="dp_options[repeater_footer_bar_btn<?php echo esc_attr( $key ); ?>_label]"><?php _e( 'Button label', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]" class="regular-text repeater-label" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></td>
							</tr>
							<tr class="footer-bar-url" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>">
								<th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]"><?php _e( 'Link URL', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]" class="regular-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></td>
							</tr>
     					<tr class="footer-bar-number" style="<?php if ( $value['type'] !== 'type3' ) { echo 'display: none;'; } ?>">
								<th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]"><?php _e( 'Phone number', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]" class="regular-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>"></td>
							</tr>
     					<tr>
								<th><?php _e( 'Button icon', 'tcd-w' ); ?></th>
								<td>
									<?php foreach( $footer_bar_icon_options as $option ) : ?>
									<p><label><input type="radio" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr( $option['value'] ); ?>"></span><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
									<?php endforeach; ?>
								</td>
							</tr>
						</table>
       			<p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
					</div>
				</div>
				<?php
					endforeach;
				endif;
				?>
				<?php
    		$key = 'addindex';
    		ob_start();
				?>
				<div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
     			<h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
					<div class="sub_box_content">
    				<p class="footer-bar-target"><label><input name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1"><?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
    				<table class="table-repeater">
     					<tr class="footer-bar-type">
								<th><label><?php _e( 'Button type', 'tcd-w' ); ?></label></th>
								<td>
									<select name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
										<?php foreach( $footer_bar_button_options as $option ) : ?>
										<option value="<?php echo esc_attr( $option['value'] ); ?>"><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
     					<tr>
								<th><label for="dp_options[repeater_footer_bar_btn<?php echo esc_attr( $key ); ?>_label]"><?php _e( 'Button label', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]" class="regular-text repeater-label" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></td>
							</tr>
							<tr class="footer-bar-url">
								<th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]"><?php _e( 'Link URL', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]" class="regular-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value=""></td>
							</tr>
     					<tr class="footer-bar-number" style="display: none;">
								<th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]"><?php _e( 'Phone number', 'tcd-w' ); ?></label></th>
								<td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]" class="regular-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value=""></td>
							</tr>
     					<tr>
								<th><?php _e( 'Button icon', 'tcd-w' ); ?></th>
								<td>
									<?php foreach( $footer_bar_icon_options as $option ) : ?>
									<p><label><input type="radio" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr( $option['value'] ); ?>"<?php if ( 'file-text' == $option['value'] ) { echo ' checked="checked"'; } ?>><span class="icon icon-<?php echo esc_attr( $option['value'] ); ?>"></span><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
									<?php endforeach; ?>
								</td>
							</tr>
						</table>
       			<p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
					</div>
				</div>
				<?php $clone = ob_get_clean(); ?>
			</div>
			<a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
		</div>
		<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>"> 
	</div>
</div><!-- END #tab-content8 -->
<?php
}

function add_footer_theme_options_validate( $input ) {

	global $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options;

	// 背景色の設定
	$input['footer_bg_upper'] = wp_filter_nohtml_kses( $input['footer_bg_upper'] );
	$input['footer_bg_upper_mobile'] = wp_filter_nohtml_kses( $input['footer_bg_upper_mobile'] );
	$input['footer_bg_lower'] = wp_filter_nohtml_kses( $input['footer_bg_lower'] );
	$input['footer_bg_lower_mobile'] = wp_filter_nohtml_kses( $input['footer_bg_lower_mobile'] );

	// SNSボタンの設定
	$input['twitter_url'] = wp_filter_nohtml_kses( $input['twitter_url'] );
 	$input['facebook_url'] = wp_filter_nohtml_kses( $input['facebook_url'] );
 	$input['insta_url'] = wp_filter_nohtml_kses( $input['insta_url'] );
 	if ( ! isset( $input['show_rss'] ) ) $input['show_rss'] = null;
  $input['show_rss'] = ( $input['show_rss'] == 1 ? 1 : 0 );
		
	// フッターに表示する会社情報
	$input['footer_company_address'] = wp_filter_nohtml_kses( $input['footer_company_address'] );

	// 資料請求ボタンの設定
 	if ( ! isset( $input['display_request'] ) ) $input['display_request'] = null;
  $input['display_request'] = ( $input['display_request'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['hide_request_on_front'] ) ) $input['hide_request_on_front'] = null;
  $input['hide_request_on_front'] = ( $input['hide_request_on_front'] == 1 ? 1 : 0 );
	$input['request_bg'] = wp_filter_nohtml_kses( $input['request_bg'] );
	$input['request_catch'] = wp_filter_nohtml_kses( $input['request_catch'] );
	$input['request_catch_color'] = wp_filter_nohtml_kses( $input['request_catch_color'] );
	$input['request_btn_url'] = wp_filter_nohtml_kses( $input['request_btn_url'] );
	$input['request_btn_label'] = wp_filter_nohtml_kses( $input['request_btn_label'] );
	$input['request_btn_label_color'] = wp_filter_nohtml_kses( $input['request_btn_label_color'] );
	$input['request_btn_bg'] = wp_filter_nohtml_kses( $input['request_btn_bg'] );
	$input['request_btn_bg_hover'] = wp_filter_nohtml_kses( $input['request_btn_bg_hover'] );

	// スマホ用固定フッターバーの設定
 	if ( ! array_key_exists( $input['footer_bar_display'], $footer_bar_display_options ) ) $input['footer_bar_display'] = 'type3';
 	$input['footer_bar_bg'] = wp_filter_nohtml_kses( $input['footer_bar_bg'] );
 	$input['footer_bar_border'] = wp_filter_nohtml_kses( $input['footer_bar_border'] );
 	$input['footer_bar_color'] = wp_filter_nohtml_kses( $input['footer_bar_color'] );
 	$input['footer_bar_tp'] = wp_filter_nohtml_kses( $input['footer_bar_tp'] );
 	$footer_bar_btns = array();
	if ( isset( $input['repeater_footer_bar_btns'] ) ) {
		foreach ( $input['repeater_footer_bar_btns'] as $key => $value ) {
  	 		$footer_bar_btns[] = array(
				'type' => ( isset( $input['repeater_footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['repeater_footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['repeater_footer_bar_btns'][$key]['type'] : 'type1',
				'label' => isset( $input['repeater_footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['label'] ) : '',
				'url' => isset( $input['repeater_footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['url'] ) : '',
				'number' => isset( $input['repeater_footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['number'] ) : '',
  	  			'target' => ! empty( $input['repeater_footer_bar_btns'][$key]['target'] ) ? 1 : 0,
  	  			'icon' => ( isset( $input['repeater_footer_bar_btns'][$key]['icon'] ) && array_key_exists( $input['repeater_footer_bar_btns'][$key]['icon'], $footer_bar_icon_options ) ) ? $input['repeater_footer_bar_btns'][$key]['icon'] : 'file-text'
			);
			
		}
	}

 	$input['footer_bar_btns'] = $footer_bar_btns;
	
	return $input;

}
