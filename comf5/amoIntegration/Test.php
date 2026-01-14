<?php

use comf5\amoIntegration\Constants\Amo;

require __DIR__ . "/handle.php";

//print_r('test');
//logger($_GET);
$amo = \Ufee\AmoV4\ApiClient::setInstance(config('amo.kkovach'));
$amo->oauth->setStorageFiles(STORAGE . '/Oauth');

//$lead = $amo->leads()->find(24356787);
//$lead->responsible_user_id = \comf5\amoIntegration\Constants\Constants::RESPONSIBLE_USER;
//$lead->save();
