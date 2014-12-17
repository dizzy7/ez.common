function shopmap_init() {
    var geolocation = ymaps.geolocation;
    var coords = [geolocation.latitude, geolocation.longitude];
    myMap = new ymaps.Map('map', {
        center: coords,
        zoom: 5
    });

    myMap.controls
        // Кнопка изменения масштаба.
        .add('zoomControl', { left: 5, top: 5 })
        // Список типов карты
        .add('typeSelector')
        // Стандартный набор кнопок
        .add('mapTools', { left: 35, top: 5 });

    var menu = $("#listul");

// Перебираем все группы.
    shops.forEach(function (group) {
        // Пункт меню.
        var menuItem = $('<li><a href="#">' + group.name + '</a></li>'),
        // Коллекция для геообъектов группы.
            collection = new ymaps.GeoObjectCollection(null, { preset: {
//                iconImageHref: '/images/maplabel.jpg', // картинка иконки
//                iconImageSize: [20, 21], // размеры картинки
//                iconImageOffset: [0, 0] // смещение картинки
            } }),
        // Контейнер для подменю.
            submenu = $('<ul class="submenu"/>');

        // Добавляем коллекцию на карту.
        myMap.geoObjects.add(collection);

        // Добавляем подменю.
        menuItem
            .append(submenu)
            // Добавляем пункт в меню.
            .appendTo(menu)
            // По клику удаляем/добавляем коллекцию на карту и скрываем/отображаем подменю.
            .find('a')
            .toggle(function () {
                submenu.slideUp(250);
            }, function () {
                submenu.slideDown(250);
            });

        // Перебираем элементы группы.
        group.items.forEach(function (item) {
            // Пункт подменю.
            var text = item.city + ' ,' + item.text;
            if(item.site.length>0){
                text += '<br><a href="'+item.site+'">'+item.site+'</a>'
            }

            var submenuItem = $('<li><a href="#">' + item.name + '</a></li>'),
            // Создаем метку.
                placemark = new ymaps.Placemark(item.center, {
                    balloonContentHeader: item.name,
                    balloonContentBody: text
                });

            // Добавляем метку в коллекцию.
            collection.add(placemark);
            // Добавляем пункт в подменю.
            submenuItem
                .appendTo(submenu)
                // При клике по пункту подменю открываем/закрываем баллун у метки.
                .find('a')
                .click(function (e) {
                    e.preventDefault();
                    myMap.setCenter(placemark.geometry.getCoordinates(), 12, {duration: 0, callback: function () {
                        placemark.balloon.open();
                    }});

                });
        });
    });

    // Выставляем масштаб карты чтобы были видны все группы.
    // Выставляем масштаб карты чтобы были видны все группы.
    var bounds = myMap.geoObjects.getBounds();

    if(bounds[0][0]==bounds[1][0] && bounds[0][1]==bounds[1][1]){
        console.log(bounds[0]);
        myMap.setCenter(bounds[0]);
        myMap.setZoom(15);
    } else {
        myMap.setBounds(myMap.geoObjects.getBounds());
    }
}
