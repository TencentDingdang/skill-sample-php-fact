<?php
class SlotValue{
	public $type;
	public $value;
	public function __construct($body) {
		$this->type = $body->type;
		$this->value = $body->value;
    }
}
?>