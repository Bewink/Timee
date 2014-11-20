<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class Room extends Entity {
    protected $lib;
    protected $capacity;

    public function __construct($id) {
        parent::__construct($id);

        $this->registerAttribute('capacity', array(
            'type' => 'int'
        ));
    }
}