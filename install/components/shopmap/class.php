<?php


class ShopsmapComponent extends \EzCommon\EzComponent
{

    public function executeComponent()
    {
        if($this->StartResultCache(3600)){
            $res = $this->getData();

            while($cib = $res->GetNextElement()){
                $arr = $cib->GetFields();
                $arr['PROPERTIES']=$cib->GetProperties();

                if($arr['PROPERTIES']['MAP']['VALUE']){
                    $this->arResult['SHOPS'][$arr['PROPERTIES']['CITY']['VALUE']]['items'][]=array(
                        'id' => $arr['ID'],
                        'city'=>$arr['PROPERTIES']['CITY']['VALUE'],
                        'center'=>explode(',',$arr['PROPERTIES']['MAP']['VALUE']),
                        'text'=>$arr['PROPERTIES']['ADDRESS']['VALUE'].'<br>'.$arr['PROPERTIES']['PHONE']['VALUE'],
                        'phone'=>$arr['PROPERTIES']['PHONE']['VALUE'],
                        'name'=>$arr['NAME'],
                        'site'=>$arr['PROPERTIES']['SITE']['VALUE'],
                    );
                }
            }

            foreach ($this->arResult['SHOPS'] as $city => $value) {
                $this->arResult['SHOPS'][$city]['name']=$city;
            }



            uasort($this->arResult['SHOPS'],function($a,$b){
                    $a = $a['name'];
                    $b = $b['name'];
                    if($a==$b){
                        return 0;
                    }
                    if($a=='Москва') $a='1111';
                    if($b=='Москва') $b='1111';
                    if($a=='Санкт-Петербург') $a='2222';
                    if($b=='Санкт-Петербург') $b='2222';

                    if($a==$b){
                        return 0;
                    }

                    return ($a < $b) ? -1 : 1;
                });

            $json = array();
            foreach ($this->arResult['SHOPS'] as $shop) {
                $json[]=$shop;
            }

            $this->arResult['SHOPS'] = json_encode($json);

            $this->IncludeComponentTemplate();
        }
    }



    private function getData()
    {
        CModule::IncludeModule('iblock');

        $arFilter = array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID']);

        if(isset($_GET['s'])){
            $arFilter[]=array(
                'LOGIC'=>'OR',
                '%NAME'=>$_GET['search'],
                '%PROPERTY_CITY_VALUE'=>$_GET['search'],
                '%PROPERTY_ADDRESS'=>$_GET['search'],
            );
            if($_GET['type'] && $_GET['type']!='Все'){
                $arFilter['PROPERTY_TYPE']=$_GET['type'];
            }
        }

        $res = CIBlockElement::GetList(
            array('PROPERTY_CITY','ASC'),
            $arFilter
        );

        return $res;
    }

}