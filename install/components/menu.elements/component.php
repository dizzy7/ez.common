<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if(!isset($arParams['LIMIT']) || intval($arParams['LIMIT'])==0 ){
    $arParams['LIMIT'] = 20;
}

CModule::IncludeModule('iblock');
$res = CIBlockElement::GetList(
    array($arParams['SORT_BY'] => $arParams['SORT_ORDER']),
    array('IBLOCK_ID'=>$arParams['IBLOCK_ID']),
    false,
    array('nTopCount'=>$arParams['LIMIT'])
);

$links = array();
while($arr = $res->GetNext()){
    $links[] = array(
        $arr['NAME'],
        $arr['DETAIL_PAGE_URL'],
        array(),
        array(),
        ""
    );
}

PC::debug($arParams);
return $links;

?>
