<?php
require_once "common/Session.php";
require_once "common/Context.php";
require_once "request/LaunchRequest.php";
require_once "request/IntentRequest.php";
require_once "request/SessionEndedRequest.php";
require_once "request/RetryIntentRequest.php";

class Skill{
	public $version;
	public $session;
	public $context;
	public $request;
	
    public function __construct($event, $context) {
		$header = $event->header;
		$body = $event->body;
		
        $this->version = $body->version;
        $this->session = new Session($body->session);
        $this->context = new Context($body->context);
		$request = "";
		switch($body->request->type)
		{
		case "LaunchRequest":
			$request = new LaunchRequest($body->request);
			break;
		case "IntentRequest":
			$request = new IntentRequest($body->request);
			break;
		case "SessionEndedRequest":
			$request = new SessionEndedRequest($body->request);
			break;
		case "RetryIntentRequest":
			$request = new RetryIntentRequest($body->request);
			break;
		default:
			$request = new IntentRequest($body->request);				
		}
        $this->request = $request;
    }
	
	public function get_slot($slotName){
		$slots = $this->request->intent->slots;
		if(isset($slots[$slotName])){
			return $slots[$slotName];
		}
		return null;
	}
	
	public function get_slot_first_value($slotName,$index=0){
		$slots = $this->request->intent->slots;
		if(isset($slots[$slotName])){
			return $slots[$slotName]->values[$index]->value->value;
		}
		return null;
	}
}

function check_skill($skill, $config){
	//技能id校验
	$applicationId = $skill->context->System->application->applicationId;
	if($applicationId != $config['skill_id']){
		return FALSE;
	}
	return TRUE;
}

function check_intent($intent, $config)
{
	//意图校验
	$intent_name = $intent->name;
	if($intent_name != $config['intent']['name']){
		return FALSE;;
	}
	return TRUE;
}

function sign_check($event, $context)
{
    $secret = getenv('dingdangsecret');
	$header = $event->header;
	if(!isset($event->header) || empty($secret))
	{
		return false;
	}
	$body = $event->body;
	$authorization = $header->Authorization;
	if(!isset($header->Authorization))
	{
		return false;
	}
	$auth_arr = explode(" ",$authorization);
	if(count($auth_arr) < 3){
		return false;
	}
	$algo = $auth_arr[0];
    
	$sign_arr = explode(",", $auth_arr[1]);
	$date_arr = explode("=", str_replace(",","=",$auth_arr[1]));
	$sign_arr = explode("=", $auth_arr[2]);

	$date_str = $date_arr[1];
	$sign_str = $sign_arr[1];

	$sign = hash_hmac('sha256', $body.$date_str, $secret);
	if($sign==$sign_str){
		return true;
	}
	var_dump($sign_str);
	var_dump($sign);
	return false;
}

?>