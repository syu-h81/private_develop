<?php

/**
 * ページビルダーウィジェット登録
 */
add_page_builder_widget(array(
	'id' => 'pb-widget-staff-list',
	'form' => 'form_page_builder_widget_staff_list',
	'form_rightbar' => 'form_rightbar_page_builder_widget_staff_list',
	'save' => 'save_page_builder_repeater',
	'display' => 'display_page_builder_widget_staff_list',
	'title' => __('Staff list', 'tcd-w'),
	'description' => '',
	'additional_class' => 'pb-repeater-widget',
	'priority' => 54
));

/**
 * リピーター行 デフォルト値
 */
function get_page_builder_widget_staff_list_default_row_values() {
	$default_row_values = array(
		'repeater_label' => '',
		'image' => '',
		'name' => '',
		'name_font_size' => '22',
		'name_font_color' => '#ffffff',
		'name_font_family' => 'type1',
		'label' => '',
		'label_bg_color' => page_builder_get_primary_color('#222222'),
		'label_mobile' => '',
		'position' => '',
		'position_font_size' => '16',
		'position_font_color' => '#ffffff',
		'position_font_family' => 'type1',
		'description' => '',
		'description_font_size' => '14',
		'description_font_color' => '#ffffff',
		'facebook_url' => '',
		'twitter_url' => '',
		'instagram_url' => '',
		'rss_url' => '',
		'overlay_bg_color' => '#000000',
		'overlay_bg_opacity' => '0.7'
	);

	return  apply_filters('get_page_builder_widget_staff_list_default_row_values', $default_row_values);
}

/**
 * フォーム
 */
function form_page_builder_widget_staff_list($values = array()) {
	// デフォルト値
	$default_values = apply_filters('page_builder_widget_staff_list_default_values', array(
		'widget_index' => '',
		'repeater' => array()
	), 'form');

	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);

	// リピーター行の並び
	$repeater_indexes = array();
	if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
		$repeater_indexes = $values['repeater_index'];

		// リピーター行データが無ければ削除
		foreach($repeater_indexes as $key => $repeater_index) {
			if (empty($values['repeater'][$repeater_index])) {
				unset($repeater_indexes[$key]);
			}
		}
	} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
		$repeater_indexes = array_keys($values['repeater']);
	}

	// リピーター行 最大インデックス
	$repeater_index_max = 0;
	if ($repeater_indexes) {
		$repeater_indexes = array_map('intval', $repeater_indexes);
		$repeater_index_max = max($repeater_indexes);
	}

	echo '<div class="pb_repeater_wrap" data-rows="'.$repeater_index_max.'">'."\n";
	echo '	<div class="pb_repeater_sortable">'."\n";

	// リピーター行あり
	if ($repeater_indexes) {
		// リピーター行ループ
		foreach($repeater_indexes as $repeater_index) {
			// リピーター行データあり
			if (!empty($values['repeater'][$repeater_index])) {
				// リピーター行出力
				form_page_builder_widget_staff_list_repeater_row(
					array(
						'widget_index' => $values['widget_index'],
						'repeater_index' => $repeater_index
					),
					$values['repeater'][$repeater_index]
				);
			}
		}
	}

	echo '	</div>'."\n"; // .pb_repeater_sortable

	// 項目の追加ボタン
	echo '<div class="form-field">';
	echo '<a href="#" class="pb_add_repeater button-primary">'.__('Add item', 'tcd-w').'</a>';
	echo '</div>'."\n";

	// 追加ボタン時に差し込むHTML
	echo '<div class="add_pb_repeater_clone hidden" style="display:none">'."\n";

	// 行出力
	form_page_builder_widget_staff_list_repeater_row(
		array(
			'widget_index' => $values['widget_index'],
			'repeater_index' => 'pb_repeater_add_index'
		)
	);

	echo '</div>'."\n"; // .add_pb_repeater_clone

	echo '</div>'."\n"; // .pb_repeater_wrap
}

/**
 * リピーター行出力
 */
function form_page_builder_widget_staff_list_repeater_row($values = array(), $row_values = array()) {
	// デフォルト値に入力値をマージ
	$values = array_merge(
		array(
			'widget_index' => '',
			'repeater_index' => ''
		),
		(array) $values
	);

	// 行デフォルト値
	$default_row_values = apply_filters('page_builder_widget_staff_list_default_row_values', get_page_builder_widget_staff_list_default_row_values());

	// 行デフォルト値に行の値をマージ
	$row_values = array_merge(
		$default_row_values,
		(array) $row_values
	);

	// リピーター表示名
	if (!$row_values['repeater_label']) {
		$row_values['repeater_label'] = $row_values['name'];
	}

	// font family 選択肢
	$font_family_options = array(
		'type1' => __('Meiryo', 'tcd-w'),
		'type2' => __('YuGothic', 'tcd-w'),
		'type3' => __('YuMincho', 'tcd-w'),
	);
?>

<div id="pb_staff_list-<?php echo esc_attr($values['widget_index'].'-'.$values['repeater_index']); ?>" class="pb_repeater pb_repeater-<?php echo esc_attr($values['repeater_index']); ?>">
	<input type="hidden" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater_index][]" value="<?php echo esc_attr($values['repeater_index']); ?>" />
	<ul class="pb_repeater_button pb_repeater_cf">
		<li><span class="pb_repeater_move"><?php _e('Move', 'tcd-w'); ?></span></li>
		<li><span class="pb_repeater_delete" data-confirm="<?php _e('Are you sure you want to delete this item?', 'tcd-w'); ?>"><?php _e('Delete', 'tcd-w'); ?></span></li>
	</ul>
	<div class="pb_repeater_content">
		<h3 class="pb_repeater_headline"><span class="index_label" data-empty="<?php _e('New item', 'tcd-w'); ?>"><?php echo esc_html($row_values['repeater_label']); ?></span><a href="#"><?php _e('Open', 'tcd-w'); ?></a></h3>
		<div class="pb_repeater_field">
			<div class="form-field">
				<h4><?php _e('Image', 'tcd-w'); ?></h4>
				<?php
					$input_name = 'pagebuilder[widget]['.$values['widget_index'].'][repeater]['.$values['repeater_index'].'][image]';
					$media_id = $row_values['image'];
					pb_media_form($input_name, $media_id);
				?>
				<p class="pb-description"><?php printf(__('Recommend image size. Width:%dpx, Height:%dpx', 'tcd-w'), 480, 600); ?></p>
			</div>

			<div class="form-field">
				<h4><?php _e('Name', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][name]" value="<?php echo esc_attr($row_values['name']); ?>" class="index_label pb-input-overview" />
				<table>
					<tr>
						<td><?php _e('Font size', 'tcd-w'); ?></td>
						<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][name_font_size]" value="<?php echo esc_attr($row_values['name_font_size']); ?>" class="pb-input-narrow hankaku" /> px</td>
					</tr>
					<tr>
						<td><?php _e('Font color', 'tcd-w'); ?></td>
						<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][name_font_color]" value="<?php echo esc_attr($row_values['name_font_color']); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_row_values['name_font_color']); ?>" /></td>
					</tr>
					<tr>
						<td><?php _e('Font family', 'tcd-w'); ?></td>
						<td>
							<select name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][name_font_family]">
								<?php
									foreach($font_family_options as $key => $value) {
										$attr = '';
										if ($row_values['name_font_family'] == $key) {
											$attr .= ' selected="selected"';
										}
										echo '<option value="'.esc_attr($key).'"'.$attr.'>'.esc_html($value).'</option>';
									}
								?>
							</select>
						</td>
					</tr>
				</table>
                <p class="pb-description"><?php _e('The font size and font color are reflected only in PC display.', 'tcd-w'); ?></p>
			</div>

			<div class="form-field">
				<h4><?php _e('Label', 'tcd-w'); ?></h4>
                <input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][label]" value="<?php echo esc_attr($row_values['label']); ?>" />				<p class="pb-description"><?php _e('It is displayed on the lower right of the image on the PC display.', 'tcd-w'); ?></p>
				<table>
					<tr>
						<td><?php _e('Background color', 'tcd-w'); ?></td>
						<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][label_bg_color]" value="<?php echo esc_attr($row_values['label_bg_color']); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_row_values['label_bg_color']); ?>" /></td>
					</tr>
				</table>
			</div>

			<div class="form-field">
				<h4><?php _e('Label for mobile', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][label_mobile]" value="<?php echo esc_attr($row_values['label_mobile']); ?>" />
                <p class="pb-description"><?php _e('It is displayed as a tab in mobile display. If it is empty, "name" is used.', 'tcd-w'); ?></p>
			</div>

			<div class="form-field">
				<h4><?php _e('Position', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][position]" value="<?php echo esc_attr($row_values['position']); ?>" />
				<table>
					<tr>
						<td><?php _e('Font size', 'tcd-w'); ?></td>
						<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][position_font_size]" value="<?php echo esc_attr($row_values['position_font_size']); ?>" class="pb-input-narrow hankaku" /> px</td>
					</tr>
					<tr>
						<td><?php _e('Font color', 'tcd-w'); ?></td>
						<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][position_font_color]" value="<?php echo esc_attr($row_values['position_font_color']); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_row_values['position_font_color']); ?>" /></td>
					</tr>
					<tr>
						<td><?php _e('Font family', 'tcd-w'); ?></td>
						<td>
							<select name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][position_font_family]">
								<?php
									foreach($font_family_options as $key => $value) {
										$attr = '';
										if ($row_values['position_font_family'] == $key) {
											$attr .= ' selected="selected"';
										}
										echo '<option value="'.esc_attr($key).'"'.$attr.'>'.esc_html($value).'</option>';
									}
								?>
							</select>
						</td>
					</tr>
				</table>
                <p class="pb-description"><?php _e('The font size and font color are reflected only in PC display.', 'tcd-w'); ?></p>
			</div>

			<div class="form-field">
				<h4><?php _e('Description', 'tcd-w'); ?></h4>
				<textarea name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][description]" rows="4"><?php echo esc_html($row_values['description']); ?></textarea>
				<table style="margin-top:5px;">
					<tr>
						<td><?php _e('Font size', 'tcd-w'); ?></td>
						<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][description_font_size]" value="<?php echo esc_attr($row_values['description_font_size']); ?>" class="pb-input-narrow hankaku" /> px</td>
					</tr>
					<tr>
						<td><?php _e('Font color', 'tcd-w'); ?></td>
						<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][description_font_color]" value="<?php echo esc_attr($row_values['description_font_color']); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_row_values['description_font_color']); ?>" /></td>
					</tr>
				</table>
                <p class="pb-description"><?php _e('The font size and font color are reflected only in PC display.', 'tcd-w'); ?></p>
			</div>

			<div class="form-field">
				<h4><?php _e('Facebook URL', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][facebook_url]" value="<?php echo esc_attr($row_values['facebook_url']); ?>" />
			</div>

			<div class="form-field">
				<h4><?php _e('Twitter URL', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][twitter_url]" value="<?php echo esc_attr($row_values['twitter_url']); ?>" />
			</div>

			<div class="form-field">
				<h4><?php _e('Instagram URL', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][instagram_url]" value="<?php echo esc_attr($row_values['instagram_url']); ?>" />
			</div>

			<div class="form-field">
				<h4><?php _e('RSS URL', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][rss_url]" value="<?php echo esc_attr($row_values['rss_url']); ?>" />
			</div>

			<div class="form-field">
				<h4><?php _e('Overlay background color', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][overlay_bg_color]" value="<?php echo esc_attr($row_values['overlay_bg_color']); ?>" class="pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_row_values['overlay_bg_color']); ?>" />
				<table style="margin-top:5px;">
					<tr>
						<td><?php _e('Transparency', 'tcd-w'); ?></td>
						<td>
							<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][overlay_bg_opacity]" value="<?php echo esc_attr($row_values['overlay_bg_opacity']); ?>" class="pb-input-narrow hankaku" />
							<span class="pb-description" style="margin-left: 5px;"><?php _e('Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w'); ?></span>							</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
}

/**
 * フォーム 右サイドバー
 */
function form_rightbar_page_builder_widget_staff_list($values = array()) {
	// デフォルト値
	$default_values = apply_filters('page_builder_widget_staff_list_default_values', array(
		'widget_index' => '',
		'margin_bottom' => 30,
		'margin_bottom_mobile' => 30
	), 'form_rightbar');

	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);
?>

<h3><?php _e('Margin setting', 'tcd-w'); ?></h3>
<div class="form-field">
	<label><?php _e('Margin bottom', 'tcd-w'); ?></label>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][margin_bottom]" value="<?php echo esc_attr($values['margin_bottom']); ?>" class="pb-input-narrow hankaku" /> px
	<p class="pb-description"><?php _e('Space below the content.<br />Default is 30px.', 'tcd-w'); ?></p>
</div>
<div class="form-field">
	<label><?php _e('Margin bottom for mobile', 'tcd-w'); ?></label>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][margin_bottom_mobile]" value="<?php echo esc_attr($values['margin_bottom_mobile']); ?>" class="pb-input-narrow hankaku" /> px
	<p class="pb-description"><?php _e('Space below the content.<br />Default is 30px.', 'tcd-w'); ?></p>
</div>

<?php
}

/**
 * フロント出力
 */
function display_page_builder_widget_staff_list($values = array(), $widget_index = null) {
	// リピーター行の並び
	if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
		$repeater_indexes = $values['repeater_index'];

		// リピーター行ループし、行データが無ければ削除
		foreach($repeater_indexes as $key => $repeater_index) {
			if (empty($values['repeater'][$repeater_index])) {
				unset($repeater_indexes[$key]);
			}
		}
	} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
		$repeater_indexes = array_keys($values['repeater']);
	}

	// リピーター行がなければ終了
	if (empty($repeater_indexes)) return;

	// 行デフォルト値
	$default_row_values = apply_filters('page_builder_widget_staff_list_default_row_values', get_page_builder_widget_staff_list_default_row_values());

	echo '<div class="pb_staff_list-pc">'."\n";

	$i = 0;
	foreach($repeater_indexes as $repeater_index) {
		$i++;
		$repeater_values = $values['repeater'][$repeater_index];
		$repeater_values = array_merge($default_row_values, $repeater_values);

		$overlay_bg_rgba = 'rgba('.esc_attr(implode(',', page_builder_hex2rgb($repeater_values['overlay_bg_color'])).','.$repeater_values['overlay_bg_opacity']).')';

		$image = null;
		if (!empty($repeater_values['image'])) {
			$image = wp_get_attachment_image_src($repeater_values['image'], apply_filters('page_builder_staff_list_image_size', 'full'));
		}

		if (!empty($image[0])) {
			echo '  <div class="pb_staff_list-item pb_staff_list-item-'.esc_attr($widget_index.'-'.$i).' has-image">';
			echo '<img src="'.esc_attr($image[0]).'" alt="" class="pb_staff_list-image" />';
		} else {
			echo '  <div class="pb_staff_list-item pb_staff_list-item-'.esc_attr($widget_index.'-'.$i).' no-image" style="background-color: '.$overlay_bg_rgba.'">';
		}

		if ($repeater_values['label']) {
			echo '<div class="pb_staff_list-label" style="background-color: '.esc_attr($repeater_values['label_bg_color']).';">'.esc_html($repeater_values['label']).'</div>';
		}

		echo '<div class="pb_staff_list-overlay" style="background-color: '.$overlay_bg_rgba.'">';

		if ($repeater_values['name']) {
			echo '<h3 class="pb_staff_list-name pb_font_family_'.esc_attr($repeater_values['name_font_family']).'" style="color: '.esc_attr($repeater_values['name_font_color']).'; font-size: '.esc_attr($repeater_values['name_font_size']).'px;">'.esc_html($repeater_values['name']).'</h3>';
		}

		if ($repeater_values['position']) {
			echo '<h4 class="pb_staff_list-position pb_font_family_'.esc_attr($repeater_values['position_font_family']).'" style="color: '.esc_attr($repeater_values['position_font_color']).'; font-size: '.esc_attr($repeater_values['position_font_size']).'px;">'.esc_html($repeater_values['position']).'</h4>';
		}

		if ($repeater_values['facebook_url'] || $repeater_values['twitter_url'] || $repeater_values['instagram_url'] || $repeater_values['rss_url']) {
			echo '<ul class="pb_staff_list-social">';

			if ($repeater_values['facebook_url']) {
				echo '<li class="pb_staff_list-social-facebook"><a href="'.esc_attr($repeater_values['facebook_url']).'" target="_blank"></a></li>';
			}
			if ($repeater_values['twitter_url']) {
				echo '<li class="pb_staff_list-social-twitter"><a href="'.esc_attr($repeater_values['twitter_url']).'" target="_blank"></a></li>';
			}
			if ($repeater_values['instagram_url']) {
				echo '<li class="pb_staff_list-social-instagram"><a href="'.esc_attr($repeater_values['instagram_url']).'" target="_blank"></a></li>';
			}
			if ($repeater_values['rss_url']) {
				echo '<li class="pb_staff_list-social-rss"><a href="'.esc_attr($repeater_values['rss_url']).'" target="_blank"></a></li>';
			}

			echo '</ul>';
		}

		if ($repeater_values['description']) {
			echo '<div class="pb_staff_list-description" style="color: '.esc_attr($repeater_values['description_font_color']).'; font-size: '.esc_attr($repeater_values['description_font_size']).'px;">'.str_replace(array("\r\n", "\r", "\n"), '<br>', esc_html($repeater_values['description'])).'</div>';
		}

		echo '</div>';

		echo '</div>'."\n";
	}

	echo '</div>'."\n";

	echo '<div class="pb_staff_list-mobile">'."\n";
	echo '  <ul class="pb_staff_list-tab">';

	$i = 0;
	foreach($repeater_indexes as $repeater_index) {
		$i++;
		$repeater_values = $values['repeater'][$repeater_index];
		$repeater_values = array_merge($default_row_values, $repeater_values);
		if (!$repeater_values['label_mobile'] && !$repeater_values['name']) {
			continue;
		}

		if ($i == 1) {
			$active = ' active';
		} else {
			$active = '';
		}

		if ($repeater_values['label_mobile']) {
			echo '<li class="pb_staff_list-label'.$active.'"><a href="#pb_staff_list-item-'.esc_attr($widget_index.'-'.$i).'">'.esc_html($repeater_values['label_mobile']).'</a></li>';
		} elseif ($repeater_values['name']) {
			echo '<li class="pb_staff_list-label'.$active.'"><a href="#pb_staff_list-item-'.esc_attr($widget_index.'-'.$i).'">'.esc_html($repeater_values['name']).'</a></li>';
		}
	}

	echo '</ul>'."\n";

	$i = 0;
	foreach($repeater_indexes as $repeater_index) {
		$i++;
		$repeater_values = $values['repeater'][$repeater_index];
		$repeater_values = array_merge($default_row_values, $repeater_values);

		if (!$repeater_values['label_mobile'] && !$repeater_values['name']) {
			continue;
		}

		if ($i == 1) {
			$active = ' active';
		} else {
			$active = '';
		}

		$image = null;
		if (!empty($repeater_values['image'])) {
			$image = wp_get_attachment_image_src($repeater_values['image'], apply_filters('page_builder_staff_list_large_image_size', 'full'));
		}

		echo '  <div id="pb_staff_list-item-'.esc_attr($widget_index.'-'.$i).'" class="pb_staff_list-item'.$active.'">';

		if (!empty($image[0])) {
			echo '<img src="'.esc_attr($image[0]).'" alt="" class="pb_staff_list-image" />';
		}

		if ($repeater_values['name']) {
			echo '<h3 class="pb_staff_list-name pb_font_family_'.esc_attr($repeater_values['name_font_family']).'">'.esc_html($repeater_values['name']).'</h3>';
		}

		if ($repeater_values['position']) {
			echo '<h4 class="pb_staff_list-position pb_font_family_'.esc_attr($repeater_values['position_font_family']).'">'.esc_html($repeater_values['position']).'</h4>';
		}

		if ($repeater_values['facebook_url'] || $repeater_values['twitter_url'] || $repeater_values['instagram_url'] || $repeater_values['rss_url']) {
			echo '<ul class="pb_staff_list-social">';

			if ($repeater_values['facebook_url']) {
				echo '<li class="pb_staff_list-social-facebook"><a href="'.esc_attr($repeater_values['facebook_url']).'" target="_blank"></a></li>';
			}
			if ($repeater_values['twitter_url']) {
				echo '<li class="pb_staff_list-social-twitter"><a href="'.esc_attr($repeater_values['twitter_url']).'" target="_blank"></a></li>';
			}
			if ($repeater_values['instagram_url']) {
				echo '<li class="pb_staff_list-social-instagram"><a href="'.esc_attr($repeater_values['instagram_url']).'" target="_blank"></a></li>';
			}
			if ($repeater_values['rss_url']) {
				echo '<li class="pb_staff_list-social-rss"><a href="'.esc_attr($repeater_values['rss_url']).'" target="_blank"></a></li>';
			}

			echo '</ul>';
		}

		if ($repeater_values['description']) {
			echo '<div class="pb_staff_list-description">'.str_replace(array("\r\n", "\r", "\n"), '<br>', esc_html($repeater_values['description'])).'</div>';
		}

		echo '</div>'."\n";
	}

	echo '</div>'."\n";
}

/**
 * フロント用js・css
 */
function page_builder_widget_staff_list_sctipts() {
	wp_enqueue_script('page_builder-staff_list', get_template_directory_uri().'/pagebuilder/assets/js/staff_list.js', array('jquery'), PAGE_BUILDER_VERSION, true);
}

function page_builder_widget_staff_list_styles() {
	wp_enqueue_style('page_builder-staff_list', get_template_directory_uri().'/pagebuilder/assets/css/staff_list.css', false, PAGE_BUILDER_VERSION);
}

function page_builder_widget_staff_list_sctipts_styles() {
	if (is_singular() && is_page_builder() && page_builder_has_widget('pb-widget-staff-list')) {
		add_action('wp_enqueue_scripts', 'page_builder_widget_staff_list_sctipts', 11);
		add_action('wp_enqueue_scripts', 'page_builder_widget_staff_list_styles', 11);
		add_action('page_builder_css', 'page_builder_widget_staff_list_css');
	}
}
add_action('wp', 'page_builder_widget_staff_list_sctipts_styles');

function page_builder_widget_staff_list_css() {
	// 現記事で使用しているstaff_listコンテンツデータを取得
	$post_widgets = get_page_builder_post_widgets(get_the_ID(), 'pb-widget-staff-list');
	if ($post_widgets) {
		// テーマオプション カラー反映
		$primary_color = page_builder_get_primary_color('#ffffff');
		echo ' .pb_staff_list-social li a:hover { color: '.esc_attr($primary_color).' !important; }'."\n";
	}
}
