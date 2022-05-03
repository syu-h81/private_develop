<?php
/**
 * Add a meta box of the plan archive
 */
$plan_archive_fields = array(
	array( 
		'id' => 'plan_archive_image',
		'title' => __( 'Background image', 'tcd-w' ),
		'type' => 'image',
		'description' => __( 'Recommend image size. Width:725px, Height:600px', 'tcd-w' ),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'plan_archive_catch',
		'title' => __( 'Catchphrase', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'plan_archive_catch_font_size',
		'title' => __( 'Font size of catchphrase', 'tcd-w' ),
		'type' => 'number',
		'unit' => 'px',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'plan_archive_desc',
		'title' => __( 'Description', 'tcd-w' ),
		'type' => 'textarea',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'plan_archive_btn_label',
		'title' => __( 'Button label', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	)
);
$plan_archive_args = array(
	'id' => 'plan_archive_meta_box',
	'title' => __( 'Archive page settings', 'tcd-w' ),
	'screen' => array( 'plan' ),
	'fields' => $plan_archive_fields
); 
$plan_archive_meta_box = new TCD_Meta_Box( $plan_archive_args );
