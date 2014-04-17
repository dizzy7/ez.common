<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/** @var $form Zebra_Form */
$form = $arResult['form'];


    $form->add('label', 'label_name', 'name', 'Ваше имя', array('inside' => true));
    /** @var $obj Zebra_Form_Control */
    $obj = $form->add('text', 'name', '', array('autocomplete' => 'off'));
    $obj->set_rule(array(
            'required' => array('error', 'Необходимо ввести имя')
        ));

    $form->add('label', 'label_email', 'email', 'Email',array('inside' => true));
    /** @var $obj Zebra_Form_Control */
    $obj = $form->add('text', 'email', '', array('autocomplete' => 'off'));
    $obj->set_rule(array(
            'required' => array('error', 'Необходимо ввести email'),
            'email' => array('error', 'Адрес email указан неверно')
        ));

    $form->add('label', 'label_comment', 'comment', 'Сообщение',array('inside' => true));
    $obj = $form->add('textarea', 'comment', '', array('autocomplete' => 'off'));
    $obj->set_rule(array(
            'required' => array('error', 'Необходимо ввести сообщение'),
        ));

    $form->add('submit', 'btnsubmit', 'Отправить');

