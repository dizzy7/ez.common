<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
$APPLICATION->SetTitle("Mediasfera Debug Options");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

require_once(__DIR__.'/formHanlder.php');

$aTabs = array(
    array("DIV" => "general", "TAB" => "Общие настройки", "TITLE" => "Общие настройки")
    );



$tabControl = new CAdminTabControl("tabControl", $aTabs);?>

<form method="post" action="<?=$APPLICATION->GetCurPage()?>">
    <?$tabControl->Begin();

    $tabControl->BeginNextTab();
    ?>
    <tr valign="top">
        <td width="40%" class="field-name">Включить <a href="https://github.com/phpconsole/phpconsole" target="_blank">php-console</a></td>
        <td valign="middle">
            <?$phpc = COption::GetOptionString("md.common", "phpconsole", "N");?>
            <input type="checkbox" <?=$phpc == "Y"?"checked=\"checked\"":"";?> name="phpconsole" value="Y"/>
        </td>
    </tr>
    <?
    $tabControl->EndTab();

    $tabControl->Buttons();?>

    <input type="submit" name="submit" value="Применить"/>

    <?$tabControl->End();?>
</form>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>