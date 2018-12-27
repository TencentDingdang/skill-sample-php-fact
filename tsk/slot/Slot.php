<?php
require_once "SlotValue.php";
class Slot{
	public $name;
	public $confirmationStatus;
	public $values;
	public function __construct($body) {
        $this->name = $body->name;
        $this->confirmationStatus = $body->confirmationStatus;
		foreach($body->values as $value)
		{
			$this->values[] = new SlotValue($value);
		}
    }
}
?>