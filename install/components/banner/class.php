<?php


class BannerComponent extends \MdCommon\MdComponent {

    public function executeComponent()
    {
        $path = $_SERVER['SCRIPT_NAME'];

        if($this->StartResultCache(3600,array($path))){
            $res = $this->getData($path);

            if($cib = $res->GetNextElement()){
                $banner = $cib->GetFields();
                $banner['PROPERTIES'] = $cib->GetProperties();

                $this->arResult['BANNER'] = CFile::GetPath($banner['PREVIEW_PICTURE']);
                $this->arResult['URL'] = $banner['PROPERTIES']['URL']['VALUE'];
                $this->arResult['TARGET'] = $banner['PROPERTIES']['TARGET']['VALUE_XML_ID'] == '51661d325d44c07238ad507c283500c3' ? '_blank' : '';

                $this->IncludeComponentTemplate();
            }

            $this->IncludeComponentTemplate();
        }

    }

    /**
     * @param $path
     *
     * @return CDBResult
     */
    private function getData($path){
        CModule::IncludeModule('iblock');

        $res = CIBlockElement::GetList(
            array('SORT'=>'DESC'),
            array(
                'IBLOCK_ID'=>$this->arParams['IBLOCK_ID'],
                'PROPERTY_PATH'=>$path,
                'ACTIVE'=>'Y',
                'ACTIVE_DATE'=>'Y'
            ),
            false,
            array('nTopCount'=>1)
        );

        return $res;
    }

}