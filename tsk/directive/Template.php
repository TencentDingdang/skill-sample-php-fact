<?php
require_once(dirname(__FILE__).'/'."../entity/AudioObj.php");
require_once(dirname(__FILE__).'/'."../entity/ImageObj.php");
require_once(dirname(__FILE__).'/'."../entity/TextContentObj.php");
class Template{
	public $type;
	public $textContent;
	public $backgroundImage;
	public $backgroundAudio;
	public $url;
	public $listItems;

	public function __construct($body) {
		if(isset($body['type'])){
			$this->type = $body['type'];
		}

		if(isset($body['textContent'])){
			$this->textContent = new TextContentObj($body['textContent']);
		}

		if(isset($body['backgroundImage'])){
			$this->backgroundImage = new ImageObj($body['backgroundImage']);
		}

		if(isset($body['backgroundAudio'])){
			$this->backgroundAudio = new AudioObj($body['backgroundAudio']);
		}

		if(isset($body['url'])){
			$this->url = $body['url'];
		}

		if(isset($body['listItems'])){
			$this->listItems = $body['listItems'];
		}
    }
}
?>