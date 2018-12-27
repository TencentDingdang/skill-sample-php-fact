<?php
class User{
	public $userId;
	public $accessToken;
    public function __construct($body) {
        $this->userId = $body->userId;
        $this->accessToken = $body->accessToken;
    }
}
?>