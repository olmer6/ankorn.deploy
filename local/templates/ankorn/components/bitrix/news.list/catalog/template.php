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


<div class="catalog">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));


        $articlelink = $arItem["PROPERTIES"]["LINK"]["VALUE"];
        if (substr($articlelink, -1) !== '/') {
            $articlelink .= '/';
        }


        $text = $arItem["PREVIEW_TEXT"]; // Исходный HTML
        $text = '<?xml encoding="UTF-8">' . $text;
        $dom = new DOMDocument();
        @$dom->loadHTML($text, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $links = $dom->getElementsByTagName('a');

        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            
            if (!empty($href)) {
                // Разделяем URL на компоненты
                $parsed = parse_url($href);
                $path = $parsed['path'] ?? '';
                $query = isset($parsed['query']) ? '?'.$parsed['query'] : '';
                $fragment = isset($parsed['fragment']) ? '#'.$parsed['fragment'] : '';
                
                // Обрабатываем только пути без расширений файлов
                if ($path && !preg_match('/\.[a-zA-Z0-9]+$/', $path)) {
                    // Добавляем слеш в конец пути, если его нет
                    $path = rtrim($path, '/').'/';
                }
                
                // Собираем обновленный URL
                $newHref = $path.$query.$fragment;
                $link->setAttribute('href', $newHref);
            }
        }

        // Получаем модифицированный HTML

        $modifiedText = $dom->saveHTML();
        $modifiedText = str_replace('<?xml encoding="UTF-8">', '', $modifiedText);

        ?>
        <div class="catalog-col catalog-col--1">
            <article id="taxonomy-term-21" class="taxonomy-term catalog-preview catalog-preview-1 vocabulary-catalog">
                <div class="catalog-preview-picture catalog-preview-picture-1">

                    <div class="field field--name-field-catalog-image field--type-image field--label-hidden field__item">
                        <a href="<?= $articlelink ?>" hreflang="ru">
                            <img
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                    height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                            />

                        </a>
                    </div>

                    <div class="read_more">
                        <a href="<?= $articlelink ?>">Посмотреть ВСЕ&gt;&gt;</a>
                    </div>
                </div>
                <div class="catalog-preview-description">
                    <a href="<?= $articlelink ?>" class="catalog-preview-title">


                        <div class="field field--name-name field--type-string field--label-hidden field__item">
                            <? echo $arItem["NAME"] ?>
                        </div>


                    </a>
                    <div class="catalog-preview-text text-formatted">
                        <?
                         //echo $arItem["PREVIEW_TEXT"];
                         echo $modifiedText;
                        ?>

                    </div>
                </div>
                <div class="clear"></div>
            </article>

        </div>
    <? endforeach; ?>
</div>
