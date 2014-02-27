<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="pathbanner">
    <?if($arResult['URL']):?>
        <a href="<?=$arResult['URL']?>" <?if($arResult['TARGET']):?>target="<?=$arResult['TARGET']?>"<?endif;?>><img src="<?=$arResult['BANNER']?>"></a>
    <?else:?>
        <img src="<?=$arResult['BANNER']?>"
    <?endif;?>
</div>