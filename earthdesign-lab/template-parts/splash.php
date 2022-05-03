<?php
$options = get_design_plus_option(); 
if ( is_front_page() ) {
	$bg_image = $options['splash_bg_image'];
	$splash_bg = $options['splash_bg'];
	$splash_display_time = $options['splash_display_time'];
} elseif ( is_page() || is_singular( 'plan' ) ) {
	$bg_image = $post->splash_bg_image;
	$splash_bg = $post->splash_bg;
	$splash_display_time = $post->splash_display_time;
}
?>
<div id="js-splash" class="p-splash" style="background-color: <?php echo esc_attr( $splash_bg ); ?>;" data-display-time="<?php echo esc_attr( $splash_display_time ); ?>">
	<div class="p-splash__img" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url( $bg_image ) ); ?>);"></div>
	<div class="p-splash__inner l-inner">
		<?php
		if ( is_front_page() ) {
			for ( $i = 0; $i <= 1; $i++ ) {
				if ( 'type1' === $options['splash_content_type' . $i] && $options['splash_image' . $i] ) {
		?>
		<div class="p-splash__catch">
			<img src="<?php echo esc_attr( wp_get_attachment_url( $options['splash_image' . $i], 'full' ) ); ?>" alt="">
		</div>
		<?php	
				} else { // type2 
		?>
		<div class="p-splash__desc c-font--<?php echo esc_attr( $options['splash_desc_font_type' . $i] ); ?>" style="color: <?php echo esc_attr( $options['splash_color' . $i] ); ?>; font-size: <?php echo is_mobile() ? esc_attr( $options['splash_font_size_sp' . $i] ) : esc_attr( $options['splash_font_size' . $i] ); ?>px;"><?php echo nl2br( esc_html( $options['splash_text' . $i] ) ); ?></div>
		<?php
				}
			} 
		} else { // page, singular plan
			for ( $i = 0; $i <= 1; $i++ ) {
				if ( 'type1' === get_post_meta( $post->ID, 'splash_content_type' . $i, true ) && get_post_meta( $post->ID, 'splash_image' . $i, true ) ) {
		?>
		<div class="p-splash__catch">
			<img src="<?php echo esc_attr( wp_get_attachment_url( get_post_meta( $post->ID, 'splash_image' . $i, true ), 'full' ) ); ?>" alt="">
		</div>
		<?php	
				} else { // type2 
		?>
		<div class="p-splash__desc c-font--<?php echo esc_attr( get_post_meta( $post->ID, 'splash_font_type' . $i, true ) ); ?>" style="color: <?php echo esc_attr( get_post_meta( $post->ID, 'splash_color' . $i, true ) ); ?>; font-size: <?php echo is_mobile() ? esc_attr( get_post_meta( $post->ID, 'splash_font_size_sp' . $i, true ) ) : esc_attr( get_post_meta( $post->ID, 'splash_font_size' . $i, true ) ); ?>px;"><?php echo nl2br( esc_html( get_post_meta( $post->ID, 'splash_text' . $i, true ) ) ); ?></div>
		<?php
				}
			} 
		}
		?>
	</div>
</div>
