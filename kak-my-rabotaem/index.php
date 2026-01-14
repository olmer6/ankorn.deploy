<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Чтобы начать работу с нами, просто позвоните по телефону 8-800-333-43-14. Компания Анкор - подбор и поставка контрольно-измерительных приборов");
$APPLICATION->SetPageProperty("title", "Как мы работаем - компания Анкорн");
$APPLICATION->SetTitle("Как мы работаем");
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

    <section class="how-we-work p-50">
        <div class="container">
            <div class="page-title">
                <h1>Как мы работаем</h1>
            </div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "how-we-work",
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
                        0 => "NAME",
                        1 => "PREVIEW_TEXT",
                        2 => "PREVIEW_PICTURE",
                        3 => "",
                    ),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "7",
                    "IBLOCK_TYPE" => "how_we_work",
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
                    "COMPONENT_TEMPLATE" => "how-we-work"
                ),
                false
            ); ?>
        </div>
    </section>

    <section class="recall pb-50">
        <div class="page-container">
            <div id="block-recall-block"
                 class="block recall-block block-block-content">
                <div class="container">
                    <div class="recall-block-title">

                        Чтобы начать работу с нами, просто позвоните по номеру

                    </div>
                    <div class="recall-block-phone">
                        <a href="tel:8 800 333-43-14" class="recall-block-title">
                            8 800 333-43-14
                        </a>
                        <div class="recall-block-label">
                            звонок по РФ бесплатный
                        </div>
                    </div>
                    <div class="recall-block-button">
                        <button type="button" class="btn-red call">
                            Заказать звонок
                        </button>
                    </div>
                    <div class="recall-block-text">
                        В ближайшее время с вами <br>свяжется наш специалист
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

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>