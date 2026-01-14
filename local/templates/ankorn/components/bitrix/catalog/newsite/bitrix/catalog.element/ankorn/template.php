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

$productId = $arResult['ID'];
$productName = htmlspecialcharsbx($arResult['NAME']);
$productPrice = $arResult['ITEM_PRICES'][0]['PRICE'] ?? 0;

$firstGalleryImage = '';

// Вариант 1: Если свойство хранится как массив файлов
    if (!empty($arResult['PROPERTIES']['GALLERY']['VALUE']) && is_array($arResult['PROPERTIES']['GALLERY']['VALUE'])) {
        $firstFileId = $arResult['PROPERTIES']['GALLERY']['VALUE'][0];
        $firstGalleryImage = CFile::GetPath($firstFileId);
    }
    
    // Вариант 2: Если свойство хранится как массив описаний
    elseif (!empty($arResult['PROPERTIES']['GALLERY']['VALUE'][0]['SRC'])) {
        $firstGalleryImage = $arResult['PROPERTIES']['GALLERY']['VALUE'][0]['SRC'];
    }
    
    // Вариант 3: Если свойство называется GALERRY (с опечаткой)
    elseif (!empty($arResult['PROPERTIES']['GALERRY']['VALUE']) && is_array($arResult['PROPERTIES']['GALERRY']['VALUE'])) {
        $firstFileId = $arResult['PROPERTIES']['GALERRY']['VALUE'][0];
        $firstGalleryImage = CFile::GetPath($firstFileId);
    }
    
    // Если нет картинки в галерее - используем основную
    if (empty($firstGalleryImage)) {
        if (!empty($arResult['DETAIL_PICTURE']['SRC'])) {
            $firstGalleryImage = $arResult['DETAIL_PICTURE']['SRC'];
        } elseif (!empty($arResult['PREVIEW_PICTURE']['SRC'])) {
            $firstGalleryImage = $arResult['PREVIEW_PICTURE']['SRC'];
        } else {
            $firstGalleryImage = '/upload/no_image.jpg';
        }
    }
$productImage = $firstGalleryImage;

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
  'ID' => $mainId,
  'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
  'STICKER_ID' => $mainId.'_sticker',
  'BIG_SLIDER_ID' => $mainId.'_big_slider',
  'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
  'SLIDER_CONT_ID' => $mainId.'_slider_cont',
  'BLOCK_PRICE_OLD' => $mainId.'_block_price',
  'OLD_PRICE_ID' => $mainId.'_old_price',
  'PRICE_ID' => $mainId.'_price',
  'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
  'PRICE_TOTAL' => $mainId.'_price_total',
  'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
  'SLIDER_PAGER_OF_ID' => $mainId.'_slider_pager_',
  'QUANTITY_COUNTER_ID' => $mainId.'_counter',
  'QUANTITY_ID' => $mainId.'_quantity',
  'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
  'QUANTITY_UP_ID' => $mainId.'_quant_up',
  'QUANTITY_MEASURE' => $mainId.'_quant_measure',
  'QUANTITY_MEASURE_CONTAINER' => $mainId.'_quant_measure_container',
  'QUANTITY_LIMIT' => $mainId.'_quant_limit',
  'BUY_LINK' => $mainId.'_buy_link',
  'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
  'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
  'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
  'COMPARE_LINK' => $mainId.'_compare_link',
  'TREE_ID' => $haveOffers && !empty($arResult['OFFERS_PROP']) ? $mainId.'_skudiv' : null,
  'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
  'DESCRIPTION_ID' => $mainId.'_description',
  'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
  'OFFER_GROUP' => $mainId.'_set_group_',
  'BASKET_PROP_DIV' => $mainId.'_basket_prop',
  'SUBSCRIBE_LINK' => $mainId.'_subscribe',
  'TABS_ID' => $mainId.'_tabs',
  'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
  'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
  'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');




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
                        <?php
                          if($arResult['PROPERTIES']['SHIPMENT']["VALUE"]) {
                        ?>
                          <li>Срок отгрузки: <?= $arResult['PROPERTIES']['SHIPMENT']["VALUE"] ?></li>
                        <?php
                          }
                        ?>

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
                    
                      if($arResult['ITEM_PRICES'][0]['PRICE']) {
                      ?>
                        <div class="price">Цена: <?= number_format(intval(ceil($arResult['ITEM_PRICES'][0]['PRICE'])), 0, '.', '.'); ?> руб./шт</div>
                      <?php
                      }
                      
                    ?>
                    <div class="price-descr">
                        Цена товаров зависит от модификации прибора и формируется исходя из текущего курса евро к рублю
                    </div>
                    <div class="compare-fav">
                      <div class="compare-item">
                        <a href="javascript:void(0)" onclick="addToCompare(<?= $productId ?>, '<?= $productName ?>')" class="" rel="noindex nofollow" title="Добавить в сравнение">Сравнить</a>
                      </div>
                      <div class="fav-item">
                        <a class=""
                        data-id="<?= $productId ?>"
                        data-name="<?= $productName ?>"
                        data-price="<?= $productPrice ?>"
                        data-image="<?= $productImage ?>"
                        data-url="<?= $arResult['DETAIL_PAGE_URL'] ?>"
                        onclick="toggleFavorite(this)"
                        rel="noindex nofollow" 
                        title="Добавить в избранное">
                        ♡ В избранное</a>
                      </div>
                    </div>
                    <?php
                      // print "<pre>";
                      // print_r($arResult);
                      // print "</pre>";
                    ?>
                    <div class="product-content-button">




                      <!--
                      на будущее
                        <div id="<?=$itemIds['BASKET_ACTIONS_ID']?>">
                          <?php
                          if ($showAddBtn)
                          {
                            ?>
                            <div class="mb-3">
                              <a class="product-item-detail-buy-button btn btn-md rounded-pill <?=$buyButtonClassName?>"
                                id="<?=$itemIds['ADD_BASKET_LINK']?>"
                                href="javascript:void(0);">
                                <?=$arParams['MESS_BTN_ADD_TO_BASKET']?>
                              </a>
                            </div>
                            <?php
                          }

                          if ($showBuyBtn)
                          {
                            ?>
                            <div class="mb-3">
                              <a class="product-item-detail-buy-button btn btn-md rounded-pill <?=$buyButtonClassName?>"
                                id="<?=$itemIds['BUY_LINK']?>"
                                href="javascript:void(0);">
                                <?=$arParams['MESS_BTN_BUY']?>
                              </a>
                            </div>
                            <?php
                          }
                          ?>
                        </div> -->
    <?php
      if($arResult['ITEM_PRICES'][0]['PRICE']) {
    ?>
    <a class="btn-red" href="/add_to_cart.php?id=<?= $arResult['ID'] ?>&sessid=<?= bitrix_sessid() ?>">Купить</a>

    <script>
    function addToCart(productId) {
        // Создаем скрытую форму
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= POST_FORM_ACTION_URI ?>';
        form.style.display = 'none';
        
        // Добавляем CSRF-токен
        var sessid = document.createElement('input');
        sessid.type = 'hidden';
        sessid.name = 'sessid';
        sessid.value = '<?= bitrix_sessid() ?>';
        form.appendChild(sessid);
        
        // Добавляем ID товара
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'action';
        input.value = 'ADD2BASKET';
        form.appendChild(input);
        
        var input2 = document.createElement('input');
        input2.type = 'hidden';
        input2.name = 'id';
        input2.value = productId;
        form.appendChild(input2);
        
        // Добавляем форму на страницу и отправляем
        document.body.appendChild(form);
        form.submit();
        
        // Предотвращаем переход по ссылке
        return false;
    }
    </script>
    <?php 
      }
      else {
        print "<button class='btn-red modal-price'>Заказать</button>";
      }
     ?>


                        
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
  $price = !empty($arResult['ITEM_PRICES'][0]['PRICE']) ?  $arResult['ITEM_PRICES'][0]['PRICE'] : '150000.000';
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
<script>
// Функция добавления в сравнение
function addToCompare(productId, productName) {
    // Показываем загрузку
    var link = event.target;
    var originalHtml = link.innerHTML;
    link.innerHTML = '⏳ Добавляем...';
    
    // AJAX запрос к компоненту сравнения
    BX.ajax({
        url: window.location.href, // Текущая страница
        method: 'POST',
        data: {
            sessid: BX.bitrix_sessid(),
            action: 'ADD_TO_COMPARE_LIST',
            id: productId,
            ajax_action: 'Y'
        },
        onsuccess: function(response) {
            // Восстанавливаем кнопку
            link.innerHTML = originalHtml;
            
            // Проверяем успех (в Битрикс обычно возвращает JSON)
            var success = false;
            try {
                var data = JSON.parse(response);
                success = data.STATUS === 'OK';
            } catch(e) {
                // Если не JSON, ищем текст успеха
                success = response.indexOf('success') > -1 || 
                         response.indexOf('добавлен') > -1;
            }
            
            if (success) {
                // Показываем всплывающее окно
                showComparePopup(productName);
            } else {
                alert('Не удалось добавить товар в сравнение');
            }
        },
        onfailure: function() {
            link.innerHTML = originalHtml;
            alert('Ошибка соединения');
        }
    });
}

// Показ всплывающего окна
function showComparePopup(productName) {
    // Создаем модальное окно
    var popup = document.createElement('div');
    popup.className = 'compare-popup';
    popup.innerHTML = `
        <div class="compare-popup-content">
            <div class="compare-popup-header">
                <h3>Товар добавлен в сравнение</h3>
                <button class="compare-popup-close" onclick="closeComparePopup()">×</button>
            </div>
            <div class="compare-popup-body">
                <p>«${productName}» добавлен в список сравнения.</p>
                <p>Вы можете сравнить его с другими товарами.</p>
            </div>
            <div class="compare-popup-footer">
                <button class="btn-continue" onclick="closeComparePopup()">Продолжить покупки</button>
                <button class="btn-go-compare" onclick="window.location.href='/catalog/compare/'">Перейти к сравнению</button>
            </div>
        </div>
        <div class="compare-popup-overlay" onclick="closeComparePopup()"></div>
    `;
    
    // Добавляем на страницу
    document.body.appendChild(popup);
    
    // Закрытие по ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeComparePopup();
    });
}

// Закрытие окна
function closeComparePopup() {
    var popup = document.querySelector('.compare-popup');
    if (popup) {
        popup.remove();
    }
}

// Инициализация при загрузке
document.addEventListener('DOMContentLoaded', function() {
    // Можно добавить обработчики для других элементов
});

// Функция переключения избранного
function toggleFavorite(button) {
    const productId = button.getAttribute('data-id');
    const productName = button.getAttribute('data-name');
    const productPrice = button.getAttribute('data-price');
    const productImage = button.getAttribute('data-image');
    const productUrl = button.getAttribute('data-url'); // Получаем URL
    
    let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const existingIndex = favorites.findIndex(item => item.id == productId);
    
    if (existingIndex >= 0) {
        // Удаляем
        favorites.splice(existingIndex, 1);
        button.innerHTML = '♡ В избранное';
        button.classList.remove('active');
    } else {
        // Добавляем с URL
        favorites.push({
            id: productId,
            name: productName,
            price: parseFloat(productPrice),
            image: productImage,
            detailUrl: productUrl, // Сохраняем URL
            quantity: 1
        });
        button.innerHTML = '♥ В избранном';
        button.classList.add('active');
    }
    
    localStorage.setItem('favorites', JSON.stringify(favorites));
    updateFavoritesCounter();
}

// Счетчик избранного в шапке
function updateFavoritesCounter() {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const counter = document.getElementById('favorites-counter');
    if (counter) {
        counter.textContent = favorites.length;
        counter.style.display = favorites.length ? 'inline' : 'none';
    }
}

// Показ уведомлений
function showNotification(message) {
    // Можно использовать BX.UI.Notification или простой alert
    if (typeof BX !== 'undefined' && BX.UI && BX.UI.Notification) {
        BX.UI.Notification.Center.notify({
            content: message,
            autoHideDelay: 3000
        });
    } else {
        alert(message);
    }
}

// При загрузке страницы проверяем, добавлен ли товар в избранное
document.addEventListener('DOMContentLoaded', function() {
    const productId = <?= $productId ?>;
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const isFavorite = favorites.some(item => item.id == productId);
    
    const button = document.querySelector('.favorite-btn[data-id="<?= $productId ?>"]');
    if (button && isFavorite) {
        button.innerHTML = '♥ В избранном';
        button.classList.add('active');
    }
    
    // Инициализируем счетчик
    updateFavoritesCounter();
});
</script>
