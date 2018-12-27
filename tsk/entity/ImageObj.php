<?php
class ImageObj{
	public $contentDescription;
	public $source;
	public function __construct($body) {
        $this->contentDescription = $body['contentDescription'];

        $this->source = new stdClass();
        $this->source->url = $body['source']['url'];
    }
}
?>