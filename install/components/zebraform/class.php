<?php


class FormCallbackComponent extends \MdCommon\MdComponent {

    public function executeComponent()
    {
        global $APPLICATION;

        require_once __DIR__.'/zebra_form/Zebra_Form.php';
        $APPLICATION->SetAdditionalCSS('/bitrix/components/mediasfera/zebraform/zebra_form/public/css/zebra_form.css');
        $APPLICATION->AddHeadScript('/bitrix/components/mediasfera/zebraform/zebra_form/public/javascript/zebra_form.js');

        $form = new Zebra_Form('form');

        $this->arResult['form'] = $form;

        $this->IncludeComponentTemplate();

        if($form->validate()){
            echo $this->arParams['OK_TEXT'];

            $arFields = $_POST;
            $arFields['EMAIL_TO'] = $this->arParams['EMAIL_TO'];

            CEvent::Send(
                $this->arParams['EVENT_NAME'],
                's1',
                $arFields
            );
        } else {
            $form->render();
        }
    }

    public function onPrepareComponentParams($arParams)
    {
        $arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
        if($arParams["EVENT_NAME"] == '')
            $arParams["EVENT_NAME"] = "FEEDBACK_FORM";
        $arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
        if($arParams["EMAIL_TO"] == '')
            $arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
        $arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
        if($arParams["OK_TEXT"] == '')
            $arParams["OK_TEXT"] = "Спасибо, ваша заявка принята!";
        
        return $arParams;
    }


}