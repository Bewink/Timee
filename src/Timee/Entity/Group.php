<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class Group extends Entity {
    protected $lib;

    public function __construct($id) {
        parent::__construct($id);
        $this->registerLink('Promo');
    }
}