<?php
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