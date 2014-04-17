<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/** @var $form Zebra_Form */
$form = $arResult['form'];


$form->add('label', 'label_organization', 'organization', 'Название организации', array('inside' => true));
/** @var $obj Zebra_Form_Control */
$obj = $form->add('text', 'organization', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо заполнить название организации')
    ));

$form->add('label', 'label_address', 'address', 'Адрес организации',array('inside' => true));
$obj = $form->add('text', 'address', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо заполнить адрес организации'),
    ));

$form->add('label', 'label_city', 'city', 'Город',array('inside' => true));
$obj = $form->add('text', 'city', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо заполнить город'),
    ));

$form->add('label', 'label_contact', 'contact', 'Контактное лицо',array('inside' => true));
$obj = $form->add('text', 'contact', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо заполнить контактное лицо'),
    ));

$form->add('label', 'label_phone', 'phone', 'Телефон',array('inside' => true));
$obj = $form->add('text', 'phone', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо заполнить телефон'),
    ));

$form->add('label', 'label_email', 'email', 'Электронная почта',array('inside' => true));
$obj = $form->add('text', 'email', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо заполнить электронная почту'),
        'email' => array('error', 'Электронная почта указан неверно')
    ));

$form->add('label', 'label_site', 'site', 'Сайт',array('inside' => true));
$obj = $form->add('text', 'site', '', array('style' => 'width: 500px'));

$form->add('label', 'label_activity', 'activity', 'Вид деятельности',array('inside' => true));
$obj = $form->add('text', 'activity', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо заполнить вид деятельности'),        
    ));

$form->add('label', 'label_year', 'year', 'С какого года Ваша компания работает на строительном рынке',array('inside' => true));
$obj = $form->add('text', 'year', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо указать год, с которого ваша компания работает на строительном рынке'),
    ));

$form->add('label', 'label_prod', 'prod', 'Какими товарами торгует организация (перечислить ассортиментные группы, бренды)',array('inside' => true));
$obj = $form->add('text', 'prod', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо указать какими товарами торгует организация'),
    ));

$form->add('label', 'label_office', 'office', 'Наличие офиса, торгово-выставочных и складских помещений (перечислить)',array('inside' => true));
$obj = $form->add('text', 'office', '', array('style' => 'width: 500px'));
$obj->set_rule(array(
        'required' => array('error', 'Необходимо указать наличие офиса, торгово-выставочных и складских помещений'),
    ));

$form->add('label', 'label_comment', 'comment', 'Комментарии',array('inside' => true));
$obj = $form->add('textarea', 'comment', '', array('style' => 'width: 500px'));

$form->add('submit', 'btnsubmit', 'Отправить');

