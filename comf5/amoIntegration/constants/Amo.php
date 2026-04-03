<?php

namespace comf5\amoIntegration\Constants;

class Amo
{
    const PIPELINE = 9424622;
    const STATUS = 75450662;
    const RESPONSIBLE_USER = 11065758;
    const LEAD_CF = [
        "utm_content" => 766611,
        "utm_medium" => 766613,
        "utm_campaign" => 766615,
        "utm_source" => 766617,
        "utm_term" => 766619,
        "utm_referrer" => 766621,

        "roistat" => 766623,
        "referrer" => 766625,
        "openstat_service" => 766627,
        "openstat_campaign" => 766629,
        "openstat_ad" => 766631,
        "openstat_source" => 766633,
        "from" => 766635,
        "gclientid" => 766637,
        "_ym_uid" => 766639,
        "_ym_counter" => 766641,
        "gclid" => 766643,
        "yclid" => 766645,
        "fbclid" => 766647,

        "comm" => 910253,
        "form" => 910259,
        "address" => 910289,
        "orderNum" => 910281,
        "deliveryType" => 910285,
        "model" => 899691,
        "file_link" => 914115
    ];

    const COMPANY_CF = [
        "address" => 766609,
        "inn" => 910277,
        "kpp" => 910279,
    ];

    const FORM_NAMES = [
        "callForm" => [
            "lead" => "Заявка с сайта (заказ звонка)",
            "form" => "Заказ звонка"
        ],
        "engineer" => [
            "lead" => "Заявка с сайта (звонок инженера)",
            "form" => "Звонок инженера"
        ],
        "callPrice" => [
            "lead" => "Заявка с сайта (заказ)",
            "form" => "Заказ"
        ],
        "podborpriibor" => [
            "lead" => "Заявка с сайта (подбор прибора)",
            "form" => "Подбор прибора"
        ],
        "form" => [
            "lead" => "Контакты",
            "form" => "Контакты"
        ],
    ];
}