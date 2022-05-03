<?php
/**
 * Add a meta box of the page header
 */
$splash_sub_box_fields = array();
for ( $i = 0; $i <= 1; $i++ ) {
	$splash_sub_box_fields[] = array(
		array(
			'id' => 'splash_content_type' . $i,
			'title' => __( 'Content type', 'tcd-w' ),
			'type' => 'radio',
			'default' => 'type1',
			'options' => array(
				array( 'value' => 'type1', 'label' => __( 'Image', 'tcd-w' ) ),
				array( 'value' => 'type2', 'label' => __( 'Text', 'tcd-w' ) )
			),
			'before_title' => '<h4 class="theme_option_headline2">',
			'after_title' => '</h4>'
		),
		array(
			'id' => 'splash_image' . $i,
			'title' => __( 'Image', 'tcd-w' ),
			'type' => 'image',
			'before_field' => '<div class="splash-img">',
			'after_field' => '</div>',
			'before_title' => '<h4 class="theme_option_headline2">',
			'after_title' => '</h4>'
		),
		array(
			'id' => 'splash_text' . $i,
			'title' => __( 'Text', 'tcd-w' ),
			'type' => 'textarea',
			'before_field' => '<div class="splash-text">',
			'after_field' => '</div>',
			'before_title' => '<h4 class="theme_option_headline2">',
			'after_title' => '</h4>'
		),
		array(
			'id' => 'splash_color' . $i,
			'title' => __( 'Font color', 'tcd-w' ),
			'type' => 'color',
			'default' => '#ffffff',
			'before_field' => '<div class="splash-text">',
			'after_field' => '</div>',
			'before_title' => '<h4 class="theme_option_headline2">',
			'after_title' => '</h4>'
		),
		array(
			'id' => 'splash_font_size' . $i,
			'title' => __( 'Font size', 'tcd-w' ),
			'type' => 'number',
			'default' => 34,
			'unit' => 'px',
			'before_field' => '<div class="splash-text">',
			'after_field' => '</div>',
			'before_title' => '<h4 class="theme_option_headline2">',
			'after_title' => '</h4>'
		),
		array(
			'id' => 'splash_font_size_sp' . $i,
			'title' => __( 'Font size for mobile', 'tcd-w' ),
			'type' => 'number',
			'default' => 34,
			'unit' => 'px',
			'before_field' => '<div class="splash-text">',
			'after_field' => '</div>',
			'before_title' => '<h4 class="theme_option_headline2">',
			'after_title' => '</h4>'
		),
		array(
			'id' => 'splash_font_type' . $i,
			'title' => __( 'Font type', 'tcd-w' ),
			'type' => 'radio',
			'default' => 'type1',
			'options' => array(
				array( 'value' => 'type1', 'label' => __( 'Meiryo', 'tcd-w' ) ),
				array( 'value' => 'type2', 'label' => __( 'YuGothic', 'tcd-w' ) ),
				array( 'value' => 'type3', 'label' => __( 'YuMincho', 'tcd-w' ) ),
			),
			'before_field' => '<div class="splash-text">',
			'after_field' => '</div>',
			'before_title' => '<h4 class="theme_option_headline2">',
			'after_title' => '</h4>'
		)
	);
	$cf_keys[] = 'splash_content_type' . $i;
	$cf_keys[] = 'splash_image' . $i;
	$cf_keys[] = 'splash_text' . $i;
	$cf_keys[] = 'splash_color' . $i;
	$cf_keys[] = 'splash_font_size' . $i;
	$cf_keys[] = 'splash_font_size_sp' . $i;
	$cf_keys[] = 'splash_font_type' . $i;
}
$splash_fields = array(
	array( 
		'id' => 'splash_display',
		'title' => __( 'Display settings', 'tcd-w' ),
		'type' => 'checkbox',
		'options' => array(
			array(
				'value' => 1,
				'label' => __( 'Display splash page on PC', 'tcd-w' )
			)
		),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'splash_display_mobile',
		'title' => __( 'Display settings for mobile device', 'tcd-w' ),
		'type' => 'checkbox',
		'options' => array(
			array(
				'value' => 1,
				'label' => __( 'Display splash page on mobile device', 'tcd-w' )
			)
		),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'title' => __( 'Contents settings', 'tcd-w' ),
		'type' => 'sub_box',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">',
		'labels' => array( // 各 sub_box の見出し
			__( 'Upper part', 'tcd-w' ), 
			__( 'Lower part', 'tcd-w' ) 
		),
		'fields' => $splash_sub_box_fields
	),
	array( 
		'id' => 'splash_bg',
		'title' => __( 'Background color', 'tcd-w' ),
		'type' => 'color',
		'default' => '#222222',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'splash_bg_opacity',
		'title' => __( 'Opacity of background color', 'tcd-w' ),
		'type' => 'number',
		'description' => __( 'Please enter the number 0 - 1.0. (e.g. 0.7)', 'tcd-w' ),
		'step' => 0.1,
		'default' => 1.0,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'splash_bg_image',
		'title' => __( 'Background image', 'tcd-w' ),
		'type' => 'image',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'splash_display_time',
		'title' => __( 'Display time', 'tcd-w' ),
		'type' => 'select',
		'description' => __( 'Setting the time to shift to the plan page after completion of logo / catch phrase', 'tcd-w' ),
		'options' => array(
			array( 'value' => 1, 'label' => 1 . __( ' seconds', 'tcd-w' ) ),
			array( 'value' => 2, 'label' => 2 . __( ' seconds', 'tcd-w' ) ),
			array( 'value' => 3, 'label' => 3 . __( ' seconds', 'tcd-w' ) ),
			array( 'value' => 4, 'label' => 4 . __( ' seconds', 'tcd-w' ) ),
			array( 'value' => 5, 'label' => 5 . __( ' seconds', 'tcd-w' ) ),
		),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content npd">'
	),
);
$splash_args = array(
	'id' => 'splash_meta_box',
	'title' => __( 'Splash page settings', 'tcd-w' ),
	'screen' => array( 'page', 'plan' ),
	'fields' => $splash_fields,
	'cf_keys' => $cf_keys
); 

$splash_meta_box = new TCD_Meta_Box( $splash_args );

/**
 * Manage the splash page.
 */
class TCD_Splash_Page {

	/**
	 * Cookie value of tcd_referrer
	 *
	 * @var string
	 */
	protected $tcd_referrer = '';

	public function __construct( $tcd_referrer ) {

		$this->tcd_referrer = esc_url( $tcd_referrer );

		add_action( 'wp_head', array( $this, 'add_splash_preload_images' ), 1 ); // 優先順位を1にする
		add_action( 'wp_footer', array( $this, 'add_splash_div' ), 1 ); // 優先順位を1にする

	}

	/**
 	 * 画像のpreloadにlinkタグを追加
 	 */
	public function add_splash_preload_images() {

		global $post;
		$options = get_design_plus_option();
		
		// フロントページ、固定ページ、プラン詳細のみ処理を行う
		if ( ! ( is_front_page() || is_page() || is_singular( 'plan' ) ) ) { return; }
	
		if ( is_front_page() ) {
			$content_type0 = $options['splash_content_type0'];
			$content_type1 = $options['splash_content_type1'];
			$img0 = $options['splash_image0'];
			$img1 = $options['splash_image1'];
			$bg_image = $options['splash_bg_image'];
		} else {
			$content_type0 = get_post_meta( $post->ID, 'splash_content_type0', true );
			$content_type1 = get_post_meta( $post->ID, 'splash_content_type1', true );
			$img0 = get_post_meta( $post->ID, 'splash_image0', true );
			$img1 = get_post_meta( $post->ID, 'splash_image1', true );
			$bg_image = $post->splash_bg_image;
		}

		if ( 'type1' === $content_type0 && $img0 ) { 
			echo '<link rel="preload" href="' . esc_attr( wp_get_attachment_url( $img0 ) ) . '" as="image">' . "\n";
		}
		if ( 'type1' === $content_type1 && $img1 ) { 
			echo '<link rel="preload" href="' . esc_attr( wp_get_attachment_url( $img1 ) ) . '" as="image">' . "\n";
		}
		if ( $bg_image ) {
			echo '<link rel="preload" href="' . esc_attr( wp_get_attachment_url( $bg_image ) ) . '" as="image">' . "\n";
		}
	}

	/**
	 * Check if it is a page to display a splash page
	 */
	function is_splash_page() {
	
		global $post;
		$options = get_design_plus_option();
		$is_splash_page = false;
	
		// get $_SERVER['HTTP_REFERER']
		$http_referrer =  isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '';
		$current_url = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	
		if ( is_front_page() && (($options['display_splash']&&!is_mobile())||($options['display_splash_mobile']&&is_mobile())) ) {
	
			if ( $this->tcd_referrer ) {
				
				if ( $this->tcd_referrer === $current_url ) {
	
					// tcd_referrer と current_url が等しいなら、
					// フロントページ=>外部=>フロントページか、フロントページ=>フロントページ、リロードのいずれかなので、
					// スプラッシュページを表示
					$is_splash_page = true;
	
				} elseif ( $this->tcd_referrer !== $http_referrer ) {
					
					// tcd_referrer と http_referrer が異なる時は、
					// 外部ページからのアクセスなので、
					// スプラッシュページを表示
					// これは、http_referrer が空の時を含む
					$is_splash_page = true;
	
				}
	
			} else {
	
				// tcd_referrer が空なら、最初のアクセスなので、スプラッシュページを表示
				$is_splash_page = true;
	
			}
	
		} elseif ( ( is_page() || is_singular( 'plan' ) ) && ((!is_mobile()&&$post->splash_display)||(is_mobile()&&$post->splash_display_mobile)) ) {
			$is_splash_page = true;
		}
	
		return $is_splash_page;
	
	}

	public function add_splash_div() {
	
		$options = get_design_plus_option();
		
		// ロード画面を使用せず、スプラッシュページを表示する場合は</div>を</footer>の後ろに追加する
		if ( ! $options['use_load_icon'] && $this->is_splash_page() ) {
			echo '</div>' . "\n";
		}

	}

}
