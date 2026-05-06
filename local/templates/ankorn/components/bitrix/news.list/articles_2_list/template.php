<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
/** @var array $templateData */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
if($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"])
$APPLICATION->SetTitle($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]);
?>

<div class="articles-list">
    <?php if (!empty($arResult["ITEMS"])): ?>
        <div class="row">

            <?php if($_GET["ajax"]=="Y") $APPLICATION->RestartBuffer();?>
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                // Получаем картинку анонса
                $picture = [];
                if ($arItem["PREVIEW_PICTURE"]) {
                    $picture = CFile::ResizeImageGet(
                        $arItem["PREVIEW_PICTURE"],
                        array("width" => 600, "height" => 120),
                        BX_RESIZE_IMAGE_EXACT,
                        true
                    );
                }
                if(!$picture)
                    $picture["src"] = $templateFolder."/images/default_preview_image.jpg";
                // Получаем количество просмотров (если используется свойство)
                $views = 0;
                if (isset($arItem["PROPERTIES"]["SHOW_COUNTER"]["VALUE"])) {
                    $views = intval($arItem["PROPERTIES"]["SHOW_COUNTER"]["VALUE"]);
                }
                if (isset($arItem["SHOW_COUNTER"])) {
                    $views = $views+intval($arItem["SHOW_COUNTER"]);
                }
                ?>

                <div class="col-xs-12 col-sm-6 col-md-4 articles-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <article class="article-teaser article-teaser--grid">
                        <?php if (!empty($picture)): ?>
                            <div class="article-teaser__image-wrapper">
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="article-teaser__image-link">
                                    <img
                                            src="<?= $picture["src"] ?>"
                                            alt="<?= htmlspecialcharsbx($arItem["PREVIEW_PICTURE"]["ALT"] ?: $arItem["NAME"]) ?>"
                                            title="<?= htmlspecialcharsbx($arItem["PREVIEW_PICTURE"]["TITLE"] ?: $arItem["NAME"]) ?>"
                                            class="article-teaser__image img-responsive"
                                    >
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="article-teaser__meta">
                            <div class="article-teaser__meta-row">
                                <!-- Иконка даты -->
                                <span class="article-teaser__date">
                                    <img src="<?=$templateFolder?>/images/date-create_icon.svg" alt="">
                                    <span class="article-teaser__date-text">
                                        <?= FormatDateFromDB($arItem["ACTIVE_FROM"] ?: $arItem["DATE_CREATE"], "DD.MM.YYYY") ?>
                                    </span>
                                </span>

                                <!-- Иконка просмотров -->
                                <?php if ($views > 0): ?>
                                    <span class="article-teaser__views">
                                        <img src="<?=$templateFolder?>/images/eye.svg" alt="">
                                        <span class="article-teaser__views-count">
                                            <?= number_format($views, 0, '', ' ') ?>
                                        </span>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <h3 class="article-teaser__title">
                            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="article-teaser__title-link">
                                <?= htmlspecialcharsbx($arItem["NAME"]) ?>
                            </a>
                        </h3>

                        <?php if (!empty($arItem["PREVIEW_TEXT"])): ?>
                            <div class="article-teaser__excerpt">
                                <?= $arItem["PREVIEW_TEXT"] ?>
                            </div>
                        <?php endif; ?>
                    </article>
                </div>
            <?php endforeach; ?>
            <?php if($_GET["ajax"]=="Y") die();?>
        </div>

        <?php if ($arParams["DISPLAY_BOTTOM_PAGER"] && $arResult["NAV_STRING"]): ?>
            <div class="articles-list__pagination">
                <?= $arResult["NAV_STRING"] ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="articles-list__empty">
            <p><?= GetMessage("CT_BNL_ELEMENT_NOT_FOUND") ?: "Статьи не найдены" ?></p>
        </div>
    <?php endif; ?>
</div>