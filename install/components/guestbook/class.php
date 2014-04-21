<?php


class ShopsmapComponent extends \EzCommon\EzComponent
{

    public function executeComponent()
    {
            $res = $this->getData();

            while($arr = $res->GetNext()){
                $arr['PREVIEW_PICTURE'] = CFile::GetPath($arr['PREVIEW_PICTURE']);
                $this->arResult['ITEMS'][] = $arr;
            }

            $this->IncludeComponentTemplate();
    }

    private function getData()
    {
        CModule::IncludeModule('iblock');

        $res = CIBlockElement::GetList(
            array('ACTIVE_FROM'=>'DESC'),
            array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'],'ACTIVE'=>'Y')
        );

        return $res;
    }

}