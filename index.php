<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Заказывайте датчики уровня, датчики давления, датчики анализа жидкости, датчики температуры в компании Анкорн. Доставка по всей России. Гарантия качества.");
$APPLICATION->SetPageProperty("title", "Датчики уровня, датчики анализа жидкости, датчики температуры на заказ | Компания Анкорн");
$APPLICATION->SetTitle("Подбор и поставка контрольно-измерительных приборов");
?>

    <section class="promo">
        <div class="page-container">
            <div class="promo-inner">
                <div class="container">
                    <div class="promo-columns">
                        <div class="promo-column promo-column--left">
                            <h1 class="promo-title">
                                <b>Контрольно-измерительные приборы</b> для автоматизации технологических процессов
                            </h1>
                        </div>
                        <div class="promo-column promo-column--right">
                            <div class="promo-partners">
                                <div class="promo-partners-label">
                                    «Анкорн» - официальный <br>дистрибьютор
                                </div>
                                <div class="promo-partners-list">
                                    <ul class="list">
                                        <li class="list-item">
                                            <img src="/local/templates/ankorn/img/promo-partner-1.png" width="231"
                                                 height="58" alt="«Анкорн» - официальный дистрибьютор BD SENSORS">
                                        </li>
                                        <li class="list-item">
                                            <img src="/local/templates/ankorn/img/promo-partner-2.png" width="168"
                                                 height="34" alt="«Анкорн» - официальный дистрибьютор NIVELCO">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <? $APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"banner-search", 
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
		"COMPONENT_TEMPLATE" => "banner-search",
		"CATEGORY_0_iblock_products" => array(
			0 => "all",
		)
	),
	false
); ?>
                </div>
                <div class="page-lines">
                    <div class="page-line page-line--1"></div>
                    <div class="page-line page-line--2"></div>
                    <div class="page-line page-line--3"></div>
                    <div class="page-line page-line--4"></div>
                    <div class="page-line page-line--5"></div>
                </div>
            </div>
        </div>
    </section>

<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "catalog-home",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0 => "NAME", 1 => "PREVIEW_PICTURE", 2 => "",),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "5",
        "IBLOCK_TYPE" => "home",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MEDIA_PROPERTY" => "",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(0 => "LINK", 1 => "",),
        "SEARCH_PAGE" => "",
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SLIDER_PROPERTY" => "",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_RATING" => "N",
        "USE_SHARE" => "N"
    )
); ?>

    <section class="selection">
        <div class="page-container">
            <div class="selection-inner"
                 style="background-image: url(/local/templates/ankorn/img/selection-bg-mobile.jpg);">
                <div class="container">
                    <div class="selection-columns">
                        <div class="selection-column selection-column--left">
                            <div class="selection-title">
                                Профессиональный подбор оборудования сэкономит деньги и время
                            </div>
                            <div class="selection-description">
                                Мы внимательно изучим задачу, расскажем о наших приборах и предложим подходящее для
                                вашего предприятия решение.
                            </div>
                            <div class="selection-items">
                                <div class="selection-item selection-item--1">
                                    <div class="selection-item-icon">
                                        <img src="/local/templates/ankorn/img/selection-1.svg" width="79" height="36"
                                             alt="Доставка по всей России">
                                    </div>
                                    <div class="selection-item-label">
                                        Доставка по
                                        <br>всей России
                                    </div>
                                </div>
                                <div class="selection-item selection-item--2">
                                    <div class="selection-item-icon">
                                        <img src="/local/templates/ankorn/img/selection-2.svg" width="30" height="36"
                                             alt="Гарантия до 5 лет">
                                    </div>
                                    <div class="selection-item-label">
                                        Гарантия
                                        <br>до 5 лет
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="selection-column selection-column--right">
                            <div class="selection-button">
                                <button type="button" class="btn-red modal-selection">
                                    Подобрать прибор
                                </button>
                            </div>
                            <div class="selection-text">
                                Вы можете задать вопрос
                                <br>специалисту прямо сейчас!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-lines">
                    <div class="page-line page-line--1"></div>
                    <div class="page-line page-line--2"></div>
                    <div class="page-line page-line--3"></div>
                    <div class="page-line page-line--4"></div>
                    <div class="page-line page-line--5"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="applications pb-50">
        <div class="container">
            <? $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "applications-sections",
                array(
                    "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COUNT_ELEMENTS" => "N",
                    "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                    "FILTER_NAME" => "sectionsFilter",
                    "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                    "IBLOCK_ID" => "6",
                    "IBLOCK_TYPE" => "application",
                    "SECTION_CODE" => "",
                    "SECTION_FIELDS" => array(0 => "NAME", 1 => "PICTURE", 2 => "",),
                    "SECTION_ID" => $_REQUEST["SECTION_ID"],
                    "SECTION_URL" => "",
                    "SECTION_USER_FIELDS" => array(0 => "", 1 => "",),
                    "SHOW_PARENT_NAME" => "Y",
                    "TOP_DEPTH" => "2",
                    "VIEW_MODE" => "LINE"
                )
            ); ?>
        </div>
    </section>

    <section class="clients p-50">
        <div class="container">
            <div class="page-title">
                <h2>Наши клиенты</h2>
            </div>
        </div>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "clients-slider",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "PREVIEW_PICTURE",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "8",
                "IBLOCK_TYPE" => "home",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MEDIA_PROPERTY" => "",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                    2 => "",
                ),
                "SEARCH_PAGE" => "",
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SLIDER_PROPERTY" => "",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_RATING" => "N",
                "USE_SHARE" => "N",
                "COMPONENT_TEMPLATE" => "clients-slider"
            ),
            false
        ); ?>
    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>