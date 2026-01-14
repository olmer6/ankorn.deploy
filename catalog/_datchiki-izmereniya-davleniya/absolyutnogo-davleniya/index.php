<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Датчики абсолютного давления - купить у официального представителя с доставкой по всем регионам России. Подробное описание продукции, характеристики, цены от производителя. Гарантия качества");
$APPLICATION->SetPageProperty("title", "Датчики абсолютного давления | Компания Анкорн");
$APPLICATION->SetTitle("Датчики абсолютного давления");
?><section class="breadcrumbs">
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
 </section> <section class="p-50">
<div class="container">
	<div class="page-title">
		<h1>Датчики абсолютного давления</h1>
	</div>
	<div class="pb-50">
		 <? $GLOBALS['arrFilterProduct'] = array("SECTION_ID" => 57); ?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"product-list",
	Array(
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
		"COMPONENT_TEMPLATE" => "product-list",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_PICTURE",2=>"",),
		"FILTER_NAME" => "arrFilterProduct",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "products",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "12",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "round",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"SHORT_DESC_PRODUCT_LIST",1=>"FULL_DESC_PRODUCT_LIST",2=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
	</div>
	<div class="page-desc">
		<div class="views-field">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "inc_desc.php"
	)
);?>
		</div>
	</div>
</div>
 </section>
<div id="taxonomy-term-22" class="taxonomy-term catalog-parent vocabulary-catalog">
 <a href="/catalog/datchiki-izmereniya-davleniya/" class="catalog-parent-content">
	<div class="catalog-parent-picture">
		<div class="field field--name-field-catalog-image field--type-image field--label-hidden field__item">
 <img width="220" alt="Сигнализаторы уровня" src="/upload/medialibrary/eeb/talmsrzhlwg70v4c3v5ot3d8wipjr7vt/catalog_image_3.png" height="220" class="image-style-catalog-token">
		</div>
	</div>
	<div class="catalog-parent-title">
		<div class="field field--name-name field--type-string field--label-hidden field__item">
			Датчики измерения давления
		</div>
	</div>
 </a>
</div><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>