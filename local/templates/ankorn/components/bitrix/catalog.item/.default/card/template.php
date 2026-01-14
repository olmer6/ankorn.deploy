<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>

<article role="article" class="node article-teaser node--type-article node--promoted node--view-mode-teaser">
		<div class="article-teaser-image" id="<?= $itemIds['PICT'] ?>"
              style="background-image: url('<?= $item['PREVIEW_PICTURE']['SRC'] ?>'); <?= ($showSlider ? 'display: none;' : '') ?>">
            <div class="field field--name-field-image field--type-image field--label-hidden field__item">
                <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                    <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" width="350" height="315" alt="" class="image-style-article-teaser">

                </a>
            </div>
		</div>
    <div class="article-teaser-title">
        <? if ($itemHasDetailUrl): ?>
        <a href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $productTitle ?>">
            <? endif; ?>
            <span class="field field--name-title field--type-string field--label-hidden"><?= $productTitle ?></span>
            <? if ($itemHasDetailUrl): ?>
        </a>
    <? endif; ?>
    </div>
    <div class="article-teaser-description">

        <div class="field field--name-field-short field--type-string-long field--label-hidden field__item">
            <?=$item["PREVIEW_TEXT"];?>
        </div>

    </div>
</article>