<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? /** @var $this CBitrixComponent */ ?>
<? /** @var $arResult Array */ ?>

<?CJSCore::Init('jquery')?>
<?$APPLICATION->AddHeadScript(__DIR__.'/script.js')?>
<?$APPLICATION->SetAdditionalCSS(__DIR__.'/style.css')?>

    <div class="scroll-gallery">
        <a href="#" class="next">next</a>
        <a href="#" class="prev">prev</a>
        <div class="gallery">
            <ul>
                <?foreach($arResult['ITEMS'] as $item):?>
                <li>
                    <a href="<?=$item['DETAIL_PAGE_URL']?>">
                        <img src="<?=$item['PREVIEW_PICTURE']?>" alt="image description" height="150" />
                    </a>
                </li>
                <?endforeach;?>
            </ul>
        </div>
    </div>