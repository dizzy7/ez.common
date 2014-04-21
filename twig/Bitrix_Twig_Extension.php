<?php

class Bitrix_Twig_Extension extends \Twig_Extension {
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'bitrix';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('AddBitrixActions',function($arItem){
                $component = new \CBitrixComponent();
                $component->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],\CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $component->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],\CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"), array("CONFIRM" => 'Удалить элемент?'));
            }),
            new \Twig_SimpleFunction('GetEditAreaId',function($arItem){
                $component = new \CBitrixComponent();
                return $component->GetEditAreaId($arItem['ID']);
            }),
            new \Twig_SimpleFunction('ResizeImage',function($id,$width,$height){
                return \CFile::ResizeImageGet($id,array('width'=>$width,'height'=>$height),BX_RESIZE_IMAGE_PROPORTIONAL,true);
            }),
            new \Twig_SimpleFunction('ResizeImageView',function($id,$width,$height,$alt=array()){
                $img = \CFile::ResizeImageGet($id,array('width'=>$width,'height'=>$height),BX_RESIZE_IMAGE_PROPORTIONAL,true);
                $html = "<img src=\"{$img['src']}\" width=\"{$img['width']}\" height=\"{$img['height']}\"";
                foreach ($alt as $tag => $value) {
                    $html .= " {$tag}=\"{$value}\"";
                }
                $html .= ">";
                return $html;
            }),
            new \Twig_SimpleFunction('pcdebug',function($data){
                PC::debug($data);
            }),
            new \Twig_SimpleFunction('dumpr',function($data){
                    dump_r($data,false,true,1000,1);
                }),
        );
    }


} 