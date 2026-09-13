<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("тест поиск");
CModule::IncludeModule("iblock");
?>


    <div class="container">

        <?$APPLICATION->IncludeComponent(
            "arturgolubev:search.title",
            "search_page",
            Array(
                "ANIMATE_HINTS" => array(""),
                "ANIMATE_HINTS_SPEED" => "1",
                "CATEGORY_0" => array(),
                "CATEGORY_0_TITLE" => "",
                "CHECK_DATES" => "N",
                "CONTAINER_ID" => "smart-title-search",
                "CONVERT_CURRENCY" => "N",
                "FILTER_NAME" => "",
                "INPUT_ID" => "smart-title-search-input",
                "INPUT_PLACEHOLDER" => "",
                "NUM_CATEGORIES" => "1",
                "ORDER" => "rank",
                "PAGE" => "/test/search/",
                "PREVIEW_HEIGHT_NEW" => "50",
                "PREVIEW_WIDTH_NEW" => "50",
                "PRICE_CODE" => array(),
                "PRICE_VAT_INCLUDE" => "Y",
                "QUICK_VARIANTS_SHOW" => "N",
                "SHOW_HISTORY" => "N",
                "SHOW_INPUT" => "Y",
                "SHOW_LOADING_ANIMATE" => "Y",
                "SHOW_PREVIEW" => "Y",
                "SHOW_PREVIEW_TEXT" => "N",
                "SHOW_PROPS" => array(""),
                "SHOW_QUANTITY" => "N",
                "TOP_COUNT" => "5",
                "USE_LANGUAGE_GUESS" => "Y",
                "VOICE_INPUT" => "N"
            )
        );?>

        <!-- Вкладки (только мобилка) -->
        <div class="search-tabs" id="searchTabs">
            <button type="button" class="search-tabs__btn active" data-tab="1">Поиск по каталогу</button>
            <button type="button" class="search-tabs__btn" data-tab="2">Поиск по статьям</button>
        </div>

        <div class="search-layout" id="searchLayout">
            <div class="search-swipe-wrapper slide-1" id="searchSwipe">

                <!-- Левая колонка 2/3 -->
                <div class="search-col search-col--main" data-col="1">
                    <div id="catalog_search">
                        <h2>Поиск по каталогу</h2>
                        <?$APPLICATION->IncludeComponent(
                            "arturgolubev:catalog.search",
                            "search_page",
                            [
                                "ACTION_VARIABLE" => "action",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "BASKET_URL" => "/personal/basket.php",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "N",
                                "CONVERT_CURRENCY" => "N",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "DISPLAY_COMPARE" => "N",
                                "DISPLAY_TOP_PAGER" => "N",
                                "ELEMENT_SORT_FIELD" => "sort",
                                "ELEMENT_SORT_FIELD2" => "id",
                                "ELEMENT_SORT_ORDER" => "asc",
                                "ELEMENT_SORT_ORDER2" => "desc",
                                "HIDE_NOT_AVAILABLE" => "N",
                                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                "IBLOCK_ID" => "2",
                                "IBLOCK_TYPE" => "products",
                                "INPUT_PLACEHOLDER" => "",
                                "LINE_ELEMENT_COUNT" => "3",
                                "OFFERS_LIMIT" => "5",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Товары",
                                "PAGE_ELEMENT_COUNT" => "30",
                                "PRICE_CODE" => "",
                                "PRICE_VAT_INCLUDE" => "Y",
                                "PRODUCT_DISPLAY_MODE" => "Y",
                                "PRODUCT_ID_VARIABLE" => "id",
                                "PRODUCT_PROPERTIES" => [
                                    0 => "ISHART",
                                    1 => "LIST_APPLICATIONS",
                                    2 => "PARAM_AVAILABLE",
                                    3 => "PARAM_ENV",
                                    4 => "PARAM_PRINCIP",
                                    5 => "PARAM_INSTALL",
                                    6 => "PARAM_DISPLAY",
                                    7 => "IN_THE_SI_REGISTRY",
                                    8 => "WARRANTY_3_YEAR",
                                    9 => "WARRANTY_5_YEAR",
                                    10 => "ADDITIONAL_FEATURES",
                                    11 => "SCOPE_OF_APPLICATION",
                                    12 => "MAIN_FEATURES",
                                    13 => "PARENT_ITEM",
                                    14 => "TR_CU_CERTIFICATE",
                                    15 => "LENGTH_RANGE",
                                    16 => "CML2_LINK",
                                    17 => "CML2_LINKALT",
                                    18 => "IS_MAIN",
                                    19 => "PLATE_LEADER",
                                    20 => "PLATE_CANCELED",
                                    21 => "PLATE_NEW",
                                ],
                                "PRODUCT_PROPS_VARIABLE" => "prop",
                                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                "PROPERTY_CODE" => [
                                    0 => "SHORT_DESC_PRODUCT_LIST",
                                    1 => "BREAD",
                                    2 => "PRICE",
                                    3 => "PRICE_EUR",
                                    4 => "FULL_DESC_PRODUCT_LIST",
                                    5 => "ANNOUNCE",
                                    6 => "ISHART",
                                    7 => "DESC",
                                    8 => "FILE_NAME1",
                                    9 => "FILE_NAME2",
                                    10 => "FILE_NAME3",
                                    11 => "FILE_NAME4",
                                    12 => "FILE_NAME5",
                                    13 => "FILE_NAME6",
                                    14 => "FILE_NAME7",
                                    15 => "FILE_NAME8",
                                    16 => "FILE_NAME9",
                                    17 => "FILE_NAME10",
                                    18 => "LIST_APPLICATIONS",
                                    19 => "DESC_APPLICATIONS",
                                    20 => "OPERATING_PRINCIPLE_DESCRIPTION",
                                    21 => "CHARACTERISTICS",
                                    22 => "PARAM_AVAILABLE",
                                    23 => "PARAM_TYPE1",
                                    24 => "PARAM_ENV",
                                    25 => "PARAM_PRINCIP",
                                    26 => "PARAM_METHOD",
                                    27 => "PARAM_RANGE1",
                                    28 => "PARAM_LENGTH",
                                    29 => "PARAM_INSTALL",
                                    30 => "PARAM_CONTROL",
                                    31 => "PARAM_ELEC",
                                    32 => "PARAM_VOLTAGE",
                                    33 => "PARAM_PRESSURE",
                                    34 => "PARAM_SAFE",
                                    35 => "PARAM_TEMP",
                                    36 => "PARAM_MAT",
                                    37 => "PARAM_MAT1",
                                    38 => "PARAM_DISPLAY",
                                    39 => "PARAM_BRAND",
                                    40 => "RVM_405_0",
                                    41 => "IN_THE_SI_REGISTRY",
                                    42 => "WEIGHT",
                                    43 => "AIR_VALVE",
                                    44 => "RESPONSE_TIME",
                                    45 => "INPUT",
                                    46 => "CONNECTION_TO_TRANSDUCERS",
                                    47 => "OUTPUT_VOLTAGE",
                                    48 => "WARRANTY_3_YEAR",
                                    49 => "WARRANTY_5_YEAR",
                                    50 => "HYSTERESIS",
                                    51 => "MAINSTR1",
                                    52 => "MAINSTR2",
                                    53 => "MAINSTR3",
                                    54 => "AMBIENT_PRESSURE",
                                    55 => "PIPE_DIAMETER",
                                    56 => "DISPLAY",
                                    57 => "LENGTH",
                                    58 => "PROBE_LENGTH",
                                    59 => "LENGTH_OF_PROBE_WITH_FLOAT",
                                    60 => "CABLE_LENGTH",
                                    61 => "ADDITIONAL_FEATURES",
                                    62 => "PROBE",
                                    63 => "PARAM_RANGE3",
                                    64 => "FIELD_GRADE_HOUSING",
                                    65 => "CABLE_COATING",
                                    66 => "CABLE_ENTRY",
                                    67 => "NUMBER_OF_BLADES",
                                    68 => "NUMBER_OF_SENSORS",
                                    69 => "NUMBER_OF_ALARM_POINTS",
                                    70 => "TAPER",
                                    71 => "ANTENNA_MATERIAL",
                                    72 => "VIBRATOR_MATERIAL",
                                    73 => "BLADE_MATERIAL",
                                    74 => "MEMBRANE_MATERIAL",
                                    75 => "PARAM_MAT5",
                                    76 => "PARAM_MAT4",
                                    77 => "WAFER_DISTANCE",
                                    78 => "MODEL",
                                    79 => "ATTACHED_WEIGHT",
                                    80 => "TITILE_FOR_MAIN_CARD_IN_LIST",
                                    81 => "SCOPE_OF_APPLICATION",
                                    82 => "MAIN_FEATURES",
                                    83 => "LIQUID_DENSITY",
                                    84 => "CONNECTION_TO_SENSOR",
                                    85 => "CONNECTION_TO_PC",
                                    86 => "S_PRIORITY",
                                    87 => "RESOLUTION",
                                    88 => "PARENT_ITEM",
                                    89 => "SENSOR",
                                    90 => "TR_CU_CERTIFICATE",
                                    91 => "CERTIFICATION",
                                    92 => "ROTATION_SPEED",
                                    93 => "DRAIN_PORT",
                                    94 => "PROCESS_CONNECTION",
                                    95 => "STRING_FOR_TITLE",
                                    96 => "PARAM_TEMP4",
                                    97 => "PARAM_TEMP2",
                                    98 => "PARAM_TEMP1",
                                    99 => "PROBE_TYPE",
                                    100 => "MEASURING_PROBE_TYPE",
                                    101 => "PARAM_PRTYPE",
                                    102 => "ACCURACY",
                                    103 => "SWITCHING_ANGLE",
                                    104 => "LENGTH_RANGE",
                                    105 => "LENGTH_NUM",
                                    106 => "CHARACTERISTICS_MOD",
                                    107 => "SENSITIVITY",
                                    108 => "SENSING_ELEMENT",
                                    109 => "ELECTRICAL_CONNECTION",
                                    110 => "ELECTRICAL_PROTECTION",
                                    111 => "CML2_LINK",
                                    112 => "CML2_LINKALT",
                                    113 => "IS_MAIN",
                                    114 => "PLATE_LEADER",
                                    115 => "PLATE_CANCELED",
                                    116 => "PLATE_NEW",
                                    117 => "PARAM_ARTICUL",
                                    118 => "PARAM_FREQ",
                                    119 => "PARAM_TYPE",
                                    120 => "PARAM_DEF",
                                    121 => "PARAM_RANGE",
                                    122 => "PARAM_JOIN",
                                    123 => "PARAM_MAT2",
                                    124 => "PARAM_MAT3",
                                    125 => "",
                                ],
                                "SECTION_ID_VARIABLE" => "SECTION_ID",
                                "SECTION_URL" => "",
                                "SHOW_HISTORY" => "Y",
                                "SHOW_PRICE_COUNT" => "1",
                                "USE_LANGUAGE_GUESS" => "Y",
                                "USE_PRICE_COUNT" => "N",
                                "USE_PRODUCT_QUANTITY" => "N"
                            ],
                            false
                        );?>
                    </div>
                </div>

                <!-- Правая колонка 1/3 -->
                <div class="search-col search-col--side" data-col="2">
                    <div id="search_page">
                        <h2>Поиск по статьям</h2>
                        <?$APPLICATION->IncludeComponent(
                            "arturgolubev:search.page",
                            "search_page",
                            [
                                "CACHE_TIME" => "3600",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "N",
                                "CONVERT_CURRENCY" => "N",
                                "DEFAULT_SORT" => "rank",
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FILTER_NAME" => "",
                                "INPUT_PLACEHOLDER" => "",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => ".default",
                                "PAGER_TITLE" => "Название результатов поиска",
                                "PAGE_RESULT_COUNT" => "50",
                                "PREVIEW_TEXT" => "",
                                "PRICE_CODE" => "",
                                "PRICE_VAT_INCLUDE" => "Y",
                                "SHOW_CLARIFY_SECTION" => "N",
                                "SHOW_DATA_MODIFY" => "N",
                                "SHOW_HISTORY" => "N",
                                "SHOW_PROPS" => [
                                    0 => "",
                                ],
                                "SHOW_WHEN" => "N",
                                "SHOW_WHERE" => "N",
                                "USE_LANGUAGE_GUESS" => "Y",
                                "arrFILTER" => [
                                    0 => "main",                 // Искать по статическим страницам сайта (контентные файлы)
                                    1 => "iblock_news",          // Искать по инфоблокам типа news
                                    2 => "iblock_how_we_work",   // Искать по инфоблокам типа how_we_work
                                ],
                                "arrFILTER_main" => [
                                    0 => "",
                                ],
                                "arrFILTER_iblock_news" => [
                                    0 => "all",                  // Искать во всех инфоблоках этого типа
                                ],
                                "arrFILTER_iblock_how_we_work" => [
                                    0 => "all",                  // Искать во всех инфоблоках этого типа
                                ],
                                "arrWHERE" => ""
                            ],
                            false
                        );?>
                    </div>
                </div>
            </div>
        </div>

    </div>


<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>