<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arEvent = Array();
$dbType = CEventMessage::GetList($by="ID", $order="DESC");
while($arType = $dbType->GetNext()){
    $arEvent[$arType["EVENT_NAME"]] = $arType["EVENT_NAME"];
}

$arComponentParameters = array(
	"PARAMETERS" => array(
		"OK_TEXT" => Array(
			"NAME" => "Текст при успешной отправке",
			"TYPE" => "STRING",
			"DEFAULT" => "Спасибо, ваша заявка принята!",
			"PARENT" => "BASE",
		),
		"EMAIL_TO" => Array(
			"NAME" => "Email получателя",
			"TYPE" => "STRING",
			"DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")), 
			"PARENT" => "BASE",
		),
		"EVENT_NAME" => Array(
			"NAME" => "Почтовое событие",
			"TYPE"=>"LIST", 
			"VALUES" => $arEvent,
			"DEFAULT"=>"", 
			"MULTIPLE"=>"Y", 
			"COLS"=>50,
			"PARENT" => "BASE",
		),

	)
);


?>