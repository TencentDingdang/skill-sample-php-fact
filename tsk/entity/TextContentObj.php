<?php
class TextContentObj{
	public $title;
	public $description;
	public function __construct($body) {
        $this->title = $body['title'];
		$this->description = $body['description'];
    }
}
?>