<?php
class OutputSpeech{
	public $type;
	public $text;
	public function __construct($body) {
        $this->type = $body['type'];
        $this->text = $body['text'];
    }
}
?>