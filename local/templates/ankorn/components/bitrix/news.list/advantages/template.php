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


<div class="about-pluses">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="about-pluses-item">
            <div class="paragraph about-plus paragraph--type--about-block paragraph--view-mode--default">
                <div class="about-plus-icon">
                    <img src="<?=CFile::GetPath($arItem["PROPERTIES"]["ICON"]["VALUE"])?>"
                         alt="<? echo $arItem["NAME"] ?>">
                </div>
                <div class="about-plus-content">
                    <div class="about-plus-title">

                        <div class="field field--name-field-about-title field--type-string field--label-hidden field__item">
                            <? echo $arItem["NAME"] ?>
                        </div>

                    </div>
                    <div class="about-plus-text">

                        <div class="field field--name-field-block-description field--type-string-long field--label-hidden field__item">
                            <? echo $arItem["PREVIEW_TEXT"] ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    <? endforeach; ?>
</div>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>
