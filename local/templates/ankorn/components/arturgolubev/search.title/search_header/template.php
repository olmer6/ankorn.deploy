<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if($INPUT_ID == '')
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if($CONTAINER_ID == '')
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
<div id="<?echo $CONTAINER_ID?>">
	<form action="<?echo $arResult["FORM_ACTION"]?>" class="search-header">
		<input
			id="<?echo $INPUT_ID?>"
			type="text"
			name="q"
			value=""
			size="40"
			maxlength="50"
			placeholder="Найти товар"
			autocomplete="off"
		/>
		<label>
			<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="15.5563" cy="15.5564" r="9.5" transform="rotate(-45 15.5563 15.5564)" stroke="#AC182D" stroke-width="3"/>
				<line x1="21.922" y1="21.9205" x2="31.8215" y2="31.82" stroke="#AC182D" stroke-width="4"/>
			</svg>
			<input name="s" class="hidden" type="submit" value="<?=GetMessage("CT_BST_SEARCH_BUTTON");?>" />
		</label>
	</form>
</div>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearchAG({
			'AJAX_PAGE': '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2,
			'PAGE': '<?=CUtil::JSEscape($arParams["PAGE"])?>',
			'POPUP_HISTORY': 'N',
			'QUICK_VARIANTS': []
		});
	});
</script>
