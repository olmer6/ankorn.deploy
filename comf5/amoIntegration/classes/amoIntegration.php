<?php

namespace comf5\amoIntegration\Classes;

use comf5\amoIntegration\Constants\Amo;

class amoIntegration
{
    public function start($data)
    {
        logger(["start", $data]);

        $amo = \Ufee\AmoV4\ApiClient::setInstance(config('amo.kkovach'));
        $amo->oauth->setStorageFiles(STORAGE . '/Oauth');

        $isOrder = isset($data["order"]);
        $contact = null;

        if ($isOrder && isset($data["order"]["PHONE"])) {
            $contact = $this->contactByPhone($data["order"]["PHONE"], $amo);
        }
        if (!$isOrder && isset($data["form"]["PHONE"])) {
            $contact = $this->contactByPhone($data["form"]["PHONE"], $amo);
        }

        if (!$contact && $isOrder && isset($data["order"]["EMAIL"])) {
            $contact = $this->contactByEmail($data["order"]["EMAIL"], $amo);
        }
        if (!$contact && !$isOrder && isset($data["form"]["EMAIL"])) {
            $contact = $this->contactByEmail($data["form"]["EMAIL"], $amo);
        }

        if (!$contact) {
            $contact = $amo->contacts()->create();
            if (isset($data["form"]["AUTHOR"])) {
                $contact->name = $data["form"]["AUTHOR"];
            }
            if (isset($data["order"]["CONTACT_PERSON"])) {
                $contact->name = $data["order"]["CONTACT_PERSON"];
            }
            if (isset($data["form"]["AUTHOR_EMAIL"])) {
                $contact->cf("Email")->setValue($data["form"]["AUTHOR_EMAIL"]);
            }
            if (isset($data["order"]["EMAIL"])) {
                $contact->cf("Email")->setValue($data["order"]["EMAIL"]);
            }
            if (isset($data["form"]["PHONE"])) {
                $contact->cf("Телефон")->setValue($data["form"]["PHONE"]);
            }
            if (isset($data["order"]["PHONE"])) {
                $contact->cf("Телефон")->setValue($data["order"]["PHONE"]);
            }
            $contact->save();
            logger("new contact " . $contact->id);
        }

        $lead = $amo->leads()->create();
        $lead->name = $isOrder ? "Заказ с сайта" : Amo::FORM_NAMES[$data["form"]["FORM_NAME"]]['lead'];
        $lead->pipeline_id = Amo::PIPELINE;
        $lead->status_id = Amo::STATUS;

        if (isset($data["order"]["price"])) {
            $lead->price = round($data["order"]["price"]);
        }

        if (isset($data["form"]["TEXT"])) {
            $lead->cf()->byId(Amo::LEAD_CF["comm"])->setValue($data["form"]["TEXT"]);
        }
        if (isset($data["order"]["comment"])) {
            $lead->cf()->byId(Amo::LEAD_CF["comm"])->setValue($data["order"]["comment"]);
        }
        if (isset($data["form"]["FORM_NAME"])) {
            $lead->cf()->byId(Amo::LEAD_CF["form"])->setValue(Amo::FORM_NAMES[$data["form"]["FORM_NAME"]]['form']);
        }

        if (isset($data["order"]["id"])) {
            $lead->cf()->byId(Amo::LEAD_CF["orderNum"])->setValue("" . $data["order"]["id"]);
        }
        if (isset($data["order"]["delivery"])) {
            $lead->cf()->byId(Amo::LEAD_CF["deliveryType"])->setValue($data["order"]["delivery"]);
        }
        if (isset($data["order"]["ADDRESS"])) {
            $lead->cf()->byId(Amo::LEAD_CF["address"])->setValue($data["order"]["ADDRESS"]);
        }

        if (isset($data["cookie"]["utm_content"])){
            $lead->cf()->byId(Amo::LEAD_CF["utm_content"])->setValue($data["cookie"]["utm_content"]);
        }
        if (isset($data["cookie"]["utm_medium"])) {
            $lead->cf()->byId(Amo::LEAD_CF["utm_medium"])->setValue($data["cookie"]["utm_medium"]);
        }
        if (isset($data["cookie"]["utm_campaign"])) {
            $lead->cf()->byId(Amo::LEAD_CF["utm_campaign"])->setValue($data["cookie"]["utm_campaign"]);
        }
        if (isset($data["cookie"]["utm_source"])) {
            $lead->cf()->byId(Amo::LEAD_CF["utm_source"])->setValue($data["cookie"]["utm_source"]);
        }
        if (isset($data["cookie"]["utm_term"])) {
            $lead->cf()->byId(Amo::LEAD_CF["utm_term"])->setValue($data["cookie"]["utm_term"]);
        }
        if (isset($data["cookie"]["utm_referrer"])) {
            $lead->cf()->byId(Amo::LEAD_CF["utm_referrer"])->setValue($data["cookie"]["utm_referrer"]);
        }
        if (isset($data["cookie"]["roistat"])) {
            $lead->cf()->byId(Amo::LEAD_CF["roistat"])->setValue($data["cookie"]["roistat"]);
        }
        if (isset($data["cookie"]["referrer"])) {
            $lead->cf()->byId(Amo::LEAD_CF["referrer"])->setValue($data["cookie"]["referrer"]);
        }
        if (isset($data["cookie"]["openstat_service"])) {
            $lead->cf()->byId(Amo::LEAD_CF["openstat_service"])->setValue($data["cookie"]["openstat_service"]);
        }
        if (isset($data["cookie"]["openstat_campaign"])) {
            $lead->cf()->byId(Amo::LEAD_CF["openstat_campaign"])->setValue($data["cookie"]["openstat_campaign"]);
        }
        if (isset($data["cookie"]["openstat_ad"])) {
            $lead->cf()->byId(Amo::LEAD_CF["openstat_ad"])->setValue($data["cookie"]["openstat_campaign"]);
        }
        if (isset($data["cookie"]["openstat_source"])) {
            $lead->cf()->byId(Amo::LEAD_CF["openstat_source"])->setValue($data["cookie"]["openstat_campaign"]);
        }
        if (isset($data["cookie"]["from"])) {
            $lead->cf()->byId(Amo::LEAD_CF["from"])->setValue($data["cookie"]["from"]);
        }
        if (isset($data["cookie"]["gclientid"])) {
            $lead->cf()->byId(Amo::LEAD_CF["gclientid"])->setValue($data["cookie"]["gclientid"]);
        }
        if (isset($data["cookie"]["_ym_uid"])) {
            $lead->cf()->byId(Amo::LEAD_CF["_ym_uid"])->setValue($data["cookie"]["_ym_uid"]);
        }
        if (isset($data["cookie"]["_ym_counter"])) {
            $lead->cf()->byId(Amo::LEAD_CF["_ym_counter"])->setValue($data["cookie"]["_ym_counter"]);
        }
        if (isset($data["cookie"]["gclid"])) {
            $lead->cf()->byId(Amo::LEAD_CF["gclid"])->setValue($data["cookie"]["gclid"]);
        }
        if (isset($data["cookie"]["yclid"])) {
            $lead->cf()->byId(Amo::LEAD_CF["yclid"])->setValue($data["cookie"]["yclid"]);
        }
        if (isset($data["cookie"]["fbclid"])) {
            $lead->cf()->byId(Amo::LEAD_CF["fbclid"])->setValue($data["cookie"]["fbclid"]);
        }
        if (isset($data['COMPANY_DETAILS_FILE_URL'])) {
            $relativePath = strstr($data['COMPANY_DETAILS_FILE_URL'], 'upload/');
            $lead->cf()->byId(Amo::LEAD_CF["file_link"])->setValue('https://' . $_SERVER['HTTP_HOST'] . '/' . $relativePath);
        }

        $lead->save();
        logger("new lead  " . $lead->id);

        $lead->attachContact($contact);

        if (isset($data["form"]["PRODUCT_NAME"])) {
            $note = $lead->createNote();
            $note->params = [
                "text" => $data["form"]["PRODUCT_NAME"]
            ];
            $note->save();
            logger("new note  " . $note->id);

            $lead->cf()->byId(Amo::LEAD_CF["model"])->setValue($data["form"]["PRODUCT_NAME"]);
        }

        if (isset($data["products"])) {
            $noteText = "";
            $i = 1;

            foreach ($data["products"] as $product) {
                $noteText .= $i . ". " . trim($product["NAME"]) . ", цена: " . (int)$product["PRICE"] . ", кол-во: " . $product["QUANTITY"] ."\n";
                $i += 1;
            }
            $note = $lead->createNote();
            $note->params = [
                "text" => $noteText
            ];
            $note->save();
            logger("new note  " . $note->id);
            $lead->cf()->byId(Amo::LEAD_CF["model"])->setValue($noteText);
        }

        if (isset($data["form"]["COMPANY"]) || $isOrder) {
            if (!$company = $contact->company()) {
                logger("new company");
                $company = $amo->companies()->create();
            }
            if (isset($data["order"]["CONTACT_PERSON"])) {
                $company->name = $data["order"]["CONTACT_PERSON"];
            }
            if (isset($data["form"]["COMPANY"])) {
                $company->name = $data["form"]["COMPANY"];
            }
            if (isset($data["form"]["COMPANY_NAME"])) {
                $company->name = $data["form"]["COMPANY_NAME"];
            }

            if (isset($data["form"]["AUTHOR_EMAIL"])) {
                $company->cf("Email")->setValue($data["form"]["AUTHOR_EMAIL"]);
            }
            if (isset($data["order"]["EMAIL"])) {
                $company->cf("Email")->setValue($data["order"]["EMAIL"]);
            }
            if (isset($data["form"]["PHONE"])) {
                $company->cf("Телефон")->setValue($data["form"]["PHONE"]);
            }
            if (isset($data["order"]["PHONE"])) {
                $company->cf("Телефон")->setValue($data["order"]["PHONE"]);
            }

            $company->save();
            logger("company " . $company->id);
            $lead->attachCompany($company);
            $contact->attachCompany($company);
            $company->responsible_user_id = Amo::RESPONSIBLE_USER;
            $company->save();
        }

        $lead->responsible_user_id = Amo::RESPONSIBLE_USER;
        $lead->save();

        $contact->responsible_user_id = Amo::RESPONSIBLE_USER;
        $contact->save();

        logger("end");
        return true;
    }

    private function contactByPhone($phone, $amo)
    {
        if (!$this->checkPhoneNumber($phone)) return false;
        $contactCollection = $amo->contacts()->searchByPhone($phone);
        $contact = $contactCollection->first();
        if (!$contact) return false;
        logger("contact by phone " . $contact->id);
        return $contact;
    }

    private function contactByEmail($email, $amo)
    {
        if (!$this->checkEmail($email)) return false;
        $contactCollection = $amo->contacts()->searchByEmail($email);
        $contact = $contactCollection->first();
        if (!$contact) return false;
        logger("contact by email " . $contact->id);
        return $contact;
    }

    private function checkPhoneNumber($input)
    {
        if (strlen(preg_replace('/\D/', '', $input)) > 6) {
            return true;
        }
        return false;
    }

    private function checkEmail($input)
    {
        return filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}