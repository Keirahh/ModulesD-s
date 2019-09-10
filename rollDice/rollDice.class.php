<?php

include'dice.class.php';

Class rollDice_Widget extends WP_Widget {

	function __construct(){
		parent::__construct(
			'rollDice',
			__('rollDice', ' rollDice_widget_domain'),
			array( 'description' => __( 'rollDice Widget Tutorial', 'rollDice_widget_domain' ), )
		);

	}
	// affichage widget dans le tableau de bord
	public function form($instance) {
		if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
		else
			$title = __( 'Default Title', 'rollDice_widget_domain' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}


	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
//si le titre est présent
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
//Formulaire du widget
		include 'form/form.php';
		echo $args['after_widget'];

	}

	static function install(){
		global $wpdb;
		$table_name = $wpdb->prefix . "lancerDes";
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'")!= $table_name) {
			$sql = "CREATE TABLE `$table_name`
			(
			`id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`jet` text COLLATE utf8mb4_unicode_ci NOT NULL,
			`userid` int(11) NOT NULL)
			ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);
		} 
	}

	static function uninstall(){
		global $wpdb;
		$table_name = $wpdb->prefix . "lancerDes";
		$wpdb->query( "DROP TABLE IF EXISTS $table_name" );
	}

	public function addData(){
		$classDice = new dice;
		$jet = $classDice->getRolls();
		$userId = get_current_user_id();
		global $wpdb;
		$table_name = $wpdb->prefix . "lancerDes";
		$test = $wpdb->insert($table_name, array('jet' => $jet, 'userid' => $userId));
	}

	public function traitement(){
		$classDice = new dice;
		$funct = $classDice->getRolls();

	}

}