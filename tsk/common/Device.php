<?php
class Device{
	public $deviceId;
	public $supportedInterfaces;
    public function __construct($body) {
        $this->deviceId = $body->deviceId;
        $this->supportedInterfaces = $body->supportedInterfaces;
    }
}
?>