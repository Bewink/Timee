<?php

namespace src\Home\Entity;

use vendor\befew\Logger;

/**
 * Class Student
 * @package src\Home\Entity
 */
class Student extends User {
    protected $numTD;
    protected $numTP;
    protected $cdSemester;
    protected $cdDUT;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->setUniqueIdInfo('student', 'NUMSTUDENT', 10);
    }
}