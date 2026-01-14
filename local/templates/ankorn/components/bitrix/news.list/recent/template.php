<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<section class="product-recently">
    <div class="container">
        <div class="product-recently-block">
            <div class="product-recently-title">
                Недавно просмотренные товары
            </div>
            <div class="product-recently-row">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="product-recently-col">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="commerce-product product-preview">
                            <div class="product-preview-picture">

                                <div class="field field--name-field-image field--type-image field--label-hidden field__item">
                                    <img
                                            class="image-style-product-preview"
                                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                            width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                            height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                            alt="<?= $arItem["NAME"]?>"
                                            title="<?= $arItem["NAME"]?>"
                                    />

                                </div>

                            </div>
                            <div class="product-preview-title">

                                <div class="field field--name-title field--type-string field--label-hidden field__item"><?= $arItem["NAME"]?></div>

                            </div>
                        </a>

                    </div>
                <? endforeach; ?>

            </div>
        </div>
    </div>
</section>
<?// if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
<!--    <br/>--><?php //= $arResult["NAV_STRING"] ?>
<?// endif; ?>
