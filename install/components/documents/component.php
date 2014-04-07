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
        array('IBLOCK_ID'=>$arParams['IBLOCK_ID'],'ACTIVE'=>'Y'),
        false,
        false,
        array(
            'ID','IBLOCK_ID','NAME','PROPERTY_FILE',
        )
    );

    while($arr = $res->GetNext()){
        if($arr['PROPERTY_FILE_VALUE']){
            $arFile = CFile::MakeFileArray($arr['PROPERTY_FILE_VALUE']); $type = "other";
            PC::debug($arFile["type"]);
            if (in_array($arFile["type"],array("application/pdf",'application/vnd.openxmlformats-officedocument.wordprocessingml.document '))) { $type = "pdf"; }
            if (in_array($arFile["type"],array("application/msword",'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))) { $type = "doc"; }
            if (in_array($arFile["type"],array("application/vnd.ms-excel",'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))) { $type = "xls"; }
            PC::debug($type);

            $arResult["FILES"][] = array(
                "SRC" => CFile::GetPath($arr['PROPERTY_FILE_VALUE']),
                "NAME" => $arr["NAME"],
                "TYPE" => $type
            );
        }
    }

    $this->IncludeComponentTemplate();
}

?>