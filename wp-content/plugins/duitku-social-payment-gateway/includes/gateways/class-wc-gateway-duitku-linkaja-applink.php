<?php

 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
 }

/**
 * Duitku Linkaja Applink
 *
 * This gateway is used for processing online payment using Linkaja Applink
 *
 * Copyright (c) Duitku
 *
 * This script is only free to the use for merchants of Duitku. If
 * you have found this script useful a small recommendation as well as a
 * comment on merchant form would be greatly appreciated.
 *
 * @class       WC_Gateway_Duitku_LINKAJA_APPLINK
 * @extends     Duitku_Payment_Gateway
 * @package     Duitku/Classes/Payment
 * @author      Duitku
 * @located at  /includes/gateways
 */

 class WC_Gateway_Duitku_LINKAJA_APPLINK extends Duitku_Payment_Gateway {
    var $sub_id = 'duitku_linkaja_applink';
        public function __construct() {
	    parent::__construct();
		$this->method_title = 'Duitku LinkAja Applink';
	    $this->payment_method = 'LA/LF';
	    //payment gateway logo
	    $this->icon = plugins_url('/assets/linkaja_applink.png', dirname(__FILE__) );

		//Load settings
		$this->init_form_fields();
		$this->init_settings();
	}

	/**
	 * set field for each payment gateway
	 * @return void
	 */
	 
	public function payment_fields(){
		$tipe			= (isset($this->settings['tipe'])) ? $this->settings['tipe'] : null;
		$description	= (isset($this->settings['description'])) ? $this->settings['description'] : null;
		echo "<div style='display:none;' class='wc_payment_method payment_method_duitku_linkaja_applink" . $tipe . "'>" . $tipe . "</div>";
		echo "<p>" . $description . "</p>";
		
	}
		
	function init_form_fields() {

		$this->form_fields = array(
			'enabled' => array(
				'title' => esc_html('Enable/Disable', 'wc-duitku'),
				'label' => esc_html('Enable Duitku', 'wc-duitku'),
				'type' => 'checkbox', 'description' => '',
				'default' => 'no',
			),
			'title' => array(
				'title' => esc_html('Title', 'wc-duitku'),
				'type' => 'text',
				'description' => esc_html('', 'wc-duitku'),
				'default' => esc_html('Pembayaran Duitku', 'wc-duitku'),
			),
			'tipe' => array(
				'title' => esc_html( 'Type', 'wc-duitku' ),
				'type' => 'select',
				'default' => 'LA',
				'description' => esc_html( 'Fee Percentage Or Fixed', 'wc-duitku' ),
				'options'   => array(
				  'LA'   => esc_html( 'Fee Percentage', 'wc-duitku' ),
				  'LF'    => esc_html( 'Fee Fixed', 'wc-duitku' ),
				),
			  ),
			'description' => array(
				'title' => esc_html('Description', 'wc-duitku'),
				'type' => 'textarea',
				'description' => esc_html('', 'wc-duitku'),
				'default' => esc_html('Sistem pembayaran menggunakan Duitku.', 'wc-duitku'),
			),
			'duitku_expiry_period' => array(
				'title' => esc_html('Expired Period', 'wc-duitku'),
				'type' => 'number',
				'text', 'description' => esc_html('', 'wc-duitku'),
				'description' => __('Masa berlaku transaksi sebelum kedaluwarsa. example <code>1 - 60 ( menit )</code>', 'wc-duitku'),
				'default' => esc_html('5', 'wc-duitku'),
				'custom_attributes' => array(
					'min'       =>  1,
					'max'       =>  60,
				),
			),
		);
	}

 }

?>
