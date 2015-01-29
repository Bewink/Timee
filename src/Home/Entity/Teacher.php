<?php

namespace src\Home\Entity;

use vendor\befew\Logger;

/**
 * Class Teacher
 * @package src\Home\Entity
 */
class Teacher extends User {
    protected $cdStatus;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->setUniqueIdInfo('teacher', 'NUMTEACHER', 10);
    }
}