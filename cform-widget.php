<?php

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class cform_widget extends WP_Widget {
	// Constructor 
	public function __construct() {
		$widget_ops = array( 'classname' => 'cform-sidebar', 'description' => __('Display your contact form in sidebar.', 'simple-contact-form') );
		parent::__construct( 'cform-widget', __('Simple Contact Form', 'simple-contact-form'), $widget_ops );
	}

	// Set widget and title in dashboard
	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'title' => '',
			'text' => '',
			'attributes' => ''
		));
		$title = !empty( $instance['title'] ) ? $instance['title'] : __('Simple Contact Form', 'simple-contact-form'); 
		$text = $instance['text'];
		$attributes = $instance['attributes'];
		?> 
		<p> 
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'simple-contact-form'); ?>:</label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" maxlength='50' value="<?php echo esc_attr( $title ); ?>">
 		</p> 
		
		
		<?php 
	}

	// Update widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Sanitize content
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = wp_kses_post( $new_instance['text'] );
		$instance['attributes'] = strip_tags( $new_instance['attributes'] );

		return $instance;
	}

	// Display widget with form in frontend 
	function widget( $args, $instance ) {
		echo $args['before_widget']; 

		if ( !empty( $instance['title'] ) ) { 
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title']; 
		} 
		if ( !empty( $instance['text'] ) ) { 
			echo '<div class="cform-sidebar-text">'.wpautop( wp_kses_post($instance['text']).'</div>');
		}

		$content = '[contact-widget ';
		if ( !empty( $instance['attributes'] ) ) { 
			$content .= $instance['attributes'];
		}
		$content .= ']';
		echo do_shortcode( $content );

		echo $args['after_widget']; 
	}
}

?>