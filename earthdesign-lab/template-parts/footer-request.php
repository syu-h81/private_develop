<?php $options = get_design_plus_option(); ?>
	<div id="js-request" class="p-request" style="background: <?php echo esc_attr( $options['request_bg'] ); ?>;">
		<?php if ( is_mobile() ) : ?><a href="<?php echo esc_url( $options['request_btn_url'] ); ?>"><?php endif; ?>
		<div class="p-request__inner">
			<p class="p-request__text" style="color: <?php echo esc_attr( $options['request_catch_color'] ); ?>;"><?php echo is_mobile() ? nl2br( esc_html( $options['request_catch'] ) ) : esc_html( $options['request_catch'] ); ?></p>
			<?php if ( ! is_mobile() ) : ?><a class="p-request__btn" href="<?php echo esc_url( $options['request_btn_url'] ); ?>" style="color: <?php echo esc_attr( $options['request_btn_label_color'] ); ?>;"><?php echo esc_html( $options['request_btn_label'] ); ?></a><?php endif; ?>
		</div>
		<?php if ( is_mobile() ) : ?></a><?php endif; ?>
		<button id="js-request__close" class="p-request__close"></button>
	</div>
