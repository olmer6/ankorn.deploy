<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Application;

class OlmCatalogSectionListComponent extends CBitrixComponent
{
    /**
     * Подготовка параметров компонента
     */
    public function onPrepareComponentParams($arParams)
    {
        $arParams = parent::onPrepareComponentParams($arParams);

        // Приведение типов
        $arParams['IBLOCK_ID'] = (int)$arParams['IBLOCK_ID'];
        $arParams['SECTION_ID'] = (int)$arParams['SECTION_ID'];
        $arParams['MAX_DEPTH'] = (int)$arParams['MAX_DEPTH'];
        $arParams['TOP_DEPTH'] = (int)$arParams['TOP_DEPTH'];
        $arParams['CACHE_TIME'] = (int)$arParams['CACHE_TIME'];

        // Установка значений по умолчанию
        if ($arParams['CACHE_TIME'] <= 0) {
            $arParams['CACHE_TIME'] = 36000000;
        }

        if (!isset($arParams['CACHE_GROUPS'])) {
            $arParams['CACHE_GROUPS'] = 'Y';
        }

        if (!isset($arParams['DISPLAY_EMPTY'])) {
            $arParams['DISPLAY_EMPTY'] = 'Y';
        }

        return $arParams;
    }

    /**
     * Получение ID раздела по коду
     */
    private function getSectionIdByCode($sectionCode, $iblockId)
    {
        if (empty($sectionCode)) {
            return 0;
        }

        $dbSection = CIBlockSection::GetList(
            array(),
            array(
                '=CODE' => $sectionCode,
                'IBLOCK_ID' => $iblockId,
                'ACTIVE' => 'Y'
            ),
            false,
            array('ID')
        );

        if ($section = $dbSection->Fetch()) {
            return (int)$section['ID'];
        }

        return 0;
    }

    /**
     * Получение всех дочерних разделов (оптимизированная версия)
     */
    private function getNestedSectionsOptimized($sectionId, $iblockId, $maxDepth = 0)
    {
        $result = array();

        // Определяем начальную глубину
        $startDepth = 1;
        if ($sectionId > 0) {
            $dbParent = CIBlockSection::GetByID($sectionId);
            if ($parentSection = $dbParent->Fetch()) {
                $startDepth = $parentSection['DEPTH_LEVEL'] + 1;
            }
        }

        // Формируем фильтр
        $filter = array(
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y',
            'GLOBAL_ACTIVE' => 'Y',
        );

        // Если задан параметр - показывать только разделы с элементами
        if ($this->arParams['SHOW_SECTIONS_WITH_ELEMENTS_ONLY'] === 'Y') {
            $filter['ELEMENT_SUBSECTIONS'] = 'N';
            $filter['CNT_ACTIVE'] = 'Y';
        }

        if ($sectionId > 0) {
            $filter['SECTION_ID'] = $sectionId;
        }

        // Получаем все разделы с сортировкой по левому полю
        $dbSections = CIBlockSection::GetList(
            array('LEFT_MARGIN' => 'ASC'),
            $filter,
            $this->arParams['COUNT_ELEMENTS'] === 'Y',
            array(
                'ID',
                'NAME',
                'CODE',
                'SECTION_PAGE_URL',
                'DEPTH_LEVEL',
                'IBLOCK_SECTION_ID',
                'SORT',
                'LEFT_MARGIN',
                'RIGHT_MARGIN',
                'ELEMENT_CNT',
                'PICTURE',
                'DESCRIPTION',
                'DESCRIPTION_TYPE',
                'UF_*'
            )
        );

        $isParentFound = false;

        while ($section = $dbSections->GetNext()) {





            // Если мы ищем с определенного раздела, пропускаем все до него
            if ($sectionId > 0 && $section['ID'] == $sectionId) {
                $isParentFound = true;
                continue;
            }

            // Если родительский раздел найден, начинаем сбор
            if ($sectionId == 0 || $isParentFound) {
                // Проверяем глубину
                if ($maxDepth > 0 && $section['DEPTH_LEVEL'] > $maxDepth + $startDepth - 1) {
                    continue;
                }

                // Если дошли до раздела того же уровня, что и родительский, но другого родителя - выходим
                if ($sectionId > 0 && $section['DEPTH_LEVEL'] == $startDepth - 1 && $section['ID'] != $sectionId) {
                    break;
                }

                // Формируем URL раздела
                $sectionUrl = $section['SECTION_PAGE_URL'];
                if (!empty($this->arParams['SECTION_URL'])) {
                    $sectionUrl = str_replace(
                        array('#SECTION_ID#', '#SECTION_CODE#'),
                        array($section['ID'], $section['CODE']),
                        $this->arParams['SECTION_URL']
                    );
                }

                $result[] = array(
                    'ID' => $section['ID'],
                    'NAME' => $section['NAME'],
                    'CODE' => $section['CODE'],
                    'URL' => $sectionUrl,
                    'DEPTH_LEVEL' => $section['DEPTH_LEVEL'],
                    'SORT' => $section['SORT'],
                    'PARENT_ID' => $section['IBLOCK_SECTION_ID'],
                    'LEFT_MARGIN' => $section['LEFT_MARGIN'],
                    'RIGHT_MARGIN' => $section['RIGHT_MARGIN'],
                    'ELEMENT_CNT' => $section['ELEMENT_CNT'] ?? 0,
                    'PICTURE' => $section['PICTURE'],
                    'DESCRIPTION' => $section['DESCRIPTION'],
                    'DESCRIPTION_TYPE' => $section['DESCRIPTION_TYPE'],
                    'RELATIVE_DEPTH_LEVEL' => $section['DEPTH_LEVEL'] - $startDepth + 1,
                );
            }
        }

        return $result;
    }

    /**
     * Получение информации о родительском разделе
     */
    private function getParentSectionInfo($sectionId)
    {
        if ($sectionId <= 0) {
            return array(
                'ID' => 0,
                'NAME' => '',
                'URL' => '',
                'DEPTH_LEVEL' => 0,
            );
        }

        $dbSection = CIBlockSection::GetByID($sectionId);
        if ($section = $dbSection->GetNext()) {
            $sectionUrl = $section['SECTION_PAGE_URL'];
            if (!empty($this->arParams['SECTION_URL'])) {
                $sectionUrl = str_replace(
                    array('#SECTION_ID#', '#SECTION_CODE#'),
                    array($section['ID'], $section['CODE']),
                    $this->arParams['SECTION_URL']
                );
            }

            return array(
                'ID' => $section['ID'],
                'NAME' => $section['NAME'],
                'CODE' => $section['CODE'],
                'URL' => $sectionUrl,
                'DEPTH_LEVEL' => $section['DEPTH_LEVEL'],
                'DESCRIPTION' => $section['DESCRIPTION'],
                'DESCRIPTION_TYPE' => $section['DESCRIPTION_TYPE'],
                'PICTURE' => $section['PICTURE'],
            );
        }

        return array();
    }

    /**
     * Основная логика компонента
     */
    public function executeComponent()
    {
        try {
            // Проверяем подключение модуля
            if (!Loader::includeModule('iblock')) {
                throw new Exception('Модуль "Инфоблоки" не установлен');
            }

            // Определяем ID раздела
            $sectionId = $this->arParams['SECTION_ID'];
            if (empty($sectionId) && !empty($this->arParams['SECTION_CODE'])) {
                $sectionId = $this->getSectionIdByCode(
                    $this->arParams['SECTION_CODE'],
                    $this->arParams['IBLOCK_ID']
                );
            }

            // Проверяем инфоблок
            if (empty($this->arParams['IBLOCK_ID'])) {
                throw new Exception('Не указан инфоблок');
            }

            // Проверяем кеш
            if ($this->startResultCache()) {
                // Получаем родительский раздел
                $this->arResult['PARENT_SECTION'] = $this->getParentSectionInfo($sectionId);


                // Получаем все дочерние разделы
                $this->arResult['SECTIONS'] = $this->getNestedSectionsOptimized(
                    $sectionId,
                    $this->arParams['IBLOCK_ID'],
                    $this->arParams['MAX_DEPTH']
                );

                // Применяем ограничение по глубине отображения
                if ($this->arParams['TOP_DEPTH'] > 0) {
                    $this->arResult['SECTIONS'] = array_filter(
                        $this->arResult['SECTIONS'],
                        function($section) {
                            return $section['RELATIVE_DEPTH_LEVEL'] <= $this->arParams['TOP_DEPTH'];
                        }
                    );
                }

                // Фильтруем пустые разделы если нужно
                if ($this->arParams['DISPLAY_EMPTY'] === 'N') {
                    $this->arResult['SECTIONS'] = array_filter(
                        $this->arResult['SECTIONS'],
                        function($section) {
                            return !empty($section['ELEMENT_CNT']) ||
                                !empty($section['DESCRIPTION']) ||
                                !empty($section['PICTURE']);
                        }
                    );
                }

                $this->setResultCacheKeys(array(
                    'PARENT_SECTION',
                    'SECTIONS',
                ));

                $this->includeComponentTemplate();
            }

        } catch (Exception $e) {
            $this->abortResultCache();
            ShowError($e->getMessage());
        }
    }
}