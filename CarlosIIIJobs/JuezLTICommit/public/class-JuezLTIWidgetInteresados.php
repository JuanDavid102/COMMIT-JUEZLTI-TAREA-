<?php

// Registrar y cargar el widget
function JuezLTICommitSuscribe_load_widget() {
    register_widget( 'JuezLTICommitWidgetSuscribe' );
}
add_action( 'widgets_init', 'JuezLTICommitSuscribe_load_widget' );

// Creando el widget
class JuezLTICommitWidgetSuscribe extends WP_Widget {

    function __construct() {
        parent::__construct(

            // ID base del widget
            'JuezLTICommitWidgetSuscribe',

            // Nombre del widget que aparecerá en la UI
            __('JuezLTICommit Suscribe Widget', 'JuezLTICommitSuscribe_widget_domain'),

            // Descripción del widget
            array( 'description' => __( 'Suscribirse para participar en el proyecto piloto, que se desarrollará durante el curso 2022/2023', 'JuezLTICommitSuscribe_widget_domain' ), )
        );
    }

// Creando la vista del widget del Frontend

    public function widget( $args, $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/JuezLTICommit-public-display.php';

        JuezLTICommitWidgetPublicForm($args, $instance);
    }


// Creando la vista del widget del Backend
    public function form( $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/JuezLTICommit-admin-display.php';


        JuezLTICommitWidgetAdminForm($instance, $this);
    }

// Actualizando el widget reemplazando la instancia antigua por la nueva
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class JuezLTICommitWidgetSuscribe ends here