<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    'NAME' => 'Древовидный список разделов каталога',
    'DESCRIPTION' => 'Отображает все дочерние разделы рекурсивно в виде дерева',
    'ICON' => '/images/icon.gif',
    'CACHE_PATH' => 'Y',
    'SORT' => 10,
    'PATH' => array(
        'ID' => 'olm',
        'NAME' => 'OLM Компоненты',
        'CHILD' => array(
            'ID' => 'catalog',
            'NAME' => 'Каталог',
            'SORT' => 30,
        ),
    ),
);