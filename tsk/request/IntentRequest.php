<?php
require_once "Request.php";
require_once(dirname(__FILE__).'/'."../intent/Intent.php");
class IntentRequest extends Request{
	public $dialogState;
	public $intent;
	public function __construct($body) {
        parent::__construct($body);
		$this->dialogState = $body->dialogState;
		$this->intent = new Intent($body->intent);
    }
}
?>