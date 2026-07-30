<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Полезные статьи, посвященные контрольно-измерительным приборам и их применение в разных отраслях промышленности.");
$APPLICATION->SetPageProperty("title", "Статьи | Компания Анкорн");
$APPLICATION->SetTitle("Статьи");
?><section class="breadcrumbs articles-breadcrumbs">
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
<?php
if(CModule::IncludeModule("iblock")) {
    if ($_GET["SECTION_CODE"]) {
    $elementRes = CIBlockElement::GetList([], ['IBLOCK_ID' => 1, 'CODE' => $_GET["SECTION_CODE"]], false, false, ['ID']);
    if ($element = $elementRes->Fetch())
        $result = ['type' => 'element', 'id' => $element['ID']];
    }
}

$sefUrlTemplates = [
    "news" => "",
    "section" => "#SECTION_CODE#/",
    "detail" => "#ELEMENT_CODE#/",
];
if( $result['type']=='element') {
    $_GET["ELEMENT_CODE"] == $_GET["SECTION_CODE"];
    unset($_GET["SECTION_CODE"]);
    $sefUrlTemplates = [
        "news" => "",
        "section" => "#SECTION_CODE_PATH#/",
        "detail" => "#ELEMENT_CODE#/",
    ];
}
?>
<?php $articlesPagePath = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/"); ?>
<?php if ($articlesPagePath === "articles" || $articlesPagePath === "articles/index.php"): ?>
<div class="container">
<div id="articlesIntro" class="articles-intro" style="display: none;">
	<p>
		Практические статьи по автоматизации, измерению уровня и расхода, промышленным датчикам и системам контроля. Разбираем реальные инженерные задачи, типовые ошибки монтажа и способы снижения технологических рисков.
	</p>
</div>
</div>
<?php endif; ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"articles_2",
	Array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "articles",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => [0=>"",1=>"",],
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"DETAIL_PAGER_TEMPLATE" => "arrows",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => ["PRODECTS","PROD","SHOW_COUNTER","TIME_READ","AUTOR"],
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PANEL" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => [0=>"NAME",1=>"PREVIEW_TEXT",2=>"PREVIEW_PICTURE",3=>"DETAIL_TEXT",4=>"",],
		"LIST_PROPERTY_CODE" => [0=>"SHOW_COUNTER",1=>"",],
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "9",
		"NUM_DAYS" => "30",
		"NUM_NEWS" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "round",
		"PAGER_TITLE" => "Статьи",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_FOLDER" => "/articles/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => $sefUrlTemplates,
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"YANDEX" => "N"
	)
);?><br>
<?php if ($articlesPagePath === "articles" || $articlesPagePath === "articles/index.php"): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
	var intro = document.getElementById('articlesIntro');
	var title = document.querySelector('h1');

	if (!intro || !title) {
		return;
	}

	title.insertAdjacentElement('afterend', intro);
	intro.style.display = '';
});
</script>
<?php endif; ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>