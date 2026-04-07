<?php

namespace local\util\ankornOrder;

use Bitrix\Main\Context;

class dataValidator
{
    function __construct($errorExist = false, $errorMessages = [])
    {}
    public function validate(
        $userName = '',
        $email = '',
        $phone = '',
        $companyDetails = null,
        $ArchiveFile = null,)
    {
        $this->validateName($userName);
        $this->validateEmail($email);
        $this->validatePhone($phone);
        $this->validateCompanyDetails($companyDetails);
        $this->validateArchiveFile($ArchiveFile);
        $this->validateApprov();

        if($this->errorExist){
            echo json_encode(
                [
                    'ERROR' => $this->errorMessages,
                    'errorExist' => $this->errorExist,
                ]
            );
            die();
        }
    }

    function validateApprov()
    {
        $approv = Context::getCurrent()->getRequest()->getPost('APPROV');
        if($approv != 'true')
            $this->errorMessages['approv'] = 'Подтвердите согласие на обработку данных';
    }

    function validatePhone(string $phone)
    {
        if (empty($phone)) {

            $this->errorMessages['phone'] = 'Телефон обязателен для заполнения';
            $this->errorExist = true;
        } elseif (!preg_match('/^[0-9+\-\s\(\)]+$/', $phone)) {
            $this->errorMessages['phone'] =  'Телефон содержит недопустимые символы';
            $this->errorExist = true;
        }
        return false;
    }

    function validateEmail(string $email)
    {
        if (empty($email)) {
            $this->errorMessages['email'] =  'Email обязателен для заполнения';
            $this->errorExist = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorMessages['email'] =  'Введите корректный email адрес';
            $this->errorExist = true;
        }
        return false;
    }

    function validateName(string $userName)
    {
        if (empty($userName)) {
            $this->errorMessages['name'] =  'Имя обязательно для заполнения';
            $this->errorExist = true;
        }
        return false;
    }
    function validateCompanyDetails($companyDetails){
        $allowedExtensions = ['pdf', 'jpg', 'png', 'doc', 'docx', 'xls', 'xlsx', 'rtf', 'odt'];
        $allowedMimeTypes = [
            'application/pdf',
            'image/jpeg', 'image/png',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/rtf',
            'application/vnd.oasis.opendocument.text'
        ];

        if (isset($companyDetails)) {
            $extension = strtolower(pathinfo($companyDetails['name'], PATHINFO_EXTENSION));

            // Проверка расширения
            if (!in_array($extension, $allowedExtensions)) {
                $this->errorExist = true;
                $this->errorMessages[] =  'Недопустимое расширение файла: '.$companyDetails['name'];
            }

            // Проверка MIME-типа (используем finfo для надежности)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $companyDetails['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mimeType, $allowedMimeTypes)) {
                $this->errorExist = true;
                $this->errorMessages[] =  'Недопустимый MIME-тип файла: '.$companyDetails['name'];
            }
        }
    }
    function validateArchiveFile($ArchiveFile){
        $allowedExtensions = ['zip', 'rar'];
        $allowedMimeTypes = [
            'application/zip',
            'application/x-zip-compressed',
            'application/x-rar',
            'application/x-rar-compressed',
            'application/vnd.rar',
        ];

        if (isset($ArchiveFile)) {
            $extension = strtolower(pathinfo($ArchiveFile['name'], PATHINFO_EXTENSION));

            // Проверка расширения
            if (!in_array($extension, $allowedExtensions)) {
                $this->errorExist = true;
                $this->errorMessages[] =  'Недопустимое расширение файла: '.$ArchiveFile['name'];
            }

            // Проверка MIME-типа (используем finfo для надежности)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $ArchiveFile['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mimeType, $allowedMimeTypes)) {
                $this->errorExist = true;
                $this->errorMessages[] =  'Недопустимый MIME-тип файла: '.$ArchiveFile['name'];
            }
        }
    }
}