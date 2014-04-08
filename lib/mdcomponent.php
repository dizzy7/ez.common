<?php

namespace MdCommon;

abstract class Mdcomponent extends \CBitrixComponent {

    /**
     * Устанавливает значения по умолчанию для параметров, если они не заданы
     *
     * @param array $params массив параметров "параметрт => значение по умолчанию"
     *
     * @return void
     */
    protected  function setDefaultParams($params){
        foreach ($params as $param=>$value) {
            $this->setDefaultParam($param,$value);
        }

    }

    /**
     * Устанавливает значение по умолчанию для параметра, если он не задан
     *
     * @param string $param название параметра
     * @param mixed  $value значение по умолчанию
     *
     * @return void
     */
    protected  function setDefaultParam($param, $value){
        if(!isset($this->arParams[$param]) || $this->arParams[$param]==''){
            $this->arParams[$param] = $value;
        }
    }

}