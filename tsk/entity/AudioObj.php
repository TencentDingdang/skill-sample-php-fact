<?php
class AudioObj{
	public $source;
	public function __construct($body) {
        $this->source = new stdClass();
        $this->source->url = $body['source']['url'];
    }
}
?>