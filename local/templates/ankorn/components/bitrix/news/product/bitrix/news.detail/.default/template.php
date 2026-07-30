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
<?php
$salesmail = "navigator.clipboard.writeText('info@ankorn.ru')";

// Массив с файлами для проверки и вывода
$fileProps = [
    ['file' => 'FILE_1', 'name' => 'FILE_NAME1'],
    ['file' => 'FILE_2', 'name' => 'FILE_NAME2'],
    ['file' => 'FILE_3', 'name' => 'FILE_NAME3'],
    ['file' => 'FILE_4', 'name' => 'FILE_NAME4']
];
$files = 0;
foreach ($fileProps as $fileProp) {
  // Проверяем, существует ли файл
  if (!empty($arResult["PROPERTIES"][$fileProp['file']]["VALUE"])) {
    $files++;
  }
}
use Bitrix\Currency\CurrencyManager;
$baseCurrency = CurrencyManager::getBaseCurrency();
// Получаем курс евро (EUR) к базовой валюте
$eurRate = \CCurrencyRates::GetConvertFactor('EUR', $baseCurrency);
?>
<?php if($arResult['PROPERTIES']['BREAD']["VALUE"]):?>
<?= htmlspecialcharsBack($arResult['PROPERTIES']['BREAD']["VALUE"]['TEXT']) ?>
<?php endif;?>
<?php
// print "<pre>";
// print_r($arResult);
// print "</pre>";
?>
<section class="p-50">
    <div class="container">
        <div class="product commerce-product">
            <div class="product-top">
                <div class="product-gallery">
                    <div class="product-gallery-row">
                        <div id="product-plates">
                          <?php if($arResult['PROPERTIES']['PLATE_LEADER']["VALUE"]) {
                            echo "<div class='product-plate plate-leader'>";
                              echo "Лидер продаж";
                            echo '</div>';
                            } 
                          ?>
                          <?php if($arResult['PROPERTIES']['PLATE_CANCELED']["VALUE"]) {
                            echo "<div class='product-plate plate-canceled'>";
                              echo "Снят с производства";
                            echo '</div>';
                            } 
                          ?>
                          <?php if($arResult['PROPERTIES']['PLATE_NEW']["VALUE"]) {
                            echo "<div class='product-plate plate-new'>";
                              echo "Новинка";
                            echo '</div>';
                            } 
                          ?>
                        </div>
                        <div id="char-plates">
                          <?php 
                          if($arResult['PROPERTIES']['PARAM_ARTICUL']['VALUE']) {
                            print "<div class='char-plate-line'>Артикул: " . $arResult['PROPERTIES']['PARAM_ARTICUL']['VALUE'] . "</div>";
                          }
                          if($arResult['PROPERTIES']['PARAM_BRAND']['VALUE']) {
                            print "<div class='char-plate-line'>Бренд: " . $arResult['PROPERTIES']['PARAM_BRAND']['VALUE'] . "</div>";
                          }
                          ?>
                          <div id="watch-char" onClick="document.getElementById('product-tab-4').click(); document.getElementById('product-tab-4').scrollIntoView({behavior: 'smooth'});">Смотреть все характеристики</div>
                        </div>
                        <?php
                        // Получаем идентификаторы файлов
                        $fileIds = $arResult["PROPERTIES"]["GALERRY"]["VALUE"];

                        // Проверяем, есть ли файлы в галерее
                        if (count($fileIds) == 1) {
                            // Если только одно изображение
                            $fileArray = CFile::GetFileArray($fileIds[0]);
                            if ($fileArray && isset($fileArray['SRC'])) {
                                $filePath = $fileArray['SRC'];
                                echo '<div class="product-gallery-thumbs">
                    <div class="product-gallery-thumb product-gallery-thumb--active" data-url="' . $filePath . '">
                        <img width="75" height="75" src="' . $filePath . '" alt="' . $arResult["NAME"] . '">
                    </div>
                  </div>
                  <div class="product-gallery-main">
                    <div class="product-gallery-image">
                        <img src="' . $filePath . '" alt="' . $arResult["NAME"] . '">
                    </div>
                    <div class="look-different">Внешний вид товаров может отличаться от изображений, представленных на сайте.</div>
                    <div class="equip-select">
                      <div class="equip-select-label">Подбор оборудования под ваш проект - быстро и без ошибок</div>
                      <div class="equip-select-text">
                        <p>Опишите вашу задачу, приложите техническое задание и чертежи на почту</p>
                        <p class="product-mail-line"><a href="mailto:info@ankorn.ru">info@ankorn.ru</a><img onClick="' . $salesmail . '" src="/local/templates/ankorn/img/copy.svg" class="industry-block-copy-img"/></p>
                        <br />
                        <p>Наш специалист подберёт оборудование со 100% гарантией соответствия, чтобы вы сохранили главное — бесперебойную работу линий и уважение тех, кто доверяет вам производство.</p>
                      </div>
                    </div>
                  </div>';
                            }
                        } elseif (count($fileIds) > 1) {
                            echo '<div class="product-gallery-thumbs">';
                            foreach ($fileIds as $index => $fileId) {
                                $fileArray = CFile::GetFileArray($fileId);
                                if ($fileArray && isset($fileArray['SRC'])) {
                                    $filePath = $fileArray['SRC'];
                                    $activeClass = $index == 0 ? 'product-gallery-thumb--active' : '';
                                    echo '<div class="product-gallery-thumb ' . $activeClass . '" data-url="' . $filePath . '">
                        <img width="75" height="75" src="' . $filePath . '" alt="' . $arResult["NAME"] . '">
                      </div>';
                                }
                            }
                            echo '</div>';

                            // Основное изображение, которое будет заменяться
                            echo '<div class="product-gallery-main">
                <div class="product-gallery-image">
                    <img src="' . CFile::GetFileArray($fileIds[0])['SRC'] . '" alt="' . $arResult["NAME"] . '">
                </div>
                <div class="look-different">Внешний вид товаров может отличаться от изображений, представленных на сайте.</div>
                <div class="equip-select">
                  <div class="equip-select-label">Подбор оборудования под ваш проект - быстро и без ошибок</div>
                  <div class="equip-select-text">
                    <p>Опишите вашу задачу, приложите техническое задание и чертежи на почту</p>
                    <p class="product-mail-line"><a href="mailto:info@ankorn.ru">info@ankorn.ru</a><img onClick="' . $salesmail . '" src="/local/templates/ankorn/img/copy.svg" class="industry-block-copy-img"/></p>
                    <br />
                    <p>Наш специалист подберёт оборудование со 100% гарантией соответствия, чтобы вы сохранили главное — бесперебойную работу линий и уважение тех, кто доверяет вам производство.</p>
                  </div>
                </div>
              </div>';
                        } else {
                            echo '<div class="product-gallery-main">
                <div class="product-gallery-image">
                    <img src="' . $arResult["PREVIEW_PICTURE"]['SRC'] . '" alt="' . $arResult["NAME"] . '">
                </div>
                <div class="look-different">Внешний вид товаров может отличаться от изображений, представленных на сайте.</div>
                <div class="equip-select">
                  <div class="equip-select-label">Подбор оборудования под ваш проект - быстро и без ошибок</div>
                  <div class="equip-select-text">
                    <p>Опишите вашу задачу, приложите техническое задание и чертежи на почту</p>
                    <p class="product-mail-line"><a href="mailto:info@ankorn.ru">info@ankorn.ru</a><img onClick="' . $salesmail . '" src="/local/templates/ankorn/img/copy.svg" class="industry-block-copy-img"/></p>
                    <br />
                    <p>Наш специалист подберёт оборудование со 100% гарантией соответствия, чтобы вы сохранили главное — бесперебойную работу линий и уважение тех, кто доверяет вам производство.</p>
                  </div>
                </div>
              </div>';
                        }?>
                    </div>
                </div>

                <div class="product-content">
                    <h1 class="product-title">
                        <?= $arResult["NAME"] ?>
                    </h1>
                    <div class="clearfix text-formatted field field--name-field-product-right-description field--type-text-long field--label-hidden field__item">
                        <?= $arResult["PREVIEW_TEXT"] ?>
                    </div>

                    <div id="ship-payment">
                      <span class="ship-payment-label">Доставка:</span>
                      <ul class="ship-payment-list">
                        <li>Самовывоз</li>
                        <li>Транспортная компания</li>
                        <li>Курьерская служба</li>
                        <li>Срок отгрузки: 98 дн</li>
                      </ul>
                      <span class="ship-payment-label">Оплата</span>
                      <ul class="ship-payment-list">
                        <li>Безналичный расчет</li>
                      </ul>
                    </div>
                    <div class="product-top-pluses">
                        <div class="product-top-plus product-top-plus--delivery">
                            Доставка по всей России
                        </div>
                        <div class="product-top-plus product-top-plus--warranty">
                            Гарантия до <br>5 лет
                        </div>
                    </div>

                    <?php 
                      if($arResult['PROPERTIES']['PRICE_EUR']["VALUE"]) {
                      ?>
                        <div class="price">Цена: от <?= number_format(intval(ceil($arResult['PROPERTIES']['PRICE_EUR']["VALUE"]*$eurRate)), 0, '.', '.'); ?> руб./шт</div>
                      <?php
                      }
                      else {
                        if($arResult['PROPERTIES']['PRICE']["VALUE"]) {
                          ?>
                            <div class="price">Цена: от <?=$arResult['PROPERTIES']['PRICE']["VALUE"]?> руб./шт</div>
                          <?php
                        }
                      }
                    ?>
                    <div class="price-descr">
                        Цена товаров зависит от модификации прибора
                    </div>
                    <div class="product-content-button">
                        <button class="btn-red modal-price">Заказать</button>
                        <button class="btn-red modal-engineer">Задать вопрос</button>
                    </div>
                </div>
            </div>

            <div class="product-bottom">
                <div class="product-bottom-content">
                    <?php if (is_array($arResult['PROPERTIES']['DESC']["VALUE"]) && isset($arResult['PROPERTIES']['DESC']["VALUE"]['TEXT'])): ?>
                        <ul role="tablist" class="nav nav-tabs">
                            <li class="nav-item">
                                <a id="product-tab-1" data-toggle="tab" href="#product-tab-body-1" role="tab" aria-controls="product-tab-body-1" aria-selected="true" class="nav-link active">
                                    Описание
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="product-tab-2" data-toggle="tab" href="#product-tab-body-2" role="tab" aria-controls="product-tab-body-2" class="nav-link">
                                    Применение
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="product-tab-3" data-toggle="tab" href="#product-tab-body-3" role="tab" aria-controls="product-tab-body-3" class="nav-link">
                                    Принцип работы
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="product-tab-4" data-toggle="tab" href="#product-tab-body-4" role="tab" aria-controls="product-tab-body-4" class="nav-link">
                                    Характеристики
                                </a>
                            </li>
                            <?php if($arResult['DETAIL_TEXT']): ?>
                                <li class="nav-item">
                                    <a id="product-tab-5" data-toggle="tab" href="#product-tab-body-5" role="tab" aria-controls="product-tab-body-5" class="nav-link">
                                        Модификации
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if($files > 0): ?>
                              <li class="nav-item">
                                  <a id="product-tab-6" data-toggle="tab" href="#product-tab-body-6" role="tab" aria-controls="product-tab-body-6" class="nav-link">
                                      Документация
                                  </a>
                              </li>
                            <?php endif; ?>
                        </ul>
                        <div class="tab-content">
                            <div id="product-tab-body-1" role="tabpanel" aria-labelledby="product-tab-1" class="tab-pane fade show active">
                                <?= (is_array($arResult['PROPERTIES']['ANNOUNCE']["VALUE"]) && isset($arResult['PROPERTIES']['ANNOUNCE']["VALUE"]['TEXT'])) ? htmlspecialcharsBack($arResult['PROPERTIES']['ANNOUNCE']["VALUE"]['TEXT']) : '' ?>
                                <?php
                                  if($arResult['PROPERTIES']['ISHART']["VALUE"]) {
                                    print "<div id='hart-block'>";
                                    print '“Для конфигурации прибора с HART-протоколом необходимо иметь HART-модем, с помощью которого через программу EView 2 можно проводить настройку и диагностику прибора”';
                                    print "</div>";
                                  }
                                ?>
                                <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                    <?= (is_array($arResult['PROPERTIES']['DESC']["VALUE"]) && isset($arResult['PROPERTIES']['DESC']["VALUE"]['TEXT'])) ? htmlspecialcharsBack($arResult['PROPERTIES']['DESC']["VALUE"]['TEXT']) : '' ?>
                                    <p>&nbsp;</p>
                                    <p><strong>Нужна помощь инженера? Закажите бесплатную консультацию!</strong></p>
                                    <p class="callback_us">
                                        <button class="btn-red modal-engineer">Заказать звонок инженера</button>
                                    </p>
                                </div>
                            </div>
                            <?= (is_array($arResult['PROPERTIES']['PARAM_TYPE']["VALUE"]) && isset($arResult['PROPERTIES']['PARAM_TYPE']["VALUE"]['TEXT'])) ? htmlspecialcharsBack($arResult['PROPERTIES']['PARAM_TYPE']["VALUE"]['TEXT']) : '' ?>
                            <div id="product-tab-body-2" role="tabpanel" aria-labelledby="product-tab-2" class="tab-pane fade">
                                <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                    <div class="views-row">
                                        <?php foreach ($arResult['PROJECTS_LIST'] as $PROJECTS): ?>
                                            <article role="article" class="node article-preview node--type-article node--promoted node--view-mode-preview">
                                                <a href="<?=$PROJECTS['DETAIL_PAGE_URL']?>/" class="article-preview-title">
                                                    <div class="primenenie-image"><div class="field field--name-field-image field--type-image field--label-hidden field__item">
                                                            <img src="<?=$PROJECTS['PREVIEW_PICTURE_SRC']?>" width="960" height="720" alt="<?=$PROJECTS['NAME']?>">
                                                        </div>
                                                    </div>
                                                    <div class="primenenie-title">
                                                        <span class="field field--name-title field--type-string field--label-hidden"><?=$PROJECTS['NAME']?></span>
                                                    </div>
                                                </a>
                                            </article>
                                        <?php endforeach; ?>
                                    </div>
                                    <?= (is_array($arResult['PROPERTIES']['DESC_APPLICATIONS']["VALUE"]) && isset($arResult['PROPERTIES']['DESC_APPLICATIONS']["VALUE"]['TEXT'])) ? htmlspecialcharsBack($arResult['PROPERTIES']['DESC_APPLICATIONS']["VALUE"]['TEXT']) : '' ?>
                                    <p>&nbsp;</p>
                                    <p><strong>Нужна помощь инженера? Закажите бесплатную консультацию!</strong></p>
                                    <p class="callback_us">
                                        <button class="btn-red modal-engineer">Заказать звонок инженера</button>
                                    </p>
                                </div>
                            </div>
                            <div id="product-tab-body-3" role="tabpanel" aria-labelledby="product-tab-3" class="tab-pane fade">
                                <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                    <?= (is_array($arResult['PROPERTIES']['OPERATING_PRINCIPLE_DESCRIPTION']["VALUE"]) && isset($arResult['PROPERTIES']['OPERATING_PRINCIPLE_DESCRIPTION']["VALUE"]['TEXT'])) ? htmlspecialcharsBack($arResult['PROPERTIES']['OPERATING_PRINCIPLE_DESCRIPTION']["VALUE"]['TEXT']) : '' ?>
                                    <p>&nbsp;</p>
                                    <p><strong>Нужна помощь инженера? Закажите бесплатную консультацию!</strong></p>
                                    <p class="callback_us">
                                        <button class="btn-red modal-engineer">Заказать звонок инженера</button>
                                    </p>
                                </div>
                            </div>
                            <div id="product-tab-body-4" role="tabpanel" aria-labelledby="product-tab-4" class="tab-pane fade">
                                <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                    <?= (is_array($arResult['PROPERTIES']['CHARACTERISTICS']["VALUE"]) && isset($arResult['PROPERTIES']['CHARACTERISTICS']["VALUE"]['TEXT'])) ? htmlspecialcharsBack($arResult['PROPERTIES']['CHARACTERISTICS']["VALUE"]['TEXT']) : '' ?>
                                    <p>&nbsp;</p>
                                    <p><strong>Нужна помощь инженера? Закажите бесплатную консультацию!</strong></p>
                                    <p class="callback_us">
                                        <button class="btn-red call">Заказать звонок инженера</button>
                                    </p>
                                </div>
                            </div>

                            <?php if($arResult['DETAIL_TEXT']): ?>
                                <div id="product-tab-body-5" role="tabpanel" aria-labelledby="product-tab-5" class="tab-pane fade">
                                    <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                        <?= isset($arResult['DETAIL_TEXT']) ? $arResult['DETAIL_TEXT'] : '' ?>
                                        <p>&nbsp;</p>
                                        <p><strong>Нужна помощь инженера? Закажите бесплатную консультацию!</strong></p>
                                        <p class="callback_us">
                                            <button class="btn-red modal-engineer">Заказать звонок инженера</button>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($files > 0): ?>
                              <div id="product-tab-body-6" role="tabpanel" aria-labelledby="product-tab-6" class="tab-pane fade">
                                <div class="field field--name-field-attach field--type-file field--label-hidden article-files">

                                    <?php


                                    foreach ($fileProps as $fileProp) {
                                        // Проверяем, существует ли файл
                                        if (!empty($arResult["PROPERTIES"][$fileProp['file']]["VALUE"])) {
                                            $file = CFile::GetFileArray($arResult["PROPERTIES"][$fileProp['file']]["VALUE"]);

                                            // Определяем класс для файла
                                            $fileClass = '';
                                            if ($file['CONTENT_TYPE'] === 'application/pdf') {
                                                $fileClass = 'file--mime-application-pdf file--application-pdf';
                                            } elseif (strpos($file['CONTENT_TYPE'], 'image') !== false) {
                                                $fileClass = 'file--mime-image file--image';
                                            }

                                            // Получаем название файла, если оно задано
                                            $fileTitle = !empty($arResult["PROPERTIES"][$fileProp['name']]["VALUE"])
                                                ? $arResult["PROPERTIES"][$fileProp['name']]["VALUE"]
                                                : 'Файл PiloTREK';

                                            // Рассчитываем размер файла в Мб
                                            $fileSizeMb = round($file['FILE_SIZE'] / (1024 * 1024), 2);
                                            ?>

                                            <div class="article-files-col">
                                                <div class="file <?= $fileClass ?> article-file">
                                                    <div class="article-file-title">
                                                        <a href="<?= $file['SRC'] ?>" type="<?= $file['CONTENT_TYPE'] ?>" title="<?= htmlspecialchars($fileTitle) ?>" target="_blank">
                                                            <?= htmlspecialchars($fileTitle) ?>
                                                        </a>
                                                    </div>
                                                    <a href="<?= $file['SRC'] ?>" target="_blank" class="article-file-description">
                                                        Скачать (<?= $fileSizeMb ?> Мб)
                                                    </a>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                    }
                                    ?>

                                </div>
                              </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (is_array($arResult['PROPERTIES']['CHARACTERISTICS_MOD']["VALUE"]) && isset($arResult['PROPERTIES']['CHARACTERISTICS_MOD']["VALUE"]['TEXT'])): ?>
                        <div class="product-mod-param">
                            <?= htmlspecialcharsBack($arResult['PROPERTIES']['CHARACTERISTICS_MOD']["VALUE"]['TEXT']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?
global $arNewsFilterLast;


// Получаем ID текущей новости
$newsID = $arResult['ID'];

// Получаем массив просмотренных новостей из куки
$viewedNews = isset($_COOKIE['VIEWED_NEWS']) ? explode(',', $_COOKIE['VIEWED_NEWS']) : [];

// Добавляем текущую новость в массив, если ее там еще нет
if (!in_array($newsID, $viewedNews)) {
    $viewedNews[] = $newsID;
}

// Ограничиваем количество записей, например, 10 последних
$viewedNews = array_slice($viewedNews, -4);

// Обновляем куки
setcookie('VIEWED_NEWS', implode(',', $viewedNews), time() + 3600 * 24 * 30, "/"); // Срок хранения 30 дней


// Получаем массив просмотренных новостей из куки
$viewedNews = isset($_COOKIE['VIEWED_NEWS']) ? explode(',', $_COOKIE['VIEWED_NEWS']) : [];

// Убираем текущую новость из списка, если нужно
if (($key = array_search($arResult['ID'], $viewedNews)) !== false) {
    unset($viewedNews[$key]);
}

// Фильтр для компонента
global $arNewsFilterLast;
$arNewsFilterLast = [
    'ID' => $viewedNews, // Массив ID просмотренных новостей
];
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "recent",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
            0 => "NAME",
            1 => "PREVIEW_PICTURE",
            2 => "",
        ),
        "FILTER_NAME" => "arNewsFilterLast",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "2",
        "IBLOCK_TYPE" => "products",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "4",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "COMPONENT_TEMPLATE" => "recent"
    ),
    false
);?>


<?php
// Определяем фильтр для товаров из текущего раздела
global $arNewsFilter;
$arNewsFilter = [
    "SECTION_ID" => $arResult["IBLOCK_SECTION_ID"], // Текущий раздел
    "!ID" => $arResult["ID"] // Исключаем текущий элемент (опционально)
];
?>

<div class="products-slider">
    <div class="container">
        <div class="page-title">
            <h2>Товары в этой категории</h2>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "product-slider",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPONENT_TEMPLATE" => "product-slider",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "N",
            "DISPLAY_PICTURE" => "N",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_PICTURE",2=>"",),
            "FILTER_NAME" => "arNewsFilter", // Указываем наш фильтр
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "2",
            "IBLOCK_TYPE" => "products",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "12",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "round",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(0=>"",1=>"",),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>
</div>

<?php
  // Получаем данные товара
  $productName = $arResult['NAME'];
  $productDescription = str_replace("\r\n", "", $arResult['~PREVIEW_TEXT']);
  //$productDescription = trim('/\t+/', '', $productDescription);
  //$productImage = $arResult['DETAIL_PICTURE']['SRC'];
  $fileArray = CFile::GetFileArray($fileIds[0]);
    if ($fileArray && isset($fileArray['SRC'])) {
    $filePath = $fileArray['SRC'];
  }
  $productUrl = $APPLICATION->GetCurPage();
  $price = !empty($arResult['PROPERTIES']['PRICE']['VALUE']) ?  $arResult['PROPERTIES']['PRICE']['VALUE'] : '150000.000';
  $currency = 'RUB'; // Укажите валюту (ISO 4217)
  $availability = 'https://schema.org/InStock';
  $category = $arResult['SECTION']['PATH'][1]['NAME'];
  

  // Формируем JSON-LD
  $schemaMarkup = '
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "' . htmlspecialcharsbx($productName) . '",
    "description": "' . html_entity_decode(strip_tags($productDescription)) . '",
    "category": "' . html_entity_decode($category) . '",
    "image": "https://' . $_SERVER["HTTP_HOST"] . htmlspecialcharsbx($filePath) . '",
    "url": "https://' . $_SERVER["HTTP_HOST"] . htmlspecialcharsbx($productUrl) . '",
    "offers": {
      "@type": "Offer",
      "priceCurrency": "' . $currency . '",
      "price": "' . $price . '",
      "availability": "' . $availability . '",
      "url": "https://' . $_SERVER["HTTP_HOST"] . htmlspecialcharsbx($productUrl) . '"
    }
  }
  </script>
  ';

  // Выводим разметку
  echo $schemaMarkup;
?>