<?php
require __DIR__ . "/handle.php";

logger($_GET);

$amo = Ufee\AmoV4\ApiClient::setInstance(config('amo.kkovach'));
try {
    $amo->oauth->setStorageFiles(STORAGE . '/Oauth');
} catch (Exception $e) {
    logger($e);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['code']) && !empty($_GET['client_id']) && $_GET['client_id'] == config('amo.kkovach')['client_id']) {
    try {
        $oauth = $amo->oauth->fetchToken($_GET['code']);
        print_r("Обновились токены");
        logger("Обновились токены " . print_r($oauth, 1));
    } catch (\Throwable $th) {
        print_r("Ошибка");
        logger($th->getMessage());
    }
    die();
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $redirect_url = "https://www.amocrm.ru/oauth?client_id=" . config('amo.kkovach')['client_id'];
    echo "<a href='" . $redirect_url . "' target='_blank'>Авторизоваться</a>";
    die();
}


