<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class Quota extends Entity {
    protected $nbHour;

    public function __construct($id) {
        parent::__construct($id);
        $this->registerAttribute('nbHour', array(
            'type' => 'int'
        ));
    }
}