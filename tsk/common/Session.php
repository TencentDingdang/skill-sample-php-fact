<?php
class Session{
	public $new;
	public $sessionId;
    public function __construct($body) {
        $this->new = $body->new;
        $this->sessionId = $body->sessionId;
    }
}
?>