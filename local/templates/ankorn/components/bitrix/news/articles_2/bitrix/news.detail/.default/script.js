$(document).ready(function() {
    // Находим контейнер статьи
    var $articleContent = $('.article-content');

    // Находим все теги ancor внутри статьи
    var $ancors = $articleContent.find('.ancor');

    // Проверяем, есть ли теги ancor
    if ($ancors.length > 0) {
        // Создаём структуру меню
        var $menu = $('<div class="article_menu"></div>');
        var $menuTitle = $('<div class="article_menu_title">Содержание:</div>');
        var $menuList = $('<ul></ul>');

        // Перебираем все ancor и добавляем пункты в меню
        $ancors.each(function(index) {
            var title = $(this).text();
            if (title && title.trim() !== '') {
                // Создаём пункт меню
                var $listItem = $('<li>' + title + '</li>');

                // Добавляем обработчик клика для плавного скролла
                $listItem.on('click', function() {
                    // Находим позицию ancor элемента
                    var targetElement = $ancors.eq(index);
                    var targetOffset = targetElement.offset().top;

                    // Плавная прокрутка к элементу
                    $('html, body').animate({
                        scrollTop: targetOffset - 20 // Небольшой отступ сверху
                    }, 800); // 800ms - длительность анимации

                    // Опционально: подсветка цели
                    targetElement.css({
                        'visibility': 'visible',
                        'background-color': '#ffff99',
                        'transition': 'all 0.3s'
                    });
                    setTimeout(function() {
                        targetElement.css({
                            'visibility': 'hidden',
                            'background-color': 'transparent'
                        });
                    }, 1000);
                });

                $menuList.append($listItem);
            }
        });

        // Собираем меню
        $menu.append($menuTitle);
        $menu.append($menuList);

        // Вставляем меню в начало .article-content
        $articleContent.prepend($menu);
    }
});