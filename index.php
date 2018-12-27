<?php
require_once "tsk/Skill.php";
require_once "tsk/SkillRsp.php";
require_once "dkcommon.php";
require_once "config.php";

function main_handler($event, $context) {
	var_dump($event);
	var_dump($context);

	global $config;
	$dkconfig = $config['dkconfig'];
	if(!isset($event->header) || !isset($event->body)){
		echo __FILE__.__LINE__.":"."params not found\n";
		return build_skill_failed_response($dkconfig, 'signInvalid');
	}

	if(!sign_check($event, $context)){
		echo __FILE__.__LINE__.":"."sign not match\n";
		return build_skill_failed_response($dkconfig, 'signInvalid');
	}

	$event->body = json_decode($event->body);
    try{
		$skill = new Skill($event, $context);
		//基本校验
		if(empty($skill) || !check_skill($skill, $dkconfig)){
			echo __FILE__.__LINE__.":"."skill invalid";
			return build_skill_failed_response($dkconfig, 'skillIdInvalid');
		}

		$result = null;
		switch ($skill->request->type) {
			case 'IntentRequest':
				echo __FILE__.__LINE__.":"."IntentRequest...\n";
				$result = intentRequestProcess($skill,$dkconfig);
				break;
			case 'LaunchRequest':
				echo __FILE__.__LINE__.":"."LaunchRequest...\n";
				$result = launchRequestProcess($skill,$dkconfig);
				break;
			default:
				echo __FILE__.__LINE__.":"."request type not found,default IntentRequest...\n";
				$result = intentRequestProcess($skill,$dkconfig);
				break;
		}

		if(!empty($result)){
			return $result;
		}
		
    }catch (Exception $e){
        echo "failed : ".$e.getMessage();
    }
    return build_skill_failed_response($dkconfig, 'exception');
}

function launchRequestProcess($skill,$dkconfig)
{
	echo __FILE__.__LINE__.":"."launch process start...\n";
	return build_skill_failed_response($dkconfig, 'skillIdInvalid');
}

function intentRequestProcess($skill,$dkconfig)
{
	echo __FILE__.__LINE__.":"."intent process start...\n";
	 try{
		$intent = $skill->request->intent;
		if(!check_intent($intent, $dkconfig)){
			echo __FILE__.__LINE__.":"."intent not found\n";
			return build_skill_failed_response($dkconfig, 'skillIdInvalid');
		}
		
		//语槽检查,并获取语槽的值
		$require_slots = array();
		$require_slots['loan'] = "";
		$require_slots['years'] = "";
		$require_slots['method'] = "";
		$config_slots = $dkconfig['intent_cfg']['slots'];
		foreach($config_slots as $slotName=>$confg_slot){
			//非必选，跳过
			if($confg_slot['needed'] != "1"){
				echo __FILE__.__LINE__.":"."$slotName slot not needed\n";
				continue;
			}

			$failedOutputSpeech = $confg_slot['failedOutputSpeech'];
			$failedOutputText = $confg_slot['failedOutputText'];
			$slotSupportedValues = $confg_slot['supportedValues'];
			//必选检查
			if(!isset($intent->slots[$slotName])){
				echo __FILE__.__LINE__.":"."slot not found:$slotName\n";
				return build_slot_elicit_failed_response($dkconfig,$failedOutputSpeech,$slotName,null,$failedOutputText);
			}
			
			//值范围检查
			$slot_first_value = $skill->get_slot_first_value($slotName);
			if(!empty($slotSupportedValues) && !in_array($slot_first_value,$slotSupportedValues)){
				echo __FILE__.__LINE__.":"."slot value invalid:$slotName\n";
				return build_slot_elicit_failed_response($dkconfig,$failedOutputSpeech,$slotName,null,$failedOutputText);
			}

			//未传值
			$format_value = format_request_dk_value($slotName,$slot_first_value);
			if(empty($format_value)){
				echo __FILE__.__LINE__.":"."slot value invalid:$slotName\n";
				return build_slot_elicit_failed_response($dkconfig,$failedOutputSpeech,$slotName,null,$failedOutputText);
			}
			
			$require_slots[$slotName] = $format_value;
		}
		$dk_total = $require_slots['loan'];
		$dk_month = $require_slots['years'];
		$hk_type = $require_slots['method'];
		$successSpeach = $dkconfig["skillSuccessOutputSpeech"][$hk_type];
		$successText = $dkconfig["skillSuccessOutputText"][$hk_type];
		$speak_info = $successSpeach['text'];
		$text_info = $successText['description'];
		$dknl = 0.049 * 1.1;
		$first_hk = 0.00;
		switch($hk_type)
		{
		case "等额本息":
			$first_hk = debx($dk_month, $dk_total, $dknl);
			break;
		case "等额本金":
			$first_hk = debj($dk_month, $dk_total, $dknl);
			break;
		default:
			$first_hk = debx($dk_month, $dk_total, $dknl);
		}
		eval("\$speak_info = \"$speak_info\";");
		eval("\$text_info = \"$text_info\";");
		if(!empty($speak_info)){
			$successSpeach['text'] = $speak_info;
			$successText['description'] = $text_info;
			return build_skill_success_response($dkconfig, $successSpeach, $successText);
		}
    }catch (Exception $e){
        echo "failed : ".$e.getMessage();
        echo "\n";
    }
    return build_skill_failed_response($dkconfig, 'exception');
}
?>