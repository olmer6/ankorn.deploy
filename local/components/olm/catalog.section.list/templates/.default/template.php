<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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

if (empty($arResult['SECTIONS']) && $arParams['HIDE_SECTION_NAME'] !== 'Y') {
    return;
}
?>

<div class="olm-section-list">
    <?php if ($arParams['SHOW_PARENT_NAME'] === 'Y' && !empty($arResult['PARENT_SECTION']['NAME'])): ?>
        <h2 class="olm-section-list__parent-title">
            <?php if (!empty($arResult['PARENT_SECTION']['URL'])): ?>
                <a href="<?= htmlspecialcharsbx($arResult['PARENT_SECTION']['URL']) ?>"
                   class="olm-section-list__parent-link">
                    <?= htmlspecialcharsbx($arResult['PARENT_SECTION']['NAME']) ?>
                </a>
            <?php else: ?>
                <?= htmlspecialcharsbx($arResult['PARENT_SECTION']['NAME']) ?>
            <?php endif; ?>
        </h2>
    <?php endif; ?>

    <?php if (!empty($arResult['SECTIONS'])): ?>
        <?php if ($arParams['VIEW_MODE'] === 'LIST'): ?>
            <ul class="olm-section-list__tree">
                <?php foreach ($arResult['SECTIONS'] as $section): ?>
                    <li class="olm-section-list__item olm-section-list__item--level-<?= $section['RELATIVE_DEPTH_LEVEL'] ?>"
                        style="margin-left: <?= ($section['RELATIVE_DEPTH_LEVEL'] - 1) * 20 ?>px;">

                        <a href="<?= htmlspecialcharsbx($section['URL']) ?>"
                           class="olm-section-list__link">
                            <?= htmlspecialcharsbx($section['NAME']) ?>

                            <?php if ($arParams['COUNT_ELEMENTS'] === 'Y' && $section['ELEMENT_CNT'] > 0): ?>
                                <span class="olm-section-list__count">
                                    (<?= $section['ELEMENT_CNT'] ?>)
                                </span>
                            <?php endif; ?>
                        </a>

                        <?php if (!empty($section['DESCRIPTION']) && $arParams['HIDE_SECTION_NAME'] !== 'Y'): ?>
                            <div class="olm-section-list__description">
                                <?php if ($section['DESCRIPTION_TYPE'] === 'html'): ?>
                                    <?= $section['DESCRIPTION'] ?>
                                <?php else: ?>
                                    <?= nl2br(htmlspecialcharsbx($section['DESCRIPTION'])) ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php elseif ($arParams['VIEW_MODE'] === 'LINE'): ?>
            <div class="olm-section-list__line">
                <?php foreach ($arResult['SECTIONS'] as $section): ?>
                    <a href="<?= htmlspecialcharsbx($section['URL']) ?>"
                       class="olm-section-list__line-item">
                        <?= htmlspecialcharsbx($section['NAME']) ?>

                        <?php if ($arParams['COUNT_ELEMENTS'] === 'Y' && $section['ELEMENT_CNT'] > 0): ?>
                            <span class="olm-section-list__count">
                                (<?= $section['ELEMENT_CNT'] ?>)
                            </span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>

        <?php elseif ($arParams['VIEW_MODE'] === 'TEXT'): ?>
            <div class="olm-section-list__text">
                <?php foreach ($arResult['SECTIONS'] as $section): ?>
                    <div class="olm-section-list__text-item">
                        <a href="<?= htmlspecialcharsbx($section['URL']) ?>"
                           class="olm-section-list__text-link">
                            <?= htmlspecialcharsbx($section['NAME']) ?>
                        </a>

                        <?php if ($arParams['COUNT_ELEMENTS'] === 'Y' && $section['ELEMENT_CNT'] > 0): ?>
                            <span class="olm-section-list__count">
                                (<?= $section['ELEMENT_CNT'] ?>)
                            </span>
                        <?php endif; ?>

                        <?php if (!empty($section['DESCRIPTION'])): ?>
                            <div class="olm-section-list__text-description">
                                <?php if ($section['DESCRIPTION_TYPE'] === 'html'): ?>
                                    <?= $section['DESCRIPTION'] ?>
                                <?php else: ?>
                                    <?= nl2br(htmlspecialcharsbx($section['DESCRIPTION'])) ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="olm-section-list__empty">
            Разделы не найдены
        </div>
    <?php endif; ?>
</div>