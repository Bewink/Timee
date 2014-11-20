<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class Promo extends Entity {
    protected $lib;

    public function __construct($id) {
        parent::__construct($id);
    }
}