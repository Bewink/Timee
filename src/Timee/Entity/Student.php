<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class Student extends Entity {
    protected $name;
    protected $surname;
    protected $phone;
    protected $email;
    protected $sex;
    protected $group;

    public function __construct($id) {
        parent::__construct($id);

        $this->registerAttributes(array(
            'phone', array(
                'length' => '(10)'
            ),
            'sex', array(
                'length' => '(1)'
            )
        ));

        $this->registerLink('group');
    }
}