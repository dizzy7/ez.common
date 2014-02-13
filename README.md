Создать каталог /local/components/md/, в нем клонировать репозиторий https://github.com/dizzy7/bitrix-shopmap, либо скачать [архив](https://github.com/dizzy7/bitrix-shopmap/archive/master.zip) и распаковать

Подключить на страницу можно через визуальный редактор, или встав код:
```php
$APPLICATION->IncludeComponent(
	"md:bitrix-shopmap",
	"",
	Array(
	   "IBLOCK_ID"=> 1 //ID инфоблока
	),
false
);
```

Образец инфоблока можно  импортировать из файла iblock.xml.

