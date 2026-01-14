<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(mb_strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
{
	$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
	$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
	$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
}

if ($arResult["SEARCH"]) {
    $arID = array();
    foreach ($arResult["SEARCH"] as $i => $arItem) {
        if ($arItem["MODULE_ID"] == "iblock" && substr($arItem["ITEM_ID"], 0, 1) !== "S")
            $arID[$arItem["ITEM_ID"]] = $i;
    }
    $grab = CIBlockElement::GetList(array(), array(
        "ID" => array_keys($arID)
    ), false, false, array(
        "ID",
        "IBLOCK_ID",
        "PREVIEW_PICTURE"
    ));
    while ($ar = $grab->Fetch()) {
        $arResult["SEARCH"][$arID[$ar["ID"]]]["PICTURE"] = CFile::GetFileArray($ar["PREVIEW_PICTURE"]);
    }
}
?>