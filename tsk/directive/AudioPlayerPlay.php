<?php
require_once "AudioInfo.php";
require_once "Directive.php";
class AudioPlayer extends Directive{
	public $playlist;
	public function __construct($body) {
        $this->type = "AudioPlayer.Play";
        $this->playlist = array();
    }
}
?>