<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

include __DIR__.'/lang/ru/template.php';

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="mfeedback">
    <?if(!empty($arResult["ERROR_MESSAGE"]))
    {
        foreach($arResult["ERROR_MESSAGE"] as $v)
            ShowError($v);
    }
    if(strlen($arResult["OK_MESSAGE"]) > 0)
    {
        ?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
    }
    ?>

    <form action="<?=POST_FORM_ACTION_URI?>" method="POST" id="callback_form">
        <?=bitrix_sessid_post()?>
        <div class="mf-name">
            <div class="mf-text">
                <?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
            </div>
            <input type="text" name="user_name" value="<?=$arResult["NAME"]?>">
        </div>
        <div class="mf-phone">
            <div class="mf-text">
                <?=GetMessage("MFT_PHONE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
            </div>
            <input type="text" name="user_phone" value="<?=$arResult["PHONE"]?>">
        </div>
        <div class="mf-email">
            <div class="mf-text">
                <?=GetMessage("MFT_TIME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("TIME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
            </div>
            <input type="text" name="user_time" value="<?=$arResult["TIME"]?>">
        </div>

        <?if($arParams["USE_CAPTCHA"] == "Y"):?>
            <div class="mf-captcha">
                <div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
                <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
                <div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
                <input type="text" name="captcha_word" size="30" maxlength="50" value="">
            </div>
        <?endif;?>
        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        <input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
    </form>
</div>

<script type="text/javascript">
    var form = $("#callback_form");
    form.on('submit',function(e){
        e.preventDefault();
        var formdata = (form.serialize());
        $.post('/bitrix/components/dev/form.callback/templates/popup/popup.php',formdata+"&submit=",function(data){
            $("#zcontainer").replaceWith(data);
        })
    })
</script>