<?php

namespace src\Home\Entity;

use vendor\befew\Entity;
use vendor\befew\Logger;
use vendor\befew\Utils;

/**
 * Class User
 * @package src\Home\Entity
 */
class User extends Entity {
    public static $ADMINS = array(
        '0000000000'
    );

    protected $num;
    protected $login;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $email;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @param $login
     * @param $password
     * @return bool|Student|Teacher
     */
    public function getUserFrom($login, $password) {
        $query = $this->db->prepare('SELECT * FROM student WHERE LOGINSTUDENT = :login AND PASSWORDSTUDENT = :password');
        $query->execute(array(
            'login' => $login,
            'password' => Utils::cryptPassword($password)
        ));

        if($query->rowCount() > 0) {
            $result = $query->fetch();

            $student = new Student();

            $student->setNum($result['NUMSTUDENT']);
            $student->setNumTD($result['NUMTD']);
            $student->setNumTP($result['NUMTP']);
            $student->setCdSemester($result['CDSEMESTER']);
            $student->setCdDUT($result['CDDUT']);
            $student->setLogin($result['LOGINSTUDENT']);
            $student->setPassword($result['PASSWORDSTUDENT']);
            $student->setFirstname($result['FIRSTNAMESTUDENT']);
            $student->setLastname($result['LASTNAMESTUDENT']);
            $student->setEmail($result['EMAILSTUDENT']);

            return $student;
        } else {
            $query = $this->db->prepare('SELECT * FROM teacher WHERE LOGINTEACHER = :login AND PASSWORDTEACHER = :password');
            $query->execute(array(
                'login' => $login,
                'password' => Utils::cryptPassword($password)
            ));

            if($query->rowCount() > 0) {
                $result = $query->fetch();

                $teacher = new Teacher();

                $teacher->setNum($result['NUMTEACHER']);
                $teacher->setCdStatus($result['CDSTATUS']);
                $teacher->setLogin($result['LOGINTEACHER']);
                $teacher->setPassword($result['PASSWORDTEACHER']);
                $teacher->setFirstname($result['FIRSTNAMETEACHER']);
                $teacher->setLastname($result['LASTNAMETEACHER']);
                $teacher->setEmail($result['EMAILTEACHER']);

                return $teacher;
            } else {
                return false;
            }
        }
    }

    /**
     * @return bool
     */
    public function isAdmin() {
        return in_array($this->num, self::$ADMINS);
    }
}