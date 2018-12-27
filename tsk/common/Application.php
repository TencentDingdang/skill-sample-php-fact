<?php
class Application{
	public $applicationId;
    public function __construct($body) {
        $this->applicationId = $body->applicationId;
    }
}
?>