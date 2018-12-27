<?php
require_once "response/Response.php";
require_once "response/OutputSpeech.php";
require_once "directive/DisplayRenderTemplate.php";
require_once "directive/DialogElicitSlot.php";
require_once "entity/TextContentObj.php";
class SkillRsp{
	public $version;
	public $response;
	
    public function __construct() {
        $this->version = "1.0";
    }
}

function build_skill_success_response($config,$speech,$outText=NULL)
{
	$reponse['outputSpeech'] = new OutputSpeech($speech);
	$reponse['shouldEndSession'] = true;

	$skillBody = new SkillRsp();
	$rsp = new Response($reponse);
	$directiveCfg = $config['successDirective'];
	$directiveCfg["token"] = get_token();
	$displayDirective = new DisplayRenderTemplate($directiveCfg);
	unset($displayDirective->template->backgroundAudio);
	unset($displayDirective->template->url);
	unset($displayDirective->template->listItems);
	unset($displayDirective->template->backgroundImage->contentDescription);
	if(!empty($outText)){
		$displayDirective->template->textContent = new TextContentObj($outText);
	}

	$rsp->add_direvtives($displayDirective);
	$skillBody->response = $rsp;
	return array("header"=>$config['header'],"body"=>$skillBody);
}

function build_skill_failed_response($config,$error_code)
{
	$errorSpeechMap = $config['errorSpeechMap'];
	return build_skill_success_response($config,$errorSpeechMap[$error_code]);
}

function build_slot_elicit_failed_response($config,$speech,$slot_name,$updatedIntent,$outText=NULL)
{
	$reponse['outputSpeech'] = new OutputSpeech($speech);
	$reponse['shouldEndSession'] = false;

	$skillBody = new SkillRsp();
	$rsp = new Response($reponse);
	$directiveCfg = $config['failedDirective'];
	$directiveCfg["slotToElicit"] = $slot_name;
	$directiveCfg["updatedIntent"] = $updatedIntent;
	$displayDirective = new DialogElicitSlot($directiveCfg);

	$directiveCfg2 = $config['successDirective'];
	$directiveCfg2["token"] = get_token();
	$displayDirective2 = new DisplayRenderTemplate($directiveCfg2);
	unset($displayDirective2->template->backgroundAudio);
	unset($displayDirective2->template->url);
	unset($displayDirective2->template->listItems);
	unset($displayDirective2->template->backgroundImage->contentDescription);
	if(!empty($outText)){
		$displayDirective2->template->textContent = new TextContentObj($outText);
	}
	
	$rsp->add_direvtives($displayDirective);
	$rsp->add_direvtives($displayDirective2);
	$skillBody->response = $rsp;
	return array("header"=>$config['header'],"body"=>$skillBody);
}


function get_token( $length = 16 ) 
{
    $str = substr(md5(time()), 0, $length);//md5加密，time()当前时间戳
    return $str;
}

?>