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
<section class="front-catalog-overlay pt-50">
    <div class="container">
        <div class="front-catalog">
            <div class="catalog catalog--small">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="catalog-col catalog-col--5">
                        <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>"
                           class="taxonomy-term catalog-teaser vocabulary-catalog">
                            <div class="catalog-teaser-picture">

                                <div class="field field--name-field-catalog-image field--type-image field--label-hidden field__item">
                                    <img
                                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                            width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                            height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                    />


                                </div>

                            </div>
                            <div class="catalog-teaser-title">
                                <? echo $arItem["NAME"] ?>
                            </div>
                        </a>
                    </div>
                <? endforeach; ?>

            </div>
            <div class="front-catalog-button">
                <a href="/catalog/" class="btn-gray">
                    Перейти в каталог
                </a>
            </div>
        </div>
    </div>
</section>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>
