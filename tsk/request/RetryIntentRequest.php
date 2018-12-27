<?php
require_once "Request.php";
require_once "RetryMeta.php";
class RetryIntentRequest extends Request{
	public $dialogState;
	public $sourceIntent;
	public $retryMeta;
	public function __construct($body) {
        parent::__construct($body);
		$this->dialogState = $body->dialogState;
		$this->sourceIntent = $body->sourceIntent;
		$this->retryMeta = new RetryMeta($body->retryMeta);
    }
}
?>