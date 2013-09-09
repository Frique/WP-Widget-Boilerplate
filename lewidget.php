<?php
class boilerplate_widget extends WP_Widget{

	function __construct(){
		parent::__construct(
			'boilerplate_widget', // Widget ID
			'Boilerplate Widget', // Full widget name
			array( // Array of extra args
				'classname' => 'boilerplate-widget',
				'description' => 'Frique boilerplate widget'
			)
		);
	}

	// Register this widget (called from widgets_init filter)
	function register_me(){
		register_widget('boilerplate_widget');
	}

	// Outputs the options form in admin area
	function form($instance){
		// Default values
		$defaults = array(
			'option1' => 'Option 1',
			'option2' => 'Option 2'
		);
		$instance = wp_parse_args($instance, $defaults);

		include(plugin_dir_path(__FILE__).'views/boilerplate_widget_admin.php');
	}

	// Processes widget options to be saved
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['option1'] = strip_tags($new_instance['option1']);
		$instance['option2'] = strip_tags($new_instance['option2']);
		return $instance;
	}

	// Outputs the content of the widget
	function widget($args, $instance){
		echo $args['before_widget'];
		include(plugin_dir_path(__FILE__).'views/boilerplate_widget_frontend.php');
		echo $args['after_widget'];
	}

}
add_action('widgets_init', array('boilerplate_widget', 'register_me'));
?>