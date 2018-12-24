<?php

namespace app\modules\v1\factory;

class BaseFactory
{
    protected $form_map = [];
    protected $run_map = [];

    public function getForm($service)
    {
        $clazz = $this->form_map[$service];
        return new $clazz();
    }

    public function getRun($service)
    {
        //$clazz = $this->run_map[$service];
        $clazz = $this->form_map[$service];
        return new $clazz();
    }

}