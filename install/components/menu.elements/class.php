<?php


class MenuElementsComponent extends \MdCommon\MdComponent
{

    public function executeComponent()
    {
        $res = $this->getData();

        $links = array();
        while ($arr = $res->GetNext()) {
            $links[] = array(
                $arr['NAME'],
                $arr['DETAIL_PAGE_URL'],
                array(),
                array(),
                ""
            );
        }

        return $links;
    }

    public function onPrepareComponentParams($arParams)
    {
        $this->setDefaultParams(
            array(
                'LIMIT' => '20',
            )
        );
    }

    private function getData()
    {
        CModule::IncludeModule('iblock');

        $res = CIBlockElement::GetList(
            array($this->arParams['SORT_BY'] => $this->arParams['SORT_ORDER']),
            array('IBLOCK_ID' => $this->arParams['IBLOCK_ID']),
            false,
            array('nTopCount' => $this->arParams['LIMIT'])
        );

        return $res;
    }

}