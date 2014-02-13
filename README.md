Создать каталог /local/components/md/, в нем сделать git clone https://github.com/dizzy7/bitrix-shopmap

Подключение на страницу:
<?$APPLICATION->IncludeComponent(
	"md:bitrix-shopmap",
	"",
	Array(
	   "IBLOCK_ID"=> 1 //ID инфоблока
	),
false
);?>

Инфоблок импортируется из файла iblock.xml

