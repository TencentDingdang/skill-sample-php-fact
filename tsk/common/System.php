<?php
require_once "Application.php";
require_once "Device.php";
require_once "User.php";
class System{
	public $application;
	public $device;
	public $user;

    public function __construct($body) {
        $this->application = new Application($body->application);
		$this->device = new Device($body->device);
        $this->user = new User($body->user);
    }
}
?>