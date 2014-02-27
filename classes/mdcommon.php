<?php


class MdCommon {
    public function OnBeforeProlog(){
        require_once __DIR__.'/../vendor/autoload.php';

        $phpc = COption::GetOptionString('md.common','phpconsole','N');
        $phppass = COption::GetOptionString('md.common','phpconsolepass','');
        if($phpc=='Y'){
            $connector = \PhpConsole\Connector::getInstance();
            if($phppass){
                $connector->setPassword($phppass);
            }
            \PhpConsole\Helper::register($connector);
        } else {
            require_once __DIR__.'/phpconsole_stub.php';
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
            "text" => "Mediasfera debug",
            "title" => 'Mediasfera debug settings',
            "url" => ($local ? "md.common_debug.local.php" : "md.common_debug.bitrix.php"),
            "items_id" => $MODULE_ID."_items",
            "more_url" => array(),
            "items" => array()
        );

        $aModuleMenu[] = $aMenu;
    }

}