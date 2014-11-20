<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class UE extends Entity {
    protected $lib;
    protected $module;

    public function __construct($id) {
        parent::__construct($id);

        $this->registerLink($module);
    }
}