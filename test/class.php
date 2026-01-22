<?php
namespace OLM;
use CIBlock;
use CIBlockElement;
use CIBlockSection;
use logArray;

class AnkornCatalogPropApdater
{
    const ibid = 2;// инфоблок продукты
    const testItemNum = [1120];

    public static function GetIBlockProperties ():array
    {
        $obRes = CIBlock::GetProperties(self::ibid, Array(), Array());
        while ($res = $obRes->Fetch()) {
            if($res["PROPERTY_TYPE"] == 'S'){
                $tmpRes = array();
                $tmpRes['PROPERTY_TYPE'] = $res['PROPERTY_TYPE'];
                $tmpRes['USER_TYPE'] = $res['USER_TYPE'];
                $tmpRes['ID'] = $res['ID'];
                $tmpRes['NAME'] = $res['NAME'];
                $tmpRes['ACTIVE'] = $res['ACTIVE'];
                $tmpRes['CODE'] = $res['CODE'];
                $arProperty[$tmpRes['ID']] = $tmpRes;
                if($res["USER_TYPE"] == "HTML"){
                    $arHtmlProperty[$tmpRes['ID']] = $tmpRes;
                    $arSelectPropertyId[$tmpRes['ID']] = $tmpRes;
                }
                if($res["USER_TYPE"] == null){
                    $arStringProperty[$tmpRes['ID']] = $tmpRes;
                    $arSelectPropertyId[$tmpRes['ID']] = $tmpRes;
                }
                unset($tmpRes);
            }
        }
        return [
            'arProperty'=>$arProperty,
            'arHtmlProperty'=>$arHtmlProperty,
            'arStringProperty'=>$arStringProperty,
            'arSelectPropertyId'=>$arSelectPropertyId,
        ];
    }

    /**
     *  Получаем массив товаров с id названием и вступительным и основным текстом
     *  а так же со строковыми и html свойствами
     *
     * @param array $properties
     * @param int $topCount
     * @param bool $parseProperies
     * @return array
     *
     */

    public static function GetIBlockItemsList (array $properties, int $topCount=10,  bool $parseProperies=false)
    {
        $obRes = CIBlockElement::GetList(
            Array(),
            array('IBLOCK_ID' => self::ibid,"ACTIVE"=>"Y", 'ID'=>self::testItemNum,  '!PROPERTY_IS_MAIN'=>22),
            false,
            Array ("nTopCount" => $topCount),
            ['IBLOCK_ID','ID','NAME','PREVIEW_TEXT',"DETAIL_TEXT", "IBLOCK_SECTION_ID"]
        );
        while ($res = $obRes->Fetch()) {
            $tmpRes=[];
            $tmpRes['ID']=$res['ID'];
            $tmpRes['NAME']=$res['NAME'];
            $tmpRes['PREVIEW_TEXT']=$res['PREVIEW_TEXT'];
            $elementIDs[] =&$row;
            $tmpRes['DETAIL_TEXT']=$res['DETAIL_TEXT'];
            $items[] = $tmpRes;
            unset($tmpRes);
            $elements[] = $res['ID'];
        }
        if($parseProperies){
            $arProperties = self::GetProperties($elements, $properties);
            foreach($items as &$item){
                $item['PROPERTIES'] = $arProperties[$item['ID']];
            }
        }
        return $items;
    }

    /**
     * Получение массива со строковыми и html свойствами для каждого элемента
     *
     * @param array $elements
     * @param array $properties
     * @return array
     */
    public static function GetProperties(array $elements, array $properties)//:array|null
    {

        $ObProperties = CIBlockElement::GetPropertyValues(
            self::ibid,
            ['ID'=>$elements],
            false,
            ['ID'=>array_column($properties['arSelectPropertyId'],'ID')]
        );
        $arPropertyValues = [];
        while ($propRes = $ObProperties->Fetch()) {
            foreach($propRes as $propKey=>$propVal)
            {
                // если значения свойств не пусты
                if(is_numeric($propKey) && !empty($propVal)){
                    $tmpArProperty = [
                        'ID' => $properties['arSelectPropertyId'][$propKey]['ID'],
                        'NAME' => $properties['arSelectPropertyId'][$propKey]['NAME'],
                        'CODE' => $properties['arSelectPropertyId'][$propKey]['CODE'],
                    ];
                    // выделили html
                    if($properties['arSelectPropertyId'][$propKey]['USER_TYPE'] == 'HTML') {
                        $propVal = unserialize($propVal, ['allowed_classes' => false]);
                        if($propVal['TEXT'] == '') continue;
                        // обработка таблиц
                        if(self::isTable($propVal['TEXT'])){
                            $propVal['PARS_DATA']["FROM_TABLE_DATA"] = self::htmlTablesToArraySimple($propVal['TEXT']);
                        }

                        if(self::isList($propVal['TEXT'])){
                            $propVal['PARS_DATA']["FROM_LIST_DATA"] = self::htmlListToArraySimple($propVal['TEXT']);
                        }
                    }
                    $tmpArProperty['VALUE'] = $propVal;
                    $propCode = $properties['arSelectPropertyId'][$propKey]['CODE'];
                    $arPropertyValues[$propRes['IBLOCK_ELEMENT_ID']][$propCode] = $tmpArProperty;
                }
            }
        }
        return   $arPropertyValues;
    }

    /**
     * Пhоверка есть ли в переданной строке html таблица
     *
     * @param string|null $text
     * @return bool
     */
    public static function isTable(string|null $text):bool
    {
        return stristr($text,'<table')!=false;
    }

    /**
     * Проверка есть ли в переданной строке html список
     *
     * @param string|null $text
     * @return bool
     */
    public static function isList(string|null $text):bool
    {
        return stristr($text,'<li')!=false;
    }

    /**
     * Парсинг таблицы в массив
     *
     * @param string $html
     * @return array|string
     */
    public static function htmlTablesToArraySimple(string $html)
    {
        $html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $html;
        $dom = new \DOMDocument();
        @$dom->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING);
        $xpath = new \DOMXPath($dom);
        if (stristr($html, 'mod-table'))
            return self::modTableHandler($xpath);
        else {
            return $html;
        }
    }

    /**
     * Парсинг таблиц класса "mod-table"
     *
     * @param $xpath
     * @return array
     */
    public static function modTableHandler($xpath):array
    {
        $features = array('main', 'additional');
        $logArray = LogArray::getLogArray();
        if(empty($logArray->data['content props'])){
            $logArray->data['content props']['main']=[];
            $logArray->data['content props']['additional']=[];
        }

        $result = [];
        $headings = $xpath->query('//h2');
        foreach ($headings as $headingIndex => $heading) {
            $headingData =  $heading->nodeValue;
            $result["h2"][$headingIndex] = $headingData;
            $logArray->data['headings'][$headingData] = $headingIndex;
        }
        // Находим все таблицы с классом mod-table
        $tables = $xpath->query('//table[contains(@class, "mod-table")]');
        foreach ($tables as $tableIndex => $table) {
            $tableData = [];
            // Находим все строки в таблице
            $rows = $xpath->query('.//tr', $table);
            foreach ($rows as $row) {
                $cells = $xpath->query('./td', $row);
                if ($cells->length >= 2) {
                    $key = trim($cells->item(0)->nodeValue);
                    $value = trim($cells->item(1)->nodeValue);
                    $tableData[$key] = $value;

                    if(!in_array($key, $logArray->data['content props'][$features[$tableIndex]]))
                        $logArray->data['content props'][$features[$tableIndex]][] = $key;
                    $logArray->data['full props'][$key] = $key;
                }
            }
            $result["table"][$tableIndex] = $tableData;
        }
        return $result;
    }


    /**
     * Парсинг таблицы в массив
     *
     * @param string $html
     * @return array|string
     */
    public static function htmlListToArraySimple(string $html)
    {

        $logArray = LogArray::getLogArray();
        if(empty($logArray->data['content props'])){
            $logArray->data['content props']['main']=[];
            $logArray->data['content props']['additional']=[];
        }

        $html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $html;
        $dom = new \DOMDocument();
        @$dom->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING);
        $xpath = new \DOMXPath($dom);

        $result = [];

        // Находим все заголовки h3
        $headers = $xpath->query('//h3');

        foreach ($headers as $header) {
            $headerText = trim($header->nodeValue);

            // Проверяем, содержит ли заголовок "Основные характеристики"
            if (stripos($headerText, 'Основные характеристики') !== false) {
                // Ищем следующий ul
                $nextUl = $xpath->query('./following-sibling::ul[1]', $header)->item(0);
                if ($nextUl) {
                    $list = $xpath->query('.//li', $nextUl);
                    $result['list'][0] =self::listToArray($list);
                }
            }
            // Проверяем, содержит ли заголовок "Дополнительные характеристики"
            if (stripos($headerText, 'Дополнительные характеристики') !== false) {
                // Ищем следующий ul
                $nextUl = $xpath->query('./following-sibling::ul[1]', $header)->item(0);
                if ($nextUl) {
                    $list = $xpath->query('.//li', $nextUl);
                    $result['list'][1] =self::listToArray($list, 'additional');
                }
            }
            // Проверяем, содержит ли заголовок "Область применения"
            if (stripos($headerText, 'Область применения') !== false) {
                // Ищем следующий ul
                $nextUl = $xpath->query('./following-sibling::ul[1]', $header)->item(0);
                if ($nextUl) {
                    $list = $xpath->query('.//li', $nextUl);
                    $result['list'][0]['Область применения'] =self::listToArray($list);
                }
            }
            // Проверяем, содержит ли заголовок "Среда"
            if (stripos($headerText, 'Среда') !== false) {
                // Ищем следующий ul
                $nextUl = $xpath->query('./following-sibling::ul[1]', $header)->item(0);
                if ($nextUl) {
                    $list = $xpath->query('.//li', $nextUl);
                    $result['list'][0]['Измеряемая среда'] =self::listToArray($list);
                }
            }
        }
        if ($result) return $result;
        else return $html;

    }

    /**
     *  Преобразуем массив строк в массив значений с разбиением по ":"
     *
     * @param array $list
     * @return array
     */
    public static function listToArray($list, $OsDop = 'main'): array
    {
        $logArray = LogArray::getLogArray();
        $result = [];
        foreach ($list as $item) {
            $text = trim($item->nodeValue);

            if (str_contains($text, ':')) {
                $parts = explode(':', $text, 2);
                $result[trim($parts[0])] = trim($parts[1]);
                if(!in_array(trim($parts[0]), $logArray->data['content props'][$OsDop]));
                    $logArray->data['content props'][$OsDop][] = trim($parts[0]);
                $logArray->data['full props'][trim($parts[0])] = trim($parts[0]);

            } else {
                // Если нет двоеточия, просто добавляем как есть
                $result[] = $text;
            }
        }

        return $result;
    }


    public static function getItemSections($elementId)
    {
        if (empty($elementId)) {
            return array();
        }

        $result = array();
        $processedSections = array();

        // Получаем все разделы элемента
        $res = CIBlockElement::GetElementGroups($elementId, true);
        while ($section = $res->Fetch()) {
            $sectionId = $section['ID'];
            if (in_array($sectionId, $processedSections)) continue;

            // Получаем навигационную цепочку раздела
            $navChain = CIBlockSection::GetNavChain(
                self::ibid,
                $sectionId,
                array('ID', 'NAME', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID'),
                true
            );

            foreach($navChain as $chainSection){
                if (!in_array($chainSection['ID'], $processedSections)) {
                    $result[$chainSection['ID']] = array(
                        'ID' => $chainSection['ID'],
                        'NAME' => $chainSection['NAME'],
                        'DEPTH_LEVEL' => $chainSection['DEPTH_LEVEL']
                    );
                    $processedSections[] = $chainSection['ID'];
                }
            }
        }

        // Сортируем по уровню вложенности
        usort($result, function($a, $b) {
            return $a['DEPTH_LEVEL'] - $b['DEPTH_LEVEL'];
        });

        return $result;
    }

        /**
     *  Добавление значений в элемент массива
     *
     * @param array $item
     * @return array
     *
     */
    public static function addPropertyValue(array $item, array $associated_properties)
    {
        $associated_properties = dataArrays::associated_properties;
        $ArPropertyValues = [];
        $mainFeatures = [];
        $additionalFeatures = [];

        // обрабатываем имена разделов и имя товара
        $itemSections = self::getItemSections($item['ID']);
        $names = array_column($itemSections, 'NAME');
        $names[] = $item['NAME'];
        foreach($names as $name){
            if(dataArrays::associated_TypeAndPrinciple['Principle'][$name])
                $ArPropertyValues['PARAM_PRINCIP'] = dataArrays::associated_TypeAndPrinciple['Principle'][$name];

            if($ArPropertyValues['PARAM_TYPE1']) continue;
            foreach(dataArrays::associated_TypeAndPrinciple['Type'] as $type){
                if(stristr(mb_strtoupper($name), mb_strtoupper($type))){
                    $ArPropertyValues['PARAM_TYPE1'] = $type;
                    break;
                }
            }
        }

        /*
        // обрабатывем таблицы "характеристики модификаций"
        if($item["PROPERTIES"]["CHARACTERISTICS_MOD"]["VALUE"]['PARS_DATA']["FROM_LIST_DATA"]["table"]){
            $CMTs = $item["PROPERTIES"]["CHARACTERISTICS_MOD"]["VALUE"]['PARS_DATA']["FROM_LIST_DATA"]["table"];
            foreach($CMTs as $Num=>$cm){
                foreach($cm as $cmPropName=>$cmPropValue){
                    if(!$associated_properties[$cmPropName]) continue;
                    $propertyCode = $associated_properties[$cmPropName]['CODE'];
                    $ArPropertyValues[$propertyCode] = trim($cmPropValue);
                    if($Num == 0)
                        $mainFeatures[] = trim($associated_properties[$cmPropName]['NAME'].' ('.$associated_properties[$cmPropName]['CODE'].')');
                    if($Num == 1)
                        $additionalFeatures[] = trim($associated_properties[$cmPropName]['NAME'].' ('.$associated_properties[$cmPropName]['CODE'].')');
                }
            }
        }

        // обрабатываем списки
        foreach($item["PROPERTIES"] as $ItemPropKay=>$itemPropValue){
            if(!empty($itemPropValue["VALUE"]['PARS_DATA']["FROM_LIST_DATA"]["list"])){
                $CMTs = $itemPropValue["VALUE"]['PARS_DATA']["FROM_LIST_DATA"]["list"];
                foreach($CMTs as $Num=>$cm){
                    foreach($cm as $cmPropName=>$cmPropValue){
                        if(!$associated_properties[$cmPropName]) continue;
                        $propertyCode = $associated_properties[$cmPropName]['CODE'];
                        if(is_string($cmPropValue))
                            $ArPropertyValues[$propertyCode] = trim($cmPropValue);
                        if(is_array($cmPropValue))
                            $ArPropertyValues[$propertyCode] = $cmPropValue;
                        if($Num == 0)
                            $mainFeatures[] = trim($associated_properties[$cmPropName]['NAME'].' ('.$associated_properties[$cmPropName]['CODE'].')');
                        if($Num == 1)
                            $additionalFeatures[] = trim($associated_properties[$cmPropName]['NAME'].' ('.$associated_properties[$cmPropName]['CODE'].')');
                    }
                }
            }
        }

        */

        if($mainFeatures != []) $ArPropertyValues['MAIN_FEATURES'] = $mainFeatures;
        if($additionalFeatures != []) $ArPropertyValues['ADDITIONAL_FEATURES'] = $additionalFeatures;


        echo '<pre id="inspect" class="ins_1" style="margin: 40px 0px;">';
        var_dump($ArPropertyValues);
        echo '</pre>';

    //    CIBlockElement::SetPropertyValuesEx($item['ID'], self::ibid, $ArPropertyValues);
        return [$item['ID']=>$item['NAME']];
    }

}