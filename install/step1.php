<form action="<?= $APPLICATION->GetCurPage() ?>" name="md_common_install">
    <?= bitrix_sessid_post() ?>

    <?
    CModule::IncludeModule('iblock');
    CJSCore::Init(array('jquery'));
    $arTypesEx = CIBlockParameters::GetIBlockTypes();
    ?>

    <input type="hidden" name="id" value="md.common">
    <input type="hidden" name="install" value="Y">
    <input type="hidden" name="step" value="2">

    <script>
        function ChangeShopmapIblock() {

        }
    </script>

    <?
    $arSiteTabControl = new CAdminViewTabControl("siteTabControl", array(
        array(
            'TITLE' => "Объекты на карте",
            'TAB'   => "Объекты на карте",
            "DIV"   => "md_shopmap"
        ),
        array(
            'TITLE' => "Формы",
            'TAB'   => "Формы",
            "DIV"   => "md_feedback"
        ),
        array(
            'TITLE' => "Отладка",
            'TAB'   => "Отладка",
            "DIV"   => "md_debug"
        ),
    ));
    $arSiteTabControl->Begin();
    ?>

    <? $arSiteTabControl->BeginNextTab(); ?>
    <table class="list-table">
        <tr>
            <td width="50%" align="right"><label for="install_shopmap_iblock">Создать инфоблок для карты объектов</label></td>
            <td><input type="checkbox" name="install_shopmap_iblock" id="install_shopmap_iblock" value="Y"
                       onclick="ChangeShopmapIblock()"></td>
        </tr>
        <tr>
            <td width="50%" align="right"><label for="install_shopmap_iblock_type">Тип информационного блока</label></td>
            <td>
                <select name="install_shopmap_iblock_type" id="install_shopmap_iblock_type" disabled>
                    <?foreach($arTypesEx as $id=>$name):?>
                        <option value="<?=$id?>"><?=$name?></option>
                    <?endforeach;?>
                </select>
            </td>
        </tr>
    </table>
    <? $arSiteTabControl->EndTab(); ?>

    <? $arSiteTabControl->BeginNextTab(); ?>
    <h2>Форма обратной связи с полем "Телефон"</h2>
    <table class="list-table">
        <tr>
            <td width="50%" align="right"><label for="install_feedback_template">Создать почтовое событие для формы</label></td>
            <td><input type="checkbox" name="install_feedback_template" id="install_feedback_template" value="Y"></td>
        </tr>
    </table>
    <h2>Форма "Заказать звонок"</h2>
    <table class="list-table">
        <tr>
            <td width="50%" align="right"><label for="install_callback_template">Создать почтовое событие для формы</label></td>
            <td><input type="checkbox" name="install_callback_template" id="install_callback_template" value="Y"></td>
        </tr>
    </table>
    <? $arSiteTabControl->EndTab(); ?>

    <? $arSiteTabControl->BeginNextTab(); ?>
    <h2>Отладка</h2>
    <h3>Фунция dump-r всегда подключена!</h3>
    <table class="list-table">
        <tr>
            <td width="50%" align="right"><label for="enable_phpconsole">Включить <a href="https://github.com/phpconsole/phpconsole" target="_blank">php-console</a></label></td>
            <td><input type="checkbox" name="enable_phpconsole" id="enable_phpconsole" value="Y"></td>
        </tr>
    </table>
    <? $arSiteTabControl->EndTab(); ?>

    <?$arSiteTabControl->End()?>

    <br>
    <input type="submit" name="inst" value="<?= GetMessage("MOD_INSTALL") ?>">




</form>

<script type="text/javascript">
    $(function(){
        $("#install_shopmap_iblock").on('change',function(e){
            if($(this).is(':checked')){
                $("#install_shopmap_iblock_type").removeAttr('disabled');
            } else {
                $("#install_shopmap_iblock_type").attr('disabled','disabled');
            }
        });
    });
</script>