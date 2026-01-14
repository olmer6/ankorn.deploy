<?php
if (!empty($_POST['checkFormAuth'])) {
    if ($_POST["checkFormAuth"] != "") {
        die();
    }
}

if (!function_exists('custom_mail') && COption::GetOptionString("webprostor.smtp", "USE_MODULE") == "Y")
{
    function custom_mail($to, $subject, $message, $additional_headers='', $additional_parameters='')
    {
        if(CModule::IncludeModule("webprostor.smtp"))
        {
            $smtp = new CWebprostorSmtp("s1");
            $result = $smtp->SendMail($to, $subject, $message, $additional_headers, $additional_parameters);

            if($result)
                return true;
            else
                return false;
        }
    }
}

//COMF5 BEGIN
if(file_exists($_SERVER["DOCUMENT_ROOT"] .'/comf5/amoIntegration/FormHandler.php')){
    AddEventHandler('main', 'OnBeforeEventAdd', 'comf5_OnBeforeEventAdd');
    AddEventHandler("sale", "OnSaleOrderSaved", "comf5_OnSaleOrderSaved");
    include $_SERVER["DOCUMENT_ROOT"] .'/comf5/amoIntegration/FormHandler.php';
}
//COMF5 END