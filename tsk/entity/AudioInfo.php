<?php
require_once "ImageObj.php";
class AudioInfo{
	public $stream;
	public $info;
	public function __construct($body) {
        $this->stream = new stdClass();
        $this->stream->url = "string";
        $this->stream->token = "string";

        $this->info = new stdClass();
        $this->info->title = "string";
        $this->info->subtitle = "string";
        $this->info->art = new ImageObj();
    }
}
?>