<?php
require_once "Request.php";
require_once "SessionEndedError.php";
class SessionEndedRequest extends Request{
	public $reason;
	public $error;
	public function __construct($body) {
        parent::__construct($body);
		$this->reason = $body->reason;
		$this->error = new SessionEndedError($body->error);
    }
}
?>