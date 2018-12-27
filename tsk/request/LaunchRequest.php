<?php
require_once "Request.php";
class LaunchRequest extends Request{
	public function __construct($body) {
        parent::__construct($body);
    }
}
?>