<?php

namespace src\Home;

use src\Home\Entity\Student;
use vendor\befew\Controller;
use vendor\befew\Logger;
use src\Home\Entity\User;
use src\Home\Entity\Teacher;
use vendor\befew\Request;
use vendor\befew\Utils;

/**
 * Class HomeController
 * @package src\Home
 */
class HomeController extends Controller {
    public function indexAction() {
        $this->template->addCSS('screen.css');
        $this->template->addJS('main.js', false);

        if($this->request->isPostData()) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $user = new User();
            $user = $user->getUserFrom($login, $password);

            if($user === false) {
                $this->request->destroySession();
                $this->template->addMessage('error', 'Login ou mot de passe incorrect');
            } else {
                $this->request->createSession();
                $_SESSION['id'] = $user->getNum();
                $_SESSION['login'] = $user->getLogin();
                $_SESSION['firstname'] = $user->getFirstname();
                $_SESSION['lastname'] = $user->getLastname();
                $_SESSION['isTeacher'] = $user instanceof Teacher;

                $this->template->addMessage('info', 'Vous êtes maintenant connecté');
            }
        }

        if($this->request->isLoggedInUser()) {
            $this->template->render('timetable.html.twig', array(
                'firstname' => $_SESSION['firstname'],
                'lastname' => $_SESSION['lastname']
            ));
        } else {
            $this->template->render('login.html.twig');
        }
    }

    public function etudiantAction() {
        $student = new Student();

        if($this->request->isPostData()) {
            if (Request::getPost('student_login') != null
            AND Request::getPost('student_pass') != null
            AND Request::getPost('student_lastname') != null
            AND Request::getPost('student_firstname') != null
            AND Request::getPost('student_dut') != null
            AND Request::getPost('student_td') != null
            AND Request::getPost('student_tp') != null
            AND Request::getPost('student_sem') != null
            AND Request::getPost('student_mail') != null) {

                if(filter_var($_POST['student_mail'], FILTER_VALIDATE_EMAIL)){

                    $login = htmlentities($_POST['student_login']);
                    $pass = Utils::cryptPassword($_POST['student_pass']);
                    $lastname = htmlentities($_POST['student_lastname']);
                    $firstname = htmlentities($_POST['student_firstname']);
                    $dut = htmlentities($_POST['student_dut']);
                    $td = htmlentities($_POST['student_td']);
                    $tp = htmlentities($_POST['student_tp']);
                    $semester = htmlentities($_POST['student_sem']);
                    $mail = htmlentities($_POST['student_mail']);

                    $student->setLogin($login);
                    $student->setPassword($pass);
                    $student->setLastname($lastname);
                    $student->setFirstname($firstname);
                    $student->setCdDUT($dut);
                    $student->setNumTD($td);
                    $student->setNumTP($tp);
                    $student->setCdSemester($semester);
                    $student->setEmail($mail);

                    $student->save();


                }
                else {
                    header('Location: index');
                }
            } else {
                header('Location: index');
            }
        }


        $students = $student->retrieveAll();

        $this->template->addCSS('screen.css');
        $this->template->addJS('main.js', false);

        if($this->request->isLoggedInUser()) {
            $this->template->render('addStudent.html.twig', array(
                'students' => $students
            ));
        } else {
            $this->template->render('login.html.twig');
        }
    }

    public function enseignantAction() {

        $teacher = new Teacher();
        $teachers = $teacher->retrieveAll();

        $this->template->addCSS('screen.css');
        $this->template->addJS('main.js', false);

        if($this->request->isLoggedInUser()) {
            $this->template->render('addTeacher.html.twig', array(
                'teachers' => $teachers
            ));
        } else {
            $this->template->render('login.html.twig');
        }
    }
    public function parametresAction() {
        $this->template->addCSS('screen.css');
        $this->template->addJS('main.js', false);

        if($this->request->isLoggedInUser()) {
            $this->template->render('parametres.html.twig');
        } else {
            $this->template->render('login.html.twig');
        }
    }

    public function disconnectAction() {
        $this->request->destroySession();
        header('Location: ' . BEFEW_BASE_URL);
    }
}