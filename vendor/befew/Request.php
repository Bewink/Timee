<?php

namespace vendor\befew;

/**
 * Class Request
 * @package vendor\befew
 */
class Request extends Utils {
    private $url;
    private $get;
    private $post;

    /**
     * Constructor
     * @param $url
     */
    public function __construct($url) {
        $this->url = $url;
        $this->get = self::getGet();
        $this->post = self::getPost();
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param null $id
     * @param null $default
     * @param bool $secure
     * @return null|string
     */
    public static function getPost($id = null, $default = null, $secure = false) {
        return ($id == null) ? parent::getVar($_POST, $default, $secure) : parent::getVar($_POST[$id], $default, $secure);
    }

    /**
     * @param null $id
     * @param null $default
     * @param bool $secure
     * @return null|string
     */
    public static function getGet($id = null, $default = null, $secure = false) {
        return ($id == null) ? parent::getVar($_GET, $default, $secure) : parent::getVar($_GET[$id], $default, $secure);
    }

    /**
     * @param $id
     * @param null $default
     * @param bool $secure
     * @param string $type
     * @return null|string
     */
    public function get($id, $default = null, $secure = false, $type = "all") {
        switch(strtolower($type)) {
            case 'get':
                return $this->getGet($id, $default, $secure);
                break;

            case 'post':
                return $this->getPost($id, $default, $secure);
                break;

            default:
                return ($this->getGet($id) == null) ? $this->getPost($id, $default, $secure) : $this->getGet($id, $default, $secure);
                break;
        }
    }

    public function createSession() {
        $_SESSION['loggedIn'] = true;
    }

    public function destroySession() {
        unset($_SESSION['loggedIn']);
        session_destroy();
    }

    /**
     * @return bool
     */
    public function isPostData() {
        return ($_SERVER['REQUEST_METHOD'] == "POST");
    }

    /**
     * @return bool
     */
    public function isLoggedInUser() {
        return (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true);
    }
}