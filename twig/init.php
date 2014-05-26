<?php

$loader = new \Twig_Loader_Filesystem(array($_SERVER['DOCUMENT_ROOT']));
$GLOBALS['twig'] = new \Twig_Environment($loader,array(
        'debug' => COption::GetOptionString('ez.common','twig.debug','N') === 'Y',
        'cache' => $_SERVER['DOCUMENT_ROOT'].'/bitrix/cache/twig',
        'autoescape' => false,
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
    $data = array(
        'p' => $arParams,
        'r' => $arResult,
        'app' => $GLOBALS['APPLICATION'],
    );
    $arResult['p']=$arParams;
    echo $GLOBALS['twig']->render($templateFile,$data);

    $component_epilog = $templateFolder . "/component_epilog.php";
    if(file_exists($_SERVER["DOCUMENT_ROOT"].$component_epilog))
    {
        $component = $template->__component;
        $component->SetTemplateEpilog(array(
                "epilogFile" => $component_epilog,
                "templateName" => $template->__name,
                "templateFile" => $template->__file,
                "templateFolder" => $template->__folder,
                "templateData" => false,
            ));
    }
}
