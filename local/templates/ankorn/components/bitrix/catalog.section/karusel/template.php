<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);
?>
<div class="product-slider">
<?php foreach($arResult["ITEMS"] as $arItem):?>
    <div class="slide-item-wrap">
        <div class="slide-item">
            <img src="<?=$arItem['PREVIEW_PICTURE']["SRC"]?>" alt="<?=$arItem['NAME']?>">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                <div class="item-title"><?=$arItem['NAME']?></div>
            </a>
        </div>
    </div>
<?php endforeach; ?>
</div>

