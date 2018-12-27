<?php
class SessionEndedError{
	public $type;
	public $message;
	public function __construct($body) {
		$this->type = $body->type;
		$this->message = $body->message;
    }
}
?>