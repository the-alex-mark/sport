<?php
/*
Plugin Name: WooCommerce psbankpayment Payments Gateway
Plugin URI: http://www.psbank.ru
Description: psbankpayment Payments Gateway
Version: 1.0.2
Author: psbankpayment
Author URI: http://www.psbank.ru
Copyright: © ПАО «Промсвязьбанк».
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

class WC_Psbankpayment {

	private $settings;

	public function __construct() {

		$this->settings = get_option( 'woocommerce_psbankpayment_settings' );



		if ( empty( $this->settings['psbankpayment_terminal'] ) ) {
			$this->settings['psbankpayment_terminal'] = '';
		}
		if ( empty( $this->settings['psbankpayment_merchant'] ) ) {
			$this->settings['psbankpayment_merchant'] = '';
		}

		if ( empty( $this->settings['psbankpayment_key'] ) ) {
			$this->settings['psbankpayment_key'] = '';
		}

		if ( empty( $this->settings['psbankpayment_merch_name'] ) ) {
			$this->settings['psbankpayment_merch_name'] = '';
		}

		if ( empty( $this->settings['psbankpayment_demo'] ) ) {
			$this->settings['psbankpayment_demo'] = '1';
		}
		if ( empty( $this->settings['psbankpayment_trtype'] ) ) {
			$this->settings['psbankpayment_trtype'] = '1';
		}
		if ( empty( $this->settings['psbankpayment_notify'] ) ) {
			$this->settings['psbankpayment_notify'] = '0';
		}

		add_action( 'init', array( $this, 'init_gateway' ) );
	}

	public function init_gateway() {
		global $woocommerce;

		if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
			return;
		}

		load_plugin_textdomain( 'woocommerce-gateway-psbankpayment-payments', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		load_plugin_textdomain( 'woocommerce-gateway-psbankpaymentcard-payments', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );



		include_once( 'includes/class-wc-gateway-psbankpayment.php' );
		include_once( 'includes/lib.php' );

		add_filter( 'woocommerce_payment_gateways',  array( $this, 'add_gateway' ) );
		//add_filter( 'wc_order_statuses',  array( $this, 'add_status' ) );
		//add_filter( 'woocommerce_valid_order_statuses_for_payment_complete',  array( $this, 'add_valid_status' ) );

		if ( empty( $this->settings['psbankpayment_merchant'] ) || $this->settings['enabled'] == 'no' ) {
			return;
		}

		// Disable for subscriptions until supported
		if ( ! is_admin() && class_exists( 'WC_Subscriptions_Cart' ) && WC_Subscriptions_Cart::cart_contains_subscription() && 'no' === get_option( WC_Subscriptions_Admin::$option_prefix . '_accept_manual_renewals', 'no' ) ) {
			return;
		}


//		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );


		//add_filter( 'woocommerce_available_payment_gateways', array( $this, 'remove_gateways' ) );
	}


	public function add_gateway( $methods ) {
		$methods[] = 'WC_Gateway_Psbankpayment';
		return $methods;
	}


	/**
	 * Remove all gateways except psbankpayment
	 */
	/*public function remove_gateways( $gateways ) {
		foreach ( $gateways as $gateway_key => $gateway ) {
			if ( $gateway_key !== 'psbankpayment' ) {
				unset( $gateways[ $gateway_key ] );
			}
		}
		return $gateways;
	}*/

	public function add_status($statuses) {
		$statuses['wc-preauth'] = _x( 'Предавторизован', 'Order status', 'woocommerce' );
		return $statuses;
	}

	public function add_valid_status($statuses) {
		$statuses[] = 'preauth';
		return $statuses;
	}


}
$GLOBALS['wc_psbankpayment'] = new WC_Psbankpayment();

function install_psbankpayment() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'psbankpayment';
	$table_name_history = $wpdb->prefix . 'psbankpayment_history';

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name
(
	ORDER_ID		INT(11)  NOT NULL,
	AMOUNT			DECIMAL(13,2) NOT NULL,
	AUTHCODE		VARCHAR(32) NULL,
	CARD			VARCHAR(250) NULL,
	DATE			DATETIME NOT NULL,
	EMAIL			VARCHAR(80) NOT NULL,
	INT_REF			VARCHAR(25) NULL,
	NAME			VARCHAR(250) NULL,
	ORG_AMOUNT		DECIMAL(13,2) NULL,
	RC				VARCHAR(2)	NULL,
	RCTEXT			VARCHAR(250) NULL,
	RESULT			VARCHAR(1) NULL,
	RRN				VARCHAR(12) NULL,
	STATUS			INT(11) DEFAULT '0',
	TRTYPE			INT(11) NOT NULL,
	NONCE			VARCHAR(40) NOT NULL,
	PRIMARY KEY (ORDER_ID)
) $charset_collate;

CREATE TABLE $table_name_history
(
	ID				INT(11)  NOT NULL AUTO_INCREMENT,
	`ORDER`			INT(11)  NOT NULL,
	AMOUNT			DECIMAL(13,2) NOT NULL,
	ORG_AMOUNT		DECIMAL(13,2) NOT NULL,
	CURRENCY		VARCHAR(32) NULL,
	`DESC`			VARCHAR(250) NULL,
	MERCH_NAME		VARCHAR(250) NULL,
	MERCHANT		VARCHAR(250) NULL,
	TERMINAL		VARCHAR(250) NULL,
	EMAIL			VARCHAR(80) NOT NULL,
	TRTYPE			INT(11) NOT NULL,
	`TIMESTAMP`		VARCHAR(14) NOT NULL,
	NONCE			VARCHAR(40) NOT NULL,
	INT_REF			VARCHAR(25) NULL,
	NAME			VARCHAR(250) NULL,
	RC				VARCHAR(2)	NULL,
	RCTEXT			VARCHAR(250) NULL,
	RESULT			VARCHAR(1) NULL,
	RRN				VARCHAR(12) NULL,
	AUTHCODE		VARCHAR(32) NULL,
	CARD			VARCHAR(250) NULL,
	CHANNEL			VARCHAR(250) NULL,
	PRIMARY KEY (ID)
) $charset_collate;
";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

register_activation_hook( __FILE__, 'install_psbankpayment' );


add_action( 'admin_menu', 'psbankpayment_menu' );


function psbankpayment_menu() {
	$icon = 'data:image/svg+xml;base64,'.base64_encode(file_get_contents(dirname(__FILE__).'/assets/images/icons/menu.svg'));
	add_menu_page( 'Промсвязьбанк: транзакции', 'Промсвязьбанк: транзакции', 'manage_options', 'psbankpayment', "psbankpayment_page_handler", $icon,  '55.6' );
}

function psbankpayment_page_handler() {
	if(isset($_GET['section']) && $_GET['section'] == 'history') {
		psbankpayment_transactions_history();
	} else {
		psbankpayment_transactions();
	}
}

function psbankpayment_transactions_history() {
	global $wpdb;
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	$trtype_lang = array(
			1 => "Оплата",
			12 => "Предавторизация",
			14 =>"Возврат" ,
			21 => "Завершение расчета",
			22 => "Отмена"

		);
	$data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}psbankpayment_history WHERE `ORDER`=".intval($_GET['order_id']));
	echo "<div class='wrap'>";
	echo "<h1>Операции по заказу №".intval($_GET['order_id'])."</h1>";
	if(!$data) {
		echo "Операций по заказу не было";
		echo "</div>";
		return;
	}?>
	<table class="wp-list-table widefat fixed striped posts">
<thead>
	<tr>
		<td>Дата операции</td>
      <td>Сумма</td>
      <td>Сумма оригинальной операции</td>
      <td>Тип операции</td>
      <td>Результат</td>
      <td>Код ответа</td>
      <td>Код авторизации</td>
      <td>Ссылка RRN</td>
      <td>Ссылка INT_REF</td>
      <td>Имя держателя карты</td>
      <td>Номер карты</td>
	</tr>
	</thead>
	<tbody>
	<?php foreach($data as $row):
	$ts = $row->TIMESTAMP;
	?>
	<tr class="transactionrow" >
		<td><?php echo "{$ts[0]}{$ts[1]}{$ts[2]}{$ts[3]}-{$ts[4]}{$ts[5]}-{$ts[6]}{$ts[7]} {$ts[8]}{$ts[9]}:{$ts[10]}{$ts[11]}:{$ts[12]}{$ts[13]}"?></td>
		<td><?php echo $row->AMOUNT?></td>
		<td><?php echo $row->ORG_AMOUNT?></td>
		<td><?php echo $trtype_lang[$row->TRTYPE]?></td>
		<td><?php echo $row->RESULT?></td>
		<td><?php echo $row->RC?> <?php echo $row->RCTEXT?></td>
		<td><?php echo $row->AUTHCODE?></td>
		<td><?php echo $row->RRN?></td>
		<td><?php echo $row->INT_REF?></td>
		<td><?php echo $row->NAME?></td>
		<td><?php echo $row->CARD?></td>
	</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php }


function psbankpayment_transactions() {
	global $wpdb;
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	$config = get_option( 'woocommerce_psbankpayment_settings', null );
	if (isset($_POST['action'])) {
		$date = new DateTime('now', new DateTimeZone('Europe/Moscow'));
		$date->modify('-3Hours');
		$timestamp = $date->format('YmdHis');
		$data = $wpdb->get_row("SELECT ORG_AMOUNT,RRN,INT_REF,EMAIL FROM {$wpdb->prefix}psbankpayment WHERE ORDER_ID=".intval($_POST['order_id']));
		$action_success = false;
		$post = $_POST;
		if(function_exists("wc_get_order")) {
			$order       = wc_get_order( $post['order_id']);
		} else {
			$order = new WC_Order( $post['order_id'] );
		}
		$return_url = $order->get_checkout_payment_url( true );
		$nonce = sha1(mt_rand().microtime());
		$params = array(
			"ORDER"			=> sprintf("%06s", $post['order_id']),
			"AMOUNT"		=> $post['sum'],
			"CURRENCY"		=> "RUB",
			"ORG_AMOUNT"	=> $data->ORG_AMOUNT,
			"RRN"			=> $data->RRN,
			"INT_REF"		=> $data->INT_REF,
			"TRTYPE"		=> $post['action'],
			"TERMINAL"		=> $config[ 'psbankpayment_terminal' ],
			"BACKREF"		=> $return_url,
			"EMAIL"			=> $data->EMAIL,
			"TIMESTAMP"		=> $timestamp,
			"NONCE"			=> $nonce
		);
		$params['P_SIGN'] = PSBankLib::calcHash($params, $config[ 'psbankpayment_key' ]);
		if ($config[ 'psbankpayment_notify' ]) {
			$params['CARDHOLDER_NOTIFY'] = 'EMAIL';
		}
		$res = PSBankLib::request($params, $config[ 'psbankpayment_demo' ]);
		$error = '';
		$counter = 20;
		$exit = 0;
	    do {
	        sleep(1);
	        $sql = "SELECT TRTYPE, RESULT, RCTEXT FROM {$wpdb->prefix}psbankpayment WHERE ORDER_ID=".intval($post['order_id']).' and NONCE="'.$nonce.'"';
			$data = $wpdb->get_row($sql);
	        if ($data && $data->TRTYPE == $post['action']) {
	            $exit = 1;
	            if($data->RESULT == 0 ){
	                $action_success = true;
	            }
	        }
	        $counter--;
	    } while(!$exit && $counter);
	}

	$paged = isset($_GET['paged'])?intval($_GET['paged']):1;
	$perpage = 25;
	$from = ($paged-1)*$perpage;
	$where = 'WHERE 1 = 1';
	if((isset($_POST['filter_order']) && $_POST['filter_order']) || (isset($_POST['filter_order_rrn']) && $_POST['filter_order_rrn'])){
		$where = array();
		if($_POST['filter_order']){
			$where[] = 'ORDER_ID='.intval($_POST['filter_order']);
		}
		if($_POST['filter_order_rrn']){
			$where[] = 'RRN="'.esc_sql($_POST['filter_order_rrn']).'"';
		}
		$where = 'WHERE '.implode(' and ', $where);
	}
	$transactions = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}psbankpayment $where order by ORDER_ID DESC limit $from,$perpage");
	$count = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}psbankpayment $where;" );
	$total_items = $count;
	$total_pages = ceil($total_items/$perpage);
	$infinite_scroll = false;
	echo "<div class='wrap'>";
	echo "<h1>Платежные транзакции</h1>";
	if(!$count) {
		echo "- нет данных -";
		echo "</div>";
		return;
	}

	$output = '<span class="displaying-num">' . sprintf( _n( '%s item', '%s items', $total_items ), number_format_i18n( $total_items ) ) . '</span>';

	$current = $paged;

	$removable_query_args = wp_removable_query_args();

	$current_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );

	$current_url = remove_query_arg( $removable_query_args, $current_url );

	$page_links = array();

	$total_pages_before = '<span class="paging-input">';
	$total_pages_after  = '</span></span>';

	$disable_first = $disable_last = $disable_prev = $disable_next = false;

		if ( $current == 1 ) {
		$disable_first = true;
		$disable_prev = true;
		}
	if ( $current == 2 ) {
		$disable_first = true;
	}
		if ( $current == $total_pages ) {
		$disable_last = true;
		$disable_next = true;
		}
	if ( $current == $total_pages - 1 ) {
		$disable_last = true;
	}

	if ( $disable_first ) {
		$page_links[] = '<span class="tablenav-pages-navspan" aria-hidden="true">&laquo;</span>';
	} else {
		$page_links[] = sprintf( "<a class='first-page' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
			esc_url( remove_query_arg( 'paged', $current_url ) ),
			__( 'First page' ),
			'&laquo;'
		);
	}

	if ( $disable_prev ) {
		$page_links[] = '<span class="tablenav-pages-navspan" aria-hidden="true">&lsaquo;</span>';
	} else {
		$page_links[] = sprintf( "<a class='prev-page' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
			esc_url( add_query_arg( 'paged', max( 1, $current-1 ), $current_url ) ),
			__( 'Previous page' ),
			'&lsaquo;'
		);
	}

	if ( 'bottom' === $which ) {
		$html_current_page  = $current;
		$total_pages_before = '<span class="screen-reader-text">' . __( 'Current Page' ) . '</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">';
	} else {
		$html_current_page = sprintf( "%s<input class='current-page' id='current-page-selector' type='text' name='paged' value='%s' size='%d' aria-describedby='table-paging' /><span class='tablenav-paging-text'>",
			'<label for="current-page-selector" class="screen-reader-text">' . __( 'Current Page' ) . '</label>',
			$current,
			strlen( $total_pages )
		);
	}
	$html_total_pages = sprintf( "<span class='total-pages'>%s</span>", number_format_i18n( $total_pages ) );
	$page_links[] = $total_pages_before . sprintf( _x( '%1$s of %2$s', 'paging' ), $html_current_page, $html_total_pages ) . $total_pages_after;

	if ( $disable_next ) {
		$page_links[] = '<span class="tablenav-pages-navspan" aria-hidden="true">&rsaquo;</span>';
	} else {
		$page_links[] = sprintf( "<a class='next-page' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
			esc_url( add_query_arg( 'paged', min( $total_pages, $current+1 ), $current_url ) ),
			__( 'Next page' ),
			'&rsaquo;'
		);
	}

	if ( $disable_last ) {
		$page_links[] = '<span class="tablenav-pages-navspan" aria-hidden="true">&raquo;</span>';
	} else {
		$page_links[] = sprintf( "<a class='last-page' href='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></a>",
			esc_url( add_query_arg( 'paged', $total_pages, $current_url ) ),
			__( 'Last page' ),
			'&raquo;'
		);
	}

	$pagination_links_class = 'pagination-links';
	if ( ! empty( $infinite_scroll ) ) {
		$pagination_links_class = ' hide-if-js';
	}
	$output .= "\n<span class='$pagination_links_class'>" . join( "\n", $page_links ) . '</span>';

	if ( $total_pages ) {
		$page_class = $total_pages < 2 ? ' one-page' : '';
	} else {
		$page_class = ' no-pages';
	}
	echo '<div class="tablenav top">';
?>
<form method="POST" action="">
<div class="alignleft actions bulkactions">
	<label class="screen-reader-text" for="search-transaction">Номер заказа:</label>
	<input placeholder="Номер заказа" type="search" id="search-transaction" class="wp-filter-search" name="filter_order" value="<?php echo htmlspecialchars(@$_POST['filter_order'], ENT_QUOTES, 'UTF-8');?>" />
	<label class="screen-reader-text" for="search-transaction-rrn">RRN:</label>
	<input placeholder="RRN" type="search" id="search-transaction-rrn" class="wp-filter-search" name="filter_order_rrn" value="<?php echo htmlspecialchars(@$_POST['filter_order_rrn'], ENT_QUOTES, 'UTF-8');?>" />
	<?php submit_button( 'Фильтр', '', '', false, array( 'id' => 'search-submit' ) ); ?>
</div>
</form>
<?php
	echo "<div class='tablenav-pages{$page_class}'>$output</div>";
	echo "</div>";
	$history_link = add_query_arg( 'section', 'history', $current_url ) ;
?>

<table class="wp-list-table widefat striped posts">
<thead>
	<tr>
		<th style="width:70px">Номер заказа</th>
		<th style="width:70px">Сумма заказа</th>
		<th>Дата транзакции</th>
		<th>Email</th>
		<th>Имя плательщика</th>
		<th>RRN</th>
		<th>Статус</th>
		<th>Действие</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($transactions as $data):
	?>
	<tr class="transactionrow" >
		<td><?php echo $data->ORDER_ID?></td>
		<td><?php echo $data->AMOUNT?></td>
		<td><?php echo $data->DATE?></td>
		<td><?php echo $data->EMAIL?></td>
		<td><?php echo $data->NAME?></td>
		<td><?php echo $data->RRN?></td>
		<td><?php
			$status = psbankpayment_get_status_name($data->STATUS);
		    if($data->RCTEXT){
		        $status .= " ({$data->RCTEXT})";
		    }
		    echo $status;
		    ?>
    </td>
		<td><?php
		$action = '';
    if(in_array($data->STATUS, array(1, 21, 12, 14, 22)) && $data->AMOUNT > 0) {
    $action = '<form method="POST" action="">
            <input type="text" name="sum" value="'.$data->AMOUNT.'" style="width:100%">
            <input type="hidden" name="order_id" value="'.$data->ORDER_ID.'">
            <br>';
            $action .= "<div style='white-space:nowrap'>";
        if(in_array($data->STATUS, array(1, 21, 14))) {
            $action .= '
                <button class="button" type="submit" name="action" value="14">Возврат</button>';
        }
         if(in_array($data->STATUS,array(12, 22))) {
            $action .= '
                <button class="button" type="submit" name="action" value="22">Отмена</button>';
            $action .= '
                <button class="button" type="submit" name="action" value="21">Завершение</button>';
        }
        $action .= "</div>";
        $action .= '</form>';
    }
    echo $action;
    ?>
    </td>
    <td><a href="<?php echo add_query_arg( 'order_id', $data->ORDER_ID, $history_link )?>">История операций</a></td>
	</tr>
<?php endforeach;?>
	</tbody>
</table>
</div>
<?php
}

function psbankpayment_get_status_name($status){
	$name = '';
	switch($status) {
		case 0:$name = 'Ожидается оплата';break;
		case 1:$name = 'Заказ оплачен';break;
		case 12:$name = 'Заказ предавторизован';break;
		case 21:$name = 'Заказ оплачен';break;
		case 22:$name = 'Предавторизация отменена';break;
		case 14:$name = 'Возврат оплаты';break;
	}
	return $name;
}
