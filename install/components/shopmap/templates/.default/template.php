<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?CJSCore::Init(array('jquery'))?>
<?$APPLICATION->AddHeadScript($templateFolder.'/shops.js')?>
<?$APPLICATION->AddHeadScript('http://api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU')?>


<form action="" method="GET" id="mapsearch">
    <label>
        <input type="text" value="<?=$_GET['search']?>" class="nnn" placeholder="Введите адрес или название магазина" name="search">
    </label>
    <label>
        <select name="type">
            <option>Все</option>
            <?foreach ($arResult['TYPES'] as $id=>$type):?>
                <option value="<?=$id?>" <?if($_GET['type']==$id):?>selected<?endif;?>><?=$type?></option>
            <?endforeach;?>
        </select>
    </label>
    <input name="s" type="submit" value="Найти">
</form>

<div id="map"></div>
<div id="list">
<ul id="listul">

</ul>
</div>

<script type="text/javascript">
    var shops = <?=$arResult['SHOPS']?>;
    ymaps.ready(shopmap_init);
</script>



