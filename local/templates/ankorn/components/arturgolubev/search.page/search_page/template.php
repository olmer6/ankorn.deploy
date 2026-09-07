<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $APPLICATION;
?>

<div class="bx-ag-search-page search-page <?=$arResult["VISUAL_PARAMS"]["THEME_CLASS"]?>">

	
	<?if(is_array($arResult["CLARIFY_SECTION"]) && count($arResult["CLARIFY_SECTION"]) > 1):?>
		<div class="ag-spage-clarify-list">
			<div class="ag-spage-clarify-title"><?=GetMessage("AG_SPAGE_CLARIFY_SECTION");?></div>
			
			<a class="ag-spage-clarify-item <?if($arResult["SELECTED_SECTION"] == "") echo 'selected';?>" href="<?=$APPLICATION->GetCurPageParam("", array("section"))?>"><?=GetMessage("AG_SPAGE_CLARIFY_SECTION_ALL");?></a>
			
			<?foreach($arResult["CLARIFY_SECTION"] as $section):?>
				<a class="ag-spage-clarify-item <?if($arResult["SELECTED_SECTION"] == $section["ID"]) echo 'selected';?>" href="<?=$APPLICATION->GetCurPageParam('section='.$section["ID"], array("section"))?>"><?=htmlspecialcharsbx($section["NAME"])?> (<?=intval($section["CNT"])?>)</a>
			<?endforeach;?>
		</div>
	<?endif;?>
	
	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
		<?// clear //?>
	<?elseif($arResult["ERROR_CODE"]!=0):?>
		<p><?=GetMessage("SEARCH_ERROR")?></p>
		<?ShowError($arResult["ERROR_TEXT"]);?>
		<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
		<br /><br />
	<?elseif(count($arResult["SEARCH"])>0):?>
		<div class="search-view-default">
			<?if($arParams["DISPLAY_TOP_PAGER"] != "N"):?>
				<?echo $arResult["NAV_STRING"]?><br />
			<?endif;?>
			
			<?foreach($arResult["SEARCH"] as $k=>$arItem):
				$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
				// echo '<pre>'; print_r($arElement); echo '</pre>';
			?>
				<div class="<?if($k==0) echo 'search-item-first'?> search-item">
					<?if(is_array($arItem["PICTURE"])):?>
						<div class="search-preview"><img src="<?=$arItem["PICTURE"]["src"]?>"></div>
					<?endif;?>
					
					<div class="search-description">
						<div class="search-title"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a></div>
						
						<div class="search-previewtext"><?echo $arItem["BODY_FORMATED"]?></div>
						
						<?if(!empty($arElement["PROPS"])):?>
							<div class="search-propslist">
								<?foreach($arElement["PROPS"] as $prop):
								if(empty($prop["VALUE"])) continue;
								?>
									<div class="search-propsitem">
										<span class="search-propsitem-name"><?=$prop["NAME"]?>:</span> <span class="search-propsitem-value"><?=implode(', ', $prop["VALUE"])?></span>
									</div>
								<?endforeach;?>
							</div>
						<?endif;?>

						<?if(is_array($arElement["PRICES"]) && count($arElement["PRICES"])):?>
							<div class="search-prices">
								<?
								foreach($arElement["PRICES"] as $code=>$arPrice)
								{
									if ($arPrice["MIN_PRICE"] != "Y")
										continue;

									if($arPrice["CAN_ACCESS"])
									{
										if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
											<div class="search-price">
												<span class="search-price-new">
													<?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
												</span>
												<span class="search-price-old"><?=$arPrice["PRINT_VALUE"]?></span>
											</div>
										<?else:?>
											<div class="search-price">
												<span class="search-price-new"><?=$arPrice["PRINT_VALUE"]?></span>
											</div>
										<?endif;
									}

									if ($arPrice["MIN_PRICE"] == "Y")
										break;
								}
								?>
							</div>
						<?endif;?>
						
						<?if (
							$arParams["SHOW_RATING"] == "Y"
							&& strlen($arItem["RATING_TYPE_ID"]) > 0
							&& $arItem["RATING_ENTITY_ID"] > 0
						):?>
							<div class="search-item-rate"><?
								$APPLICATION->IncludeComponent(
									"bitrix:rating.vote", $arParams["RATING_TYPE"],
									Array(
										"ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
										"ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
										"OWNER_ID" => $arItem["USER_ID"],
										"USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
										"USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0? 'N': 'Y',
										"TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
										"TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
										"TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
										"TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
										"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
									),
									$component,
									array("HIDE_ICONS" => "Y")
								);?>
							</div>
						<?endif;?>

						<?if($arParams['SHOW_DATA_MODIFY'] == 'Y'):?>
							<br>
							<small><?=GetMessage("SEARCH_MODIFIED")?> <?=$arItem["DATE_CHANGE"]?></small>
						<?endif;?>
						<div class="clear"></div>
					</div>
				</div>
			<?endforeach;?>
			
			<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N"):?>
				<?echo $arResult["NAV_STRING"]?><br />
			<?endif;?>
			
			<div class="search-change-how">
				<?if($arResult["REQUEST"]["HOW"]=="d"):?>
					<a href="<?=$arResult["URL"]?>&amp;how=r<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
				<?else:?>
					<b><?=GetMessage("SEARCH_SORTED_BY_RANK")?></b>&nbsp;|&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
				<?endif;?>
			</div>
		</div>
	<?else:?>
		<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
	<?endif;?>
</div>

<?if($arResult["VISUAL_PARAMS"]["THEME_COLOR"]):?>
	<style>
		.search-page .search-item, .search-page input[type=text], .search-page input[type=submit], .ag-spage-clarify-item, .ag-spage-clarify-item:hover {
			border-color: <?=htmlspecialcharsbx($arResult["VISUAL_PARAMS"]["THEME_COLOR"])?> !important;
		}
		.search-page input[type=submit] {
			background-color: <?=htmlspecialcharsbx($arResult["VISUAL_PARAMS"]["THEME_COLOR"])?> !important;
		}
	</style>
<?endif;?>