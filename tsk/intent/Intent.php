<?php
require_once(dirname(__FILE__).'/'."../slot/Slot.php");
class Intent{
	public $name;
	public $confirmationStatus;
	public $slots;
	public function __construct($body) {
        $this->name = $body->name;
        $this->confirmationStatus = $body->confirmationStatus;
		foreach($body->slots as $slotName=>$slot)
		{
			$this->slots[$slotName] = new Slot($slot);
		}
    }
}
?>