<?php

namespace MdCommon;

abstract class Mdcomponent extends \CBitrixComponent {

    /**
     * Устанавливает значения по умолчанию для параметров, если они не заданы
     *
     * @param array $defaults массив параметров "параметрт => значение по умолчанию"
     *
     * @return array
     */
    protected  function setDefaultParams($arParams,$defaults){
        foreach ($defaults as $param=>$value) {
            $this->setDefaultParam($param,$value);
        }

        return array_merge($arParams,$defaults);
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