<?php
require_once "Directive.php";
require_once "Template.php";
class DisplayRenderTemplate extends Directive{
	public $token;
	public $template;
	public function __construct($body) {
        $this->type = "Display.RenderTemplate";
		$this->token = $body['token'];
        $this->template = new Template($body['template']);
    }
}
?>