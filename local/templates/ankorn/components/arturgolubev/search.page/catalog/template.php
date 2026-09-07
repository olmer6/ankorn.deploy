<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $APPLICATION;
?>

<?if($arResult["VISUAL_PARAMS"]["THEME_COLOR"]):?>
	<style>
		.search-page hr, .search-page input[type=text], .search-page input[type=submit], .ag-spage-clarify-item, .ag-spage-clarify-item:hover {
			border-color: <?=htmlspecialcharsbx($arResult["VISUAL_PARAMS"]["THEME_COLOR"])?> !important;
		}
		.search-page input[type=submit] {
			background-color: <?=htmlspecialcharsbx($arResult["VISUAL_PARAMS"]["THEME_COLOR"])?> !important;
		}
	</style>
<?endif;?>