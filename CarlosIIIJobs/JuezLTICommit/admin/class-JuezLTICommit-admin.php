<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    JuezLTICommit
 * @subpackage JuezLTICommit/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    JuezLTICommit
 * @subpackage JuezLTICommit/admin
 * @author     Your Name <email@example.com>
 */
class JuezLTICommit_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $JuezLTICommit    The ID of this plugin.
	 */
	private $JuezLTICommit;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $JuezLTICommit       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $JuezLTICommit, $version ) {

		$this->JuezLTICommit = $JuezLTICommit;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in JuezLTICommit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The JuezLTICommit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->JuezLTICommit, plugin_dir_url( __FILE__ ) . 'css/JuezLTICommit-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in JuezLTICommit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The JuezLTICommit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->JuezLTICommit, plugin_dir_url( __FILE__ ) . 'js/JuezLTICommit-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function JuezLTICommit_suscribe() {
		$suscriptores = get_option('JuezLTICommit_suscriptores');

		if(!in_array(htmlspecialchars($_POST["nombre"]), $suscriptores)) {

			$suscriptores[] = htmlspecialchars($_POST["nombre"]);
			update_option('JuezLTICommit_suscriptores', $suscriptores);
			$nombreSuscriptor = htmlspecialchars($_POST["nombre"]);
			$emailSuscriptor = htmlspecialchars($_POST["email"]);
			$logoUrlSuscriptor = htmlspecialchars($_POST["url_logo"]);

			if(!$this->getSuscriptor($nombreSuscriptor)) {
				$this->addSuscriptor($nombreSuscriptor, $emailSuscriptor, $logoUrlSuscriptor);
			}
		}

		wp_safe_redirect(site_url() );
	}

	public function getSuscriptor($nombreSuscriptor) {
		global $wpdb;
 
			$table_name = $wpdb->prefix . "JltiCSuscriptores";
				// convendría no duplicar este código
				// Una buena forma sería crear una constante en la clase CarlosIIIJobs con:
				// const C3JSUSCRIPTORES_TABLE = 'JltiCSuscriptores';
			$query = "SELECT count(nombre) FROM $table_name WHERE nombre = %s";
			$existeSuscriptor = $wpdb->get_var( $wpdb->prepare($query, $nombreSuscriptor)); 
			return $existeSuscriptor > 0;
	}
 
	public function addSuscriptor($nombreSuscriptor, $emailSuscriptor, $logoUrlSuscriptor) {
		global $wpdb;
 
			$table_name = $wpdb->prefix . "JltiCSuscriptores";
			$wpdb->insert(
				$table_name,
				array(
						'nombre' => $nombreSuscriptor,
						'email' => $emailSuscriptor,
						'url_logo' => $logoUrlSuscriptor,
						'time' => current_time('mysql', 2),
				),
				array('%s')
			);
	}

}
