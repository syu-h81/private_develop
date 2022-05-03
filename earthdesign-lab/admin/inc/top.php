<?php
/**
 * top
 */
// デフォルト変数を追加
add_filter( 'before_getting_design_plus_option', 'add_top_dp_default_options' );

// タブパネルのラベルを追加
add_action( 'tcd_tab_labels', 'add_top_tab_label' );

// タブパネルの HTML を追加
add_action( 'tcd_tab_panel', 'add_top_tab_panel' );

// サニタイズ処理を追加
add_filter( 'theme_options_validate', 'add_top_theme_options_validate' );

// スプラッシュページの設定
global $splash_content_type_options;
$splash_content_type_options = array(
 	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Image', 'tcd-w' )
	),
 	'type2' => array( 
		'value' => 'type2',
		'label' => __( 'Text', 'tcd-w' ) 
	)
);
global $splash_desc_font_type_options;
$splash_desc_font_type_options = array(
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

global $splash_display_time_options;
for ( $i = 1; $i <= 5; $i++ ) {
	$splash_display_time_options[$i] = array( 'value' => $i, 'label' => $i );
}

// ヘッダーコンテンツの設定
global $hero_header_type_options;
$hero_header_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Image', 'tcd-w' ) 
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Video', 'tcd-w' )
	),
 	'type3' => array(
		'value' => 'type3',
		'label' => __( 'YouTube', 'tcd-w' )
	)
);

// メインイメージのレイアウト
global $cb_main_image_layout_options;
$cb_main_image_layout_options = array(
	'type1' => array( 
		'value' => 'type1', 
		'label' => __( 'Type1 (display text contents on the left side)', 'tcd-w' )
	),
	'type2' => array( 
		'value' => 'type2', 
		'label' => __( 'Type2 (display text contents on the right side)', 'tcd-w' )
	)
);

// メインイメージの画像サイズ
global $cb_main_image_size_options;
$cb_main_image_size_options = array(
	'type1' => array( 
		'value' => 'type1', 
		'label' => __( 'Full width(Recommended size: width:1450px, height:600px)', 'tcd-w' )
	),
	'type2' => array( 
		'value' => 'type2', 
		'label' => __( '50%(Recommended size: width:725px, height:600px)', 'tcd-w' )
	)
);

function add_top_dp_default_options( $dp_default_options ) {

	// スプラッシュページの設定
	$dp_default_options['display_splash'] = 0;
	$dp_default_options['display_splash_mobile'] = 0;

	for ( $i = 0; $i <= 1; $i++ ) {
		$dp_default_options['splash_content_type' . $i] = 'type1';
		$dp_default_options['splash_image' . $i] = '';
		$dp_default_options['splash_text' . $i] = '';
		$dp_default_options['splash_desc_font_type' . $i] = 'type1';
		$dp_default_options['splash_color' . $i] = '#ffffff';
		$dp_default_options['splash_font_size' . $i] = 34;
		$dp_default_options['splash_font_size_sp' . $i] = 34;
	}

	$dp_default_options['splash_bg'] = '#222222';
	$dp_default_options['splash_bg_opacity'] = 1;
	$dp_default_options['splash_bg_image'] = '';
	$dp_default_options['splash_display_time'] = 3;

	// ヘッダーコンテンツの設定
	for ( $i = 1; $i <= 4; $i++ ) {
		$dp_default_options['hero_header_type' . $i] = 'type1';
		$dp_default_options['hero_header_image' . $i] = '';
		$dp_default_options['hero_header_image_sp' . $i] = '';
		$dp_default_options['hero_header_url' . $i] = '';
		$dp_default_options['hero_header_catch' . $i] = '';
		$dp_default_options['hero_header_catch_font_size' . $i] = 30;
		$dp_default_options['hero_header_video' . $i] = '';
		$dp_default_options['hero_header_yt' . $i] = '';
	}
	$dp_default_options['hero_header_link_text'] = '';

	// コンテンツビルダー
	$dp_default_options['contents_builder'] = array();

	return $dp_default_options;

}

function add_top_tab_label( $tab_labels ) {
	$tab_labels[] = __( 'Index', 'tcd-w' );
	return $tab_labels;
}

function add_top_tab_panel( $options ) {

	global $dp_default_options, $splash_content_type_options, $splash_desc_font_type_options, $splash_display_time_options, $hero_header_type_options;
?>
<div id="tab-content3">
	<?php // スプラッシュページの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Splash page settings', 'tcd-w' ); ?></h3>
		<p><label><input type="checkbox" name="dp_options[display_splash]" value="1" <?php checked( 1, $options['display_splash'] ); ?>> <?php _e( 'Display splash page on PC', 'tcd-w' ); ?></label></p>
		<p><label><input type="checkbox" name="dp_options[display_splash_mobile]" value="1" <?php checked( 1, $options['display_splash_mobile'] ); ?>> <?php _e( 'Display splash page on mobile device', 'tcd-w' ); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Contents settings', 'tcd-w' ); ?></h4>
		<?php for ( $i = 0; $i <= 1; $i++ ) : ?>
		<div class="sub_box cf"> 
    	<h3 class="theme_option_subbox_headline"><?php if ( 0 === $i ) { _e( 'Upper part', 'tcd-w' ); } else { _e( 'Lower part', 'tcd-w' ); } ?></h3>
    	<div class="sub_box_content">
    		<h4 class="theme_option_headline2"><?php _e( 'Content type', 'tcd-w' ); ?></h4>
				<?php foreach ( $splash_content_type_options as $option ) : ?>
				<p class="splash_content_<?php echo esc_attr( $option['value'] ); ?>"><label><input type="radio" name="dp_options[splash_content_type<?php echo $i; ?>]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['splash_content_type' . $i] ); ?>> <?php echo esc_html( $option['label'] ); ?> </label></p>
				<?php endforeach; ?>
				<div class="splash-img"<?php if ( 'type2' === $options['splash_content_type' . $i] ) { echo ' style="display: none;"'; } ?>>
    			<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
    			<div class="image_box cf">
    				<div class="cf cf_media_field hide-if-no-js">
    					<input type="hidden" value="<?php echo esc_attr( $options['splash_image' . $i] ); ?>" id="splash_image<?php echo $i; ?>" name="dp_options[splash_image<?php echo $i; ?>]" class="cf_media_id">
    					<div class="preview_field"><?php if ( $options['splash_image' . $i] ) { echo wp_get_attachment_image( $options['splash_image' . $i], 'medium' ); } ?></div>
    					<div class="button_area">
    						<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    						<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['splash_image' . $i] ) { echo 'hidden'; } ?>">
    					</div>
    				</div>
    			</div>
				</div>
				<div class="splash-text"<?php if ( 'type1' === $options['splash_content_type' . $i] ) { echo ' style="display: none;"'; } ?>>
    			<h4 class="theme_option_headline2"><?php _e( 'Text', 'tcd-w' ); ?></h4>
					<textarea class="large-text" name="dp_options[splash_text<?php echo $i; ?>]"><?php echo esc_textarea( $options['splash_text' . $i] ); ?></textarea>
					<p><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[splash_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['splash_color' .$i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['splash_color' . $i] ); ?>"></p>
					<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" class="tiny-text" name="dp_options[splash_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $options['splash_font_size' . $i] ); ?>"> px</label></p>
					<p><label><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" min="1" class="tiny-text" name="dp_options[splash_font_size_sp<?php echo $i; ?>]" value="<?php echo esc_attr( $options['splash_font_size_sp' . $i] ); ?>"> px</label></p>
    			<h4 class="theme_option_headline2"><?php _e( 'Font type of catchphrase', 'tcd-w' ); ?></h4>
					<?php foreach ( $splash_desc_font_type_options as $option ) : ?>
					<p><label><input type="radio" name="dp_options[splash_desc_font_type<?php echo $i; ?>]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['splash_desc_font_type' . $i] ); ?>> <?php echo esc_html( $option['label'] ); ?></label></p>
					<?php endforeach; ?>
				</div>
				<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div><!-- .sub_box END -->
		<?php endfor; ?>	
    <h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
		<input type="text" class="c-color-picker" name="dp_options[splash_bg]" value="<?php echo esc_attr( $options['splash_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['splash_bg'] ); ?>">
		<p><?php _e( 'Opacity of background color', 'tcd-w' ); ?> <input type="number" min="0" max="1" step="0.1" name="dp_options[splash_bg_opacity]" value="<?php echo esc_attr( $options['splash_bg_opacity'] ); ?>">
		<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
    <div class="image_box cf">
    	<div class="cf cf_media_field hide-if-no-js">
    		<input type="hidden" value="<?php echo esc_attr( $options['splash_bg_image'] ); ?>" id="splash_bg_image" name="dp_options[splash_bg_image]" class="cf_media_id">
    		<div class="preview_field"><?php if ( $options['splash_bg_image'] ) { echo wp_get_attachment_image( $options['splash_bg_image'], 'medium' ); } ?></div>
    		<div class="button_area">
    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['splash_bg_image'] ) { echo 'hidden'; } ?>">
    		</div>
    	</div>
    </div>
    <h4 class="theme_option_headline2"><?php _e( 'Display time', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Setting the time to shift to the top page after completion of logo / catch phrase', 'tcd-w' ); ?></p>
		<select name="dp_options[splash_display_time]">
			<?php foreach ( $splash_display_time_options as $option ) : ?>
			<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['splash_display_time'] ); ?>><?php echo esc_html( $option['label'] ); ?><?php _e( ' seconds', 'tcd-w' ); ?></option>
			<?php endforeach; ?>
		</select>
		<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // ヘッダーコンテンツの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Hero header setting', 'tcd-w' ); ?></h3>
		<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
		<div class="sub_box cf"> 
    	<h3 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-w' ); ?><?php echo $i; ?></h3>
    	<div class="sub_box_content">
    		<h4 class="theme_option_headline2"><?php _e( 'Content type', 'tcd-w' ); ?></h4>
				<p><?php _e( 'On tablets and smartphones images are displayed regardless of the type of content', 'tcd-w' ); ?></p>
				<?php foreach ( $hero_header_type_options as $option ) : ?>
				<p><label><input type="radio" class="hero-header-<?php echo esc_attr( $option['value'] ); ?>" name="dp_options[hero_header_type<?php echo $i; ?>]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $options['hero_header_type' . $i], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
				<?php endforeach; ?>
    		<h4 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[hero_header_url<?php echo $i; ?>]" value="<?php echo esc_attr( $options['hero_header_url' . $i] ); ?>">
    		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[hero_header_catch<?php echo $i; ?>]" value="<?php echo esc_attr( $options['hero_header_catch' . $i] ); ?>">
				<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" class="tiny-text" name="dp_options[hero_header_catch_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $options['hero_header_catch_font_size' . $i] ); ?>"> px</label></p>
    		<h4 class="theme_option_headline2"><?php _e( 'Background image for tablet and mobile', 'tcd-w' ); ?></h4>
				<p><?php _e( 'Recommended size: width: 1450px or more, height: 815px or more', 'tcd-w' ); ?></p>
  		  <div class="image_box cf">
  		  	<div class="cf cf_media_field hide-if-no-js">
  		  		<input type="hidden" value="<?php echo esc_attr( $options['hero_header_image_sp' . $i] ); ?>" id="hero_header_image_sp<?php echo $i; ?>" name="dp_options[hero_header_image_sp<?php echo $i; ?>]" class="cf_media_id">
  		  		<div class="preview_field"><?php if ( $options['hero_header_image_sp' . $i] ) { echo wp_get_attachment_image( $options['hero_header_image_sp' . $i], 'medium' ); } ?></div>
  		  		<div class="button_area">
  		   			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  		   			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['hero_header_image_sp' . $i] ) { echo 'hidden'; } ?>">
  		  		</div>
  		  	</div>
				</div>
				<div class="hero-header-type1-content"<?php if ( 'type1' !== $options['hero_header_type' . $i] ) { echo ' style="display: none;"'; } ?>>
    			<h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
					<p><?php _e( 'Recommended size: width: 1450px or more, height: 815px or more', 'tcd-w' ); ?></p>
  		  	<div class="image_box cf">
  		   		<div class="cf cf_media_field hide-if-no-js">
  		    		<input type="hidden" value="<?php echo esc_attr( $options['hero_header_image' . $i] ); ?>" id="hero_header_image<?php echo $i; ?>" name="dp_options[hero_header_image<?php echo $i; ?>]" class="cf_media_id">
  		    		<div class="preview_field"><?php if ( $options['hero_header_image' . $i] ) { echo wp_get_attachment_image( $options['hero_header_image' . $i], 'medium' ); } ?></div>
  		    		<div class="button_area">
  		     			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  		     			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['hero_header_image' . $i] ) { echo 'hidden'; } ?>">
  		    		</div>
  		   		</div>
  		  	</div>
  		  </div>
				<div class="hero-header-type2-content"<?php if ( 'type2' !== $options['hero_header_type' . $i] ) { echo ' style="display: none;"'; } ?>>
					<h4 class="theme_option_headline2"><?php _e( 'Video file', 'tcd-w' ); ?></h4>
					<p><?php _e( 'Please upload MP4 format file.', 'tcd-w' ); ?></p>
					<div class="image_box cf">
						<div class="cf cf_media_field hide-if-no-js video">
							<input type="hidden" value="<?php echo esc_attr( $options['hero_header_video' . $i] ); ?>" id="hero_header_video<?php echo $i; ?>" name="dp_options[hero_header_video<?php echo $i; ?>]" class="cf_media_id">
							<div class="preview_field preview_field_video">
								<?php if ( $options['hero_header_video' . $i] ) : ?>
								<h5><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h5>
          			<p><?php echo esc_html( wp_get_attachment_url( $options['hero_header_video' . $i] ) ); ?></p>
								<?php endif; ?>
         			</div>
         			<div class="button_area">
          			<input type="button" value="<?php _e( 'Select MP4 file', 'tcd-w' ); ?>" class="cfmf-select-video button">
          			<input type="button" value="<?php _e( 'Remove MP4 file', 'tcd-w' ); ?>" class="cfmf-delete-video button <?php if ( ! $options['hero_header_video' . $i] ) { echo 'hidden'; }; ?>">
         			</div>
        		</div>
       		</div>
				</div>
				<div class="hero-header-type3-content"<?php if ( 'type3' !== $options['hero_header_type' . $i] ) { echo ' style="display: none;"'; } ?>>
					<h4 class="theme_option_headline2"><?php _e( 'YouTube video ID', 'tcd-w' ); ?></h4>
					<p><?php _e( 'Please enter video ID of YouTube.', 'tcd-w' ); ?></p>
					<p><input type="text" class="large-text" name="dp_options[hero_header_yt<?php echo $i; ?>]" value="<?php echo esc_attr( $options['hero_header_yt' . $i] ); ?>"></p>
				</div>
				<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
     	</div>
    </div>
		<?php endfor; ?>
		<h4 class="theme_option_headline2"><?php _e( 'Button label', 'tcd-w' ); ?></h4>
		<p><?php _e( 'Clicking this button scrolls the window to the top of contents builder.', 'tcd-w' ); ?><br><?php _e( 'This button is displayed at the right bottom of the hero header.', 'tcd-w' ); ?></p>
		<p><input type="text" class="regular-text" name="dp_options[hero_header_link_text]" value="<?php echo esc_attr( $options['hero_header_link_text'] ); ?>"></p>
		<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // コンテンツビルダー ?>
  <div class="theme_option_field cf index_cb_data">
  	<h3 class="theme_option_headline"><?php _e( 'Contents Builder', 'tcd-w' ); ?></h3>
    <div class="theme_option_message"><?php echo __( '<p>You can build contents freely with this function.</p><p>FIRST STEP: Click Add content button.<br />SECOND STEP: Select content from dropdown menu to show on each column.</p><p>You can change row by dragging MOVE button and you can delete row by clicking DELETE button.</p>', 'tcd-w' ); ?></div>
    <div id="contents_builder_wrap">
    	<div id="contents_builder" data-delete-confirm="<?php _e( 'Are you sure you want to delete this content?', 'tcd-w' ); ?>">
      <?php
      if ( ! empty( $options['contents_builder'] ) ) :
      	foreach( $options['contents_builder'] as $key => $content ) :
        	$cb_index = 'cb_' . $key;
      ?>
      <div class="cb_row one_column">
      	<ul class="cb_button cf">
        	<li><span class="cb_move"><?php echo __( 'Move', 'tcd-w' ); ?></span></li>
        	<li><span class="cb_delete"><?php echo __( 'Delete', 'tcd-w' ); ?></span></li>
       	</ul>
       	<div class="cb_column_area cf">
        	<div class="cb_column">
         		<input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>">
         		<input type="hidden" name="dp_options[contents_builder][<?php echo $cb_index; ?>][column]" value="one_column">
         		<?php the_cb_content_select( $cb_index, $content['cb_content_select'] ); ?>
         		<?php if ( ! empty( $content['cb_content_select'] ) ) the_cb_content_setting( $cb_index, $content['cb_content_select'], $content ); ?>
        </div>
       </div><!-- END .cb_column_area -->
      </div><!-- END .cb_row -->
      <?php
      	endforeach;
      endif;
      ?>
     </div><!-- END #contents_builder -->
     <div id="cb_add_row_buttton_area">
      <input type="button" value="<?php echo __( 'Add content', 'tcd-w' ); ?>" class="button-secondary add_row-one_column">
     </div>
     <p><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>
    </div><!-- END #contents_builder_wrap -->
   </div><!-- END .theme_option_field -->
   <?php // コンテンツビルダー追加用 非表示 ?>
   <div id="contents_builder-clone" class="hidden">
    <div class="cb_row one_column">
     <ul class="cb_button cf">
      <li><span class="cb_move"><?php echo __( 'Move', 'tcd-w' ); ?></span></li>
      <li><span class="cb_delete"><?php echo __( 'Delete', 'tcd-w' ); ?></span></li>
     </ul>
     <div class="cb_column_area cf">
      <div class="cb_column">
       <input type="hidden" class="cb_index" value="cb_cloneindex">
       <input type="hidden" name="dp_options[contents_builder][cb_cloneindex][column]" value="one_column">
       <?php the_cb_content_select( 'cb_cloneindex' ); ?>
      </div>
     </div><!-- END .cb_column_area -->
    </div><!-- END .cb_row -->
    <?php
    // キャッチフレーズと説明文
    the_cb_content_setting( 'cb_cloneindex', 'catch_and_desc' );

    // プランコンテンツ
    the_cb_content_setting( 'cb_cloneindex', 'plan' );

    // メインイメージ
    the_cb_content_setting( 'cb_cloneindex', 'main_image' );

    // ブログ・ニュース
    the_cb_content_setting( 'cb_cloneindex', 'blog_and_news' );

    // ギャラリーコンテンツ
    the_cb_content_setting( 'cb_cloneindex', 'gallery_contents' );

    // フリースペース
    the_cb_content_setting( 'cb_cloneindex', 'wysiwyg' );
    ?>
	</div><!-- END #contents_builder-clone.hidden -->
  <?php // コンテンツビルダーここまで ---------------------------------------------------------------- ?>	
</div><!-- END #tab-content3 -->
<?php
}

function add_top_theme_options_validate( $input ) {

	global $splash_content_type_options, $splash_desc_font_type_options, $splash_display_time_options, $hero_header_type_options, $cb_main_image_layout_options, $cb_main_image_size_options;

	// スプラッシュページの設定
	if ( ! isset( $input['display_splash'] ) ) $input['display_splash'] = null;
	$input['display_splash'] = ( $input['display_splash'] == 1 ? 1 : 0 );
	if ( ! isset( $input['display_splash_mobile'] ) ) $input['display_splash_mobile'] = null;
	$input['display_splash_mobile'] = ( $input['display_splash_mobile'] == 1 ? 1 : 0 );

	for ( $i = 0; $i <= 1; $i++ ) {
 		if ( ! isset( $input['splash_content_type' . $i] ) ) $input['splash_content_type' . $i] = null;
 		if ( ! array_key_exists( $input['splash_content_type' . $i], $splash_content_type_options ) ) $input['splash_content_type' . $i] = null;
		$input['splash_image' . $i] = wp_filter_nohtml_kses( $input['splash_image' . $i] );
		$input['splash_text' . $i] = wp_filter_nohtml_kses( $input['splash_text' . $i] );
		$input['splash_color' . $i] = wp_filter_nohtml_kses( $input['splash_color' . $i] );
		$input['splash_font_size' . $i] = wp_filter_nohtml_kses( $input['splash_font_size' . $i] );
		$input['splash_font_size_sp' . $i] = wp_filter_nohtml_kses( $input['splash_font_size_sp' . $i] );
 		if ( ! isset( $input['splash_desc_font_type' . $i] ) ) $input['splash_desc_font_type' . $i] = null;
 		if ( ! array_key_exists( $input['splash_desc_font_type' . $i], $splash_desc_font_type_options ) ) $input['splash_desc_font_type' . $i] = null;
	}

	$input['splash_bg'] = wp_filter_nohtml_kses( $input['splash_bg'] );
	$input['splash_bg_opacity'] = wp_filter_nohtml_kses( $input['splash_bg_opacity'] );
	$input['splash_bg_image'] = wp_filter_nohtml_kses( $input['splash_bg_image'] );
 	if ( ! isset( $input['splash_display_time'] ) ) $input['splash_display_time'] = null;
 	if ( ! array_key_exists( $input['splash_display_time'], $splash_display_time_options ) ) $input['splash_display_time'] = null;

	// ヘッダーコンテンツの設定
	for ( $i = 1; $i <= 4; $i++ ) {
 		if ( ! isset( $input['hero_header_type' . $i] ) ) $input['hero_header_type' . $i] = null;
 		if ( ! array_key_exists( $input['hero_header_type' . $i], $hero_header_type_options ) ) $input['hero_header_type' . $i] = null;
		$input['hero_header_url' . $i] = wp_filter_nohtml_kses( $input['hero_header_url' . $i] );
		$input['hero_header_catch' . $i] = wp_filter_nohtml_kses( $input['hero_header_catch' . $i] );
		$input['hero_header_catch_font_size' . $i] = wp_filter_nohtml_kses( $input['hero_header_catch_font_size' . $i] );
		$input['hero_header_image_sp' . $i] = wp_filter_nohtml_kses( $input['hero_header_image_sp' . $i] );
		$input['hero_header_image' . $i] = wp_filter_nohtml_kses( $input['hero_header_image' . $i] );
		$input['hero_header_video' . $i] = wp_filter_nohtml_kses( $input['hero_header_video' . $i] );
		$input['hero_header_yt' . $i] = wp_filter_nohtml_kses( $input['hero_header_yt' . $i] );
	}
	$input['hero_header_link_text'] = wp_filter_nohtml_kses( $input['hero_header_link_text'] );

	// コンテンツビルダー
 	if ( ! empty( $input['contents_builder'] ) ) {
  	$input_cb = $input['contents_builder'];
  	$input['contents_builder'] = array();

  	foreach( $input_cb as $key => $value ) {

   		// クローン用はスルー
			if ( in_array( $key, array( 'cb_cloneindex', 'cb_cloneindex2' ) ) ) continue;

			// キャッチフレーズと説明文 ------------------------------
   		if ( 'catch_and_desc' == $value['cb_content_select'] ) {

 				if ( ! isset( $value['cb_catch_and_desc_display'] ) ) $value['cb_catch_and_desc_display'] = null;
  			$value['cb_catch_and_desc_display'] = ( $value['cb_catch_and_desc_display'] == 1 ? 1 : 0 );
     		$value['cb_catch_and_desc_headline'] = wp_filter_nohtml_kses( $value['cb_catch_and_desc_headline'] );
     		$value['cb_catch_and_desc_headline_font_size'] = wp_filter_nohtml_kses( $value['cb_catch_and_desc_headline_font_size'] );
     		$value['cb_catch_and_desc_desc'] = wp_filter_nohtml_kses( $value['cb_catch_and_desc_desc'] );
     		$value['cb_catch_and_desc_desc_font_size'] = wp_filter_nohtml_kses( $value['cb_catch_and_desc_desc_font_size'] );

			// プランコンテンツ ------------------------------
			} elseif ( 'plan' == $value['cb_content_select'] ) {

 				if ( ! isset( $value['cb_plan_display'] ) ) $value['cb_plan_display'] = null;
  			$value['cb_plan_display'] = ( $value['cb_plan_display'] == 1 ? 1 : 0 );

   		// メインイメージ ------------------------------
   		} elseif ( 'main_image' == $value['cb_content_select'] ) {
 				
				if ( ! isset( $value['cb_main_image_display'] ) ) $value['cb_main_image_display'] = null;
  			$value['cb_main_image_display'] = ( $value['cb_main_image_display'] == 1 ? 1 : 0 );
				if ( ! isset( $value['cb_main_image_layout'] ) ) $value['cb_main_image_layout'] = null;
     		if ( ! array_key_exists( $value['cb_main_image_layout'], $cb_main_image_layout_options ) ) $value['cb_main_image_layout'] = null;
     		$value['cb_main_image_headline'] = wp_filter_nohtml_kses( $value['cb_main_image_headline'] );
     		$value['cb_main_image_headline_font_size'] = wp_filter_nohtml_kses( $value['cb_main_image_headline_font_size'] );
     		$value['cb_main_image_desc'] = wp_filter_nohtml_kses( $value['cb_main_image_desc'] );
     		$value['cb_main_image_desc_font_size'] = wp_filter_nohtml_kses( $value['cb_main_image_desc_font_size'] );
     		$value['cb_main_image_color'] = wp_filter_nohtml_kses( $value['cb_main_image_color'] );
 				if ( ! isset( $value['cb_main_image_display_btn'] ) ) $value['cb_main_image_display_btn'] = null;
  			$value['cb_main_image_display_btn'] = ( $value['cb_main_image_display_btn'] == 1 ? 1 : 0 );
     		$value['cb_main_image_btn_label'] = wp_filter_nohtml_kses( $value['cb_main_image_btn_label'] );
     		$value['cb_main_image_btn_url'] = wp_filter_nohtml_kses( $value['cb_main_image_btn_url'] );
 				if ( ! isset( $value['cb_main_image_btn_target'] ) ) $value['cb_main_image_btn_target'] = null;
  			$value['cb_main_image_btn_target'] = ( $value['cb_main_image_btn_target'] == 1 ? 1 : 0 );
				$value['cb_main_image_btn_bg'] = wp_filter_nohtml_kses( $value['cb_main_image_btn_bg'] );
				$value['cb_main_image_btn_bg_hover'] = wp_filter_nohtml_kses( $value['cb_main_image_btn_bg_hover'] );
     		$value['cb_main_image_overlay'] = wp_filter_nohtml_kses( $value['cb_main_image_overlay'] );
     		$value['cb_main_image_opacity'] = wp_filter_nohtml_kses( $value['cb_main_image_opacity'] );
				if ( ! isset( $value['cb_main_image_size'] ) ) $value['cb_main_image_size'] = null;
     		if ( ! array_key_exists( $value['cb_main_image_size'], $cb_main_image_size_options ) ) $value['cb_main_image_size'] = null;
     		$value['cb_main_image_bg_image'] = wp_filter_nohtml_kses( $value['cb_main_image_bg_image'] );

			// プランコンテンツ ------------------------------
			} elseif ( 'blog_and_news' == $value['cb_content_select'] ) {

 				if ( ! isset( $value['cb_blog_and_news_display'] ) ) $value['cb_blog_and_news_display'] = null;
  			$value['cb_blog_and_news_display'] = ( $value['cb_blog_and_news_display'] == 1 ? 1 : 0 );
 				if ( ! isset( $value['cb_blog_and_news_layout'] ) ) $value['cb_blog_and_news_layout'] = null;
  			$value['cb_blog_and_news_layout'] = ( $value['cb_blog_and_news_layout'] == 1 ? 1 : 0 );
     		$value['cb_blog_and_news_blog_catch'] = wp_filter_nohtml_kses( $value['cb_blog_and_news_blog_catch'] );
     		$value['cb_blog_and_news_blog_catch_font_size'] = wp_filter_nohtml_kses( $value['cb_blog_and_news_blog_catch_font_size'] );
     		$value['cb_blog_and_news_blog_link_text'] = wp_filter_nohtml_kses( $value['cb_blog_and_news_blog_link_text'] );
     		$value['cb_blog_and_news_news_catch'] = wp_filter_nohtml_kses( $value['cb_blog_and_news_news_catch'] );
     		$value['cb_blog_and_news_news_catch_font_size'] = wp_filter_nohtml_kses( $value['cb_blog_and_news_news_catch_font_size'] );
     		$value['cb_blog_and_news_news_link_text'] = wp_filter_nohtml_kses( $value['cb_blog_and_news_news_link_text'] );
     		$value['cb_blog_and_news_news_bg'] = wp_filter_nohtml_kses( $value['cb_blog_and_news_news_bg'] );
     		$value['cb_blog_and_news_news_bg_hover'] = wp_filter_nohtml_kses( $value['cb_blog_and_news_news_bg_hover'] );

   		// ギャラリーコンテンツ ------------------------------
   		} elseif ( 'gallery_contents' == $value['cb_content_select'] ) {

 				if ( ! isset( $value['cb_gallery_contents_display'] ) ) $value['cb_gallery_contents_display'] = null;
  			$value['cb_gallery_contents_display'] = ( $value['cb_gallery_contents_display'] == 1 ? 1 : 0 );

     		$value['cb_gallery_contents_headline'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_headline'] );
     		$value['cb_gallery_contents_headline_font_size'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_headline_font_size'] );
     		$value['cb_gallery_contents_desc'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_desc'] );
     		$value['cb_gallery_contents_desc_font_size'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_desc_font_size'] );

     		$value['cb_gallery_contents_color'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_color'] );

 				if ( ! isset( $value['cb_gallery_contents_display_btn'] ) ) $value['cb_gallery_contents_display_btn'] = null;
  			$value['cb_gallery_contents_display_btn'] = ( $value['cb_gallery_contents_display_btn'] == 1 ? 1 : 0 );
     		$value['cb_gallery_contents_btn_label'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_btn_label'] );
     		$value['cb_gallery_contents_btn_url'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_btn_url'] );
 				if ( ! isset( $value['cb_gallery_contents_btn_target'] ) ) $value['cb_gallery_contents_btn_target'] = null;
  			$value['cb_gallery_contents_btn_target'] = ( $value['cb_gallery_contents_btn_target'] == 1 ? 1 : 0 );
     		$value['cb_gallery_contents_btn_bg'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_btn_bg'] );
     		$value['cb_gallery_contents_btn_bg_hover'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_btn_bg_hover'] );
     		$value['cb_gallery_contents_bg'] = wp_filter_nohtml_kses( $value['cb_gallery_contents_bg'] );

				$cb_gallery_contents_items = array();
				if ( isset( $value['cb_gallery_contents_items']['image'] ) ) {
   				foreach( array_keys( $value['cb_gallery_contents_items']['image']) as $key ) {
   					$cb_gallery_contents_items[] = array(
   				  	'image' => isset( $value['cb_gallery_contents_items']['image'][$key] ) ? wp_filter_nohtml_kses( $value['cb_gallery_contents_items']['image'][$key] ) : '',
   				   );
   				 }
				}
				$value['cb_gallery_contents_items'] = $cb_gallery_contents_items;

   			// フリースペース ------------------------------
   			} elseif ( 'wysiwyg' == $value['cb_content_select'] ) {

 					if ( ! isset( $value['cb_wysiwyg_display'] ) ) $value['cb_wysiwyg_display'] = null;
  				$value['cb_wysiwyg_display'] = ( $value['cb_wysiwyg_display'] == 1 ? 1 : 0 );

   			}

   			$input['contents_builder'][] = $value;

  		}
	 } // コンテンツビルダーループここまで

	return $input;

}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function the_cb_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_content_select = array(
		'catch_and_desc' => __( 'Catchphrase and description', 'tcd-w' ),
		'plan' => __( 'Plan contents', 'tcd-w' ),
		'main_image' => __( 'Main image', 'tcd-w' ),
		'blog_and_news' => __( 'Blog & News', 'tcd-w' ),
		'gallery_contents' => __( 'Gallery contents', 'tcd-w' ),
		'wysiwyg' => __( 'WYSIWYG Editor', 'tcd-w' )
	);

	if ( $selected && isset( $cb_content_select[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="dp_options[contents_builder][' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
	$out .= '<option value="" style="padding-right: 10px;">' . __( 'Choose the content', 'tcd-w' ) . '</option>';

	foreach( $cb_content_select as $key => $value ) {
		$attr = '';
		if ( $key == $selected ) {
			$attr = ' selected="selected"';
		}
		$out .= '<option value="' . esc_attr( $key ) . '"' . $attr . ' style="padding-right: 10px;">' . esc_html( $value ) . '</option>';
	}

	$out .= '</select>';

	echo $out; 
}

/**
 * コンテンツビルダー用 コンテンツ設定 ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function the_cb_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {
	global $cb_main_image_layout_options, $cb_main_image_size_options;
?>
	<div class="cb_content_wrap cf <?php echo esc_attr( $cb_content_select ); ?>">
	<?php
	// キャッチフレーズと説明文 ----------------------------------------------------------------------------------------
	if ( 'catch_and_desc' ==  $cb_content_select ) {

		if ( ! isset( $value['cb_catch_and_desc_display'] ) ) {
			$value['cb_catch_and_desc_display'] = null;
		}
		if ( ! isset( $value['cb_catch_and_desc_headline'] ) ) {
			$value['cb_catch_and_desc_headline'] = '';
		}
		if ( ! isset( $value['cb_catch_and_desc_headline_font_size'] ) ) {
			$value['cb_catch_and_desc_headline_font_size'] = 40;
		}
		if ( ! isset( $value['cb_catch_and_desc_desc'] ) ) {
			$value['cb_catch_and_desc_desc'] = '';
		}
		if ( ! isset( $value['cb_catch_and_desc_desc_font_size'] ) ) {
			$value['cb_catch_and_desc_desc_font_size'] = 14;
		}
?>
    <h3 class="cb_content_headline"><span><?php _e( 'Catchphrase and description', 'tcd-w' ); ?></span><a href="#"><?php _e( 'Open', 'tcd-w' ); ?></a></h3>
    <div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_catch_and_desc_display]" type="checkbox" value="1" <?php checked( 1, $value['cb_catch_and_desc_display'] ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'Headline', 'tcd-w' ); ?></h4>
  		<textarea rows="2" class="large-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_catch_and_desc_headline]"><?php echo esc_textarea( $value['cb_catch_and_desc_headline'] ); ?></textarea>
  		<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_catch_and_desc_headline_font_size]" value="<?php echo esc_attr( $value['cb_catch_and_desc_headline_font_size'] ); ?>"> px</label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
  		<textarea rows="2" class="large-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_catch_and_desc_desc]"><?php echo esc_textarea( $value['cb_catch_and_desc_desc'] ); ?></textarea>
  		<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_catch_and_desc_desc_font_size]" value="<?php echo esc_attr( $value['cb_catch_and_desc_desc_font_size'] ); ?>"> px</label></p>
	<?php
	// プランコンテンツ　----------------------------------------------------------------------------------------
	} elseif ( 'plan' == $cb_content_select ) {

		if ( ! isset( $value['cb_plan_display'] ) ) {
			$value['cb_plan_display'] = null;
		}
?>
    <h3 class="cb_content_headline"><span><?php _e( 'Plan contents', 'tcd-w' ); ?></span><a href="#"><?php _e( 'Open', 'tcd-w' ); ?></a></h3>
    <div class="cb_content">
			<p><?php _e( 'The plan list is displayed.', 'tcd-w' ); ?></p>
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_plan_display]" type="checkbox" value="1" <?php checked( 1, $value['cb_plan_display'] ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
			<p><?php printf( __( 'please set the number of columns at %s plan list settings page</a>.', 'tcd-w' ), '<a class="cb-plan-notice" href="#tab-content6" data-position=".a-plan-list-num">' ); ?></p>
	<?php
	// メインイメージ　----------------------------------------------------------------------------------------
	} elseif ( 'main_image' == $cb_content_select ) {

		if ( ! isset( $value['cb_main_image_display'] ) ) {
			$value['cb_main_image_display'] = null;
		}
		if ( ! isset( $value['cb_main_image_layout'] ) ) {
			$value['cb_main_image_layout'] = 'type1';
		}
		if ( ! isset( $value['cb_main_image_headline'] ) ) {
			$value['cb_main_image_headline'] = '';
		}
		if ( ! isset( $value['cb_main_image_headline_font_size'] ) ) {
			$value['cb_main_image_headline_font_size'] = 40;
		}
		if ( ! isset( $value['cb_main_image_desc'] ) ) {
			$value['cb_main_image_desc'] = '';
		}
		if ( ! isset( $value['cb_main_image_desc_font_size'] ) ) {
			$value['cb_main_image_desc_font_size'] = 14;
		}
		if ( ! isset( $value['cb_main_image_color'] ) ) {
			$value['cb_main_image_color'] = '#ffffff';
		}
		if ( ! isset( $value['cb_main_image_display_btn'] ) ) {
			$value['cb_main_image_display_btn'] = null;
		}
		if ( ! isset( $value['cb_main_image_btn_label'] ) ) {
			$value['cb_main_image_btn_label'] = '';
		}
		if ( ! isset( $value['cb_main_image_btn_url'] ) ) {
			$value['cb_main_image_btn_url'] = '';
		}
		if ( ! isset( $value['cb_main_image_btn_target'] ) ) {
			$value['cb_main_image_btn_target'] = '';
		}
		if ( ! isset( $value['cb_main_image_btn_bg'] ) ) {
			$value['cb_main_image_btn_bg'] = '#222222';
		}
		if ( ! isset( $value['cb_main_image_btn_bg_hover'] ) ) {
			$value['cb_main_image_btn_bg_hover'] = '#004353';
		}
		if ( ! isset( $value['cb_main_image_overlay'] ) ) {
			$value['cb_main_image_overlay'] = '#222222';
		}
		if ( ! isset( $value['cb_main_image_opacity'] ) ) {
			$value['cb_main_image_opacity'] = 0.5;
		}
		if ( ! isset( $value['cb_main_image_size'] ) ) {
			$value['cb_main_image_size'] = 'type1';
		}
		if ( ! isset( $value['cb_main_image_bg_image'] ) ) {
			$value['cb_main_image_bg_image'] = '';
		}
	?>
    <h3 class="cb_content_headline"><span><?php _e( 'Main image', 'tcd-w' ); ?></span><a href="#"><?php _e( 'Open', 'tcd-w' ); ?></a></h3>
    <div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_display]" type="checkbox" value="1" <?php checked( 1, $value['cb_main_image_display'] ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
      <h4 class="theme_option_headline2"><?php _e( 'Layout', 'tcd-w' ); ?></h4>
			<ul>
				<?php foreach ( $cb_main_image_layout_options as $option ) : ?>
				<li><label><input type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_layout]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['cb_main_image_layout'] ); ?>> <?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></li>
				<?php endforeach; ?>
			</ul>
  		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
  		<textarea rows="2" class="large-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_headline]"><?php echo esc_textarea( $value['cb_main_image_headline'] ); ?></textarea>
  		<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text hankaku" type="number" min="1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_headline_font_size]" value="<?php echo esc_attr( $value['cb_main_image_headline_font_size'] ); ?>"> px</label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
  		<textarea rows="4" class="large-text" cols="50" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_desc]"><?php echo esc_textarea( $value['cb_main_image_desc'] ); ?></textarea>
  		<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text hankaku" type="number" min="1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_desc_font_size]" value="<?php echo esc_attr( $value['cb_main_image_desc_font_size'] ); ?>"> px</label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'Font color', 'tcd-w' ); ?></h4>
			<input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_color]" value="<?php echo esc_attr( $value['cb_main_image_color'] ); ?>" data-default-color="#ffffff" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>">
  		<h4 class="theme_option_headline2"><?php _e( 'Button settings', 'tcd-w' ); ?></h4>
  		<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_display_btn]" type="checkbox" value="1" <?php checked( 1, $value['cb_main_image_display_btn'] ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
  		<p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_btn_label]" value="<?php echo esc_attr( $value['cb_main_image_btn_label'] ); ?>"></label></p>
  		<p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_btn_url]" value="<?php echo esc_attr( $value['cb_main_image_btn_url'] ); ?>"></label></p>
			<p><label><input type="checkbox" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_btn_target]" value="1" <?php checked( 1, $value['cb_main_image_btn_target'] ); ?>><?php _e( 'Open a URL in a new window', 'tcd-w' ); ?></label></p>
			<div><?php _e( 'Background color', 'tcd-w' ); ?> <input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_btn_bg]" value="<?php echo esc_attr( $value['cb_main_image_btn_bg'] ); ?>" data-default-color="#222222" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>"></div>
			<div><?php _e( 'Background color on hover', 'tcd-w' ); ?> <input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_btn_bg_hover]" value="<?php echo esc_attr( $value['cb_main_image_btn_bg_hover'] ); ?>" data-default-color="#004353" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>"></div>
			<h4 class="theme_option_headline2"><?php _e( 'Background color of text contents', 'tcd-w' ); ?></h4>
			<input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_overlay]" value="<?php echo esc_attr( $value['cb_main_image_overlay'] ); ?>" data-default-color="#222222" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>">
			<p><label><?php _e( 'Opacity', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="0" max="1" step="0.1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_opacity]" value="<?php echo esc_attr( $value['cb_main_image_opacity'] ); ?>"></label></p>
			<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ); ?></p>

			<h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
			<p><?php _e( 'Please select the size of background image', 'tcd-w' ); ?></p>
			<?php foreach ( $cb_main_image_size_options as $option ) : ?>
			<p><label><input type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_size]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['cb_main_image_size'] ); ?>> <?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
			<?php endforeach; ?>
    	<div class="image_box cf">
    		<div class="cf cf_media_field hide-if-no-js">
    			<input type="hidden" value="<?php echo esc_attr( $value['cb_main_image_bg_image'] ); ?>" id="cb_main_image_bg_image-<?php echo $cb_index; ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_main_image_bg_image]" class="cf_media_id">
    			<div class="preview_field"><?php if ( $value['cb_main_image_bg_image'] ) { echo wp_get_attachment_image( $value['cb_main_image_bg_image'], 'medium' ); } ?></div>
    			<div class="button_area">
    	 			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    	 			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $value['cb_main_image_bg_image'] ) { echo 'hidden'; } ?>">
    			</div>
    		</div>
    	</div>
	<?php
	// ブログ&ニュースコンテンツ ----------------------------------------------------------------------------------------
	} elseif ( 'blog_and_news' ==  $cb_content_select ) {

		if ( ! isset( $value['cb_blog_and_news_display'] ) ) {
			$value['cb_blog_and_news_display'] = null;
		}
		if ( ! isset( $value['cb_blog_and_news_layout'] ) ) {
			$value['cb_blog_and_news_layout'] = '';
		}

		// blog
		if ( ! isset( $value['cb_blog_and_news_blog_catch'] ) ) {
			$value['cb_blog_and_news_blog_catch'] = '';
		}
		if ( ! isset( $value['cb_blog_and_news_blog_catch_font_size'] ) ) {
			$value['cb_blog_and_news_blog_catch_font_size'] = 40;
		}
		if ( ! isset( $value['cb_blog_and_news_blog_link_text'] ) ) {
			$value['cb_blog_and_news_blog_link_text'] = '';
		}

		// news
		if ( ! isset( $value['cb_blog_and_news_news_catch'] ) ) {
			$value['cb_blog_and_news_news_catch'] = '';
		}
		if ( ! isset( $value['cb_blog_and_news_news_catch_font_size'] ) ) {
			$value['cb_blog_and_news_news_catch_font_size'] = 40;
		}
		if ( ! isset( $value['cb_blog_and_news_news_link_text'] ) ) {
			$value['cb_blog_and_news_news_link_text'] = '';
		}
		if ( ! isset( $value['cb_blog_and_news_news_bg'] ) ) {
			$value['cb_blog_and_news_news_bg'] = '#222222';
		}
		if ( ! isset( $value['cb_blog_and_news_news_bg_hover'] ) ) {
			$value['cb_blog_and_news_news_bg_hover'] = '#333333';
		}
?>
    <h3 class="cb_content_headline"><span><?php _e( 'Blog & News', 'tcd-w' ); ?></span><a href="#"><?php _e( 'Open', 'tcd-w' ); ?></a></h3>
    <div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_display]" type="checkbox" value="1" <?php checked( 1, $value['cb_blog_and_news_display'] ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'Layout settings', 'tcd-w' ); ?></h4>
			<p><label><input type="checkbox" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_layout]" value="1" <?php checked( 1, $value['cb_blog_and_news_layout'] ); ?>> <?php _e( 'Display news contents on the left side.', 'tcd-w' ); ?></label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'Blog settings', 'tcd-w' ); ?></h4>
			<h5 class="theme_option_headline3"><?php _e( 'Headline', 'tcd-w' ); ?></h5>
  		<input type="text" class="regular-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_blog_catch]" value="<?php echo esc_attr( $value['cb_blog_and_news_blog_catch'] ); ?>">
  		<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_blog_catch_font_size]" value="<?php echo esc_attr( $value['cb_blog_and_news_blog_catch_font_size'] ); ?>"> px</label></p>
			<h5 class="theme_option_headline3"><?php _e( 'Archive page link', 'tcd-w' ); ?></h5>
  		<p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_blog_link_text]" value="<?php echo esc_attr( $value['cb_blog_and_news_blog_link_text'] ); ?>"></label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'News settings', 'tcd-w' ); ?></h4>
			<h5 class="theme_option_headline3"><?php _e( 'Headline', 'tcd-w' ); ?></h5>
  		<input type="text" class="regular-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_news_catch]" value="<?php echo esc_attr( $value['cb_blog_and_news_news_catch'] ); ?>">
  		<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_news_catch_font_size]" value="<?php echo esc_attr( $value['cb_blog_and_news_news_catch_font_size'] ); ?>"> px</label></p>
			<h5 class="theme_option_headline3"><?php _e( 'Archive page link', 'tcd-w' ); ?></h5>
  		<p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_news_link_text]" value="<?php echo esc_attr( $value['cb_blog_and_news_news_link_text'] ); ?>"></label></p>
			<h5 class="theme_option_headline3"><?php _e( 'Background color', 'tcd-w' ); ?></h5>
			<input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_news_bg]" value="<?php echo esc_attr( $value['cb_blog_and_news_news_bg'] ); ?>" data-default-color="#222222" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>">
			<h5 class="theme_option_headline3"><?php _e( 'Background color of news items on hover', 'tcd-w' ); ?></h5>
			<input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_blog_and_news_news_bg_hover]" value="<?php echo esc_attr( $value['cb_blog_and_news_news_bg_hover'] ); ?>" data-default-color="#333333" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>">
	<?php
	// ギャラリーコンテンツ ----------------------------------------------------------------------------------------
	} elseif ( 'gallery_contents' == $cb_content_select ) {

		if ( ! isset( $value['cb_gallery_contents_display'] ) ) {
			$value['cb_gallery_contents_display'] = null;
		}
		if ( ! isset( $value['cb_gallery_contents_headline'] ) ) {
			$value['cb_gallery_contents_headline'] = '';
		}
		if ( ! isset( $value['cb_gallery_contents_headline_font_size'] ) ) {
			$value['cb_gallery_contents_headline_font_size'] = 40;
		}
		if ( ! isset( $value['cb_gallery_contents_desc'] ) ) {
			$value['cb_gallery_contents_desc'] = '';
		}
		if ( ! isset( $value['cb_gallery_contents_desc_font_size'] ) ) {
			$value['cb_gallery_contents_desc_font_size'] = 14;
		}
		if ( ! isset( $value['cb_gallery_contents_color'] ) ) {
			$value['cb_gallery_contents_color'] = '#ffffff';
		}
		if ( ! isset( $value['cb_gallery_contents_display_btn'] ) ) {
			$value['cb_gallery_contents_display_btn'] = 0;
		}
		if ( ! isset( $value['cb_gallery_contents_btn_label'] ) ) {
			$value['cb_gallery_contents_btn_label'] = '';
		}
		if ( ! isset( $value['cb_gallery_contents_btn_url'] ) ) {
			$value['cb_gallery_contents_btn_url'] = '';
		}
		if ( ! isset( $value['cb_gallery_contents_btn_target'] ) ) {
			$value['cb_gallery_contents_btn_target'] = '';
		}
		if ( ! isset( $value['cb_gallery_contents_btn_bg'] ) ) {
			$value['cb_gallery_contents_btn_bg'] = '#333333';
		}
		if ( ! isset( $value['cb_gallery_contents_btn_bg_hover'] ) ) {
			$value['cb_gallery_contents_btn_bg_hover'] = '#004353';
		}
		if ( ! isset( $value['cb_gallery_contents_bg'] ) ) {
			$value['cb_gallery_contents_bg'] = '#222222';
		}
		if ( ! isset( $value['cb_gallery_contents_items'] ) ) {
			$value['cb_gallery_contents_items'] = array(
				array(
					'image' => ''
				)
			);
		}
?>
    <h3 class="cb_content_headline"><span><?php _e( 'Gallery contents', 'tcd-w' ); ?></span><a href="#"><?php _e( 'Open', 'tcd-w' ); ?></a></h3>
    <div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_display]" type="checkbox" value="1" <?php checked( 1, $value['cb_gallery_contents_display'] ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
  		<textarea rows="2" class="large-text" cols="50" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_headline]"><?php echo esc_textarea( $value['cb_gallery_contents_headline'] ); ?></textarea>
  		<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_headline_font_size]" value="<?php echo esc_attr( $value['cb_gallery_contents_headline_font_size'] ); ?>"> px</label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
  		<textarea rows="4" class="large-text" cols="50" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_desc]"><?php echo esc_textarea( $value['cb_gallery_contents_desc'] ); ?></textarea>
  		<p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text hankaku" type="number" min="1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_desc_font_size]" value="<?php echo esc_attr( $value['cb_gallery_contents_desc_font_size'] ); ?>"> px</label></p>
  		<h4 class="theme_option_headline2"><?php _e( 'Font color', 'tcd-w' ); ?></h4>
			<input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_color]" value="<?php echo esc_attr( $value['cb_gallery_contents_color'] ); ?>" data-default-color="#ffffff" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>">
  		<h4 class="theme_option_headline2"><?php _e( 'Button settings', 'tcd-w' ); ?></h4>
  		<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_display_btn]" type="checkbox" value="1" <?php checked( 1, $value['cb_gallery_contents_display_btn'] ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
  		<p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_btn_label]" value="<?php echo esc_attr( $value['cb_gallery_contents_btn_label'] ); ?>"></label></p>
  		<p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_btn_url]" value="<?php echo esc_attr( $value['cb_gallery_contents_btn_url'] ); ?>"></label></p>
			<p><label><input type="checkbox" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_btn_target]" value="1" <?php checked( 1, $value['cb_gallery_contents_btn_target'] ); ?>><?php _e( 'Open a URL in a new window', 'tcd-w' ); ?></label></p>
			<div><?php _e( 'Background color', 'tcd-w' ); ?> <input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_btn_bg]" value="<?php echo esc_attr( $value['cb_gallery_contents_btn_bg'] ); ?>" data-default-color="#333333" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>"></div>
			<div><?php _e( 'Background color on hover', 'tcd-w' ); ?> <input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_btn_bg_hover]" value="<?php echo esc_attr( $value['cb_gallery_contents_btn_bg_hover'] ); ?>" data-default-color="#004353" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>"></div>
  		<h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
			<input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_bg]" value="<?php echo esc_attr( $value['cb_gallery_contents_bg'] ); ?>" data-default-color="#222222" class="<?php echo preg_match( '/^cb_\d+$/', $cb_index ) ? 'c-color-picker' : 'cb-color-picker'; ?>">
  		<h4 class="theme_option_headline2"><?php _e( 'Carousel slider', 'tcd-w' ); ?></h4>
    	<div class="topt_repeater_wrapper">
    		<div class="topt_repeater" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
<?php 
if ( $value['cb_gallery_contents_items'] ) : 
	foreach ( $value['cb_gallery_contents_items'] as $rpt_key => $rpt_value ) :
?>
      		<div class="topt_repeater-row sub_box">
       			<table class="topt_table">
        			<tr class="tr_cf_media_field">
      					<p><?php _e( 'Recommended size: width:970px, height:600px', 'tcd-w' ); ?></p>
        				<td>
        	 				<div class="cf cf_media_field hide-if-no-js">
        	  				<input type="hidden" value="<?php echo esc_attr( $rpt_value['image'] ); ?>" id="cb_gallery_contents_items-image-<?php echo $cb_index; ?>-<?php echo esc_attr( $rpt_key ); ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_items][image][]" class="cf_media_id">
										<div class="preview_field"><?php if ( isset( $rpt_value['image'] ) ) { echo wp_get_attachment_image( $rpt_value['image'], 'medium' ); } ?></div>
        	  				<div class="button_area">
        	  					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        	  					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $rpt_value['image'] ) { echo 'hidden'; } ?>">
        	  				</div>
        	 				</div>
        				</td>
        			</tr>
						</table>
       			<p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
					</div><!-- /.topt_repeater-row -->
<?php
	endforeach;
endif;
$key = 'addindex';
ob_start(); 
?>
      		<div id="topt_repeater-<?php echo esc_attr( $key ); ?>" class="topt_repeater-row sub_box">
       			<table class="topt_table">
        			<tr class="tr_cf_media_field">
        				<td>
        	 				<div class="cf cf_media_field hide-if-no-js">
        	  				<input type="hidden" value="" id="cb_gallery_contents_items-image-<?php echo $cb_index; ?>-<?php echo esc_attr( $key ); ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_gallery_contents_items][image][]" class="cf_media_id">
        	  				<div class="preview_field"></div>
        	  				<div class="button_area">
        	   					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        	   					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
        	  				</div>
        	 				</div>
        				</td>
        			</tr>
						</table>
       			<p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
     			</div>
<?php 
$clone = ob_get_clean(); 
?>
				</div>
  	   	<a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
			</div>
<?php
	// フリーススペース ----------------------------------------------------------------------------------------
	} elseif ( 'wysiwyg' == $cb_content_select ) {

		if ( ! isset( $value['cb_wysiwyg_display'] ) ) {
			$value['cb_wysiwyg_display'] = null;
		}
		if ( ! isset( $value['cb_wysiwyg_editor'] ) ) {
			$value['cb_wysiwyg_editor'] = '';
		}
?>
    <h3 class="cb_content_headline"><span><?php _e( 'WYSIWYG editor', 'tcd-w' ); ?></span><a href="#"><?php _e( 'Open', 'tcd-w' ); ?></a></h3>
    <div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_wysiwyg_display]" type="checkbox" value="1" <?php checked( 1, $value['cb_wysiwyg_display'] ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
			<?php wp_editor( $value['cb_wysiwyg_editor'], 'cb_wysiwyg_editor-' . $cb_index, array( 'textarea_name' => 'dp_options[contents_builder][' . $cb_index . '][cb_wysiwyg_editor]', 'textarea_rows' => 10, 'editor_class' => 'change_content_headline' ) ); ?>
<?php
	} else {
?>
    <h3 class="cb_content_headline"><?php echo esc_html( $cb_content_select ); ?><a href="#"><?php _e( 'Open', 'tcd-w' ); ?></a></h3>
    <div class="cb_content">
<?php
      }
?>
     <ul class="cb_content_button cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>"></li>
      <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>

    </div><!-- END .cb_content -->
   </div><!-- END .cb_content_wrap -->
<?php
}
