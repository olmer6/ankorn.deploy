<?php
if (!empty($arResult['PROPERTIES']['LIST_APPLICATIONS']['VALUE'])) {
    $res = CIBlockElement::GetList(
        array(
            'DATE_CREATE' => 'ASC'
        ),
        array(
            'ID' => $arResult['PROPERTIES']['LIST_APPLICATIONS']['VALUE']
        ),
        false,
        false,
        array(
            'NAME','PREVIEW_PICTURE','DETAIL_PAGE_URL'
        )
    );
    while($ob = $res->GetNext()){
        $ob['PREVIEW_PICTURE_SRC'] = CFile::GetPath($ob['PREVIEW_PICTURE']);
        $arResult['PROJECTS_LIST'][] = $ob;
    }
}