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

<article role="article" class="node article node--type-statji node--view-mode-full">
    <div class="article-content">

        <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
            <?echo $arResult["DETAIL_TEXT"];?>

            <p class="callback_us"><button class="btn-red call">Заказать звонок инженера</button></p>
        </div>



    </div>
    <div class="side-column">
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