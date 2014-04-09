<?php

$loader = new \Twig_Loader_Filesystem(array($_SERVER['DOCUMENT_ROOT']));
$GLOBALS['twig'] = new \Twig_Environment($loader,array(
        'debug' => COption::GetOptionString('md.common','twig.debug','N') === 'Y',
        'cache' => $_SERVER['DOCUMENT_ROOT'].'/bitrix/cache/twig'
    ));
$GLOBALS['twig']->addExtension(new \Twig_Extension_Debug());
require_once __DIR__. '/Bitrix_Twig_Extension.php';
$GLOBALS['twig']->addExtension(new Bitrix_Twig_Extension());
$GLOBALS['arCustomTemplateEngines']=array(
    'twig'=>array(
        'templateExt'=>array('twig'),
        'function'=>'twigRender'
    ),
);

function twigRender($templateFile, $arResult, $arParams, $arLangMessages, $templateFolder, $parentTemplateFolder, $template){
    $arResult['PARAMS']=$arParams;
    echo $GLOBALS['twig']->render($templateFile,$arResult);
}
