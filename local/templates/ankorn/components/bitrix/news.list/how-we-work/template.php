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
$count = 0
?>


    <div class="hww">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $count++
            ?>
            <div class="hww-col">
                <div class="paragraph hww-item paragraph--type--how-work paragraph--view-mode--default">
                    <div class="hww-item-num">
                        0<?= $count ?>
                    </div>
                    <div class="hww-item-title">

                        <div class="field field--name-field-how-work-title field--type-string field--label-hidden field__item">
                            <? echo $arItem["NAME"] ?>
                        </div>

                    </div>
                    <div class="hww-item-text">

                        <div class="field field--name-field-how-work-text field--type-string-long field--label-hidden field__item">
                            <? echo $arItem["PREVIEW_TEXT"] ?>
                        </div>

                    </div>
                </div>
            </div>
        <? endforeach; ?>

    </div>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>
