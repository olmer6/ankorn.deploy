<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

// Подключаем модули
if (!CModule::IncludeModule("iblock")) {
    die("Ошибка подключения модуля iblock");
}

// ================= НАСТРОЙКИ =================
$testMode = true; // true - тестовый режим (без реальных изменений), false - реальное обновление
$iblockId = 2; // ID инфоблока каталога
// =============================================

// Путь к CSV файлу
$csvFilePath = __DIR__ . "/metatags.csv";

// Проверяем существование файла
if (!file_exists($csvFilePath)) {
    die("Файл metatags.csv не найден по пути: " . $csvFilePath);
}

// Открываем CSV файл
$handle = fopen($csvFilePath, "r");
if ($handle === false) {
    die("Не удалось открыть файл: " . $csvFilePath);
}

// Пропускаем заголовок CSV
$headers = fgetcsv($handle, 0, ",");

// Счетчики для статистики
$totalProcessed = 0;
$totalUpdated = 0;
$totalSkipped = 0;
$totalErrors = 0;
$totalTestUpdates = 0; // Счетчик запланированных обновлений в тестовом режиме
$errors = [];
$testUpdatesLog = []; // Лог запланированных изменений в тестовом режиме

echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h2 { color: #333; border-bottom: 2px solid #0066cc; padding-bottom: 10px; }
    h3 { color: #555; margin-top: 30px; }
    table { border-collapse: collapse; width: 100%; margin: 20px 0; box-shadow: 0 2px 3px rgba(0,0,0,0.1); }
    th { background: #0066cc; color: white; padding: 12px; text-align: left; }
    td { padding: 10px; border: 1px solid #ddd; }
    tr:nth-child(even) { background: #f9f9f9; }
    tr:hover { background: #f0f0f0; }
    .status-success { color: #28a745; font-weight: bold; }
    .status-error { color: #dc3545; font-weight: bold; }
    .status-skip { color: #6c757d; }
    .status-test { color: #ffc107; font-weight: bold; }
    .alert { padding: 15px; margin: 20px 0; border-radius: 5px; }
    .alert-warning { background: #fff3cd; border: 1px solid #ffc107; color: #856404; }
    .alert-info { background: #d1ecf1; border: 1px solid #0dcaf0; color: #0c5460; }
    .alert-success { background: #d4edda; border: 1px solid #28a745; color: #155724; }
    .stats { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
    .mode-switch { 
        display: inline-block; 
        padding: 10px 20px; 
        background: #0066cc; 
        color: white; 
        text-decoration: none; 
        border-radius: 5px;
        margin: 10px 0;
    }
    .mode-switch:hover { background: #0052a3; }
    .change-detail { font-size: 0.9em; color: #666; margin-top: 5px; }
    ul { margin: 10px 0; }
    li { margin: 5px 0; }
</style>";

// Вывод информации о режиме работы
if ($testMode) {
    echo "<div class='alert alert-warning'>
            <strong>⚠️ ТЕСТОВЫЙ РЕЖИМ</strong><br>
            Реальные изменения в базу данных НЕ вносятся. Показываются только запланированные изменения.<br>
            <a href='?mode=live' class='mode-switch'>Переключить в РАБОЧИЙ режим</a>
          </div>";
} else {
    echo "<div class='alert alert-danger'>
            <strong>⚠️ РАБОЧИЙ РЕЖИМ</strong><br>
            Изменения БУДУТ внесены в базу данных!<br>
            <a href='?mode=test' class='mode-switch'>Переключить в ТЕСТОВЫЙ режим</a>
          </div>";
}

// Обработка переключения режимов через URL
if (isset($_GET['mode'])) {
    if ($_GET['mode'] === 'test') {
        $testMode = true;
    } elseif ($_GET['mode'] === 'live') {
        $testMode = false;
    }
}

echo "<h2>📊 Обновление мета-тегов товаров</h2>";

// Если тестовый режим, создаем файл для лога
if ($testMode) {
    $logFile = __DIR__ . "/test_update_log_" . date("Y-m-d_H-i-s") . ".html";
    $logContent = "<html><head><meta charset='utf-8'><title>Лог тестового обновления</title></head><body>";
    $logContent .= "<h2>Лог тестового обновления мета-тегов</h2>";
    $logContent .= "<p>Дата: " . date("d.m.Y H:i:s") . "</p>";
    $logContent .= "<table border='1' cellpadding='5'><tr><th>URL</th><th>Товар</th><th>Изменения</th></tr>";
}

echo "<table>
        <tr>
            <th>№</th>
            <th>URL</th>
            <th>Товар (ID)</th>
            <th>Статус</th>
            <th>Текущее значение</th>
            <th>Новое значение</th>
        </tr>";

// Обрабатываем каждую строку CSV
$rowNumber = 0;
while (($data = fgetcsv($handle, 0, ",")) !== false) {
    $rowNumber++;
    $totalProcessed++;

    // Получаем данные из CSV
    $url = trim($data[0]);
    $metaTitleOld = trim($data[1]);
    $metaTitleNew = trim($data[2]);
    $metaDescriptionOld = trim($data[3]);
    $metaDescriptionNew = trim($data[4]);
    $h1New = trim($data[5]);

    // Извлекаем символьный код из URL
    $productCode = getProductCodeFromUrl($url);

    if (empty($productCode)) {
        $totalErrors++;
        $errors[] = "Строка {$rowNumber}: Не удалось извлечь символьный код из URL: " . $url;
        echo "<tr>
                <td>{$rowNumber}</td>
                <td>" . htmlspecialchars($url) . "</td>
                <td>-</td>
                <td class='status-error'>❌ Ошибка</td>
                <td colspan='2'>Неверный формат URL</td>
              </tr>";
        continue;
    }

    // Ищем товар по символьному коду
    $productId = getProductByCode($productCode, $iblockId);

    if (!$productId) {
        $totalErrors++;
        $errors[] = "Строка {$rowNumber}: Товар не найден: " . $productCode;
        echo "<tr>
                <td>{$rowNumber}</td>
                <td>" . htmlspecialchars($url) . "</td>
                <td>Код: " . htmlspecialchars($productCode) . "</td>
                <td class='status-error'>❌ Ошибка</td>
                <td colspan='2'>Товар не найден в инфоблоке</td>
              </tr>";
        continue;
    }

    // Получаем текущие значения элемента
    $element = CIBlockElement::GetByID($productId)->Fetch();
    if (!$element) {
        $totalErrors++;
        $errors[] = "Строка {$rowNumber}: Не удалось получить данные товара ID={$productId}";
        continue;
    }

    // Подготавливаем поля для обновления
    $updateFields = [];
    $changesDescription = [];
    $currentValues = [];
    $newValues = [];

    // Получаем текущие SEO свойства
    $ipropertyValues = [];
    $rsIprop = CIBlockElement::GetPropertyValues($iblockId, ['ID' => $productId], false, ['ID']);
    // Получаем SEO шаблоны для элемента
    $elementIprop = new \Bitrix\Iblock\InheritedProperty\ElementValues($iblockId, $productId);
    $currentIpropValues = $elementIprop->getValues();

    $currentMetaTitle = $currentIpropValues['ELEMENT_META_TITLE'] ?? $element['NAME'];
    $currentMetaDescription = $currentIpropValues['ELEMENT_META_DESCRIPTION'] ?? '';

    // Проверяем и обновляем мета-тайтл
    if (!empty($metaTitleNew)) {
        if ($currentMetaTitle != $metaTitleNew) {
            $updateFields['IPROPERTY_TEMPLATES']['ELEMENT_META_TITLE'] = $metaTitleNew;
            $changesDescription[] = "META TITLE";
            $currentValues[] = "Текущий metaTitle: " . htmlspecialchars($currentMetaTitle);
            $newValues[] = "Новый metaTitle: " . htmlspecialchars($metaTitleNew);
        }
    }

    // Проверяем и обновляем мета-дескрипшн
    if (!empty($metaDescriptionNew)) {
        if ($currentMetaDescription != $metaDescriptionNew) {
            $updateFields['IPROPERTY_TEMPLATES']['ELEMENT_META_DESCRIPTION'] = $metaDescriptionNew;
            $changesDescription[] = "META DESCRIPTION";
            $currentValues[] = "Текущий metaDescription: " . htmlspecialchars($currentMetaDescription);
            $newValues[] = "Новый metaDescription: " . htmlspecialchars($metaDescriptionNew);
        }
    }

    // Проверяем и обновляем заголовок H1 (NAME элемента)
    if (!empty($h1New)) {
        $currentName = $element['NAME'];
        if ($currentName != $h1New) {
            $updateFields['NAME'] = $h1New;
            $changesDescription[] = "H1 (NAME)";
            $currentValues[] = "Текущий h1: " . htmlspecialchars($currentName);
            $newValues[] = "Новый h1: " . htmlspecialchars($h1New);
        }
    }

    // Если есть что обновлять
    if (!empty($updateFields)) {
        $totalTestUpdates++;

        // В тестовом режиме только показываем изменения
        if ($testMode) {
            echo "<tr>
                    <td>{$rowNumber}</td>
                    <td>" . htmlspecialchars($url) . "</td>
                    <td>{$productCode} (ID: {$productId})</td>
                    <td class='status-test'>🔄 Запланировано</td>
                    <td>" . implode("<br>", $currentValues) . "</td>
                    <td>" . implode("<br>", $newValues) . "</td>
                  </tr>";

            // Добавляем в лог
            $logContent .= "<tr>
                <td>" . htmlspecialchars($url) . "</td>
                <td>{$productCode} (ID: {$productId})</td>
                <td>" . implode("<br>", $changesDescription) . "</td>
            </tr>";

            $testUpdatesLog[] = [
                'url' => $url,
                'product_code' => $productCode,
                'product_id' => $productId,
                'changes' => $changesDescription,
                'current' => $currentValues,
                'new' => $newValues,
                'update_fields' => $updateFields
            ];
        } else {
            // Реальное обновление
            $el = new CIBlockElement;
            $result = $el->Update($productId, $updateFields);

            if ($result) {
                $totalUpdated++;
                echo "<tr>
                        <td>{$rowNumber}</td>
                        <td>" . htmlspecialchars($url) . "</td>
                        <td>{$productCode} (ID: {$productId})</td>
                        <td class='status-success'>✅ Обновлен</td>
                        <td>" . implode("<br>", $currentValues) . "</td>
                        <td>" . implode("<br>", $newValues) . "</td>
                      </tr>";
            } else {
                $totalErrors++;
                $errorMsg = $el->LAST_ERROR;
                $errors[] = "Строка {$rowNumber}: Ошибка обновления товара {$productCode}: " . $errorMsg;
                echo "<tr>
                        <td>{$rowNumber}</td>
                        <td>" . htmlspecialchars($url) . "</td>
                        <td>{$productCode} (ID: {$productId})</td>
                        <td class='status-error'>❌ Ошибка</td>
                        <td colspan='2'>" . htmlspecialchars($errorMsg) . "</td>
                      </tr>";
            }
        }
    } else {
        $totalSkipped++;
        echo "<tr>
                <td>{$rowNumber}</td>
                <td>" . htmlspecialchars($url) . "</td>
                <td>{$productCode} (ID: {$productId})</td>
                <td class='status-skip'>⏭️ Пропущен</td>
                <td colspan='2'>Изменений не требуется (значения совпадают)</td>
              </tr>";
    }
}

echo "</table>";

// Закрываем файл
fclose($handle);

// Закрываем лог в тестовом режиме
if ($testMode) {
    $logContent .= "</table></body></html>";
    file_put_contents($logFile, $logContent);
}

// Выводим статистику
echo "<div class='stats'>";
echo "<h3>📈 Статистика обработки:</h3>";
echo "<table style='width: auto;'>";
echo "<tr><td>Всего обработано строк:</td><td><strong>{$totalProcessed}</strong></td></tr>";

if ($testMode) {
    echo "<tr><td>Запланировано к обновлению:</td><td><strong style='color: #ffc107;'>{$totalTestUpdates}</strong></td></tr>";
    echo "<tr><td>Пропущено (без изменений):</td><td><strong>{$totalSkipped}</strong></td></tr>";
    echo "<tr><td>Ошибок:</td><td><strong style='color: #dc3545;'>{$totalErrors}</strong></td></tr>";
} else {
    echo "<tr><td>Успешно обновлено:</td><td><strong style='color: #28a745;'>{$totalUpdated}</strong></td></tr>";
    echo "<tr><td>Пропущено (без изменений):</td><td><strong>{$totalSkipped}</strong></td></tr>";
    echo "<tr><td>Ошибок:</td><td><strong style='color: #dc3545;'>{$totalErrors}</strong></td></tr>";
}

echo "</table>";
echo "</div>";

// Выводим ошибки, если они есть
if (!empty($errors)) {
    echo "<div class='alert alert-danger'>";
    echo "<h3>❌ Список ошибок:</h3>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo "</div>";
}

// В тестовом режиме показываем дополнительную информацию
if ($testMode) {
    echo "<div class='alert alert-info'>";
    echo "<h3>📝 Информация о тестовом прогоне:</h3>";
    echo "<p>Файл с детальным логом сохранен: <strong>" . basename($logFile) . "</strong></p>";

    if (!empty($testUpdatesLog)) {
        echo "<h4>Детали запланированных изменений:</h4>";
        foreach ($testUpdatesLog as $index => $update) {
            echo "<div style='margin: 10px 0; padding: 10px; background: white; border-radius: 5px;'>";
            echo "<strong>#{$index} " . htmlspecialchars($update['product_code']) . " (ID: {$update['product_id']})</strong><br>";
            echo "Изменяемые поля: " . implode(", ", $update['changes']) . "<br>";
            foreach ($update['changes'] as $i => $change) {
                echo "<div class='change-detail'>";
                echo "{$change}:<br>";
                echo "&nbsp;&nbsp;{$update['current'][$i]}<br>";
                echo "&nbsp;&nbsp;→ {$update['new'][$i]}";
                echo "</div>";
            }
            echo "</div>";
        }
    }

    echo "<p style='margin-top: 20px;'>
            <strong>Для применения изменений переключитесь в рабочий режим:</strong><br>
            <a href='?mode=live' class='mode-switch'>Переключить в РАБОЧИЙ режим</a>
          </p>";
    echo "</div>";
}

/**
 * Извлекает символьный код товара из URL
 */
function getProductCodeFromUrl($url) {
    // Убираем базовый URL
    $baseUrl = "https://ankorn.ru/product/";
    $code = str_replace($baseUrl, "", $url);

    // Убираем слеш в конце, если есть
    $code = rtrim($code, "/");

    // Декодируем URL
    $code = urldecode($code);

    return $code;
}

/**
 * Получает ID элемента инфоблока по символьному коду
 */
function getProductByCode($code, $iblockId) {
    $arFilter = [
        "IBLOCK_ID" => $iblockId,
        "CODE" => $code,
        "ACTIVE" => "Y" // Только активные товары, при необходимости убрать
    ];

    $rsElements = CIBlockElement::GetList(
        [],
        $arFilter,
        false,
        false,
        ["ID", "NAME", "CODE"]
    );

    if ($element = $rsElements->Fetch()) {
        return $element["ID"];
    }

    return false;
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>