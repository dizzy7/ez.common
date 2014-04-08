<?php


class ShopsmapComponent extends \MdCommon\MdComponent
{

    public function executeComponent()
    {
        if($this->StartResultCache(3600)){
            $res = $this->getData();

            while($arr = $res->GetNext()){
                $arr['PREVIEW_PICTURE'] = CFile::GetPath($arr['PREVIEW_PICTURE']);
                $arResult['ITEMS'][] = $arr;
            }

            $this->IncludeComponentTemplate();
        }
    }



    private function getData()
    {
        CModule::IncludeModule('iblock');

        $res = CIBlockElement::GetList(
            array('SORT'=>'ASC'),
            array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'],'ACTIVE'=>'Y')
        );

        return $res;
    }

}