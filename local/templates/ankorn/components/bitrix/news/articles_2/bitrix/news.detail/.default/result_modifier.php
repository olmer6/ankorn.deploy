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

// микроразметка
if (!empty($arResult['ID'])) {
    $imageId = 0;
    $imageAlt = $arResult['NAME'] ?? '';
    // Получаем ID картинки
    if (!empty($arResult['PREVIEW_PICTURE']['ID'])) {
        $imageId = (int)$arResult['PREVIEW_PICTURE']['ID'];
    } elseif (!empty($arResult['DETAIL_PICTURE']['ID'])) {
        $imageId = (int)$arResult['DETAIL_PICTURE']['ID'];
    }
    if ($imageId > 0) {
        $arImage = CFile::GetFileArray($imageId);
        if ($arImage) {
            global $APPLICATION;
            $APPLICATION->SetPageProperty('og_image_url', $arImage['SRC']?:"https://disk.yandex.ru/i/s9drpgwe0krlWg");
            $APPLICATION->SetPageProperty('og_image_width', $arImage['WIDTH']?:"1280");
            $APPLICATION->SetPageProperty('og_image_height', $arImage['HEIGHT']?:"720");
            $APPLICATION->SetPageProperty('og_image_type', $arImage['CONTENT_TYPE']);
        }
    }
    // ALT всегда отправляем
    $APPLICATION->SetPageProperty('og_image_alt', $imageAlt);
    // убираем индексацию дублей
    if($arResult["LIST_PAGE_URL"] != "/articles/")
        $APPLICATION->SetPageProperty('robots', "noindex, nofollow");
}