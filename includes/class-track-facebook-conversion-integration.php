<?php
/**
 * Integration Track Facebook Conversion.
 *
 * @package  WC_Integration_Track_Facebook_Conversion
 * @category Integration
 * @author   Carlos Cardoso Dias
 */

if (!defined('ABSPATH')) {
    exit;
}

if(!class_exists('WC_Integration_Track_Facebook_Conversion')):

class WC_Integration_Track_Facebook_Conversion extends WC_Integration {

	public function __construct() {
		global $woocommerce;

		$this->id = 'wc-integration-track-facebook-conversion';
		$this->method_title = 'Track Facebook Conversion';
		$this->method_description = 'Monitoramento da conversão através do facebook.';
		
		$this->init_form_fields();
		$this->init_settings();

		$this->facebook_code = $this->get_option('facebook_code');
		$this->facebook_curency = $this->get_option('facebook_curency');

		add_action('woocommerce_update_options_integration_' . $this->id, array($this, 'process_admin_options'));
	}

	public function init_form_fields() {
		$this->form_fields = array(
			'facebook_code'     => array(
				'title'         => 'Código do Facebook',
				'type'          => 'decimal',
				'description'   => 'Obtenha este código através do facebook.',
				'default'       => ''
			),
			'facebook_currency' => array(
				'title'         => 'Moeda',
				'type'          => 'select',
				'options'       => array('BRL' => 'BRL', 'USD' => 'USD'),
				'description'   => 'Sua moeda local',
				'default'       => 'BRL'
			)
		);
	}
}

endif;