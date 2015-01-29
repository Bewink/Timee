<?php

namespace vendor\befew;

/**
 * Class Response
 * @package vendor\befew
 */
class Response {
    /**
     * @param $code
     */
    public static function throwStatus($code) {
        switch($code) {
            case 404:
                header("HTTP/1.0 404 Not Found");
                include(BEFEW_BASE_URL.'app/404.php');
                break;

            default:
                include(BEFEW_BASE_URL.'app/404.php');
        }
    }
}