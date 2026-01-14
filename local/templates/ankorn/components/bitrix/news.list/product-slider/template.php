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

<div class="catalog-slider">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div class="products-slider-item">

            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="commerce-product product-block">
                <div class="product-block-picture">

                    <div class="field field--name-field-image field--type-image field--label-hidden field__item">  <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="210" height="210" alt="<? echo $arItem["NAME"] ?>" class="image-style-product-block">


                    </div>

                </div>
                <div class="product-block-title">

                    <div class="field field--name-title field--type-string field--label-hidden field__item"><? echo $arItem["NAME"] ?></div>

                </div>
            </a>


        </div>

    <? endforeach; ?>
</div>
<?// if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
<!--    <br/>--><?php //= $arResult["NAV_STRING"] ?>
<?// endif; ?>

