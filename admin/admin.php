<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
$APPLICATION->SetTitle("Mediasfera Debug Options");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

require_once(__DIR__.'/formHanlder.php');

$aTabs = array(
    array("DIV" => "md_debug", "TAB" => "Debug", "TITLE" => "Debug"),
    array("DIV" => "md_twig", "TAB" => "Twig", "TITLE" => "Twig"),
    );



$tabControl = new CAdminTabControl("tabControl", $aTabs);?>

<form method="post" action="<?=$APPLICATION->GetCurPage()?>">
    <?$tabControl->Begin();

    $tabControl->BeginNextTab();
    ?>
    <tr valign="top">
        <td width="40%" class="field-name">Включить <a href="https://github.com/phpconsole/phpconsole" target="_blank">php-console</a></td>
        <td>
            <?$twig = COption::GetOptionString("md.common", "phpconsole", "N");?>
            <input type="checkbox" <?=$twig == "Y"?"checked=\"checked\"":"";?> name="phpconsole" value="Y"/>
        </td>
    </tr>
    <tr valign="top">
        <td width="40%" class="field-name">Пароль phpconsole</td>
        <td>
            <?$twig = COption::GetOptionString("md.common", "phpconsolepass", "");?>
            <input name="phpconsolepass" type="password" value="<?=$twig?>" />
        </td>
    </tr>

    <?
    $tabControl->EndTab();
    $tabControl->BeginNextTab();
    ?>
    <tr valign="top">
        <td width="40%" class="field-name">Включить <a href="http://twig.sensiolabs.org/" target="_blank">Twig</a></td>
        <td>
            <?$twig = COption::GetOptionString("md.common", "twig", "N");?>
            <input type="checkbox" <?=$twig == "Y"?"checked=\"checked\"":"";?> name="twig" value="Y"/>
        </td>
    </tr>
    <tr valign="top">
        <td width="40%" class="field-name">Включить отладку (dump) </td>
        <td>
            <?$twigDebug = COption::GetOptionString("md.common", "twig.debug", "N");?>
            <input type="checkbox" <?=$twigDebug == "Y"?"checked=\"checked\"":"";?> name="twig_debug" value="Y"/>
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