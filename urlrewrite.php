<?php
$arUrlRewrite=array (
    0 =>
        array (
            'CONDITION' => '#^/services/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/services/index.php',
            'SORT' => 100,
        ),
    6 =>
        array (
            'CONDITION' => '#^/product/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/product/index.php',
            'SORT' => 100,
        ),
    8 =>
        array (
            'CONDITION' => '#^/industries/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/industries/index.php',
            'SORT' => 100,
        ),
    9 =>
        array (
            'CONDITION' => '#^/articles/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/articles/index.php',
            'SORT' => 100,
        ),
      10 =>
      array (
        'CONDITION' => '#^/bitrix/services/ymarket/#',
        'RULE' => '',
        'ID' => '',
        'PATH' => '/bitrix/services/ymarket/index.php',
        'SORT' => 100,
      ),
      11 =>
      array (
        'CONDITION' => '#^/news/#',
        'RULE' => '',
        'ID' => 'bitrix:news',
        'PATH' => '/news/index.php',
        'SORT' => 100,
      ),
    13 =>
        array (
            'CONDITION' => '#^/personal/order/#',
            'RULE' => '',
            'ID' => 'bitrix:sale.personal.order',
            'PATH' => '/personal/order/index.php',
            'SORT' => 100,
        ),
    14 =>
        array (
            'CONDITION' => '#^/personal/#',
            'RULE' => '',
            'ID' => 'bitrix:sale.personal.section',
            'PATH' => '/personal/index.php',
            'SORT' => 100,
        ),
    15 =>
        array (
            'CONDITION' => '#^/store/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog.store',
            'PATH' => '/store/index.php',
            'SORT' => 100,
        ),
/*
    16 =>
    array(
        'CONDITION' => '#^/catalog/([^/]+)/([^/]+)/([^/]+)/([^/]+)/([^/]+)/?.*#',
        'RULE' => 'FIRST_LEVEL_SECTION_CODE=$1&SECTION_CODE=$5',
        'ID' => 'bitrix:catalog',
        'PATH' => '/catalog/index.php',
    ),
    17 =>
    array(
        'CONDITION' => '#^/catalog/([^/]+)/([^/]+)/([^/]+)/([^/]+)/?.*#',
        'RULE' => 'FIRST_LEVEL_SECTION_CODE=$1&SECTION_CODE=$4',
        'ID' => 'bitrix:catalog',
        'PATH' => '/catalog/index.php',
    ),
    18 =>
    array(
        'CONDITION' => '#^/catalog/([^/]+)/([^/]+)/([^/]+)/?.*#',
        'RULE' => 'FIRST_LEVEL_SECTION_CODE=$1&SECTION_CODE=$3',
        'ID' => 'bitrix:catalog',
        'PATH' => '/catalog/index.php',
    ),
*/
    19 =>
    array(
        'CONDITION' => '#^/catalog/([^/]+)/([^/]+)/.*#',
        'RULE' => 'FIRST_LEVEL_SECTION_CODE=$1',
        'ID' => 'bitrix:catalog',
        'PATH' => '/catalog/index.php',
    ),
    20 =>
    array(
        'CONDITION' => '#^/catalog/([^/]+)/.*#',
        'RULE' => 'SECTION_CODE=$1',
        'ID' => 'bitrix:catalog',
        'PATH' => '/catalog/index.php',
    ),
    50 =>
    array (
        'CONDITION' => '#^/catalog/#',
        'RULE' => '',
        'ID' => 'bitrix:catalog',
        'PATH' => '/catalog/index.php',
        'SORT' => 100,
    ),


  1000 => // такое только в конец
  array (
    'CONDITION' => '#^/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php?error=404',
    'SORT' => 100,
  ),

);
