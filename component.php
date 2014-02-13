<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($this->StartResultCache(3600)){
    CModule::IncludeModule('iblock');
    $res = CIBlockElement::GetList(
        array('PROPERTY_CITY','ASC'),
        array('IBLOCK_ID'=>$arParams['IBLOCK_ID'])
    );

    while($cib = $res->GetNextElement()){
        $arr = $cib->GetFields();
        $arr['PROPERTIES']=$cib->GetProperties();

        if($arr['PROPERTIES']['MAP']['VALUE']){
            $arResult['SHOPS'][$arr['PROPERTIES']['CITY']['VALUE']]['items'][]=array(
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

    foreach ($arResult['SHOPS'] as $city => $value) {
        $arResult['SHOPS'][$city]['name']=$city;
    }



    uasort($arResult['SHOPS'],function($a,$b){
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
    foreach ($arResult['SHOPS'] as $shop) {
        $json[]=$shop;
    }

    $arResult['SHOPS'] = json_encode($json);

    $this->IncludeComponentTemplate();
}
