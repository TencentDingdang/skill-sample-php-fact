<?php
$config['dkconfig'] = array(
	"skill_id" => "1072052610523357184",
	"intent" => array(
		"name" =>"monthly_instalment",
		"confirmationStatus" =>"",
		"slots" => array(
			"loan" => array(
				"name" => "loan",
				"confirmationStatus" => "",
				"values" => array(
					array(
						"type" => "text"
					)
				)
			),
			"years" => array(
				"name" => "years",
				"confirmationStatus" => "",
				"values" => array(
					array(
						"type" => "text"
					)
				),
			),
			"method" => array(
				"name" => "method",
				"confirmationStatus" => "",
				"values" => array(
					array(
						"type" => "text",
					)
				)
			)
		)
	),
	"intent_cfg" => array(
		"name" =>"monthly_instalment",
		"confirmationStatus" =>"",
		"slots" => array(
			"loan" => array(
				"name" => "loan",
				"confirmationStatus" => "",
				"needed" => "1", //是否必填
				"values" => array(
					array(
						"type" => "sys.number",
						"value" => 100
					)
				),
				"failedOutputSpeech" => array(
					"type"=>"PlainText",
					"text"=>"你的贷款金额是多少万？"
				),
				"failedOutputText" => array(
					"title"=>"",
					"description"=>"贷款金额：多少万？"
				)
			),
			"years" => array(
				"name" => "years",
				"confirmationStatus" => "",
				"needed" => "1", //是否必填
				"values" => array(
					array(
						"type" => "usr.years",
						"value" => 30
					)
				),
				"failedOutputSpeech" => array(
					"type"=>"PlainText",
					"text"=>"你的还款年限是20年，还是30年？"
				),
				"failedOutputText" => array(
					"title"=>"",
					"description"=>"还款年限：20年，30年？"
				)
			),
			"method" => array(
				"name" => "method",
				"confirmationStatus" => "",
				"needed" => "1", //是否必填
				"values" => array(
					array(
						"type" => "usr.method",
						"value" => "等额本息"
					)
				),
				"failedOutputSpeech" => array(
					"type"=>"PlainText",
					"text"=>"你的还款方式是等额本息，还是等额本金？"
				),
				"failedOutputText" => array(
					"title"=>"",
					"description"=>"还款方式：等额本息，等额本金？"
				),
				"supportedValues" => array("等额本息","等额本金") //取值范围
			)
		)
	),
	"skillSuccessOutputSpeech" => array(
		"等额本金"=>array("type"=>"PlainText","text"=>'首月的还款金额是 $first_hk 元，此后每月递减。'),
		"等额本息"=>array("type"=>"PlainText","text"=>'每月的还款金额是 $first_hk 元。')
	),
	"skillSuccessOutputText" => array(
		"等额本金"=>array("title"=>"","description"=>'首月还款： $first_hk 元，每月递减。'),
		"等额本息"=>array("title"=>"","description"=>'每月还款： $first_hk 元。')
	),
	"skillFailedOutputSpeech" => array(
		"等额本金"=>array("type"=>"PlainText","text"=>"对不起，我不是很理解你说的。"),
		"等额本息"=>array("type"=>"PlainText","text"=>"对不起，我不是很理解你说的。")
	),
	"errorSpeechMap" => array(
		"signInvalid" => array("type"=>"PlainText","text"=>"对不起，我不是很理解你说的。你可以试试这样问？我要查月供"),
		"skillIdInvalid" => array("type"=>"PlainText","text"=>"对不起，我不是很理解你说的。你可以试试这样问？我要查月供"),
		"exception" => array("type"=>"PlainText","text"=>"对不起，我不是很理解你说的。")
	),
	"header" => array('Content-Type'=>"application/json;charset=UTF-8"),
	"successDirective" => array(
		"type"=>"Display.RenderTemplate",
		"template"=>array(
			"type"=>"NewsBodyTemplate1",
			"textContent"=>array(
				"title"=>"",
				"description"=>"商业贷款，基准利率+10%，结果仅供参考"
			),
			"backgroundImage"=>array(
				"contentDescription"=>"string", 
				"source"=>array(
					"url"=>"http://softimtt.myapp.com/browser/smart_service/ugc_skill/skill_demo_fangdai.jpg")
			),
			"backgroundAudio"=>array(
				"source"=>array(
					"url"=>"string"
				)
			),
			"url"=>"string"
		)
	),
	"failedDirective"=>array(
		"type"=>"Dialog.ElicitSlot",
		"slotToElicit"=>"string",
		"updatedIntent"=>array()
	)
);
?>

