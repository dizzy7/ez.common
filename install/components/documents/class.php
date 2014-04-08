<?php


class DocumentsComponent extends \MdCommon\MdComponent {

    private $types = array(
        'doc' => array(
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ),
        'pdf' => array(
            'application/pdf',
        ),
        'xls' => array(
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ),

    );

    public function executeComponent()
    {
        if($this->StartResultCache(3600)){
            $res = $this->getData();

            while($arr = $res->GetNext()){
                if($arr['PROPERTY_FILE_VALUE']){
                    $arFile = CFile::MakeFileArray($arr['PROPERTY_FILE_VALUE']); $type = "other";
                    foreach ($this->types as $fileType=>$mime) {
                        if(in_array($arFile['type'],$mime)){
                            $type = $fileType;
                        }
                    }

                    $this->arResult["FILES"][] = array(
                        "SRC" => CFile::GetPath($arr['PROPERTY_FILE_VALUE']),
                        "NAME" => $arr["NAME"],
                        "TYPE" => $type
                    );
                }
            }

            $this->IncludeComponentTemplate();
        }

    }

    public function onPrepareComponentParams($arParams)
    {
        $this->setDefaultParams(array(
                'SORT_BY' => 'SORT',
                'SORT_ORDER' => 'ASC',
            ));
    }

    private function getData(){
        CModule::IncludeModule('iblock');
        $res = CIBlockElement::GetList(
            array('SORT'=>'ASC'),
            array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'],'ACTIVE'=>'Y'),
            false,
            false,
            array(
                'ID','IBLOCK_ID','NAME','PROPERTY_FILE',
            )
        );

        return $res;
    }

}