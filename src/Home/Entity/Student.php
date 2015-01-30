<?php

namespace src\Home\Entity;

use vendor\befew\Logger;
use vendor\befew\Utils;

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

    public function retrieve($num) {
        $query = $this->db->prepare("SELECT * FROM student WHERE NUMSTUDENT = :num");
        $query->execute(array(
           'num' => $num
        ));

        if($query->rowCount() > 0) {
            $result = $query->fetch();

            $this->num = $result['NUMSTUDENT'];
            $this->login = $result['LOGINSTUDENT'];
            $this->password = $result['PASSWORDSTUDENT'];
            $this->firstname = $result['FIRSTNAMESTUDENT'];
            $this->lastname = $result['LASTNAMESTUDENT'];
            $this->email = $result['EMAILSTUDENT'];
            $this->numTD = $result['NUMTD'];
            $this->numTP = $result['NUMTP'];
            $this->cdSemester = $result['CDSEMESTER'];
            $this->cdDUT = $result['CDDUT'];

            return true;
        } else {
            return false;
        }
    }

    public function retrieveAll() {
        $query = $this->db->prepare("SELECT * FROM student");
        $query->execute();
        if($query->rowCount() > 0) {

            $students = array();

            while($result = $query->fetch()){
                $student = new Student();

                $student->setNum($result['NUMSTUDENT']);
                $student->setLogin($result['LOGINSTUDENT']);
                $student->setPassword($result['PASSWORDSTUDENT']);
                $student->setFirstname($result['FIRSTNAMESTUDENT']);
                $student->setLastname($result['LASTNAMESTUDENT']);
                $student->setEmail($result['EMAILSTUDENT']);
                $student->setNumTD($result['NUMTD']);
                $student->setNumTP($result['NUMTP']);
                $student->setCdSemester($result['CDSEMESTER']);
                $student->setCdDUT($result['CDDUT']);

                $students[] = $student;
            }
        return $students;
        } else {
            return false;
        }
    }

    public function save() {
        if(Utils::getVar($this->num) == null) {
            $this->num = $this->generateUniqId();
            $query = $this->db->prepare("INSERT INTO student(NUMSTUDENT, NUMTD, NUMTP, CDSEMESTER, CDDUT, LOGINSTUDENT, PASSWORDSTUDENT, FIRSTNAMESTUDENT, LASTNAMESTUDENT, EMAILSTUDENT)
                                          VALUES(:id, :td, :tp, :semester, :dut, :login, :pass, :firstname, :lastname, :mail)");
            $query->execute(array(
                'id' => $this->num,
                'td' => $this->numTD,
                'tp' => $this->numTP,
                'semester' => $this->cdSemester,
                'dut' => $this->cdDUT,
                'login' => $this->login,
                'pass'  => $this->password,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'mail' => $this->email
            ));
        } else {
            $query = $this->db->prepare("UPDATE student
                                          SET NUMTD = :td, NUMTP = :tp, CDSEMESTER = :semester, CDDUT = :dut, LOGINSTUDENT = :login, PASSWORDSTUDENT = :pass, FIRSTNAMESTUDENT = :firstname, LASTNAMESTUDENT = :lastname, EMAILSTUDENT = :mail
                                          WHERE NUMSTUDENT = :id");
            $query->execute(array(
                'id' => $this->num,
                'td' => $this->numTD,
                'tp' => $this->numTP,
                'semester' => $this->cdSemester,
                'dut' => $this->cdDUT,
                'login' => $this->login,
                'pass'  => $this->password,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'mail' => $this->email
            ));
        }

        return true;
    }
}