<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?foreach($arResult["FILES"] as $file):?>

    <div class="file <?=$file['TYPE']?>">
        <a href="<?=$file['SRC']?>"><?=$file['NAME']?></a>
    </div>

<?endforeach;?>

