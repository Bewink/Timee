<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class Right extends Entity {
    protected $lib;
    protected $teacher;
    protected $promo;

    public function __construct($id) {
        parent::__construct($id);

        $this->registerAttribute('lib', array(
            'length' => '(1)'
        ));

        $this->registerLinks(array(
            'teacher',
            'promo'
        ));
    }
}