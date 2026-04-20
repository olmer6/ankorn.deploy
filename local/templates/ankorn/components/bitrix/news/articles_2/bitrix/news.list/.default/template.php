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

<div class="statji">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div class="statji-col">

            <article role="article" class="node statji-teaser node--type-statji node--view-mode-teaser">
                <div class="statji-teaser-image">

                    <div class="field field--name-field-image field--type-image field--label-hidden field__item">
                        <img
                                src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                        />

                    </div>

                </div>
                <div class="statji-teaser-data">

                    <div class="field field--name-field-data field--type-datetime field--label-hidden field__item">
                        <time datetime="<?= FormatDateFromDB($arItem["ACTIVE_FROM"], 'SHORT');?>" class="datetime">
                            <?= FormatDateFromDB($arItem["ACTIVE_FROM"], 'SHORT');?>
                        </time>
                    </div>

                </div>
                <div class="statji-teaser-title">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">

                    <span class="field field--name-title field--type-string field--label-hidden">
                        <? echo $arItem["NAME"] ?>
                    </span>


                    </a>
                </div>
                <div class="statji-teaser-description">

                    <div class="field field--name-field-short field--type-string-long field--label-hidden field__item">
                        <? echo $arItem["PREVIEW_TEXT"] ?>
                    </div>

                </div>
                <div class="clear"></div>
            </article>
        </div>

    <? endforeach; ?>
</div>