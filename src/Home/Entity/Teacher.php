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

    public function retrieve($num){
        $query = $this->db->prepare("SELECT * FROM teacher WHERE NUMTEACHER = :num");
        $query->execute(array(
            'num' => $num
        ));

        if($query->rowCount() > 0) {
            $result = $query->fetch();
            $this->num = $result['NUMTEACHER'];
            $this->cdStatus = $result['CDSTATUS'];
            $this->login = $result['LOGINTEACHER'];
            $this->password = $result['PASSWORDTEACHER'];
            $this->firstname = $result['FIRSTNAMETEACHER'];
            $this->lastname = $result['LASTNAMETEACHER'];
            $this->email = $result['EMAILTEACHER'];

            return true;
        } else {
            return false;
        }
    }

    public function retrieveAll() {
        $query = $this->db->prepare("SELECT * FROM teacher");
        $query->execute();
        if($query->rowCount() > 0) {

            $teachers = array();

            while($result = $query->fetch()){
                $teacher = new Teacher();

                $teacher->setNum($result['NUMTEACHER']);
                $teacher->setCdStatus($result['CDSTATUS']);
                $teacher->setLogin($result['LOGINTEACHER']);
                $teacher->setPassword($result['PASSWORDTEACHER']);
                $teacher->setFirstname($result['FIRSTNAMETEACHER']);
                $teacher->setLastname($result['LASTNAMETEACHER']);
                $teacher->setEmail($result['EMAILTEACHER']);

                $teachers[] = $teacher;
            }
            return $teachers;
        } else {
            return false;
        }
    }
}