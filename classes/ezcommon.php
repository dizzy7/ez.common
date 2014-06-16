<?php


class EzCommon {
    public function OnBeforeProlog(){
        require_once __DIR__.'/../vendor/autoload.php';

        $phpc = COption::GetOptionString('ez.common','phpconsole','N');
        $phppass = COption::GetOptionString('ez.common','phpconsolepass','');
        if($phpc=='Y'){
            $connector = \PhpConsole\Connector::getInstance();
            if($phppass){
                $connector->setPassword($phppass);
            }
            $connector->getDumper()->itemsCountLimit=5000;
            \PhpConsole\Helper::register($connector);
        } else {
            require_once __DIR__.'/phpconsole_stub.php';
        }

        $twig = COption::GetOptionString('ez.common','twig','N');
        if($twig==='Y'){
            require_once __DIR__.'/../twig/init.php';
        }

    }

    function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        $local = preg_match('#/local/modules/#',__DIR__);
        $MODULE_ID = basename(dirname(__FILE__));
        $aMenu = array(
            "parent_menu" => "global_menu_settings",
            "section" => $MODULE_ID,
            "sort" => 50,
            "text" => "Настройки EZ",
            "title" => 'Настройки EZ',
            "url" => ($local ? "ez.common_debug.local.php" : "ez.common_debug.bitrix.php"),
            "items_id" => $MODULE_ID."_items",
            "more_url" => array(),
            "items" => array()
        );

        $aModuleMenu[] = $aMenu;
    }

}