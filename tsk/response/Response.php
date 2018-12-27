<?php
class Response{
	public $outputSpeech;
	public $shouldEndSession;
	public $directives;
	public function __construct($body) {
        $this->outputSpeech = $body['outputSpeech'];
		$this->shouldEndSession = $body['shouldEndSession'];
        $this->directives = array();
    }

    function add_direvtives($directive){
    	array_push($this->directives, $directive);
    }
}
?>