<?php
require_once "Directive.php";
class DialogElicitSlot extends Directive{
	public $slotToElicit;
	public $updatedIntent;
	public function __construct($body) {
        $this->type = "Dialog.ElicitSlot";
		$this->slotToElicit = $body['slotToElicit'];
        $this->updatedIntent = $body['updatedIntent'];
    }
}
?>