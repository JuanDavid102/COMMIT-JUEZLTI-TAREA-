<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    JuezLTICommit
 * @subpackage JuezLTICommit/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    JuezLTICommit
 * @subpackage JuezLTICommit/includes
 * @author     Your Name <email@example.com>
 */
class JuezLTICommit {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      JuezLTICommit_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $JuezLTICommit    The string used to uniquely identify this plugin.
	 */
	protected $JuezLTICommit;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'JuezLTICommit_VERSION' ) ) {
			$this->version = JuezLTICommit_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->JuezLTICommit = 'JuezLTICommit';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		$this->define_commit_types();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - JuezLTICommit_Loader. Orchestrates the hooks of the plugin.
	 * - JuezLTICommit_i18n. Defines internationalization functionality.
	 * - JuezLTICommit_Admin. Defines all hooks for the admin area.
	 * - JuezLTICommit_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-JuezLTICommit-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-JuezLTICommit-i18n.php';

        /**
         * The class responsible for defining new Commit Type
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-JuezLTICommit-COMMIT-type.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-JuezLTICommit-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-JuezLTICommit-public.php';

		/**
		 * The class responsible for defining shortcode.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-JuezLTICommit-shortcode.php';

		/**
		 * Clase responsable de gestionar las opciones.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-JuezLTICommit-options.php';

		/**
         * La clase responsable de la definición del widget de subscripción.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-JuezLTIWidgetInteresados.php';

		$this->loader = new JuezLTICommit_Loader();

	}

    /**
     * Register Commit Type.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_commit_types() {
        // Register custom post types
        $Commit_Type = new JuezLTICommit_COMMIT_type();
    }

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the JuezLTICommit_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new JuezLTICommit_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new JuezLTICommit_Admin( $this->get_JuezLTICommit(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        $this->loader->add_action( 'admin_post_nopriv_JuezLTICommit_suscribe', $plugin_admin, 'JuezLTICommit_suscribe' );
        $this->loader->add_action( 'admin_post_JuezLTICommit_suscribe', $plugin_admin, 'JuezLTICommit_suscribe' );

		$plugin_shortcode = new JuezLTICommit_shortcode();

		$this->loader->add_action( 'init', $plugin_shortcode, 'JuezLTICommit_shortcode_init' );
		// Creando una entrada nueva en el menú Jobs
        $plugin_options = new JuezLTICommit_Options();

		$this->loader->add_action( 'admin_menu', $plugin_options, 'JuezLTICommit_options_menu' );
		$this->loader->add_action( 'admin_init', $plugin_options, 'JuezLTICommitRegistraOpciones');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new JuezLTICommit_Public( $this->get_JuezLTICommit(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_JuezLTICommit() {
		return $this->JuezLTICommit;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    JuezLTICommit_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
