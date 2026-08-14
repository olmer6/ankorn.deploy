<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("тест поиск");
?><?php
CModule::IncludeModule("iblock");
?><br>
    <br>


    <div class="container">
        <h2>умный поиск по заголовкам</h2>
        <h2><?$APPLICATION->IncludeComponent(
                "arturgolubev:search.title",
                "",
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
            );?><br>
        </h2>
        <div>
            <br>
        </div>
        <h2>умный поиск по каталогу</h2>
        <h2><?$APPLICATION->IncludeComponent(
                "arturgolubev:catalog.search",
                "",
                Array(
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
                    "PRICE_CODE" => array(),
                    "PRICE_VAT_INCLUDE" => "Y",
                    "PRODUCT_DISPLAY_MODE" => "Y",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRODUCT_PROPERTIES" => array("ISHART","LIST_APPLICATIONS","PARAM_AVAILABLE","PARAM_ENV","PARAM_PRINCIP","PARAM_INSTALL","PARAM_DISPLAY","IN_THE_SI_REGISTRY","WARRANTY_3_YEAR","WARRANTY_5_YEAR","ADDITIONAL_FEATURES","SCOPE_OF_APPLICATION","MAIN_FEATURES","PARENT_ITEM","TR_CU_CERTIFICATE","LENGTH_RANGE","CML2_LINK","CML2_LINKALT","IS_MAIN","PLATE_LEADER","PLATE_CANCELED","PLATE_NEW"),
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "PROPERTY_CODE" => array("SHORT_DESC_PRODUCT_LIST","BREAD","PRICE","PRICE_EUR","FULL_DESC_PRODUCT_LIST","ANNOUNCE","ISHART","DESC","FILE_NAME1","FILE_NAME2","FILE_NAME3","FILE_NAME4","FILE_NAME5","FILE_NAME6","FILE_NAME7","FILE_NAME8","FILE_NAME9","FILE_NAME10","LIST_APPLICATIONS","DESC_APPLICATIONS","OPERATING_PRINCIPLE_DESCRIPTION","CHARACTERISTICS","PARAM_AVAILABLE","PARAM_TYPE1","PARAM_ENV","PARAM_PRINCIP","PARAM_METHOD","PARAM_RANGE1","PARAM_LENGTH","PARAM_INSTALL","PARAM_CONTROL","PARAM_ELEC","PARAM_VOLTAGE","PARAM_PRESSURE","PARAM_SAFE","PARAM_TEMP","PARAM_MAT","PARAM_MAT1","PARAM_DISPLAY","PARAM_BRAND","RVM_405_0","IN_THE_SI_REGISTRY","WEIGHT","AIR_VALVE","RESPONSE_TIME","INPUT","CONNECTION_TO_TRANSDUCERS","OUTPUT_VOLTAGE","WARRANTY_3_YEAR","WARRANTY_5_YEAR","HYSTERESIS","MAINSTR1","MAINSTR2","MAINSTR3","AMBIENT_PRESSURE","PIPE_DIAMETER","DISPLAY","LENGTH","PROBE_LENGTH","LENGTH_OF_PROBE_WITH_FLOAT","CABLE_LENGTH","ADDITIONAL_FEATURES","PROBE","PARAM_RANGE3","FIELD_GRADE_HOUSING","CABLE_COATING","CABLE_ENTRY","NUMBER_OF_BLADES","NUMBER_OF_SENSORS","NUMBER_OF_ALARM_POINTS","TAPER","ANTENNA_MATERIAL","VIBRATOR_MATERIAL","BLADE_MATERIAL","MEMBRANE_MATERIAL","PARAM_MAT5","PARAM_MAT4","WAFER_DISTANCE","MODEL","ATTACHED_WEIGHT","TITILE_FOR_MAIN_CARD_IN_LIST","SCOPE_OF_APPLICATION","MAIN_FEATURES","LIQUID_DENSITY","CONNECTION_TO_SENSOR","CONNECTION_TO_PC","S_PRIORITY","RESOLUTION","PARENT_ITEM","SENSOR","TR_CU_CERTIFICATE","CERTIFICATION","ROTATION_SPEED","DRAIN_PORT","PROCESS_CONNECTION","STRING_FOR_TITLE","PARAM_TEMP4","PARAM_TEMP2","PARAM_TEMP1","PROBE_TYPE","MEASURING_PROBE_TYPE","PARAM_PRTYPE","ACCURACY","SWITCHING_ANGLE","LENGTH_RANGE","LENGTH_NUM","CHARACTERISTICS_MOD","SENSITIVITY","SENSING_ELEMENT","ELECTRICAL_CONNECTION","ELECTRICAL_PROTECTION","CML2_LINK","CML2_LINKALT","IS_MAIN","PLATE_LEADER","PLATE_CANCELED","PLATE_NEW","PARAM_ARTICUL","PARAM_FREQ","PARAM_TYPE","PARAM_DEF","PARAM_RANGE","PARAM_JOIN","PARAM_MAT2","PARAM_MAT3",""),
                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                    "SECTION_URL" => "",
                    "SHOW_HISTORY" => "Y",
                    "SHOW_PRICE_COUNT" => "1",
                    "USE_LANGUAGE_GUESS" => "Y",
                    "USE_PRICE_COUNT" => "N",
                    "USE_PRODUCT_QUANTITY" => "N"
                )
            );?></h2>
        <div>
            <br>
        </div>
        <h2>умная страница поиска</h2>
        <br>
        <?$APPLICATION->IncludeComponent(
            "arturgolubev:search.page",
            "",
            Array(
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
                "PRICE_CODE" => array(),
                "PRICE_VAT_INCLUDE" => "Y",
                "SHOW_CLARIFY_SECTION" => "N",
                "SHOW_DATA_MODIFY" => "N",
                "SHOW_HISTORY" => "N",
                "SHOW_PROPS" => array(""),
                "SHOW_WHEN" => "N",
                "SHOW_WHERE" => "N",
                "USE_LANGUAGE_GUESS" => "Y",
                "arrFILTER" => array("no"),
                "arrFILTER_iblock_news" => array("all"),
                "arrFILTER_iblock_products" => array("all"),
                "arrFILTER_main" => array(""),
                "arrWHERE" => array()
            )
        );?><br>
    </div>
<?=$_SERVER["DOCUMENT_ROOT"]?>
    <br>


<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>