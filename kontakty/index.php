<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Вы можете обратиться к нам любым удобным способом: позвонить по телефону, заказать обратный звонок, воспользоваться электронной почтой или прийти в офис");
$APPLICATION->SetPageProperty("title", "Контакты компании Анкорн");
$APPLICATION->SetTitle("Контакты");
?>

    <section class="breadcrumbs">
        <div class="container">
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "main",
                Array(
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0"
                )
            );?>
        </div>
    </section>
<!--    <svg class="synmap-point" viewBox="0 0 42 60" xmlns="http://www.w3.org/2000/svg">-->
<!--        <path d="M21 0C7.31177 0 0.54541 9.54 0.54541 21.3082C0.54541 33.0764 21 60 21 60C21 60 41.4545-->
<!--        33.0764 41.4545 21.3082C41.4545 9.54 34.6881 0 21 0ZM21 28.6364C14.9754 28.6364 10.0909-->
<!--        23.7518 10.0909 17.7273C10.0909 11.7027 14.9754 6.81818 21 6.81818C27.0245 6.81818 31.909-->
<!--        11.7027 31.909 17.7273C31.909 23.7518 27.0245 28.6364 21 28.6364Z"></path>-->
<!--    </svg>-->
<section class="contacts-page p-50">
    <div class="container">
        <div class="page-title">
            <h1>Контакты</h1>
        </div>
        <div class="contacts-page__row">
            <div  class="contacts-page__desc">



                <article role="article" class="node node--type-page node--promoted node--view-mode-full">





                    <div class="node__content">

                        <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item"><p>Вы можете обратиться к&nbsp;нам любым удобным способом: позвонить по&nbsp;телефону, заказать обратный звонок, воспользоваться электронной почтой или прийти в&nbsp;офис.</p>

                            <p><a href="tel:88003334314">8 800 333-43-14</a><br><a href="mailto:info@ankorn.ru">info@ankorn.ru</a></p>

                            <p><strong>Время работы</strong><br>
                                пн—пт, с 9:00 до 19:00 без перерывов&nbsp;<br>
                                (время Московское)</p>

                            <p><strong>Адрес офиса АНКОРН</strong></p>

                            <p><strong>Головной офис и центральный склад: </strong><br>
                                108840, Россия, г. Москва,&nbsp;г. Троицк, микрорайон В, д.55<br>
                                (посещение офиса по предварительной договоренности с вашим менеджером)</p>

                            <p><a href="tel:+74958435093">7 (495) 843-50-93</a></p>

                            <p><strong>Юридический и почтовый адрес:&nbsp;</strong></p>

                            <p>108840, Россия, город Москва,</p>

                            <p>Внутригородская территория (внутригородское муниципальное образование) города федерального значения, городской округ Троицк, город Троицк, улица Лесная, дом 4Б, помещение 78</p>

                            <p>ИНН 2631036482, КПП 775101001&nbsp;</p>
                        </div>

                    </div>

                </article>


            </div>
            <div class="contact-message-contact-form contact-message-form contact-form block form block-contact-block" data-user-info-from-browser="" data-drupal-selector="contact-message-contact-form" id="block-adaptive-form-contact">

                <h2>
                    Срочно нужен датчик уровня? <br>
                    Заполните форму
                </h2>
                <p>
                    подберём решение под ваши условия эксплуатации с гарантией совместимости уже сегодня
                </p>

                <div id="contact_ajax_contact_message_contact_form">
                    <?$APPLICATION->IncludeComponent(
                        "kontactcomp:main.feedback",
                        "form",
                        array(
                            "AJAX_MODE" => "Y",
                            "EMAIL_TO" => "info@ankorn.ru",
                            "EVENT_MESSAGE_ID" => array(
                                0 => "25",
                            ),
                            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                            "REQUIRED_FIELDS" => array(
                            ),
                            "USE_CAPTCHA" => "N",
                            "COMPONENT_TEMPLATE" => "callForm"
                        ),
                        false
                    );?>
                </div>
            </div>
        </div>
    </div>
</section>

    <div id="map" style="width: 100%; height: 500px"></div>

    <script src="https://api-maps.yandex.ru/2.1/?apikey=f06f9be6-4490-42f8-ac04-2509ba629eee
&lang=ru_RU" type="text/javascript">
    </script>

    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [55.492069, 37.297323],
                zoom: 15
            });

            // Создаем пользовательскую метку с балуном
            var myPlacemark = new ymaps.Placemark(
                [55.492069, 37.297323],
                {
                    balloonContent: '<strong>«Анкорн»</strong>' // Текст в балуне
                },
                {
                    iconLayout: 'default#image',
                    iconImageHref: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                <svg class="synmap-point" viewBox="0 0 42 60" xmlns="http://www.w3.org/2000/svg" fill="#AC182D">
                    <path d="M21 0C7.31177 0 0.54541 9.54 0.54541 21.3082C0.54541 33.0764 21 60 21 60C21 60 41.4545
                    33.0764 41.4545 21.3082C41.4545 9.54 34.6881 0 21 0ZM21 28.6364C14.9754 28.6364 10.0909
                    23.7518 10.0909 17.7273C10.0909 11.7027 14.9754 6.81818 21 6.81818C27.0245 6.81818 31.909
                    11.7027 31.909 17.7273C31.909 23.7518 27.0245 28.6364 21 28.6364Z"></path>
                </svg>
            `),
                    iconImageSize: [42, 60], // Размеры SVG
                    iconImageOffset: [-21, -60] // Смещение для корректного позиционирования
                }
            );

            // Добавляем метку на карту
            myMap.geoObjects.add(myPlacemark);
        }
    </script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>