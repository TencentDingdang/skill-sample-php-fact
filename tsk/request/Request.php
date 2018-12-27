<?php
class Request{
	public $type;
	public $requestId;
	public $timestamp;
	public $queryText;
	public function __construct($body) {
        $this->type = $body->type;
        $this->requestId = $body->requestId;
		$this->timestamp = $body->timestamp;
        $this->queryText = $body->queryText;
    }
}
?>