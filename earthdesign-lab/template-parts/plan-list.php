<?php
$options = get_design_plus_option();
$plan_list_num = $options['plan_list_num'];
// $plan_list_num が 1 or 2 であれば、横長画像、3 or 4 であれば縦長画像
// 横長画像か縦長画像かでクラスを切り替える（スマホのスタイル調整に使用）
switch ( $plan_list_num ) {
	case '1' : 
	case '2' :
		$img_class = 'p-content02__item-img--horizontal';
		break;
	case '3' : 
	case '4' :
		$img_class = 'p-content02__item-img--vertical';
		break;
	default :
		$img_class = '';
		break;
}
$args = array(
	'post_status' => 'publish',
	'post_type' => 'plan',
	'posts_per_page' => -1,
	'no_found_rows' => true
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
?>
	<div class="p-content02" style="background-color: <?php echo esc_attr( $options['plan_list_overlay'] ); ?>;">
		<?php
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
		?>
		<article class="p-content02__item">
			<a href="<?php the_permalink(); ?>" class="p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
				<img class="p-content02__item-img <?php echo esc_attr( $img_class ); ?>" src="<?php echo esc_attr( wp_get_attachment_url( $post->plan_list_image, 'full' ) ); ?>" alt="">
				<div class="p-content02__item-content p-content02__item-content--<?php echo esc_attr( $options['plan_list_valign'] ); ?>">
					<h2 class="p-content02__item-title"><?php echo esc_html( $post->plan_list_catch ); ?></h2>
					<p class="p-content02__item-sub"><?php echo esc_html( $post->plan_list_sub ); ?></p>
				</div>
			</a>
		</article>
		<?php
		endwhile;
		wp_reset_postdata();
		?>
	</div>
<?php endif; ?>
