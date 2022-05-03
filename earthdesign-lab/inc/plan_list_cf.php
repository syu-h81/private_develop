<?php
/**
 * Add a meta box of the plan list
 */
$options = get_design_plus_option();

// プランリストの表示数に応じて推奨画像サイズを変更する
switch ( $options['plan_list_num'] ) {
	case 1 :
		$plan_list_image_desc = __( 'Recommend image size. Width:1450px, Height:600px', 'tcd-w' );
		break;
	case 2 :
		$plan_list_image_desc = __( 'Recommend image size. Width:725px, Height:600px', 'tcd-w' );
		break;
	case 3 :
		$plan_list_image_desc = __( 'Recommend image size. Width:483px, Height:600px', 'tcd-w' ); 
		break;
	case 4 :
		$plan_list_image_desc = __( 'Recommend image size. Width:363px, Height:600px', 'tcd-w' ); 
		break;
}

$plan_list_fields = array(
	array( 
		'id' => 'plan_list_image',
		'title' => __( 'Background image', 'tcd-w' ),
		'type' => 'image',
		'description' => $plan_list_image_desc,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'plan_list_catch',
		'title' => __( 'Catchphrase', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'plan_list_sub',
		'title' => __( 'Sub Title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	)
);
$plan_list_args = array(
	'id' => 'plan_list_meta_box',
	'title' => __( 'Plan list settings(Front page and Singular page)', 'tcd-w' ),
	'screen' => array( 'plan' ),
	'fields' => $plan_list_fields
); 
$plan_list_meta_box = new TCD_Meta_Box( $plan_list_args );
