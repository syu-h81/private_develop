<?php 
/**
 * news
 */
// デフォルト変数を追加
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );

// タブパネルのラベルを追加
add_action( 'tcd_tab_labels', 'add_news_tab_label' );

// タブパネルの HTML を追加
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );

// サニタイズ処理を追加
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );

function add_news_dp_default_options( $dp_default_options ) {

	$dp_default_options['single_mobile_ad_url1'] = '';

	// ページヘッダーの設定
	$dp_default_options['news_ph_image'] = '';
	$dp_default_options['news_ph_catchphrase'] = '';
	$dp_default_options['news_ph_catchphrase_font_size'] = 28;
	$dp_default_options['news_ph_color'] = '#ffffff';
	$dp_default_options['news_ph_bg_color'] = '#222222';
	$dp_default_options['news_ph_bg_opacity'] = 1;

	// 記事詳細の設定
	$dp_default_options['news_title_font_size'] = 34;
	$dp_default_options['news_content_font_size'] = 14;
	$dp_default_options['recent_news_headline'] = '';
	$dp_default_options['recent_news_link_text'] = '';

	// 表示設定
	$dp_default_options['show_date_news'] = 1;
	$dp_default_options['show_thumbnail_news'] = 1;
	$dp_default_options['show_next_post_news'] = 1;
	$dp_default_options['show_sns_top_news'] = 1;
	$dp_default_options['show_sns_btm_news'] = 1;
	$dp_default_options['show_recent_news'] = 1;
	$dp_default_options['news_breadcrumb'] = __( 'News', 'tcd-w' );
	$dp_default_options['news_slug'] = 'news';
	

	// 記事詳細の広告設定1
	$dp_default_options['news_ad_code1'] = '';
	$dp_default_options['news_ad_image1'] = false;
	$dp_default_options['news_ad_url1'] = '';
	$dp_default_options['news_ad_code2'] = '';
	$dp_default_options['news_ad_image2'] = false;
	$dp_default_options['news_ad_url2'] = '';

	// 記事詳細の広告設定2
	$dp_default_options['news_ad_code3'] = '';
	$dp_default_options['news_ad_image3'] = false;
	$dp_default_options['news_ad_url3'] = '';
	$dp_default_options['news_ad_code4'] = '';
	$dp_default_options['news_ad_image4'] = false;
	$dp_default_options['news_ad_url4'] = '';

	// スマートフォン専用の広告
	$dp_default_options['news_mobile_ad_code1'] = '';
	$dp_default_options['news_mobile_ad_image1'] = false;
	$dp_default_options['news_mobile_ad_url1'] = '';

	return $dp_default_options;

}

function add_news_tab_label( $tab_labels ) {
	$tab_labels[] = __( 'News', 'tcd-w' );
	return $tab_labels;
}

function add_news_tab_panel( $options ) {
	
	global $dp_default_options;
?>
<div id="tab-content5">
	<?php // ページヘッダーの設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?><?php _e( '(Archive page and Singular page)', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommend image size. Width:1450px, Height:600px', 'tcd-w' ); ?></p>
    <div class="image_box cf">
    	<div class="cf cf_media_field hide-if-no-js news_ph_image">
    		<input type="hidden" value="<?php echo esc_attr( $options['news_ph_image'] ); ?>" id="news_ph_image" name="dp_options[news_ph_image]" class="cf_media_id">
    		<div class="preview_field"><?php if ( $options['news_ph_image'] ) { echo wp_get_attachment_image( $options['news_ph_image'], 'medium' ); } ?></div>
    		<div class="button_area">
    			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ph_image'] ) { echo 'hidden'; } ?>">
    		</div>
    	</div>
    </div>
    <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[news_ph_catchphrase]"><?php echo esc_textarea( $options['news_ph_catchphrase'] ); ?></textarea>
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" name="dp_options[news_ph_catchphrase_font_size]" value="<?php echo esc_attr( $options['news_ph_catchphrase_font_size'] ); ?>"> <span>px</span></label></p>
		<p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" name="dp_options[news_ph_color]" value="<?php echo esc_attr( $options['news_ph_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ph_color'] ); ?>" class="c-color-picker"></label></p>
		<p><label><?php _e( 'Background color', 'tcd-w' ); ?> <input type="text" name="dp_options[news_ph_bg_color]" value="<?php echo esc_attr( $options['news_ph_bg_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ph_bg_color'] ); ?>" class="c-color-picker">
		<p><label><?php _e( 'Opacity of background color', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="0" max="1" step="0.1" name="dp_options[news_ph_bg_opacity]" value="<?php echo esc_attr( $options['news_ph_bg_opacity'] ); ?>"></label></p>
		<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ); ?></p>
    <input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // 記事詳細の設定 ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Font size of post title', 'tcd-w' ); ?></h4>
    <input class="hankaku tiny-text" type="number" min="1" name="dp_options[news_title_font_size]" value="<?php echo esc_attr( $options['news_title_font_size'] ); ?>"> <span>px</span>
    <h4 class="theme_option_headline2"><?php _e( 'Font size of post contents', 'tcd-w' ); ?></h4>
    <input class="hankaku tiny-text" type="number" min="1" name="dp_options[news_content_font_size]" value="<?php echo esc_attr( $options['news_content_font_size'] ); ?>"> <span>px</span>
    <h4 class="theme_option_headline2"><?php _e( 'Setting for latest news archive', 'tcd-w' ); ?></h4>
  	<p><?php _e( 'This text will be displayed at the bottom of news page', 'tcd-w' ); ?></p>
  	<p><label><?php _e( 'Headline', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[recent_news_headline]" value="<?php echo esc_attr( $options['recent_news_headline'] ); ?>"></label></p>
  	<p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[recent_news_link_text]" value="<?php echo esc_attr( $options['recent_news_link_text'] ); ?>"></label></p>
  	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // 表示設定 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display setting', 'tcd-w' ); ?></h3>
  	<ul>
   		<li><label><input name="dp_options[show_date_news]" type="checkbox" value="1" <?php checked( '1', $options['show_date_news'] ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label></li>
   		<li><label><input name="dp_options[show_thumbnail_news]" type="checkbox" value="1" <?php checked( '1', $options['show_thumbnail_news'] ); ?>><?php _e( 'Display thumbnail', 'tcd-w' ); ?></label></li>
   		<li><label><input name="dp_options[show_sns_top_news]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_top_news'] ); ?>><?php _e( 'Display share button under post title', 'tcd-w' ); ?></label></li>
   		<li><label><input name="dp_options[show_sns_btm_news]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_btm_news'] ); ?>><?php _e( 'Display share button under post content', 'tcd-w' ); ?></label></li>
   		<li><label><input name="dp_options[show_next_post_news]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post_news'] ); ?>><?php _e( 'Display next previous post link', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_recent_news]" type="checkbox" value="1" <?php checked( '1', $options['show_recent_news'] ); ?>><?php _e( 'Display latest news', 'tcd-w' ); ?></label></li>
  	</ul>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "News" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[news_breadcrumb]" value="<?php echo esc_attr( $options['news_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "news" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[news_slug]" value="<?php echo esc_attr( $options['news_slug'] ); ?>"></p>
  	<input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
	<?php // 記事詳細の広告設定1 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner setup', 'tcd-w' ); ?>1</h3>
  	<p><?php _e( 'This banner will be displayed under contents.', 'tcd-w' ); ?></p>
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
    		<div class="theme_option_content">
      		<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
      		<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
      		<textarea id="dp_options[news_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[news_ad_code1]"><?php echo esc_textarea( $options['news_ad_code1'] ); ?></textarea>
     		</div>
     		<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
     		<div class="theme_option_content">
      		<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
      		<div class="image_box cf">
       			<div class="cf cf_media_field hide-if-no-js news_ad_image1">
        			<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image1'] ); ?>" id="news_ad_image" name="dp_options[news_ad_image1]" class="cf_media_id">
        			<div class="preview_field"><?php if ( $options['news_ad_image1'] ) { echo wp_get_attachment_image( $options['news_ad_image1'], 'medium' ); } ?></div>
        			<div class="button_area">
         				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
         				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image1'] ) { echo 'hidden'; } ?>">
        			</div>
       			</div>
      		</div>
     		</div>
     		<div class="theme_option_content">
      		<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
      		<input id="dp_options[news_ad_url1]" class="regular-text" type="text" name="dp_options[news_ad_url1]" value="<?php esc_attr_e( $options['news_ad_url1'] ); ?>">
      		<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
     		</div>
			</div>
		</div><!-- END .sub_box -->
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
    		<div class="theme_option_content">
    			<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' );  ?></h4>
    			<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
    			<textarea id="dp_options[news_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[news_ad_code2]"><?php echo esc_textarea( $options['news_ad_code2'] ); ?></textarea>
    		</div>
    		<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
    		<div class="theme_option_content">
    			<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
    			<div class="image_box cf">
    				<div class="cf cf_media_field hide-if-no-js news_ad_image2">
    					<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image2'] ); ?>" id="news_ad_image2" name="dp_options[news_ad_image2]" class="cf_media_id">
    					<div class="preview_field"><?php if ( $options['news_ad_image2'] ) { echo wp_get_attachment_image($options['news_ad_image2'], 'medium' ); } ?></div>
    					<div class="button_area">
    						<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
    						<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image2'] ) { echo 'hidden'; } ?>">
    					</div>
    				</div>
      		</div>
     		</div>
    		<div class="theme_option_content">
     			<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
      		<input id="dp_options[news_ad_url2]" class="regular-text" type="text" name="dp_options[news_ad_url2]" value="<?php esc_attr_e( $options['news_ad_url2'] ); ?>">
      		<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     		</div>
    	</div><!-- END .sub_box -->
		</div>
	</div><!-- END .theme_option_field -->
	<?php // 記事詳細の広告設定2 ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner setup', 'tcd-w' ); ?>2</h3>
  	<p><?php _e( 'Please copy and paste the short code inside the content to show this banner.', 'tcd-w' ); ?></p>
  	<p><?php _e( 'Short code', 'tcd-w' );  ?> : <input type="text" readonly="readonly" value="[n_ad]"></p>
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea id="dp_options[news_ad_code3]" class="large-text" cols="50" rows="10" name="dp_options[news_ad_code3]"><?php echo esc_textarea( $options['news_ad_code3'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image3">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image3'] ); ?>" id="news_ad_image3" name="dp_options[news_ad_image3]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image3'] ) { echo wp_get_attachment_image( $options['news_ad_image3'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image3'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input id="dp_options[news_ad_url3]" class="regular-text" type="text" name="dp_options[news_ad_url3]" value="<?php esc_attr_e( $options['news_ad_url3'] ); ?>">
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
  				<textarea id="dp_options[news_ad_code4]" class="large-text" cols="50" rows="10" name="dp_options[news_ad_code4]"><?php echo esc_textarea( $options['news_ad_code4'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image4">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image4'] ); ?>" id="news_ad_image4" name="dp_options[news_ad_image4]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image4'] ) { echo wp_get_attachment_image( $options['news_ad_image4'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if( ! $options['news_ad_image4'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input id="dp_options[news_ad_url4]" class="regular-text" type="text" name="dp_options[news_ad_url4]" value="<?php esc_attr_e( $options['news_ad_url4'] ); ?>">
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
 			<textarea class="large-text" cols="50" rows="10" name="dp_options[news_mobile_ad_code1]"><?php echo esc_textarea( $options['news_mobile_ad_code1'] ); ?></textarea>
 		</div>
 		<p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
 		<div class="theme_option_content">
 			<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); ?></h4>
 			<div class="image_box cf">
 				<div class="cf cf_media_field hide-if-no-js news_mobile_ad_image1">
 					<input type="hidden" value="<?php echo esc_attr( $options['news_mobile_ad_image1'] ); ?>" id="news_mobile_ad_image" name="dp_options[news_mobile_ad_image1]" class="cf_media_id">
 					<div class="preview_field"><?php if($options['news_mobile_ad_image1']){ echo wp_get_attachment_image($options['news_mobile_ad_image1'], 'medium'); }; ?></div>
 					<div class="buttton_area">
 						<input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
 						<input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['news_mobile_ad_image1']){ echo 'hidden'; }; ?>">
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="theme_option_content">
 			<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
 			<input class="regular-text" type="text" name="dp_options[news_mobile_ad_url1]" value="<?php echo esc_attr( $options['news_mobile_ad_url1'] ); ?>">
 			<input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
 		</div>
 	</div><!-- END .theme_option_field -->
</div><!-- END #tab-content5 -->
<?php
}

function add_news_theme_options_validate( $input ) {

 	// ページヘッダーの設定
 	$input['news_ph_image'] = wp_filter_nohtml_kses( $input['news_ph_image'] );
 	$input['news_ph_catchphrase'] = wp_filter_nohtml_kses( $input['news_ph_catchphrase'] );
 	$input['news_ph_catchphrase_font_size'] = wp_filter_nohtml_kses( $input['news_ph_catchphrase_font_size'] );
 	$input['news_ph_color'] = wp_filter_nohtml_kses( $input['news_ph_color'] );
 	$input['news_ph_bg_color'] = wp_filter_nohtml_kses( $input['news_ph_bg_color'] );
 	$input['news_ph_bg_opacity'] = wp_filter_nohtml_kses( $input['news_ph_bg_opacity'] );

	// 記事詳細の設定
 	$input['news_title_font_size'] = wp_filter_nohtml_kses( $input['news_title_font_size'] );
 	$input['news_content_font_size'] = wp_filter_nohtml_kses( $input['news_content_font_size'] );

	// ニュース表示設定
 	if ( ! isset( $input['show_date_news'] ) ) $input['show_date_news'] = null;
 	$input['show_date_news'] = ( $input['show_date_news'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_thumbnail_news'] ) ) $input['show_thumbnail_news'] = null;
 	$input['show_thumbnail_news'] = ( $input['show_thumbnail_news'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_sns_top_news'] ) ) $input['show_sns_top_news'] = null;
  $input['show_sns_top_news'] = ( $input['show_sns_top_news'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_sns_btm_news'] ) ) $input['show_sns_btm_news'] = null;
  $input['show_sns_btm_news'] = ( $input['show_sns_btm_news'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_next_post_news'] ) ) $input['show_next_post_news'] = null;
  $input['show_next_post_news'] = ( $input['show_next_post_news'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_related_post'] ) ) $input['show_related_post'] = null;
  $input['show_related_post'] = ( $input['show_related_post'] == 1 ? 1 : 0 );
 	$input['news_breadcrumb'] = wp_filter_nohtml_kses( $input['news_breadcrumb'] );
 	$input['news_slug'] = wp_filter_nohtml_kses( $input['news_slug'] );

	// 最近のニュース一覧の設定
 	$input['recent_news_headline'] = wp_filter_nohtml_kses( $input['recent_news_headline'] );
 	$input['recent_news_link_text'] = wp_filter_nohtml_kses( $input['recent_news_link_text'] );

	// 記事ページの広告設定1, 2
	for ( $i = 1; $i <= 4; $i++ ) {
 		$input['news_ad_code' . $i] = $input['news_ad_code' . $i];
 		$input['news_ad_image' . $i] = wp_filter_nohtml_kses( $input['news_ad_image' . $i] );
 		$input['news_ad_url' . $i] = wp_filter_nohtml_kses( $input['news_ad_url' . $i] );
	}
	// スマートフォン専用の広告
	$input['news_mobile_ad_code1'] = $input['news_mobile_ad_code1'];
 	$input['news_mobile_ad_image1'] = wp_filter_nohtml_kses( $input['news_mobile_ad_image1'] );
 	$input['news_mobile_ad_url1'] = wp_filter_nohtml_kses( $input['news_mobile_ad_url1'] );

	return $input;

}
