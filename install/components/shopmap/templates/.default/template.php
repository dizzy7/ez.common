<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?CJSCore::Init(array('jquery'))?>
<?$APPLICATION->AddHeadScript($templateFolder.'/shops.js')?>
<?$APPLICATION->AddHeadScript('http://api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU')?>

<div id="map"></div>
<div id="list">
<ul id="listul">

</ul>
</div>

<script type="text/javascript">
    var shops = <?=$arResult['SHOPS']?>;
    ymaps.ready(shopmap_init);
</script>



