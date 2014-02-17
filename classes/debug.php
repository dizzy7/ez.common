<?php


class MdDebug {
    public function OnBeforeProlog(){
        require_once __DIR__.'/../vendor/autoload.php';

        $phpc = COption::GetOptionString('md.common','phpconsole','N');
        if($phpc=='Y'){
            $connector = \PhpConsole\Connector::getInstance();
            $connector->setPassword('111');
            \PhpConsole\Helper::register($connector);
        }
    }
}