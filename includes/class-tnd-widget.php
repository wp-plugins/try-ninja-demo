<?php
/**
 * create the Try Ninja Demo widget
 */
if ( ! defined( 'ABSPATH' ) ) exit; // no accessing this file directly


class TND_Widget extends WP_Widget
{

	/**
	 * important information about the widget
	 */
	public function __construct() {

		// build widget specifics
		$widget_ops = array( 
			'classname'		=> 'try-ninja-demo-widget', 
			'description'	=> __( 'Use this widget to output the Ninja Demo sign-in form and display content based on whether or not the user is inside the demo.', 'tnd' ) 
		);
		$control_ops = array( 
			'width'		=> 400, 
			'height'	=> 350
		);

		// outputs the content of the widget
		parent::__construct( 
			'tnd_widget',
			__( 'Try Ninja Demo', 'tnd' ),
			 $widget_ops,
			 $control_ops
		);
	}	

	/**
	 * outputs the content of the widget
	 */
	public function widget( $args, $instance ) {
		extract($args);

		// outputs the options form on admin
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		/**
		 * filter the content of the TND widget
		 */
		$sandbox_text = 
			apply_filters( 'widget_text', empty( $instance['sandbox_text'] ) ? '' : $instance['sandbox_text'], $instance );
		$not_sandbox_text = 
			apply_filters( 'widget_text', empty( $instance['not_sandbox_text'] ) ? '' : $instance['not_sandbox_text'], $instance );

		echo $before_widget;
		if ( ! empty( $title ) ) { 
			echo $before_title . $title . $after_title; 
		}

		// swap output based on sandbox status
		if ( ! Ninja_Demo()->is_sandbox() ) { // the user is NOT inside of a sandbox ?>
			<div class="textwidget tnd-widget">
				<div class="tnd-widget-content tnd-not-in-demo">
					<?php echo ! empty( $instance['filter'] ) ? wpautop( $not_sandbox_text ) : $not_sandbox_text; ?>
				</div>
				<?php echo do_shortcode('[try_demo]'); ?>
			</div>
			<?php
		} else { // the user is inside of a sandbox ?>
			<div class="textwidget tnd-widget">
				<div class="tnd-widget-content tnd-in-demo">
					<?php echo ! empty( $instance['filter'] ) ? wpautop( $sandbox_text ) : $sandbox_text; ?>
				</div>
			</div>
			<?php
		}
		echo $after_widget;
	}	

	/**
	 * processing widget options on save
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['sandbox_text']		=  $new_instance['sandbox_text'];
			$instance['not_sandbox_text']	=  $new_instance['not_sandbox_text'];
		} else {
			// wp_filter_post_kses() expects slashed
			$instance['sandbox_text']		= stripslashes( wp_filter_post_kses( addslashes( $new_instance['sandbox_text'] ) ) );
			$instance['not_sandbox_text']	= stripslashes( wp_filter_post_kses( addslashes( $new_instance['not_sandbox_text'] ) ) );
		}
		$instance['filter'] = isset( $new_instance['filter'] );
		return $instance;
	}	

	/**
	 * outputs the options form on admin
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 
			'title'				=> '', 
			'sandbox_text'		=> '', 
			'not_sandbox_text'	=> ''
		) );
		$title = strip_tags( $instance['title'] );
		$sandbox_text		= esc_textarea( $instance['sandbox_text'] );
		$not_sandbox_text	= esc_textarea( $instance['not_sandbox_text'] );
		?>

		<!-- The Title Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tnd' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<!-- For users who are not inside the demo yet -->
		<p>
			<label for="<?php echo $this->get_field_id( 'not_sandbox_text' ); ?>"><?php _e( 'User IS NOT inside the demo:', 'tnd' ); ?></label>
			<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'not_sandbox_text' ); ?>" name="<?php echo $this->get_field_name( 'not_sandbox_text' ); ?>"><?php echo $not_sandbox_text; ?></textarea>
		</p>

		<!-- For users who are inside the demo -->
		<p>
			<label for="<?php echo $this->get_field_id( 'sandbox_text' ); ?>"><?php _e( 'User IS inside the demo:', 'tnd' ); ?></label>
			<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'sandbox_text' ); ?>" name="<?php echo $this->get_field_name( 'sandbox_text' ); ?>"><?php echo $sandbox_text; ?></textarea>
		</p>

		<!-- Add paragraphs... or nah? -->
		<p>
			<input id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox" <?php checked( isset($instance['filter'] ) ? $instance['filter'] : 0); ?> />&nbsp;
			<label for="<?php echo $this->get_field_id( 'filter' ); ?>">
				<?php _e( 'Automatically add paragraphs', 'tnd' ); ?>
			</label>
		</p>
		<?php
	}
}

// register TND_Widget widget
function tnd_register_widget() {
	register_widget( 'TND_Widget' );
}
add_action( 'widgets_init', 'tnd_register_widget' );