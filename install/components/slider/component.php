<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var $this CBitrixComponent
 *  @var $USER CUser
 *  @var $APPLICATION CMain
 */

CModule::IncludeModule('iblock');

if($this->StartResultCache(3600)){
    $res = CIBlockElement::GetList(
        array('SORT'=>'ASC'),
        array('IBLOCK_ID'=>$arParams['IBLOCK_ID'],'ACTIVE'=>'Y')
    );

    while($arr = $res->GetNext()){
        $arr['PREVIEW_PICTURE'] = CFile::GetPath($arr['PREVIEW_PICTURE']);
        $arResult['ITEMS'][] = $arr;
    }

    $this->IncludeComponentTemplate();
}

?>