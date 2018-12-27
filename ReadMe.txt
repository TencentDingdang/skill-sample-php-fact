
【SDK文件目录说明】
.
|--config.php 叮当开发平台上面配置的skill配置
|--dkcommon.php 业务函数，用户自己写
|--index.php 入口函数，用户自己写逻辑
|--tsk skd所在目录
	|--common 一些通用的类
	|--intent 意图定义类
		|--intent.php 意图定义
	|--request 请求定义
		|--Request.php 请求公共部分
		|--IntentRequest.php 明确意图的请求
		|--LaunchRequest.php 语音请求
		|--RetryIntentRequest.php 重试意图请求
		|--SessionEndedRequest.php 结束会话请求	
	|--slot 语槽
		|--Slot.php 语槽定义
		|--SlotValue.php 语槽的值定义 .
	|--TestTemplate.txt demo测试模板
	|--ReadMe.txt readme文件
	|--directive
		|--AudioPlayerPlay.php 音频播放指令AudioPlayer.Play
		|--DialogElicitSlot.php 语槽追问指令Dialog.ElicitSlot
		|--Directive.php 指令
		|--DisplayRenderTemplate.php 展示指令Display.RenderTemplate
		|--PaymentPay.php 支付指令Payment.Pay
		|--Template.php 展示所用模板内容
	|--entity 实体定义目录
		|--ImageObj.php 图片实体
		|--AudioObj.php 音频实体
		|--TextContentObj.php 文本实体
	|--response 响应定义
		|--OutputSpeech.php 语音内容
		|--Response.php 回复结构定义
	|--Skill.php 请求技能定义
	|--SkillRsp.php 回复技能定义
	
【开发步骤】
1、叮当开放平台配置技能skill,包括意图，语料，语槽等配置；
2、根据1的配置，填写config.php文件；
3、编写业务逻辑：dkcommon.php，index.php
4、打包当前目录成zip文件；
5、腾讯云SCF函数创建，配置叮当开放平台秘钥到SCF的环境变量dingdangsecret里面，上传4中的.zip包；
6、完成开发，保存后测试验证；

【说明】
本例子是房贷计算器，业务逻辑在dkcommon.php，index.php中，通过用户录入贷款总额，贷款年限，还款方式，计算首月的还款额度；