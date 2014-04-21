<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<br><br>
<h3>Добавить отзыв</h3>
<?
$APPLICATION->IncludeComponent(
    "bitrix:iblock.element.add.form",
    "",
    Array(
        "SEF_MODE" => "N",
        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "PROPERTY_CODES" => array("NAME", "PREVIEW_TEXT"),
        "PROPERTY_CODES_REQUIRED" => array("NAME", "PREVIEW_TEXT"),
        "GROUPS" => array("2"),
        "STATUS_NEW" => "ANY",
        "STATUS" => "INACTIVE",
        "LIST_URL" => "",
        "ELEMENT_ASSOC" => "CREATED_BY",
        "MAX_USER_ENTRIES" => "100000",
        "MAX_LEVELS" => "100000",
        "LEVEL_LAST" => "Y",
        "USE_CAPTCHA" => "Y",
        "USER_MESSAGE_EDIT" => "",
        "USER_MESSAGE_ADD" => "Спасибо! Ваш отзыв принят и скоро появится на сайте!",
        "DEFAULT_INPUT_SIZE" => "30",
        "RESIZE_IMAGES" => "N",
        "MAX_FILE_SIZE" => "0",
        "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
        "CUSTOM_TITLE_NAME" => "Ваше имя",
        "CUSTOM_TITLE_TAGS" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
        "CUSTOM_TITLE_PREVIEW_TEXT" => "Отзыв",
        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
        "CUSTOM_TITLE_DETAIL_TEXT" => "",
        "CUSTOM_TITLE_DETAIL_PICTURE" => ""
    ),
    false
);
?>
<br>
<hr>
<?foreach ($arResult['ITEMS'] as $item):?>
    <b><?=$item['NAME']?></b> (<?=substr($item['ACTIVE_FROM'],0,10)?>)<br>
    <?=$item['PREVIEW_TEXT']?>
    <hr>
<?endforeach;?>



