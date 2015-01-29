<?php

namespace src\Home;

use vendor\befew\Controller;
use vendor\befew\Logger;
use src\Home\Entity\User;
use src\Home\Entity\Teacher;

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
        $this->template->addCSS('screen.css');
        $this->template->addJS('main.js', false);
        $this->template->render('addStudent.html.twig');
    }

    public function disconnectAction() {
        $this->request->destroySession();
        header('Location: ' . BEFEW_BASE_URL);
    }
}