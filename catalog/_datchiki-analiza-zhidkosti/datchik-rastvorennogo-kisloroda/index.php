<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Датчики растворенного кислорода - купить у официального представителя с доставкой по всем регионам России. Подробное описание измерителей, характеристики, цены от производителя. Гарантия качества.");
$APPLICATION->SetPageProperty("keywords", "купить датчик растворенного кислорода, выбор датчика растворенного кислорода, цены на датчики растворенного кислорода");
$APPLICATION->SetPageProperty("title", "Датчики растворенного кислорода - каталог и цены на измерители | Компания Анкорн");
$APPLICATION->SetTitle("Датчики растворенного кислорода");
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
		<h1>Датчики растворенного кислорода</h1>
	</div>
	<div class="page-desc">
		<div class="text-formatted">
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
<div id="taxonomy-term-19" class="taxonomy-term catalog-parent vocabulary-catalog">
 <a href="/catalog/datchiki-analiza-zhidkosti/" class="catalog-parent-content">
	<div class="catalog-parent-picture">
		<div class="field field--name-field-catalog-image field--type-image field--label-hidden field__item">
 <img width="220" alt="Датчики анализа жидкости" src="/upload/medialibrary/d26/sikui7xzw0qsi516xhlpk6pkrq9ymy7i/catalog_image_4.png" height="242" class="image-style-catalog-token">
		</div>
	</div>
	<div class="catalog-parent-title">
		<div class="field field--name-name field--type-string field--label-hidden field__item">
			Датчики анализа жидкости
		</div>
	</div>
 </a>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>