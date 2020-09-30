<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Psbankpayment Payment Gateway
 *
 * Provides a Psbankpayment Payment Gateway.
 *
 * @class 		WC_Getaway_Psbankpayment
 * @extends		WC_Payment_Gateway
 * @version		1.0.0
 * @author 		Psbankpayment
 */
class WC_Gateway_Psbankpayment extends WC_Payment_Gateway {

	var $notify_url;

	/**
	 * Constructor for the gateway.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->id                   = 'psbankpayment';
		$this->icon                 = apply_filters( 'woocommerce_psbankpayment_icon', plugins_url('wc_psbankpayment/assets/images/icons/card.jpg')  );
		$this->has_fields           = false;
		$this->order_button_text    = __( 'Оплатить', 'woocommerce-gateway-psbankpayment-payments' );
		$this->method_title         = __( 'Промсвязьбанк: Интернет эквайринг', 'woocommerce-gateway-psbankpayment-payments' );
		$this->notify_url           = WC()->api_request_url( 'WC_Gateway_Psbankpayment' );
		$this->method_description   = __( 'Оплата картой Visa/Masrercard/Мир', 'woocommerce-gateway-psbankpayment-payments' );
		$this->supports 			= array(
			'products',
		);

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables
		$this->title        = $this->get_option( 'title' );
		$this->description  = $this->get_option( 'description' );
		$this->instructions = $this->get_option( 'instructions', $this->description );
		$this->psbankpayment_terminal 			= $this->get_option( 'psbankpayment_terminal' );
		$this->psbankpayment_merchant 		= $this->get_option( 'psbankpayment_merchant' );
		$this->psbankpayment_key 			= $this->get_option( 'psbankpayment_key' );
		$this->psbankpayment_merch_name 	= $this->get_option( 'psbankpayment_merch_name' );
		$this->psbankpayment_demo   = $this->get_option( 'psbankpayment_demo' );
		$this->psbankpayment_trtype   = $this->get_option( 'psbankpayment_trtype' );
		$this->psbankpayment_notify   = $this->get_option( 'psbankpayment_notify' );


		// Actions
		//add_action( 'valid-paypal-standard-ipn-request', array( $this, 'successful_request' ) );
		//add_action( 'woocommerce_receipt_psbankpayment', array( $this, 'receipt_page' ) );
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_filter( 'woocommerce_thankyou_order_received_text', array( $this, 'return_handler' ), 10, 2 );
		add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));

		// Payment listener/API hook
		add_action( 'woocommerce_api_wc_gateway_psbankpayment', array( $this, 'notification' ) );

		if ( ! $this->is_valid_for_use() ) {
			$this->enabled = false;
		}
	}

	/**
	 * Check if this gateway is enabled and available in the user's country
	 *
	 * @access public
	 * @return bool
	 */
	function is_valid_for_use() {
		/*if ( ! in_array( get_woocommerce_currency(), apply_filters( 'woocommerce_psbankpayment_supported_currencies', array('RUB' ) ) ) ) {
			return false;
		}*/

		return true;
	}


	/**
	 * Admin Panel Options
	 * - Options for bits like 'title' and availability on a country-by-country basis
	 *
	 * @since 1.0.0
	 */
	public function admin_options() {
		if ( $this->is_valid_for_use() ) {
			parent::admin_options();
		} else {
			?>
			<div class="inline error"><p><strong><?php _e( 'Gateway Disabled', 'woocommerce' ); ?></strong>: <?php _e( 'Psbankpayment does not support your store currency.', 'woocommerce-gateway-psbankpayment-payments' ); ?></p></div>
			<?php
		}
	}

	/**
	 * Initialise Gateway Settings Form Fields
	 *
	 * @access public
	 * @return void
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title'   => __( 'Enable/Disable', 'woocommerce' ),
				'type'    => 'checkbox',
				'label'   => __( 'Включить оплату по карте', 'woocommerce-gateway-psbankpayment-payments' ),
				'default' => 'yes'
			),

			'title' => array(
				'title'       => __( 'Title', 'woocommerce' ),
				'type'        => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
				'default'     => __( 'Оплата по карте', 'woocommerce-gateway-psbankpayment-payments' ),
				'desc_tip'    => true,
			),
			'description' => array(
				'title'       => __( 'Description', 'woocommerce' ),
				'type'        => 'textarea',
				'description' => __( 'Payment method description that the customer will see on your checkout.', 'woocommerce' ),
				'default'     => __( '', 'woocommerce-gateway-psbankpayment-payments' ),
				'desc_tip'    => true,
			),
			'instructions' => array(
				'title'       => __( 'Instructions', 'woocommerce' ),
				'type'        => 'textarea',
				'description' => __( 'Instructions that will be added to the thank you page and emails.', 'woocommerce' ),
				'default'     => '',
				'desc_tip'    => true,
			),
			'psbankpayment_merchant' => array(
				'title'       => __( 'MERCHANT', 'woocommerce-gateway-psbankpayment-payments' ),
				'type'        => 'text',
				'default'     => ''
			),
			'psbankpayment_terminal' => array(
				'title'       => __( 'TERMINAL', 'woocommerce-gateway-psbankpayment-payments' ),
				'type'        => 'text',
				'default'     => '',
			),

			'psbankpayment_key' => array(
				'title'       => __( 'KEY', 'woocommerce-gateway-psbankpayment-payments' ),
				'type'        => 'text',
				'default'     => '',
			),

			'psbankpayment_merch_name' => array(
				'title'       => __( 'MERCH_NAME', 'woocommerce-gateway-psbankpayment-payments' ),
				'type'        => 'text',
				'default'     => '',
			),
			'psbankpayment_demo' => array(
				'title'       => __( 'Режим работы', 'woocommerce-gateway-psbankpayment-payments' ),
				'type'        => 'select',
				'class'		=> 'wc-enhanced-select',
				'options'	=> array(
					1 => __('Тестовый', 'woocommerce-gateway-psbankpayment-payments'),
					0 => __('Рабочий', 'woocommerce-gateway-psbankpayment-payments'),
				),
				'default' 	=> 1
			),
			'psbankpayment_notify' => array(
				'title'       => __( 'Отправлять уведомление клиенту на почту', 'woocommerce-gateway-psbankpayment-payments' ),
				'type'        => 'select',
				'class'		=> 'wc-enhanced-select',
				'options'	=> array(
					0 => __('Нет', 'woocommerce-gateway-psbankpayment-payments'),
					1 => __('Да', 'woocommerce-gateway-psbankpayment-payments'),
				),
				'default' 	=> 0
			),
			'psbankpayment_trtype' => array(
				'title'       => __( 'Тип оплаты', 'woocommerce-gateway-psbankpayment-payments' ),
				'type'        => 'select',
				'class'		=> 'wc-enhanced-select',
				'default'     => '',
				'options'	=> array(
					1 => __('Оплата', 'woocommerce-gateway-psbankpayment-payments'),
					12 => __('Предавторизация', 'woocommerce-gateway-psbankpayment-payments'),
				)
			),

			'psbankpayment_callback' => array(
				'title'       => __( 'URL CGI скрипта, обрабатывающего уведомления', 'woocommerce-gateway-psbankpayment-payments' ),
				'type'        => 'title',
				'description' =>  $this->notify_url
			),

		);
	}


	/**
	 * Process the payment and return the result
	 *
	 * @access public
	 * @param int $order_id
	 * @return array
	 */
	public function process_payment( $order_id ) {
		$order = new WC_Order($order_id);
        return array('result' => 'success', 'redirect' => $order->get_checkout_payment_url( true ));
	}

	function return_handler($desc, $order) {

		global $woocommerce, $wpdb;
		$order_id = $order->get_id();
		if($order->get_payment_method() != $this->id) return $desc;
		$result = '';
		$data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}psbankpayment WHERE ORDER_ID=".intval($order_id ));
		if($data && ($data->TRTYPE == 1 || $data->TRTYPE == 12) && $data->RESULT == 0) {
			$result =  "Спасибо за оплату заказа";
		} else {
			if($data && $data->TRTYPE != 0 ) {
				$result =  "При оплате заказа возникла ошибка: "
				.htmlspecialchars($data->RCTEXT)."<br>";
			}
	        $date = new DateTime('now', new DateTimeZone('Europe/Moscow'));
			$date->modify('-3Hours');
			$timestamp = $date->format('YmdHis');
			$nonce = sha1(mt_rand().microtime());

			$return_url = $order->get_checkout_order_received_url( true );

			$url = PSBankLib::getUrl($this->psbankpayment_demo);

			if (version_compare($woocommerce->version, "3.0", ">=")) {
	            $billing_email = $order->get_billing_email();
	            $order_total = $order->get_total();
	        } else {
	            $billing_email = $this->order->billing_email;
	            $order_total = number_format($order->order_total, 2, '.', '');
	        }

			$data = array(
				'AMOUNT' => $order_total,
				'CURRENCY' => 'RUB',
				'ORDER' => sprintf("%06s", $order_id),
				'MERCH_NAME' => $this->psbankpayment_merch_name,
				'MERCHANT' => $this->psbankpayment_merchant ,
				'TERMINAL' => $this->psbankpayment_terminal ,
				'EMAIL' => $billing_email,
				'TRTYPE' => $this->psbankpayment_trtype,
				'TIMESTAMP' => $timestamp,
				'NONCE' => $nonce,
				'BACKREF' => $return_url,
			);

			$desc = sprintf(__('Оплата заказа №%s', 'woocommerce-gateway-psbankpayment-payments'), $order_id);

			$sign = PSBankLib::calcHash($data, $this->psbankpayment_key);

			$this->insertTransaction($order_id, $data['AMOUNT'], $data['EMAIL'], 0, $data['NONCE']);
			$button .= "<form id='submit_{$this->id}_payment_form' method='POST' action='".$url."'>";
			foreach($data as $k=>$v)
			{
				$button .= "<input type='hidden' name='".$k."' value='".$v."'>";
			}
			$button .= "<input type='hidden' name='P_SIGN' value='".$sign."'>
						<input type='hidden' name='DESC' value='".$desc."'>
						<input class='button btn btn-default psbank_payment_button' type='submit' value='Оплатить' />
						";
			//$woocommerce->cart->empty_cart();
			$result = $button;
		}
		return $result;
	}

	function receipt_page($order_id){
		global $woocommerce, $wpdb;
        if(function_exists("wc_get_order")) {
			$order       = wc_get_order( $order_id );
		} else {
			$order = new WC_Order( $order_id );
		}
        $date = new DateTime('now', new DateTimeZone('Europe/Moscow'));
		$date->modify('-3Hours');
		$timestamp = $date->format('YmdHis');
		$nonce = sha1(mt_rand().microtime());

		$return_url = $order->get_checkout_order_received_url( true );

		$url = PSBankLib::getUrl($this->psbankpayment_demo);

		if (version_compare($woocommerce->version, "3.0", ">=")) {
            $billing_email = $order->get_billing_email();
            $order_total = $order->get_total();
        } else {
            $billing_email = $this->order->billing_email;
            $order_total = number_format($order->order_total, 2, '.', '');
        }

		$data = array(
			'AMOUNT' => $order_total,
			'CURRENCY' => 'RUB',
			'ORDER' => sprintf("%06s", $order_id),
			'MERCH_NAME' => $this->psbankpayment_merch_name,
			'MERCHANT' => $this->psbankpayment_merchant ,
			'TERMINAL' => $this->psbankpayment_terminal ,
			'EMAIL' => $billing_email,
			'TRTYPE' => $this->psbankpayment_trtype,
			'TIMESTAMP' => $timestamp,
			'NONCE' => $nonce,
			'BACKREF' => $return_url,
		);

		$desc = sprintf(__('Оплата заказа №%s', 'woocommerce-gateway-psbankpayment-payments'), $order_id);

		$sign = PSBankLib::calcHash($data, $this->psbankpayment_key);
		if ($this->psbankpayment_notify) {
			$data['CARDHOLDER_NOTIFY'] = 'EMAIL';
		}
		$this->insertTransaction($order_id, $data['AMOUNT'], $data['EMAIL'], 0, $data['NONCE']);
		$button .= "<form id='submit_{$this->id}_payment_form' method='POST' action='".$url."'>";
		foreach($data as $k=>$v)
		{
			$button .= "<input type='hidden' name='".$k."' value='".$v."'>";
		}
		$button .= "<input type='hidden' name='P_SIGN' value='".$sign."'>
					<input type='hidden' name='DESC' value='".$desc."'>
					<input class='button btn btn-default psbank_payment_button' type='submit' value='Оплатить' />
					";
		$button .= '<script type="text/javascript">';
		$button .= 'jQuery(document).ready(function ($){ jQuery("#submit_' . $this->id . '_payment_form").submit(); });';
		$button .= '</script></form>';
		//$woocommerce->cart->empty_cart();
		echo $button;
	}

	private function insertTransaction($order_id, $amount, $email, $trtype, $nonce) {
		global $wpdb;
		$wpdb->insert("{$wpdb->prefix}psbankpayment", array(
				"ORDER_ID" => $order_id,
				"AMOUNT" => $amount,
				"ORG_AMOUNT" => $amount,
				"EMAIL" => $email,
				'STATUS' => $trtype,
				'NONCE' => $nonce,
				'DATE'=> current_time('mysql')
			), array("%d", "%s", "%s", "%s","%d","%s", "%s"));
	}

	private function updateTransaction($data){
		global $wpdb;
		$fields = array("AUTHCODE","CARD","EMAIL","INT_REF","NAME","RC","RCTEXT","RESULT","RRN","TRTYPE","NONCE");
		$query = array();
		foreach($fields as $field) {
			if(isset($data[$field]) && $data[$field] !== ''){
				$query[] = "{$field}='".esc_sql($data[$field])."'";
			}
		}
		if($data['RESULT'] == 0) {
			$query[] = "STATUS='".esc_sql($data['TRTYPE'])."'";
			if ($data['TRTYPE'] == 22 || $data['TRTYPE'] == 14){
				$query[] = "AMOUNT=AMOUNT-'".esc_sql($data['AMOUNT'])."'";
			} else {
				$query[] = "AMOUNT='".esc_sql($data['AMOUNT'])."'";
			}
		}

		$wpdb->query("UPDATE {$wpdb->prefix}psbankpayment SET
			".implode(',', $query).",
			DATE=NOW()
			WHERE ORDER_ID=".intval($data['ORDER'])
		);
	}


	private function insertHistory($data) {
		global $wpdb;
		$wpdb->query("INSERT INTO {$wpdb->prefix}psbankpayment_history 	(AMOUNT, ORG_AMOUNT, CURRENCY, `ORDER`, `DESC`, MERCH_NAME, MERCHANT, TERMINAL, EMAIL,TRTYPE,`TIMESTAMP`,NONCE,RESULT, RC, RCTEXT, AUTHCODE, RRN, INT_REF, NAME, CARD, CHANNEL) VALUES ('".esc_sql($data['AMOUNT'])."','".esc_sql($data['ORG_AMOUNT'])."','".esc_sql($data['CURRENCY'])."','".esc_sql($data['ORDER'])."','".esc_sql($data['DESC'])."','".esc_sql($data['MERCH_NAME'])."','".esc_sql($data['MERCHANT'])."','".esc_sql($data['TERMINAL'])."','".esc_sql($data['EMAIL'])."','".esc_sql($data['TRTYPE'])."','".esc_sql($data['TIMESTAMP'])."','".esc_sql($data['NONCE'])."','".esc_sql($data['RESULT'])."','".esc_sql($data['RC'])."','".esc_sql($data['RCTEXT'])."','".esc_sql($data['AUTHCODE'])."','".esc_sql($data['RRN'])."','".esc_sql($data['INT_REF'])."','".esc_sql($data['NAME'])."','".esc_sql($data['CARD'])."','".esc_sql($data['CHANNEL'])."')");
	}


	function notification() {
		$sign = PSBankLib::calcHash($_POST, $this->psbankpayment_key);
		if(strcmp($sign, $_POST['P_SIGN']) === 0){
			$this->updateTransaction($_POST);
			$this->insertHistory($_POST);
			if(($_POST['TRTYPE'] == 1 || $_POST['TRTYPE'] == 12 || $_POST['TRTYPE'] == 21)
			&& $_POST['RESULT'] == 0) {
				$order_id = intval($_POST['ORDER']);
				if(function_exists("wc_get_order")) {
					$order       = wc_get_order( $order_id );
				} else {
					$order = new WC_Order( $order_id );
				}
				if($_POST['TRTYPE'] == 12) {
					$order->set_status('pending');
					$order->save();

				} else {
					if ( $order->has_status( 'completed' ) ) {
		            	exit();
		            }
		            $order->payment_complete( time() );
		        }
	        }
		}
		exit();
	}
/*
	static function renew_cart(){
		if ( isset( $_GET['cancel_order'] ) && isset( $_GET['order'] ) && isset( $_GET['order_id'] ) ) {
			if(!session_id()) {
		        session_start();
		    }
			if($_SESSION['psbankpayment_cart']){
				foreach($_SESSION['psbankpayment_cart'] as $item){
					WC()->cart->add_to_cart( $item['product_id'], $item['qty'] );
				}
				$_SESSION['psbankpayment_cart'] = array();
			}
		}
		//wp_safe_redirect( WC()->cart->get_cart_url() );
	}

	static function restore_fields($x, $input){
			if(!session_id()) {
		        session_start();
		    }
			if($_SESSION['psbankpayment_fields'] && isset($_SESSION['psbankpayment_fields'][$input]) && $_SESSION['psbankpayment_fields'][$input]){
				$val = $_SESSION['psbankpayment_fields'][$input];
				unset($_SESSION['psbankpayment_fields'][$input]);
				return $val;
			} else {
				return null;
			}
	}
*/
}


//wc_add_notice( __( 'Your order can no longer be cancelled. Please contact us if you need assistance.', 'woocommerce' ), 'error' );
/*
add_action( 'wp_loaded', array( "WC_Gateway_Psbankpayment", 'renew_cart' ), 10 );
add_filter( 'woocommerce_checkout_get_value', array( "WC_Gateway_Psbankpayment", 'restore_fields' ), 10,2 );
*/