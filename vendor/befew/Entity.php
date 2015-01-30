<?php

namespace vendor\befew;

/**
 * Class Entity
 * @package vendor\befew
 */
class Entity {
    private $uniqueKeyInfo = array();
    protected $db;

    /**
     * Constructor
     */
    public function __construct() {
        global $DBH;

        $this->db = $DBH;
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $args) {
        if (substr($method, 0, 3) == "get") {
            return $this->get(lcfirst(str_replace('get', '', $method)));
        } else if (substr($method, 0, 3) == "set") {
            return $this->set(lcfirst(str_replace('set', '', $method)), $args[0]);
        } else {
            throw new \Exception('Unknown method "' . $method . '" called');
        }
    }

    /**
     * @param $element
     * @return mixed
     */
    protected function get($element) {
        return $this->{$element};
    }

    /**
     * @param $element
     * @param $value
     * @return mixed
     */
    protected function set($element, $value) {
        return $this->{$element} = $value;
    }

    /**
     * Generates a unique key
     * Less than one chance over 1.343646e+111 to bump into an existing key. If it happens, it just generates another key.
     * @return string
     * @throws \Exception
     */
    public function generateUniqId() {
        if(count($this->uniqueKeyInfo) != 3) {
            throw new \Exception('Error while generating unique key: please fill the informations first by calling Entity::setUniqueIdInfo');
        } else {
            $query = null;
            $key = '';
            $chars = array(
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
                '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
            );

            do {
                while (strlen($key) < $this->uniqueKeyInfo['length']) {
                    $key .= $chars[rand(0, count($chars))];
                }

                $query = $this->db->prepare('SELECT * FROM ' . $this->uniqueKeyInfo['table'] . ' WHERE ' . $this->uniqueKeyInfo['key'] . ' = :keyvalue');
                $query->execute(array(
                    'keyvalue' => $key
                ));
            } while ($query->rowCount() > 0);

            return $key;
        }
    }

    /**
     * @param $tableName
     * @param $keyName
     * @param $length
     */
    protected function setUniqueIdInfo($tableName, $keyName, $length) {
        $this->uniqueKeyInfo['table'] = $tableName;
        $this->uniqueKeyInfo['key'] = $keyName;
        $this->uniqueKeyInfo['length'] = $length;
    }
}