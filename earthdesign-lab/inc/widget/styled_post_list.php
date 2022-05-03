<?php
/**
 * Styled post list (tcd ver)
 */
class Styled_Post_List_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array( 
			'classname' => 'styled_post_list_widget',
			'description' => __( 'Displays styled post list.', 'tcd-w' )
		);

		parent::__construct(
			'styled_post_list_widget', // ID
			__( 'Styled post list (tcd ver)', 'tcd-w' ), // Name
			$widget_ops
		);

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$options = get_design_plus_option();

		$title = apply_filters( 'widget_title', $instance['title'] );
   	$post_type = $instance['post_type'];
		$post_num = $instance['post_num'];
   	$show_date = $instance['show_date'];
   	$post_order = $instance['post_order'];
		$order = 'date2' == $post_order ? 'ASC' : 'DESC';

   	if ( 'date1' == $post_order || 'date2' == $post_order ) { 
			$orderby = 'date'; 
		}

   	if ( 'recent_post' == $post_type ) {
    	$post_args = array(
				'post_type' => 'post', 
				'posts_per_page' => $post_num, 
				'ignore_sticky_posts' => 1, 
				'orderby' => $post_order, 
				'order' => $order
			);
   	} else {
     	$post_args = array(
				'post_type' => 'post', 
				'posts_per_page' => $post_num, 
				'ignore_sticky_posts' => 1, 
				'orderby' => $post_order, 
				'order' => $order, 
				'meta_key' => $post_type, 
				'meta_value' => 'on'
			);
   	}
   	$post_list= new WP_Query( $post_args );

   	echo $args['before_widget'];
   	
		if ( $title ) { 
			echo $args['before_title'] . $title . $args['after_title']; 
		}
		?>
		<ul class="p-widget-post-list">
		<?php
   	if ( $post_list->have_posts() ) :
    	while ( $post_list->have_posts() ) : 
				$post_list->the_post();
		?>
			<li class="p-widget-post-list__item u-clearfix">
				<a href="<?php the_permalink(); ?>" class="p-widget-post-list__item-image p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'size4' ); 
					} else {
						echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-400x400.gif" alt="">';
					}
					?>
				</a>
				<h3 class="p-widget-post-list__item-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 25, '...' ); ?></a></h3>
				<?php if ( $show_date ) : ?>
				<time class="p-widget-post-list__item-date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
				<?php endif; ?>
 			</li>
		<?php 
			endwhile;
			wp_reset_postdata();
		else :
		?>
			<li class="p-widget-post-list__item p-widget-post-list__item--no-post"><?php _e( 'There is no registered post.', 'tcd-w' ); ?></li>
		<?php endif; ?>
		</ul>
		<?php
   	echo $args['after_widget'];		
	} 

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */	
	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$post_num = isset( $instance['post_num'] ) ? $instance['post_num'] : 5;
		$post_order = isset( $instance['post_order'] ) ? $instance['post_order'] : 'date1';
		$post_type = isset( $instance['post_type'] ) ? $instance['post_type'] : 'recent_post';
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : 0;
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tcd-w' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>'" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Post type:', 'tcd-w' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'post_type'); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" class="widefat">
				<option value="recent_post" <?php selected( $post_type, 'recent_post' ); ?>><?php _e( 'Recent post', 'tcd-w' ); ?></option>
				<option value="recommend_post" <?php selected( $post_type, 'recommend_post' ); ?>><?php _e( 'Recommend post1', 'tcd-w' ); ?></option>
				<option value="recommend_post2" <?php selected( $post_type, 'recommend_post2' ); ?>><?php _e( 'Recommend post2', 'tcd-w' ); ?></option>
				<option value="recommend_post3" <?php selected( $post_type, 'recommend_post3' ); ?>><?php _e( 'Recommend post3', 'tcd-w' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_num' ); ?>"><?php _e( 'Number of post:', 'tcd-w' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'post_num' ); ?>" name="<?php echo $this->get_field_name( 'post_num' ); ?>" class="widefat">
				<?php
				for ( $i = 1; $i <= 10; $i++ ) {
					echo '<option value="' . $i . '" ' . selected( $post_num, $i ) . '>' . $i . '</option>' . "\n"; 
				}
				?>
 			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e( 'Post order:', 'tcd-w' ); ?></label>
 			<select id="<?php echo $this->get_field_id( 'post_order' ); ?>" name="<?php echo $this->get_field_name( 'post_order' ); ?>" class="widefat">
				<option value="date1" <?php selected( $post_order, 'date1' ); ?>><?php _e( 'Date (DESC)', 'tcd-w' ); ?></option>
  				<option value="date2" <?php selected( $post_order, 'date2' ); ?>><?php _e( 'Date (ASC)', 'tcd-w' ); ?></option>
  				<option value="rand" <?php selected( $post_order, 'rand' ); ?>><?php _e( 'Random', 'tcd-w' ); ?></option>
			</select>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" type="checkbox" value="1" <?php checked( $show_date, 1 ); ?>>
 			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display date', 'tcd-w' ); ?></label>
		</p>
		<?php
 	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_num'] = strip_tags( $new_instance['post_num'] );
		$instance['post_order'] = strip_tags( $new_instance['post_order'] );
  	$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		$instance['show_date'] = strip_tags( $new_instance['show_date'] );
		return $instance;
	}
}

// register Styled_Post_List_Widget widget
function register_styled_post_list_widget() {
	register_widget( 'Styled_Post_List_Widget' );
}
add_action( 'widgets_init', 'register_styled_post_list_widget' );
