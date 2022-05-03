<?php
/**
 * Add a meta box of the page header
 */
$ph_fields = array(
	array( 
		'id' => 'ph_image',
		'title' => __( 'Background image', 'tcd-w' ),
		'type' => 'image',
		'description' => __( 'Recommend image size. Width:1450px, Height:600px', 'tcd-w' ),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'ph_catch',
		'title' => __( 'Catchphrase', 'tcd-w' ),
		'type' => 'textarea',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'ph_catch_font_size',
		'title' => __( 'Font size of catchphrase', 'tcd-w' ),
		'type' => 'number',
		'unit' => 'px',
		'default' => 40,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'ph_color',
		'title' => __( 'Font color of catchphrase', 'tcd-w' ),
		'type' => 'color',
		'default' => '#ffffff',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'ph_bg_color',
		'title' => __( 'Background color of catchphrase', 'tcd-w' ),
		'type' => 'color',
		'default' => '#222222',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'ph_bg_opacity',
		'title' => __( 'Opacity of background color', 'tcd-w' ),
		'type' => 'number',
		'description' => __( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ),
		'step' => 0.1,
		'default' => 1.0,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	)
);
$ph_args = array(
	'id' => 'ph_meta_box',
	'title' => __( 'Page header settings', 'tcd-w' ),
	'screen' => array( 'page', 'plan' ),
	'fields' => $ph_fields
); 
$ph_meta_box = new TCD_Meta_Box( $ph_args );
