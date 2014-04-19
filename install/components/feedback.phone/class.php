<?php


class FeedbackPhoneComponent extends \EzCommon\EzComponent {

    public function executeComponent()
    {
        global $APPLICATION, $USER;

        if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $this->arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
        {
            $this->arResult["ERROR_MESSAGE"] = array();
            if(check_bitrix_sessid())
            {
                if(empty($this->arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $this->arParams["REQUIRED_FIELDS"]))
                {
                    if((empty($this->arParams["REQUIRED_FIELDS"]) || in_array("NAME", $this->arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_name"]) <= 1)
                        $this->arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_NAME");
                    if((empty($this->arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $this->arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_phone"]) <= 1)
                        $this->arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_PHONE");
                    if((empty($this->arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $this->arParams["REQUIRED_FIELDS"])) && strlen($_POST["user_email"]) <= 1)
                        $this->arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_EMAIL");
                    if((empty($this->arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $this->arParams["REQUIRED_FIELDS"])) && strlen($_POST["MESSAGE"]) <= 3)
                        $this->arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_MESSAGE");
                }
                if(strlen($_POST["user_email"]) > 1 && !check_email($_POST["user_email"]))
                    $this->arResult["ERROR_MESSAGE"][] = GetMessage("MF_EMAIL_NOT_VALID");
                if($this->arParams["USE_CAPTCHA"] == "Y")
                {
                    include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
                    $captcha_code = $_POST["captcha_sid"];
                    $captcha_word = $_POST["captcha_word"];
                    $cpt = new CCaptcha();
                    $captchaPass = COption::GetOptionString("main", "captcha_password", "");
                    if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
                    {
                        if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
                            $this->arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
                    }
                    else
                        $this->arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");

                }
                if(empty($this->arResult["ERROR_MESSAGE"]))
                {
                    $arFields = Array(
                        "AUTHOR" => $_POST["user_name"],
                        "AUTHOR_EMAIL" => $_POST["user_email"],
                        "AUTHOR_PHONE" => $_POST["user_phone"],
                        "EMAIL_TO" => $this->arParams["EMAIL_TO"],
                        "TEXT" => $_POST["MESSAGE"],
                    );
                    if(!empty($this->arParams["EVENT_MESSAGE_ID"]))
                    {
                        foreach($this->arParams["EVENT_MESSAGE_ID"] as $v)
                            if(IntVal($v) > 0)
                                CEvent::Send($this->arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
                    }
                    else
                        CEvent::Send($this->arParams["EVENT_NAME"], SITE_ID, $arFields);
                    $_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
                    $_SESSION["MF_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
                    LocalRedirect($APPLICATION->GetCurPageParam("success=".$this->arResult["PARAMS_HASH"], Array("success")));
                }

                $this->arResult["MESSAGE"] = htmlspecialcharsbx($_POST["MESSAGE"]);
                $this->arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
                $this->arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_POST["user_email"]);
                $this->arResult["AUTHOR_PHONE"] = htmlspecialcharsbx($_POST["user_phone"]);
            }
            else
                $this->arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
        }
        elseif($_REQUEST["success"] == $this->arResult["PARAMS_HASH"])
        {
            $this->arResult["OK_MESSAGE"] = $this->arParams["OK_TEXT"];
        }

        if(empty($this->arResult["ERROR_MESSAGE"]))
        {
            if($USER->IsAuthorized())
            {
                $this->arResult["AUTHOR_NAME"] = $USER->GetFormattedName(false);
                $this->arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($USER->GetEmail());
            }
            else
            {
                if(strlen($_SESSION["MF_NAME"]) > 0)
                    $this->arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_SESSION["MF_NAME"]);
                if(strlen($_SESSION["MF_EMAIL"]) > 0)
                    $this->arResult["AUTHOR_EMAIL"] = htmlspecialcharsbx($_SESSION["MF_EMAIL"]);
            }
        }

        if($this->arParams["USE_CAPTCHA"] == "Y")
            $this->arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

        $this->IncludeComponentTemplate();

    }

    public function onPrepareComponentParams($arParams)
    {
        global $USER;
        $this->arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

        $arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
        $arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
        if($arParams["EVENT_NAME"] == '')
            $arParams["EVENT_NAME"] = "FEEDBACK_FORM";
        $arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
        if($arParams["EMAIL_TO"] == '')
            $arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
        $arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
        if($arParams["OK_TEXT"] == '')
            $arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

        return $arParams;
    }


}