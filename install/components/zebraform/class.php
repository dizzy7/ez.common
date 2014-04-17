<?php


class FormCallbackComponent extends \MdCommon\MdComponent {

    public function executeComponent()
    {
        global $APPLICATION;

        require_once __DIR__.'/zebra_form/Zebra_Form.php';
        $APPLICATION->AddHeadScript('/bitrix/components/mediasfera/zebraform/zebra_form/public/javascript/zebra_form.js');

        $form = new Zebra_Form('form');

        $this->arResult['form'] = $form;

        PC::debug($this->arParams);

        $this->IncludeComponentTemplate();

        if($form->validate()){
            echo '<h2 style="color: green;">'.$this->arParams['OK_TEXT'].'</h2>';

            $arFields = $_POST;
            $arFields['EMAIL_TO'] = $this->arParams['EMAIL_TO'];

            CEvent::SendImmediate(
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
        $this->setDefaultParams($arParams, array(
                'EVENT_NAME' => 'FEEDBACK_FORM',
                'EMAIL_TO' => COption::GetOptionString("main", "email_from"),
                'OK_TEXT' => 'Спасибо, ваша заявка принята!',
            ));
        
        return $arParams;
    }


}