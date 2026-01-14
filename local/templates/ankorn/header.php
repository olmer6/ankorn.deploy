<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use Bitrix\Main\Page\Asset;

IncludeTemplateLangFile(__FILE__);
$currentUri = strtok($APPLICATION->GetCurUri(), '?');
if ($currentUri === '/') {
    $headerClass = "transparent";
} else {
    $headerClass = "";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
          rel="stylesheet">
    <script async type="text/javascript"> (function ct_load_script() {
            var ct = document.createElement('script');
            ct.type = 'text/javascript';
            ct.async = true;
            ct.rel = "preload";
            ct.src = document.location.protocol + '//cc.calltracking.ru/phone.b32eb.13477.async.js?nc=' + Math.floor(new Date().getTime() / 300000);
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ct, s);
        })(); </script>
    <script type="text/javascript"> (function ab() {
            var request = new XMLHttpRequest();
            request.open('GET', "https://scripts.botfaqtor.ru/one/129364", false);
            request.send();
            if (request.status == 200) eval(request.responseText);
        })(); </script>

    <script>(function(a,m,o,c,r,m){a[m]={id:"428629",hash:"b614dd2efe585a7489691531faa3ce939d2c708260e54172a3e40ddf251d4682",locale:"ru",inline:false,setMeta:function(p){this.params=(this.params||[]).concat([p])}};a[o]=a[o]||function(){(a[o].q=a[o].q||[]).push(arguments)};var d=a.document,s=d.createElement('script');s.async=true;s.id=m+'_script';s.src='https://gso.amocrm.ru/js/button.js';d.head&&d.head.appendChild(s)}(window,0,'amoSocialButton',0,0,'amo_social_button'));</script>

    <title><? $APPLICATION->ShowTitle() ?></title>
    <?php

    Asset::getInstance()
        ->addString('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />');
    Asset::getInstance()
        ->addString('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />');
    Asset::getInstance()
        ->addString('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />');
    Asset::getInstance()
        ->addString('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.min.css" integrity="sha512-fJcFDOQo2+/Ke365m0NMCZt5uGYEWSxth3wg2i0dXu7A1jQfz9T4hdzz6nkzwmJdOdkcS8jmy2lWGaRXl+nFMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />');

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/colorbox.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/bootstrap.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/style.css');


    Asset::getInstance()
        ->addString('<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>');
    //    Asset::getInstance()
    //        ->addString('<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.3.2/swiper-bundle.min.js" integrity="sha512-V1mUBtsuFY9SNr+ptlCQAlPkhsH0RGLcazvOCFt415od2Bf9/YkdjXxZCdhrP/TVYsPeAWuHa+KYLbjNbeEnWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>');
    Asset::getInstance()
        ->addString('<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>');
    //    Asset::getInstance()
    //        ->addString('<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>');
    Asset::getInstance()
        ->addString('<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>');
    Asset::getInstance()
        ->addString('<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>');
    Asset::getInstance()
        ->addString('<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>');
    Asset::getInstance()
        ->addString('<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.pkgd.min.js" integrity="sha512-achKCfKcYJg0u0J7UDJZbtrffUwtTLQMFSn28bDJ1Xl9DWkl/6VDT3LMfVTo09V51hmnjrrOTbtg4rEgg0QArA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>');
    Asset::getInstance()
        ->addString('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.4/jquery.colorbox-min.js" integrity="sha512-DAVSi/Ovew9ZRpBgHs6hJ+EMdj1fVKE+csL7mdf9v7tMbzM1i4c/jAvHE8AhcKYazlFl7M8guWuO3lDNzIA48A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>');

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/main.js');
    ?>

    <? $APPLICATION->ShowHead(); ?>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(45467883, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/45467883" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

<?php
  // Формируем JSON-LD
  $schemaMarkup = '
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Анкорн",
      "url": "https://ankorn.ru",
      "logo": "https://ankorn.ru/local/templates/ankorn/img/logo.png",
      "description": "Контрольно-измерительные приборы для автоматизации технологических процессов",
      "telephone": "8 (800) 333 43 14",
      "email": "info@ankorn.ru",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Лесная улица, д. 4Б",
        "addressLocality": "Москва",
        "postalCode": "108840",
        "addressCountry": "RU"
      }
    }
    </script>
  ';

  // Выводим разметку
  echo $schemaMarkup;
?>

</head>
<body>

<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

<div class="header <?php echo $headerClass; ?>">
    <div class="page-container">
        <div class="header__row">
            <div class="header__logo">
                <a href="/" title="Главная" rel="home">
                    <img src="/local/templates/ankorn/img/logo.png" alt="">
                    <p>
                        Подбор и поставка <br>
                        контрольно-измерительных <br>
                        приборов
                    </p>
                </a>
            </div>
            <div class="header__contact header__contact--email">
                <!-- <a href="mailto:info+f2g@ankorn.ru"> -->
                <a href="mailto:info@ankorn.ru">
                    <img src="/local/templates/ankorn/img/email-gray.svg" alt="info@ankorn.ru">
                    <span>info@ankorn.ru</span>
                </a>
                <div id="mail-explain">Для связи с отделом продаж</div>
            </div>
            <div class="header-telegram-mobile mobile_only">
              <a href="https://t.me/ANKORNbot" class="amo-button__link" data-social="telegram" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">  <path fill="#E1E1E1" d="M18.186 37.327c-.965 0-.8-.37-1.134-1.303l-2.838-9.488 21.85-13.165"></path> <path fill="#CDCDCD" d="M18.186 37.328c.745 0 1.074-.346 1.49-.757l3.973-3.923-4.956-3.035"></path> <path fill="#fff" d="m18.693 29.614 12.007 9.01c1.37.768 2.36.37 2.7-1.292l4.888-23.392c.5-2.038-.765-2.962-2.075-2.357l-28.7 11.239c-1.96.798-1.948 1.908-.357 2.403l7.365 2.334 17.05-10.925c.805-.496 1.544-.23.938.317"></path> </svg></a>
            </div>
            <div class="header-whatsapp-mobile mobile_only">
              <a href="https://wa.me/79604884112" class="amo-button__link" data-social="whatsapp" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">  <path fill="#fff" d="M40.8 23.567c0 9.04-7.384 16.367-16.495 16.367-2.892 0-5.609-.739-7.973-2.036L7.2 40.8l2.977-8.782a16.194 16.194 0 0 1-2.367-8.45c0-9.04 7.385-16.368 16.495-16.368 9.112 0 16.495 7.328 16.495 16.367ZM24.305 9.807c-7.647 0-13.867 6.173-13.867 13.76 0 3.011.981 5.8 2.641 8.068l-1.732 5.11 5.329-1.693a13.86 13.86 0 0 0 7.63 2.276c7.646 0 13.867-6.172 13.867-13.76S31.953 9.807 24.305 9.807Zm8.33 17.53c-.102-.167-.371-.268-.775-.468-.405-.2-2.393-1.172-2.763-1.305-.37-.134-.641-.201-.91.2-.27.402-1.044 1.305-1.28 1.573-.237.268-.472.302-.877.1-.404-.2-1.706-.624-3.25-1.99-1.203-1.063-2.014-2.376-2.25-2.778-.236-.401-.025-.618.177-.818.182-.18.405-.468.607-.703.203-.234.27-.4.404-.669.135-.268.068-.502-.034-.703-.1-.2-.91-2.175-1.247-2.978-.337-.803-.673-.67-.91-.67-.235 0-.505-.033-.774-.033-.27 0-.708.1-1.079.502-.37.402-1.414 1.372-1.414 3.346s1.448 3.882 1.65 4.15c.203.267 2.797 4.45 6.907 6.056 4.111 1.605 4.111 1.07 4.852 1.002.741-.066 2.392-.97 2.73-1.906.336-.938.336-1.74.236-1.908Z"></path> </svg></a>
            </div>
            <div class="header__contact header-whatsapp">
                <!-- <a href="https://wa.me/79175138220" target="_blank"> -->
                <a href="https://wa.me/79604884112" target="_blank">
                    <img src="/local/templates/ankorn/img/whatsap-gray.svg" alt="WhatsApp">
                    <span>WhatsApp</span>
                </a>
            </div>

            <div class="header__contact header-phone">
                <div class="header-phone-item">
                  <a href="tel:+78003334314">
                      <img src="/local/templates/ankorn/img/phone-gray.svg" alt="8 800 333-43-14">
                      <span class="wide-number">8 800 333-43-14</span>
                  </a>
                  <!-- <p>(Звонок по России бесплатный)</p> -->
                </div>
                
                <div class="header-phone-item">
                  <a href="tel:+74958435093">
                      <img src="/local/templates/ankorn/img/phone-gray.svg" alt="8 800 333-43-14">
                      <span>+7(495)843-50-93</span>
                  </a>
                  <!-- <p>(Москва)</p> -->
                </div>

            </div>

            <div class="header__contact header-icons">
                <a title="Сравнение" href="/catalog/compare/" class="header-icon-compare" rel="nofollow"><span>Сравнение</span></a>
                <a title="Избранное" href="/favorites/" class="header-icon-fav" rel="nofollow"><span>Избранное</span></a>
                <a title="Корзина" href="/personal/cart/" class="header-icon-cart" rel="nofollow"><span>Корзина</span></a>
            </div>

            
            <div class="call">
                <button class="btn-red call">Заказать звонок</button>
            </div>
            <div class="header-toggler">
                <div class="header-toggler-item header-toggler-item--1"></div>
                <div class="header-toggler-item header-toggler-item--2"></div>
                <div class="header-toggler-item header-toggler-item--3"></div>
            </div>
        </div>
        <div class="header__menu">
            <div class="header__menu-row">
                <nav role="navigation">
                    <ul>
                        <li class="header__menu-item menu-item--catalog">
                            <a class="header__menu-link" href="/catalog/">Каталог продукции</a>
                        </li>
                        <li class="header__menu-item">
                            <a class="header__menu-link" href="/industries/">Применение приборов</a>
                        </li>
                        <li class="header__menu-item">
                            <a class="header__menu-link" href="/kak-my-rabotaem/">Как мы работаем</a>
                        </li>
                        <li class="header__menu-item">
							<a class="header__menu-link" href="/about/">О компании</a>
                        </li>
                        <li class="header__menu-item">
                            <a class="header__menu-link" href="/kontakty/">Контакты</a>
                        </li>
                    </ul>
                </nav>
                <div class="header__search">
                    <? $APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"search-input", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_products",
		),
		"CATEGORY_0_TITLE" => "",
		"CHECK_DATES" => "Y",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "search-input",
		"CATEGORY_0_iblock_products" => array(
			0 => "all",
		)
	),
	false
); ?>
                </div>
            </div>
        </div>
        <div id="block-catalog-nav" class="block block-">




            <div class="catalog-nav">
                <div class="page-container">
                    <div class="catalog-nav-overlay">
                        <div class="catalog-nav-content">
                            <div class="catalog-nav-item">
								<a href="/catalog/datchiki-izmereniya-urovnya/" class="catalog-nav-picture">
                                    <img src="/upload/medialibrary/d11/ix2fu5jkr56roo9h7nkn5qmz7u2dsj67/catalog_image_5.png.jpg" alt="">
                                </a>
                                <div class="catalog-nav-list">
                                    <ul class="list">
                                        <li class="list-item list-item--first">
											<a href="/catalog/datchiki-izmereniya-urovnya/" class="list-link">
                                                Датчики измерения уровня
                                            </a>
                                        </li>
                                        <li class="list-item">
											<a href="/catalog/datchiki-izmereniya-urovnya/urovnemery/" class="list-link">
                                                Уровнемеры
                                            </a>
											
                                        </li>
                                        <li class="list-item">
											<a href="/catalog/signalizatory-urovnya/" class="list-link">
                                                Сигнализаторы уровня
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="catalog-nav-item">
								<a href="/catalog/datchiki-izmereniya-davleniya/" class="catalog-nav-picture">
                                    <img src="/upload/medialibrary/0ca/3e2stv578rzri5yo1ar8vowpghlq57bj/catalog_image_3.png.jpg" alt="">
                                </a>
                                <div class="catalog-nav-list">
                                    <ul class="list">
                                        <li class="list-item list-item--first">
											<a href="/catalog/datchiki-izmereniya-davleniya/" class="list-link">
                                                Датчики измерения давления
                                            </a>
                                        </li>
                                        <li class="list-item">
											<a href="/catalog/datchiki-izmereniya-davleniya/absolyutnogo-davleniya/" class="list-link">
                                                Датчики абсолютного давления
                                            </a>
                                        </li>
                                        <li class="list-item">
											<a href="/catalog/datchiki-izmereniya-davleniya/differencielnye/" class="list-link">
                                                Дифференциальные датчики давления
                                            </a>
                                        </li>
                                        <li class="list-item">
											<a href="/catalog/datchiki-izmereniya-davleniya/rele/" class="list-link">
                                                Реле давления
                                            </a>
                                        </li>
                                        <li class="list-item">
											<a href="/catalog/datchiki-izmereniya-davleniya/cifrovye-manometry/" class="list-link">
                                                Цифровые манометры
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="catalog-nav-item">
								<a href="/catalog/datchiki-analiza-zhidkosti/" class="catalog-nav-picture">
                                    <img src="/upload/medialibrary/93e/xn34u2rwar6s20df2hrmfeimwh71n1zu/catalog_image_4.png.jpg" alt="">
                                </a>
                                <div class="catalog-nav-list">
                                    <ul class="list">
                                        <li class="list-item list-item--first">
											<a href="/catalog/datchiki-analiza-zhidkosti/" class="list-link">
                                                Датчики анализа жидкости
                                            </a>
                                        </li>
                                        <li class="list-item">
											<a href="/catalog/datchiki-analiza-zhidkosti/izmerenie-ph/" class="list-link">
                                                Датчики измерения pH
                                            </a>
                                        </li>
                                        <li class="list-item">
											<a href="/catalog/datchiki-analiza-zhidkosti/provodimost-vody/" class="list-link">
                                                Датчики проводимости воды
                                            </a>
                                        </li>
                                        <li class="list-item">
											<a href="/catalog/datchiki-analiza-zhidkosti/datchik-rastvorennogo-kisloroda/" class="list-link">
                                                Датчики растворенного кислорода
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="catalog-nav-item">
								<a href="/catalog/datchiki-izmereniya-temperatury/" class="catalog-nav-picture">
                                    <img src="/upload/medialibrary/7e3/0djhjjg1tqtx1pfncfbpbu0jnm29xkdy/catalog_image_1.png.jpg" alt="">
                                </a>
                                <div class="catalog-nav-list">
                                    <ul class="list">
                                        <li class="list-item list-item--first">
											<a href="/catalog/datchiki-izmereniya-temperatury/" class="list-link">
                                                Датчики температуры
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="catalog-nav-item">
								<a href="/catalog/vtorichnye-pribory-dlya-avtomatizacii/" class="catalog-nav-picture">
                                    <img src="/upload/medialibrary/129/9wm7falska38dvk7hdjeuz1g7syge8y6/catalog_image_2.png.jpg" alt="">
                                </a>
                                <div class="catalog-nav-list">
                                    <ul class="list">
                                        <li class="list-item list-item--first">
											<a href="/catalog/vtorichnye-pribory-dlya-avtomatizacii/" class="list-link">
                                                Вторичные приборы для автоматизации
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>