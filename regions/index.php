<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Доставка продукции компании Анкорн по России");
$APPLICATION->SetPageProperty("title", "Доставка в регионы | Компания Анкорн");
$APPLICATION->SetTitle("Регионы");
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
		<h1>Доставка в регионы</h1>
	</div>
	<div class="region region-content">
		<div id="block-adaptive-content" class="block block-system block-system-main-block">
			<div class="views-element-container">
				<div class="view view-regions view-id-regions view-display-id-page_1 js-view-dom-id-81cd153792e2f84ed5e4d4d2efa50e249e5501286e674802372be7349b47bb74">
					<div class="view-content">
						
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>