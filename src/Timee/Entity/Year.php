<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class Year extends Entity {
    protected $lib;

    public function __construct($id) {
        parent::__construct($id);
        $this->registerAttribute('lib', array(
            'type' => 'int',
            'length' => '(4)'
        ));
    }
}