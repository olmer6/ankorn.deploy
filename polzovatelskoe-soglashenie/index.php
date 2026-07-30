<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Настоящее Соглашение определяет условия использования Пользователями материалов и сервисов сайта https://ankorn.ru");
$APPLICATION->SetPageProperty("title", "Пользовательское соглашение сайта Анкорн");
$APPLICATION->SetTitle("Пользовательское соглашение");
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
	<section class="p-50">
		<div class="container">
			<div class="page-title">
				<h1>Пользовательское соглашение</h1>
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


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>