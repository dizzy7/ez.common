<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('iblock');

$path = $_SERVER['SCRIPT_NAME'];
$res = CIBlockElement::GetList(
    array('SORT'=>'DESC'),
    array('IBLOCK_ID'=>$arParams['IBLOCK_ID'],'PROPERTY_PATH'=>$path,'ACTIVE'=>'Y','ACTIVE_DATE'=>'Y'),
    false,
    array('nTopCount'=>1)
);
if($cib = $res->GetNextElement()){
    $banner = $cib->GetFields();
    $banner['PROPERTIES'] = $cib->GetProperties();

    $arResult['BANNER'] = CFile::GetPath($banner['PREVIEW_PICTURE']);
    $arResult['URL'] = $banner['PROPERTIES']['URL']['VALUE'];
    $arResult['TARGET'] = $banner['PROPERTIES']['TARGET']['VALUE_XML_ID'] == '51661d325d44c07238ad507c283500c3' ? '_blank' : '';

    $this->IncludeComponentTemplate();
}


?>
