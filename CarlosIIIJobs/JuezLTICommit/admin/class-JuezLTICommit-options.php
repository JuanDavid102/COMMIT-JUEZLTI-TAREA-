<?php
class JuezLTICommit_options {
    /**
     * Metodo para las opciones del menu
     */
    public function JuezLTICommit_options_menu() {
	    $hookname = add_submenu_page(
	        'edit.php?post_type=' . JuezLTICommit_commit_type::POST_TYPE,
	        __( 'Options del plugin JuezLTICommit', 'textdomain' ),
	        __( 'Commit Options', 'textdomain' ),
	        'manage_options',
	        'commit-options',
	        array( $this, 'commit_options_callback' )
	    );

	    add_action( 'load-' . $hookname, array($this, 'JuezLTICommit_save_options') );
	}
    

    function commit_options_callback() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/commit-options-form.php';
	}
    
    public function JuezLTICommitRegistraOpciones() {
		
        $opciones = array(
			array(
				'name' => 'nOfertas',
				'title' => 'N&uacute;mero de ofertas en Shortcode',
				'args' => array(
					'type' => 'integer',
					'default' => NULL,
				),
			),
		);

		foreach ($opciones as $opcion) {
		    register_setting( 'JuezLTICommit_options', $opcion['name'], $opcion['args'] );
		}

		add_settings_section( 'JuezLTICommit_options_section', 'Opciones', array($this, 'commit_options_section_callback'), 'commit-options');

		foreach ($opciones as $opcion) {
		    add_settings_field( $opcion['name'], $opcion['title'], array($this, 'commit_options_' . $opcion['name'] . '_callback'), 'commit-options', 'JuezLTICommit_options_section');
		}

	}

    public function commit_options_nOfertas_callback($args) {
    	echo '<input type="text" id="JuezLTICommit_options_nOfertas" name="JuezLTICommit_options_nOfertas" value="'. get_option('JuezLTICommit_options_nOfertas') .'">';
    }

    public function commit_options_section_callback( $arg ) {
        echo '<hr>';       // title: Example settings section in reading
    }

    public function JuezLTICommit_save_options() {
    	if ('POST' === $_SERVER['REQUEST_METHOD']) {
			update_option('JuezLTICommit_options_dominio', htmlspecialchars($_POST["JuezLTICommit_options_dominio"]));
			update_option('JuezLTICommit_options_nOfertas', htmlspecialchars($_POST["JuezLTICommit_options_nOfertas"]));
			wp_redirect( admin_url( 'edit.php?post_type=' . JuezLTICommit_commit_type::POST_TYPE) );
		}
    }
}
