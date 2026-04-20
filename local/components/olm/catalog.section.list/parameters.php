<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    'PARAMETERS' => array(
        'IBLOCK_TYPE' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Тип инфоблока',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
        'IBLOCK_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Инфоблок',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
        'SECTION_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'ID раздела',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
        'SECTION_CODE' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Код раздела',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
        'MAX_DEPTH' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Максимальная глубина',
            'TYPE' => 'STRING',
            'DEFAULT' => '0',
        ),
        'CACHE_FILTER' => array(
            'PARENT' => 'CACHE_SETTINGS',
            'NAME' => 'Кешировать при установленном фильтре',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
        ),
        'CACHE_TIME' => array(
            'PARENT' => 'CACHE_SETTINGS',
            'NAME' => 'Время кеширования (сек.)',
            'TYPE' => 'STRING',
            'DEFAULT' => 36000000,
        ),
        'CACHE_GROUPS' => array(
            'PARENT' => 'CACHE_SETTINGS',
            'NAME' => 'Учитывать права доступа',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ),
        'DISPLAY_EMPTY' => array(
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => 'Отображать пустые разделы',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ),
        'SHOW_SECTIONS_WITH_ELEMENTS_ONLY' => array(
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => 'Показывать только разделы с элементами',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
        ),
        'COUNT_ELEMENTS' => array(
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => 'Показывать количество элементов',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ),
        'TOP_DEPTH' => array(
            'PARENT' => 'VISUAL',
            'NAME' => 'Максимальная отображаемая глубина (0 - без ограничений)',
            'TYPE' => 'STRING',
            'DEFAULT' => '0',
        ),
        'SECTION_URL' => array(
            'PARENT' => 'URL_TEMPLATES',
            'NAME' => 'URL, ведущий на страницу с содержимым раздела',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
        'VIEW_MODE' => array(
            'PARENT' => 'VISUAL',
            'NAME' => 'Вид списка подразделов',
            'TYPE' => 'LIST',
            'VALUES' => array(
                'LIST' => 'Многоуровневый список',
                'LINE' => 'В одну линию',
                'TEXT' => 'Текст',
            ),
            'DEFAULT' => 'LIST',
            'ADDITIONAL_VALUES' => 'Y',
        ),
        'SHOW_PARENT_NAME' => array(
            'PARENT' => 'VISUAL',
            'NAME' => 'Показывать название раздела',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ),
        'HIDE_SECTION_NAME' => array(
            'PARENT' => 'VISUAL',
            'NAME' => 'Не показывать название подразделов',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
        ),
    ),
);