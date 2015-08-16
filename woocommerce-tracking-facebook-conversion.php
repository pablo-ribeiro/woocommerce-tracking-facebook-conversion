<?php
/**
 * Plugin Name: WooCommerce Tracking Facebook Conversion
 * Plugin URI: http://www.pabloribeiro.net
 * Description: Plugin send conversion for facebook ads. Confira a versão premium de nossos plugins em <a href="http://www.magmastore.com.br/">http://www.magmastore.com.br/</a>.
 * Version: 1.0.0
 * Author: agenciamagma, Pablo Ribeiro, Carlos Cardoso Dias
 * Author URI: http://agenciamagma.com.br
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit;
}

if(!class_exists('AG_Magma_Tracking_Facebook_Conversion')):

class AG_Magma_Tracking_Facebook_Conversion {

    const VERSION = '1.0.0';

    private static $instance = null;

    public static function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

	public function __construct() {
        if (class_exists('WC_Integration')) {
            add_filter('woocommerce_integrations', array($this, 'add_integration'));
            add_action('woocommerce_thankyou', array($this, 'fb_integration'));
        }
	}

    public function add_integration($integrations) {
        require_once('includes/class-track-facebook-conversion-integration.php');
        $integrations[] = 'WC_Integration_Track_Facebook_Conversion';
        return $integrations;
    }
    
	public function fb_integration($order_id) {
        $options = get_option('woocommerce_wc-integration-track-facebook-conversion_settings');
        $order = new WC_Order($order_id);

        if (!$order || !$options || !$options['facebook_code'] || !$options['facebook_currency']) {
            return;
        }

        include 'includes/facebook-code.php';
    }
}


/**
 * Initialize the plugin.
 */
add_action('plugins_loaded', array('AG_Magma_Tracking_Facebook_Conversion', 'get_instance'));

endif;
