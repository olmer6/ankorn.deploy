<?php
namespace OLM;
use CIBlockElement;

class SateliteHandler
{
    public $items = array();
    public $mainItems = array();

    public $el;

    public function __construct()
    {
        $properties = AnkornCatalogPropApdater::GetIBlockProperties();
        $items = AnkornCatalogPropApdater::GetIBlockItemsList($properties, 5000, true);
        $this->items = $items;
        foreach ($this->items as $item) {
            if ($item["PROPERTIES"]['IS_MAIN']['VALUE'] == 22)
                $this->mainItems[] = $item;
        }
        $this->el = new CIBlockElement;
    }

    public function testRun()
    {

        foreach($this->mainItems as $item){
            set_time_limit(30);


            $ancorList = $this->ancorList($item["DETAIL_TEXT"]);
            // выбираем дочерние по анкору
            // $arIDs = self::arIdByArAncore($ancorList);

            // выбираем дочерние по родителю
            $arIDs = self::arIDsChildItemByParentID($item['ID']);
            $elementGroups = self::ElementGroupIDs($item['ID']);
            $mainSection = $item["IBLOCK_SECTION_ID"];

            // собираем группы родителя
            $arSectionIds = ['elementGroups'=>$elementGroups, 'mainSection'=>$mainSection];

            $settings = self::createArUpdatedSettings($item);
            $ArPropertyValues = self::createArProperty($item);

            foreach($arIDs as $childItemId){
            //    $childItemId=4948;
                self::apdateChildItem(itemId:$childItemId, settings:$settings, ArPropertyValues:$ArPropertyValues, arSectionIds:$arSectionIds);
            }
        }
    }



    /**
     * Создание списка обновляемых основных свойств
     *
     * @param array $item
     * @return array
     */
    public static function createArUpdatedSettings(array $item): array
    {
        $settings = [];

        return $settings;
    }

    /**
     * Создание списка обновляемых (наполняемых) свойств
     *
     * @param array $item
     * @return array
     */
    public static function createArProperty(array $item): array
    {
        $ArPropertyValues = [];
        //$ArPropertyValues['PARENT_ITEM'] = $item['ID'];

        return $ArPropertyValues;
    }

    /**
     * Обновляем дочерний элемент
     *
     * @param int $itemId
     * @param array $settings
     * @param array $ArPropertyValues
     * @return void
     */
    public function apdateChildItem(int $itemId = 0, array $settings = [], array $ArPropertyValues = [], array $arSectionIds = [])
    {
        set_time_limit(30);
        if($itemId == 0) return;
        if($settings)
            $this->updateItemSetting ( itemId:$itemId, settings:$settings);
        if($ArPropertyValues)
            self::addPropertyValue ( itemId:$itemId, ArPropertyValues:$ArPropertyValues);
        if($arSectionIds)
            self::SetElementSection(itemId:$itemId, arSectionIds:$arSectionIds);
    }

    /**
     * Изменяем основные параметры элемента
     *
     * @param int $id
     * @param array $settings
     * @return bool|mixed
     */
    public function updateItemSetting (int $itemId, array $settings=[]){
        global $USER;
        $settings["MODIFIED_BY"] = $USER->GetID();
        if(isset($settings['PROPERTY_VALUES'])) unset($settings['PROPERTY_VALUES']);
        $res = $this->el->Update($itemId, $settings);
        return $res;
    }

        /**
     *  Добавляем элементу свойство
     *
     * @param int $itemId
     * @param array $ArPropertyValues
     * @return void
     */
    public static function addPropertyValue(int $itemId, array $ArPropertyValues = [])
    {
        if($ArPropertyValues != [])
            CIBlockElement::SetPropertyValuesEx($itemId, AnkornCatalogPropApdater::ibid, $ArPropertyValues);
    }

    /**
     * Получаем массив ID разделов товара
     *
     * @param int $id
     * @return array
     */
    public static function ElementGroupIDs(int $id): array
    {
        $elementGroups = [];
        $obElementGroups = CIBlockElement::GetElementGroups($id, true);
        while ($section = $obElementGroups->Fetch()) {
            $elementGroups[] = $section['ID'];
        }
        return $elementGroups;
    }

    /**
     * Получаем массив ID дочерних элементов по id анкоров
     *
     * @param array $arAncore
     * @return array
     */
    public static function arIdByArAncore(array $arAncore): array
    {
        if($arAncore == []) return [];
        $arIDs = [];
        $obRes = CIBlockElement::GetList(
            Array(),
            array('IBLOCK_ID'=>AnkornCatalogPropApdater::ibid,"ACTIVE"=>"Y", 'CODE'=>$arAncore),
            false,
            false,
            ['IBLOCK_ID','ID','NAME']
        );
        while ($res = $obRes->Fetch()){
            $arIDs[] = $res['ID'];
        }
        return $arIDs;
    }

    /**
     * Возвращает список анкоров дочерних элементов.
     *
     * @param string $html
     * @return array
     */
    public static function ancorList(string $html):array
    {
        $result = [];
        $html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $html;
        $dom = new \DOMDocument();
        @$dom->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING);
        $xpath = new \DOMXPath($dom);
        // Находим все ссылки
        $links = $xpath->query('//a');
        foreach ($links as $link) {
            $segments = explode("/", $link->getAttribute('href'));
            array_pop($segments);
            $result[] = array_pop($segments);
        }
        return $result;
    }

    /**
     * Получаем список дочерних элементов по их связи с родителем.
     *
     * @param int $parentID
     * @return array
     */
    public static function arIDsChildItemByParentID(int $parentID): array
    {
        $arIDs = [];
        $obRes = CIBlockElement::GetList(
            Array(),
            array('IBLOCK_ID'=>AnkornCatalogPropApdater::ibid, 'PROPERTY_PARENT_ITEM.ID'=>$parentID),
            false,
            false,
            ['IBLOCK_ID','ID','NAME']
        );
        while ($res = $obRes->Fetch()){
            $arIDs[] = $res['ID'];
        }
        return $arIDs;
    }

    public static function SetElementSection(int $itemId, array $arSectionIds)
    {
        $elementGroups = $arSectionIds['elementGroups'];
        $mainSection = $arSectionIds['mainSection'];

        echo '<pre id="inspect" class="ins_1" style="margin: 40px 0px;">';
        var_dump(['$itemId'=>$itemId, '$elementGroups'=>$elementGroups, '$mainSection'=>$mainSection]);
        echo '</pre>';

        CIBlockElement::SetElementSection($itemId, $elementGroups,sectionId:$mainSection);
    }



}