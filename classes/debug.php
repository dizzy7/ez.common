<?php


class MdDebug {
    public function OnBeforeProlog(){
        require_once __DIR__.'/../vendor/autoload.php';

        $connector = \PhpConsole\Connector::getInstance();
        $connector->setPassword('111');
        \PhpConsole\Helper::register($connector);
    }
}