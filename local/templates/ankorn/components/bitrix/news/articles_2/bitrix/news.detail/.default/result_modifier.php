<?php
use local\util\shortcode\ProdInArticle;

if (!empty($arResult['PROPERTIES']['PRODECTS']['VALUE'])) {
    $res = CIBlockElement::GetList(
        array(
            'DATE_CREATE' => 'ASC'
        ),
        array(
            'ID' => $arResult['PROPERTIES']['PRODECTS']['VALUE']
        ),
        false,
        false,
        array(
            'NAME','PREVIEW_PICTURE','DETAIL_PAGE_URL'
        )
    );
    while($ob = $res->GetNext()){
        $ob['PREVIEW_PICTURE_SRC'] = CFile::GetPath($ob['PREVIEW_PICTURE']);
        $arResult['PRODECTS_LIST'][] = $ob;
    }
}


if (!empty($arResult['PROPERTIES']['AUTOR']['VALUE'])) {
    $res = CIBlockElement::GetList(
        array(
            'DATE_CREATE' => 'ASC'
        ),
        array(
            'ID' => $arResult['PROPERTIES']['AUTOR']['VALUE']
        ),
        false,
        false,
        array(
            'NAME','PREVIEW_PICTURE','CODE','DETAIL_PAGE_URL',"PROPERTY_POSITION"
        )
    );
    while($ob = $res->GetNext()){
        $ob['PREVIEW_PICTURE_SRC'] = CFile::GetPath($ob['PREVIEW_PICTURE']);
        $arResult['AUTOR']= $ob;
    }
}
$arResult['PROPERTIES']["PROD"]["VALUE"] = ($arResult['PROPERTIES']["PROD"]["VALUE"])?:[];
$arResult["DETAIL_TEXT"] = ProdInArticle::insertingProductsIntoText($arResult["DETAIL_TEXT"], $arResult['PROPERTIES']["PROD"]["VALUE"]);