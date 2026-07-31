<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

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

        echo '<pre id="inspect" class="ins_" style="display:none">';
        var_dump($arImage);
        echo '</pre>';
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
}