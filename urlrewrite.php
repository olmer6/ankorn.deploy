<?php
$arUrlRewrite=array (
  19 => 
  array (
    'CONDITION' => '#^/catalog/([^/]+)/([^/]+)/.*#',
    'RULE' => 'FIRST_LEVEL_SECTION_CODE=$1',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
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
  20 => 
  array (
    'CONDITION' => '#^/catalog/([^/]+)/.*#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  1020 =>
  array (
    'CONDITION' => '#^/yastore.checkout/#',
    'RULE' => '',
    'ID' => 'yastore:checkout',
    'PATH' => '/yastore.checkout/index.php',
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
  8 => 
  array (
    'CONDITION' => '#^/industries/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/industries/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/services/index.php',
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

  1009 =>
    array (
        'CONDITION' => '#^/articles/([^/]+)/.*#',
        'RULE' => 'SECTION_CODE=$1',
        'ID' => 'bitrix:news',
        'PATH' => '/articles/index.php',
        'SORT' => 100,
    ),

  1010 =>
  array (
    'CONDITION' => '#^/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/articles/index.php',
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
  50 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
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
  11 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
  1000 => 
  array (
    'CONDITION' => '#^/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php?error=404',
    'SORT' => 100,
  ),
);
