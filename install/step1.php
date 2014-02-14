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

    <br>
    <input type="submit" name="inst" value="<?= GetMessage("MOD_INSTALL") ?>">
    <?
    $arSiteTabControl->End();
    ?>

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