<?php

namespace src\Timee\Entity;

use vendors\BeFeW\Entity as Entity;

class Slot extends Entity {
    protected $description;
    protected $duration;
    protected $room;
    protected $subject;
    protected $teacher;
    protected $quota;
    protected $module;
    protected $promo;
    protected $group;

    public function __construct($id) {
        parent::__construct($id);

        $this->registerAttributes(array(
            'description', array(
                'type' => 'text'
            ),
            'duration', array(
                'type' => 'int'
            )
        ));

        $this->registerLinks(array(
            'room',
            'subject',
            'teacher',
            'quota',
            'module',
            'promo',
            'group'
        ));
    }
}