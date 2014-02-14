<?php
IncludeModuleLangFile(__FILE__);


if(class_exists('md_common'))
    return;

class md_common extends CModule {
    public $MODULE_ID = 'md.common';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_CSS;

    public $START_TYPE = 'WINDOW';
    public $WIZARD_TYPE = "INSTALL";

    public function md_common(){
        $arModuleVersion = array();
        include(__DIR__.'/version.php');
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = "Готовые решения Медиасферы";
        $this->MODULE_DESCRIPTION = "Набор готовых компонентов на разные случаи жизни";
    }

    public function DoInstall()
    {
        global $APPLICATION, $step;
        $step = IntVal($step);
        if ($step < 2)
            $APPLICATION->IncludeAdminFile("Установка модуля", __DIR__.'/step1.php');
        elseif($step==2)
        {
            $this->InstallFiles();
            $this->InstallDB();

            if($_REQUEST['install_shopmap_iblock']=='Y' && $_REQUEST['install_shopmap_iblock_type']){
                $this->CreateShopMapIblock($_REQUEST['install_shopmap_iblock_type']);
            }
        }

    }

    public function DoUninstall()
    {
        $this->unInstallFiles();
        $this->unInstallDB();
    }

    function InstallDB()
    {
        RegisterModule("md.common");;
    }

    function UnInstallDB()
    {
        UnRegisterModule("md.common");;
    }

    function InstallFiles()
    {
        CopyDirFiles(__DIR__.'/components',$_SERVER['DOCUMENT_ROOT'].'/bitrix/components/md',true,true);

        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFilesEx('/bitrix/components/md');
    }

    private function CreateShopMapIblock($iblockType)
    {
        CModule::IncludeModule('iblock');

        //Создание инфоблока
        $iblock = new CIBlock;
        $ID = $iblock->Add(
            array(
                'ACTIVE'         => 'Y',
                'NAME'           => 'Объекты на карте',
                'CODE'           => 'shopmap',
                'IBLOCK_TYPE_ID' => $iblockType,
                'SITE_ID'        => 's1',
                'GROUP_ID'       => Array("2" => "R", "3" => "R"),
            )
        );

        var_dump($ID);
        $err = $iblock->LAST_ERROR;

        //Создание свойств
        $ibp = new CIBlockProperty;

        $ibp->Add(
            Array(
                "NAME"          => "Город",
                "ACTIVE"        => "Y",
                "SORT"          => "100",
                "CODE"          => "CITY",
                "PROPERTY_TYPE" => "L",
                "IBLOCK_ID"     => $ID,
                "VALUES"        => array(
                    array('VALUE' => 'Москва', 'DEF' => 'N', 'SORT' => 1),
                    array('VALUE' => 'Санкт-Петербург', 'DEF' => 'N', 'SORT' => 2),
                )
            )
        );

        $ibp->Add(
            array(
                "NAME"          => "Адрес",
                "CODE"          => "ADDRESS",
                "SORT"          => "100",
                "ACTIVE"        => "Y",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID"     => $ID,
            )
        );

        $ibp->Add(
            array(
                "NAME"          => "Телефон",
                "CODE"          => "PHONE",
                "SORT"          => "100",
                "ACTIVE"        => "Y",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID"     => $ID,
            )
        );

        $ibp->Add(
            array(
                "NAME"          => "Адрес сайта(с http://)",
                "CODE"          => "SITE",
                "SORT"          => "100",
                "ACTIVE"        => "Y",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID"     => $ID,
            )
        );

        $ibp->Add(
            array(
                "NAME"          => "Местоположение",
                "CODE"          => "MAP",
                "SORT"          => "100",
                "ACTIVE"        => "Y",
                "PROPERTY_TYPE" => "S",
                "USER_TYPE"     => "map_yandex",
                "IBLOCK_ID"     => $ID,
            )
        );
    }

}