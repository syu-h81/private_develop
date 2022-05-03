<?php 
/**
 * blog
 */
// デフォルト変数を追加
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );

// タブパネルのラベルを追加
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );

// タブパネルの HTML を追加
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );

// サニタイズ処理を追加
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );

function add_blog_dp_default_options( $dp_default_options ) {

	// ページヘッダーの設定
	$dp_default_options['ph_image'] = '';
	$dp_default_options['ph_catchphrase'] = '';
	$dp_default_options['ph_catchphrase_font_size'] = 28;
	$dp_default_options['ph_color'] = '#ffffff';
	$dp_default_options['ph_bg_color'] = '#222222';
	$dp_default_options['ph_bg_opacity'] = 1;

	// アーカイブページの設定
	$dp_default_options['archive_catchphrase'] = '';
	$dp_default_options['archive_catchphrase_font_size'] = 40;
	$dp_default_options['archive_desc'] = '';

	// 記事詳細の設定
	$dp_default_options['title_font_size'] = 34;
	$dp_default_options['content_font_size'] = 14;

	// 表示設定
	$dp_default_options['show_date'] = 1;
	$dp_default_options['show_category'] = 1;
	$dp_default_options['show_tag'] = 1;
	$dp_default_options['show_author'] = 1;
	$dp_default_options['show_thumbnail'] = 1;
	$dp_default_options['show_sns_top'] = 1;
	$dp_default_options['show_sns_btm'] = 1;
	$dp_default_options['show_next_post'] = 1;
	$dp_default_options['show_related_post'] = 1;
	$dp_default_options['show_comment'] = 1;
	$dp_default_options['show_trackback'] = 1;

	// 記事詳細の広告設定1
	$dp_default_options['single_ad_code1'] = '';
	$dp_default_options['single_ad_image1'] = false;
	$dp_default_options['single_ad_url1'] = '';
	$dp_default_options['single_ad_code2'] = '';
	$dp_default_options['single_ad_image2'] = false;
	$dp_default_options['single_ad_url2'] = '';

	// 記事詳細の広告設定2
	$dp_default_options['single_ad_code3'] = '';
	$dp_default_options['single_ad_image3'] = false;
	$dp_default_options['single_ad_url3'] = '';
	$dp_default_options['single_ad_code4'] = '';
	$dp_default_options['single_ad_image4'] = false;
	$dp_default_options['single_ad_url4'] = '';

	// スマートフォン専用の広告
	$dp_default_options['single_mobile_ad_code1'] = '';
	$dp_default_options['single_mobile_ad_image1'] = false;
	$dp_default_options['single_mobile_ad_url1'] = '';

	return $dp_default_options;

}

function add_blog_tab_label( $tab_labels ) {
	$tab_labels[] = __( 'Blog', 'tcd-w' );
	return $tab_labels;
}

function add_blog_tab_panel( $options ) {

	global $dp_default_options;
?>
<div id="tab-content4">
	<?php // ページヘッダーの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?><?php _e( '(Archive page and Singular page', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommend image size. Width:1450px, Height:600px', 'tcd-w' ); ?></p>
    <div class="image_box cf">
    	<div class="cf cf_media_field hide-if-no-js ph_image">
    		<input type="hidden" value="<?php echo esc_attr( $options['ph_image'] ); ?>" id="ph_image" name="dp_options[ph_image]" class="cf_media_id">
    		<div class="preview_field"><?php if ( $options['ph_image'] ) { echo wp_get_attachment_image( $options['ph_image'], 'medium' ); } ?></div>
    		<div class="button_area">
    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ph_image'] ) { echo 'hidden'; } ?>">
    		</div>
    	</div>
    </div>
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[ph_catchphrase]"><?php echo esc_textarea( $options['ph_catchphrase'] ); ?></textarea>
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" name="dp_options[ph_catchphrase_font_size]" value="<?php echo esc_attr( $options['ph_catchphrase_font_size'] ); ?>"> <span>px</span></label></p>
		<p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" name="dp_options[ph_color]" value="<?php echo esc_attr( $options['ph_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['ph_color'] ); ?>" class="c-color-picker"></label></p>
		<p><label><?php _e( 'Background color', 'tcd-w' ); ?> <input type="text" name="dp_options[ph_bg_color]" value="<?php echo esc_attr( $options['ph_bg_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['ph_bg_color'] ); ?>" class="c-color-picker">
		<p><label><?php _e( 'Opacity of background color', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="0" max="1" step="0.1" name="dp_options[ph_bg_opacity]" value="<?php echo esc_attr( $options['ph_bg_opacity'] ); ?>"></label></p>
		<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ); ?></p>
    <input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // アーカイブページの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Archive page settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[archive_catchphrase]"><?php echo esc_textarea( $options['archive_catchphrase'] ); ?></textarea>
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" name="dp_options[archive_catchphrase_font_size]" value="<?php echo esc_attr( $options['archive_catchphrase_font_size'] ); ?>"> <span>px</span></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[archive_desc]"><?php echo esc_textarea( $options['archive_desc'] ); ?></textarea>
    <input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // 記事詳細ページの設定 ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" name="dp_options[title_font_size]" value="<?php echo esc_attr( $options['title_font_size'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" name="dp_options[content_font_size]" value="<?php echo esc_attr( $options['content_font_size'] ); ?>"> <span>px</span>
  	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // 表示設定 ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display setting', 'tcd-w' ); ?></h3>
    <ul>
    	<li><label><input name="dp_options[show_date]" type="checkbox" value="1" <?php checked( '1', $options['show_date'] ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_category]" type="checkbox" value="1" <?php checked( '1', $options['show_category'] ); ?>><?php _e( 'Display category', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_tag]" type="checkbox" value="1" <?php checked( '1', $options['show_tag'] ); ?>><?php _e( 'Display tags', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_author]" type="checkbox" value="1" <?php checked( '1', $options['show_author'] ); ?>><?php _e( 'Display author', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $options['show_thumbnail'] ); ?>><?php _e( 'Display thumbnail', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_top'] ); ?>><?php _e( 'Buttons to the article top', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_btm'] ); ?>><?php _e( 'Buttons to the article bottom', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post'] ); ?>><?php _e( 'Display next previous post link', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( '1', $options['show_related_post'] ); ?>><?php _e( 'Display related post', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_comment]" type="checkbox" value="1" <?php checked( '1', $options['show_comment'] ); ?>><?php _e( 'Display comment', 'tcd-w' ); ?></label></li>
    	<li><label><input id="dp_options[show_trackback]" name="dp_options[show_trackback]" type="checkbox" value="1" <?php checked( '1', $options['show_trackback'] ); ?>><?php _e( 'Display trackbacks', 'tcd-w' ); ?></label></li>
    </ul>
    <input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // 広告の登録1 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner setup', 'tcd-w' ); ?>1</h3>
  	<p><?php _e( 'This banner will be displayed under contents.', 'tcd-w' ); ?></p>
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea id="dp_options[single_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code1]"><?php echo esc_textarea( $options['single_ad_code1'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image1">
  						<input type="hidden" value="<?php echo esc_attr( $options['single_ad_image1'] ); ?>" id="single_ad_image" name="dp_options[single_ad_image1]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['single_ad_image1'] ) { echo wp_get_attachment_image( $options['single_ad_image1'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['single_ad_image1'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input id="dp_options[single_ad_url1]" class="regular-text" type="text" name="dp_options[single_ad_url1]" value="<?php echo esc_attr( $options['single_ad_url1'] ); ?>">
  				<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea id="dp_options[single_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code2]"><?php echo esc_textarea( $options['single_ad_code2'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image2">
  						<input type="hidden" value="<?php echo esc_attr( $options['single_ad_image2'] ); ?>" id="single_ad_image2" name="dp_options[single_ad_image2]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['single_ad_image2'] ) { echo wp_get_attachment_image($options['single_ad_image2'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['single_ad_image2'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' );  ?></h4>
  				<input id="dp_options[single_ad_url2]" class="regular-text" type="text" name="dp_options[single_ad_url2]" value="<?php echo esc_attr( $options['single_ad_url2'] ); ?>">
  				<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div><!-- END .sub_box -->
		</div>
  </div><!-- END .theme_option_field -->
	<?php // 記事詳細の広告設定2 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner setup', 'tcd-w' ); ?>2</h3>
  	<p><?php _e( 'Please copy and paste the short code inside the content to show this banner.', 'tcd-w' ); ?></p>
  	<p><?php _e( 'Short code', 'tcd-w' );  ?> : <input type="text" readonly="readonly" value="[s_ad]"></p>
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea id="dp_options[single_ad_code3]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code3]"><?php echo esc_textarea( $options['single_ad_code3'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image3">
  						<input type="hidden" value="<?php echo esc_attr( $options['single_ad_image3'] ); ?>" id="single_ad_image3" name="dp_options[single_ad_image3]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['single_ad_image3'] ) { echo wp_get_attachment_image( $options['single_ad_image3'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['single_ad_image3'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input id="dp_options[single_ad_url3]" class="regular-text" type="text" name="dp_options[single_ad_url3]" value="<?php echo esc_attr( $options['single_ad_url3'] ); ?>">
  				<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea id="dp_options[single_ad_code4]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code4]"><?php echo esc_textarea( $options['single_ad_code4'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image4">
  						<input type="hidden" value="<?php echo esc_attr( $options['single_ad_image4'] ); ?>" id="single_ad_image4" name="dp_options[single_ad_image4]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['single_ad_image4'] ) { echo wp_get_attachment_image( $options['single_ad_image4'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if( ! $options['single_ad_image4'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input id="dp_options[single_ad_url4]" class="regular-text" type="text" name="dp_options[single_ad_url4]" value="<?php echo esc_attr( $options['single_ad_url4'] ); ?>">
  				<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div>
  	</div><!-- END .sub_box -->
  </div><!-- END .theme_option_field -->
 	<?php // スマホ専用広告の登録 ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Mobile device banner setup', 'tcd-w' ); ?></h3>
		<p><?php _e( 'This banner will be displayed on mobile device.', 'tcd-w' ); ?></p>
 	 	<div class="theme_option_content">
 	 		<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
 	    <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
 	    <textarea id="dp_options[single_mobile_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[single_mobile_ad_code1]"><?php echo esc_textarea( $options['single_mobile_ad_code1'] ); ?></textarea>
 	  </div>
 	  <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
 	  <div class="theme_option_content">
 	  	<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); ?></h4>
 	  	<div class="image_box cf">
 	    	<div class="cf cf_media_field hide-if-no-js single_mobile_ad_image1">
 	      	<input type="hidden" value="<?php echo esc_attr( $options['single_mobile_ad_image1'] ); ?>" id="single_mobile_ad_image" name="dp_options[single_mobile_ad_image1]" class="cf_media_id">
 	      	<div class="preview_field"><?php if($options['single_mobile_ad_image1']){ echo wp_get_attachment_image($options['single_mobile_ad_image1'], 'medium' ); }; ?></div>
 	      	<div class="buttton_area">
 	       		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
 	       		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if(!$options['single_mobile_ad_image1']){ echo 'hidden'; }; ?>">
 	     		</div>
 	    	</div>
			</div>
 	  </div>
 	 	<div class="theme_option_content">
 	    <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
 	    <input id="dp_options[single_mobile_ad_url1]" class="regular-text" type="text" name="dp_options[single_mobile_ad_url1]" value="<?php echo esc_attr( $options['single_mobile_ad_url1'] ); ?>">
 	  	<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
		</div>
	</div><!-- END .theme_option_field -->
</div><!-- END #tab-content4 -->
<?php
}

function add_blog_theme_options_validate( $input ) {

 	// ページヘッダーの設定
 	$input['ph_image'] = wp_filter_nohtml_kses( $input['ph_image'] );
 	$input['ph_catchphrase'] = wp_filter_nohtml_kses( $input['ph_catchphrase'] );
 	$input['ph_catchphrase_font_size'] = wp_filter_nohtml_kses( $input['ph_catchphrase_font_size'] );
 	$input['ph_color'] = wp_filter_nohtml_kses( $input['ph_color'] );
 	$input['ph_bg_color'] = wp_filter_nohtml_kses( $input['ph_bg_color'] );
 	$input['ph_bg_opacity'] = wp_filter_nohtml_kses( $input['ph_bg_opacity'] );

	// アーカイブページの設定
 	$input['archive_catchphrase'] = wp_filter_nohtml_kses( $input['archive_catchphrase'] );
 	$input['archive_catchphrase_font_size'] = wp_filter_nohtml_kses( $input['archive_catchphrase_font_size'] );
 	$input['archive_desc'] = wp_filter_nohtml_kses( $input['archive_desc'] );

	// 記事詳細の設定
 	$input['title_font_size'] = wp_filter_nohtml_kses( $input['title_font_size'] );
 	$input['content_font_size'] = wp_filter_nohtml_kses( $input['content_font_size'] );

 	// 表示設定
 	if ( ! isset( $input['show_date'] ) ) $input['show_date'] = null;
  $input['show_date'] = ( $input['show_date'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_category'] ) ) $input['show_category'] = null;
  $input['show_category'] = ( $input['show_category'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_tag'] ) ) $input['show_tag'] = null;
  $input['show_tag'] = ( $input['show_tag'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_author'] ) ) $input['show_author'] = null;
  $input['show_author'] = ( $input['show_author'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_thumbnail'] ) ) $input['show_thumbnail'] = null;
  $input['show_thumbnail'] = ( $input['show_thumbnail'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_sns_top'] ) ) $input['show_sns_top'] = null;
  $input['show_sns_top'] = ( $input['show_sns_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_sns_btm'] ) ) $input['show_sns_btm'] = null;
  $input['show_sns_btm'] = ( $input['show_sns_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_next_post'] ) ) $input['show_next_post'] = null;
  $input['show_next_post'] = ( $input['show_next_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_related_post'] ) ) $input['show_related_post'] = null;
  $input['show_related_post'] = ( $input['show_related_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_comment'] ) ) $input['show_comment'] = null;
  $input['show_comment'] = ( $input['show_comment'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_trackback'] ) ) $input['show_trackback'] = null;
  $input['show_trackback'] = ( $input['show_trackback'] == 1 ? 1 : 0 );

	// 記事ページの広告設定1, 2
	for ( $i = 1; $i <= 4; $i++ ) {
 		$input['single_ad_code' . $i] = $input['single_ad_code' . $i];
 		$input['single_ad_image' . $i] = wp_filter_nohtml_kses( $input['single_ad_image' . $i] );
 		$input['single_ad_url' . $i] = wp_filter_nohtml_kses( $input['single_ad_url' . $i] );
	}
	// スマートフォン専用の広告
	$input['single_mobile_ad_code1'] = $input['single_mobile_ad_code1'];
 	$input['single_mobile_ad_image1'] = wp_filter_nohtml_kses( $input['single_mobile_ad_image1'] );
 	$input['single_mobile_ad_url1'] = wp_filter_nohtml_kses( $input['single_mobile_ad_url1'] );

	return $input;

}
