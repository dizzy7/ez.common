<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?CJSCore::Init('jquery')?>
<?$APPLICATION->AddHeadScript($templateFolder.'/jquery.easing.1.3.js',true)?>

<div class="camera_wrap">

<?foreach($arResult["ITEMS"] as $arItem):?>

    <div data-src="<?=$arItem["PREVIEW_PICTURE"]?>">
        <div class="camera_caption fadeIn">
            <div class="camera_caption_bg">
                <div class="title1"><?=$arItem["PREVIEW_TEXT"];?></div>
            </div>
        </div>
    </div>

<?endforeach;?>

</div>

<script>
    $(window).load( function(){
        jQuery('.camera_wrap').camera();
    });
</script>