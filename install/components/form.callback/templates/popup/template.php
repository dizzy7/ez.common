<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
CJSCore::Init(array('jquery'));
$APPLICATION->AddHeadScript($templateFolder.'/fancybox/jquery.fancybox.pack.js');
$APPLICATION->AddHeadScript($templateFolder.'/callback.js');
$APPLICATION->SetAdditionalCSS($templateFolder.'/fancybox/jquery.fancybox.css');
?>

<a href="/bitrix/components/dev/form.callback/templates/popup/popup.php" id="callback_popup">
    <?=$arParams['~BUTTON_HTML']?>
</a>