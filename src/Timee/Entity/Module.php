<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class Module extends Entity {
    protected $lib;
    protected $promo;
    protected $teachingUnit;

    public function __construct($id) {
        parent::__construct($id);
        $this->registerLink('promo');
        $this->registerLink('teachingUnit');
    }
}