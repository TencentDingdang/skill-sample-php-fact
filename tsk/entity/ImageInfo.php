<?php
class ImageInfo{
	public $contentDescription;
	public $source;
	public function __construct($body) {
        $this->contentDescription = "这是一个图片";

        $this->source = new stdClass();
        $this->source->url = "http://string.jpg";
    }
}
?>