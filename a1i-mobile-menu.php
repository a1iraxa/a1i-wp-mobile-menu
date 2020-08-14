<?php
/*
	Plugin Name: a1i Mobile Menu
	Plugin URI: https://github.com/a1iraxa/
	Description: ai1 Mobile Responsive Menu
	Version: 1.0
	Author: a1iraxa
	Author URI: https://github.com/a1iraxa/
	License: GPL v2
*/

define('DCM_PLUGIN_NAME',  'digitsol-custom-menu');
define('DCM_PLUGIN_VERSION', '1.0');
define('DCM_PLUGIN_BASE', plugin_dir_path(__FILE__));
define('DCM_PLUGIN_BASE_URL', plugin_dir_url(__FILE__));

define('DCM_PLUGIN_ASSETS', DCM_PLUGIN_BASE . '/assets');
define('DCM_PLUGIN_ASSETS_URL', DCM_PLUGIN_BASE_URL . 'assets');

define('DCM_PLUGIN_CLASSES', DCM_PLUGIN_BASE . '/classes');
define('DCM_PLUGIN_CLASSES_URL', DCM_PLUGIN_BASE_URL . '/classes');

class DigitSol_Custom_Menu
{

	/**
	 * Method run on plugin activation
	 */
	public static function plugin_activation()
	{
		// include nag class
		require_once(DCM_PLUGIN_CLASSES . '/digitsol-custom-navwalker.php');
	}

	/**
	 * Method render menu
	 */
	public static function render($logo_url)
	{
		?>
		<header id="header" class="header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-sm-12">
						<div class="logo-nav">
							<div class="header__logo">
								<a href="<?php echo esc_url(home_url('/')); ?>" class="header__home-link">
									<img src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>" class="header__logo-img">
								</a>
							</div>

							<?php
								wp_nav_menu(
									array(
										'theme_location'    => 'digitSol_Menu',
										'container'         => 'nav',
										'container_class'   => 'header__main-nav main-nav',
										'container_id'      => 'main-nav',
										'depth'             => 4,
										'menu_class'        => 'main-nav__menu',
										'menu_id'        	=> 'main-nav__menu',
										'fallback_cb'       => 'DigitSol_Custom_Navwalker::fallback',
										'walker'            => new DigitSol_Custom_Navwalker()
									)
								);
							?>

							<div class="main-nav-toggle"><i class="fas fa-bars"></i></div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<?php
	}

	/**
	 * Constructor
	 */
	public function __construct()
	{
		add_action('init', array($this, 'frontend_hooks'));
		add_action('after_setup_theme', array($this, 'dcm_register_custom_nav'));
		require_once(DCM_PLUGIN_CLASSES . '/digitsol-custom-navwalker.php');
	}

	/**
	 * Setup the frontend hooks
	 *
	 * @return void
	 */
	public function dcm_register_custom_nav()
	{
		register_nav_menu('digitSol_Menu', 'DigitSol Custom Manu');
	}

	/**
	 * Setup the frontend hooks
	 *
	 * @return void
	 */
	public function frontend_hooks()
	{
		// Don't run in admin or if the admin bar isn't showing
		if ( is_admin() ) {
			// return;
		}
		wp_enqueue_style('dcm-style', DCM_PLUGIN_ASSETS_URL . '/digitsol-custom-manu.css', array(), true);
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('dcm-script', DCM_PLUGIN_ASSETS_URL . '/digitsol-custom-manu.js', array(), DCM_PLUGIN_VERSION, true);
	}
}

/**
 * What The File main function
 */
function digitsol_custom_menu()
{
	new DigitSol_Custom_Menu();
}

// Init plugin
add_action('plugins_loaded', 'digitsol_custom_menu');
