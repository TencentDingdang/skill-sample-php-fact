<?php
require_once "Directive.php";
class PaymentPay extends Directive{
	public $order;
	public function __construct($order) {
        $this->type = "Payment.Pay";
        $this->order = $order;
    }
}
?>