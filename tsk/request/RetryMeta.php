<?php
class RetryMeta{
	public $type;
	public $partnerOrderId;
	public $dingdangOrderId;
	public function __construct($body) {
		$this->type = $body->type;
		$this->partnerOrderId = $body->partnerOrderId;
		$this->dingdangOrderId = $body->dingdangOrderId;
    }
}
?>