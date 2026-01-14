<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="catalog">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div class="catalog-col catalog-col--4">
            <article class="commerce-product catalog-preview catalog-preview--product">
                <div class="catalog-preview-picture">

                    <div class="field field--name-field-image field--type-image field--label-hidden field__item">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" hreflang="ru">
                            <img
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                    height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                            />

                        </a>
                    </div>

                </div>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="catalog-preview-title">

                    <div class="field field--name-title field--type-string field--label-hidden field__item">
                        <? echo $arItem["NAME"] ?>
                    </div>

                </a>
                <div class="catalog-preview-text text-formatted">
                    <?= htmlspecialcharsBack($arItem['PROPERTIES']['SHORT_DESC_PRODUCT_LIST']["VALUE"]['TEXT']) ?>
                </div>
                <div class="catalog-preview-footer">
                    <div class="catalog-preview-more text-formatted">
                        <?= htmlspecialcharsBack($arItem['PROPERTIES']['FULL_DESC_PRODUCT_LIST']["VALUE"]['TEXT']) ?>

                    </div>
                    <div class="catalog-preview-button">
                        Развернуть
                    </div>
                </div>
            </article>


        </div>

    <? endforeach; ?>
</div>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>