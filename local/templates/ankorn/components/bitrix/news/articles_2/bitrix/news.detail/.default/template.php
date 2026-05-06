<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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


// Получаем количество просмотров (если используется свойство)
$views = 0;
if (isset($arResult["PROPERTIES"]["SHOW_COUNTER"]["VALUE"])) {
    $views = intval($arResult["PROPERTIES"]["SHOW_COUNTER"]["VALUE"]);
}
if ($showCounter = CIBlockElement::GetByID($arResult['ID'])->GetNext()["SHOW_COUNTER"]) {
    $views = $views+intval($showCounter);
}

$arGroups = CIBlockElement::GetElementGroups(
    $arResult["ID"],
    true,  // $skipIblockCheck - пропускать проверку инфоблока
    array('ID', 'NAME', 'CODE', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL') // выбираемые поля
);

$sections = [];
while($arGroup = $arGroups->Fetch()) {
    $sections[] = $arGroup;
}
?>

<div class="article__meta">
    <div class="article__meta-row">
        <?php if($arResult["PROPERTIES"]["TIME_READ"]["VALUE"]):?>
        <!-- Иконка даты -->
        <span class="article__time-read">
            <img src="<?=$templateFolder?>/images/clock.svg" alt="">
            <span class="article__time-read">
                <?=$arResult["PROPERTIES"]["TIME_READ"]["VALUE"]?> мин
            </span>
        </span>
        <?php endif; ?>

        <!-- Иконка даты -->
        <span class="article__date">
            <img src="<?=$templateFolder?>/images/date-create_icon.svg" alt="">
            <span class="article__date-text">
                <?= FormatDateFromDB($arResult["ACTIVE_FROM"] ?: $arResult["DATE_CREATE"], "DD.MM.YYYY") ?>
            </span>
        </span>

        <!-- Иконка просмотров -->
        <?php if ($views > 0): ?>
            <span class="article__views">
                <img src="<?=$templateFolder?>/images/eye.svg" alt="">
                <span class="article__views-count">
                    <?= number_format($views, 0, '', ' ') ?>
                </span>
            </span>
        <?php endif; ?>
    </div>
</div>

<div class="article__sections">
    <?php foreach($sections as $section):?>
        <a href="/articles/<?=$section['CODE']?>/">#<?=$section['NAME']?></a>
    <?php endforeach?>
</div>

<article role="article" class="node article node--type-statji node--view-mode-full">
    <div class="article-content">
        <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
            <?php echo $arResult["DETAIL_TEXT"];?>
            <p class="callback_us"><button class="btn-red call">Заказать звонок инженера</button></p>
        </div>
    </div>
    <div class="side-column">


    <?php if(is_array($arResult['AUTOR'])){ ?>
        <div class="article-sidebar">
            <div class="article-sidebar-title">
                Автор статьи
            </div>
                <article role="article" class="article-preview autor">
                    <a href="<?=$arResult['AUTOR']["DETAIL_PAGE_URL"]?>">
                    <div class="autor_image"><img src="<?=$arResult['AUTOR']["PREVIEW_PICTURE_SRC"]?>" alt=""></div>
                    <div class="autor_name article-sidebar-title"><?=$arResult['AUTOR']["NAME"]?></div>
                    <div class="autor_position"><?=$arResult['AUTOR']["PROPERTY_POSITION_VALUE"]?></div>
                    </a>
                </article>
        </div>
    <?php } ?>


    <?php if(!empty($arResult['PRODECTS_LIST'])):?>
    <div class="article-sidebar">
        <div class="article-sidebar-title">
            Вам подойдут следующие продукты
        </div>
        <div class="field field--name-field-article-products field--type-entity-reference field--label-hidden article-products">
            <?php foreach ($arResult['PRODECTS_LIST'] as $PROJECTS): ?>
                <article role="article" class="node article-preview node--type-article node--promoted node--view-mode-preview">
                    <a href="<?=$PROJECTS['DETAIL_PAGE_URL']?>" class="commerce-product product-preview">
                        <div class="product-preview-picture">
                            <div class="field field--name-field-image field--type-image field--label-hidden field__item">  <img src="<?=$PROJECTS['PREVIEW_PICTURE_SRC']?>" width="90" height="90" alt="<?=$PROJECTS['NAME']?>" class="image-style-product-preview">
                            </div>
                        </div>
                        <div class="product-preview-title">
                            <div class="field field--name-title field--type-string field--label-hidden field__item"><?=$PROJECTS['NAME']?></div>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="article-sidebar article-sidebar-2">
        <div class="article-sidebar-title">
            Подберем оборудование под ваш проект
        </div>
        <div class="field field--name-field-article-products field--type-entity-reference field--label-hidden article-products">
            <article role="article" class="node article-preview node--type-article node--promoted node--view-mode-preview">
                    <div class="product-preview-title article-block-title">
                        <div class="field field--name-title field--type-string field--label-hidden field__item">
                          Опишите вашу задачу и приложите техническое задание и чертежи на почту
                          <br />
                          <br />
                          <a href="mailto:info@ankorn.ru">info@ankorn.ru</a><img onClick="navigator.clipboard.writeText('info@ankorn.ru')" src="/local/templates/ankorn/img/copy.svg" class="article-block-copy-img"/>
                        </div>
                    </div>
            </article>
        </div>
    </div>
    <?php else:?>
    <div class="article-sidebar">
        <div class="article-sidebar-title">
            Подберем оборудование под ваш проект
        </div>
        <div class="field field--name-field-article-products field--type-entity-reference field--label-hidden article-products">
            <article role="article" class="node article-preview node--type-article node--promoted node--view-mode-preview">
                    <div class="product-preview-title article-block-title">
                        <div class="field field--name-title field--type-string field--label-hidden field__item">
                          Опишите вашу задачу и приложите техническое задание и чертежи на почту
                          <br />
                          <br />
                          <a href="mailto:info@ankorn.ru">info@ankorn.ru</a><img onClick="navigator.clipboard.writeText('info@ankorn.ru')" src="/local/templates/ankorn/img/copy.svg" class="article-block-copy-img"/>
                        </div>
                    </div>
            </article>
        </div>
    </div>
    <?php endif;?>
    </div>
</article>