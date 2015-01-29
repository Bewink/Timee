<?php

namespace vendor\befew;

/**
 * Class Utils
 * @package vendor\befew
 */
class Utils {
    private static $SQLMAP = [
        'tinyint' => '(4)',
        'smallint' => '(6)',
        'mediumint' => '(9)',
        'int' => '(11)',
        'bigint' => '(20)',
        'decimal' => '(10, 0)',
        'float' => '',
        'double' => '',
        'bit' => '(64)',
        'date' => '',
        'datetime' => '',
        'timestamp' => '',
        'time' => '',
        'year' => '(4)',
        'char' => '(30)',
        'varchar' => '(255)',
        'tinytext' => '',
        'text' => '',
        'mediumtext' => '',
        'longtext' => '',
        'binary' => '(255)',
        'longblob' => '',
        'tinyblob' => '',
        'mediumblob' => '',
        'blob' => '',
        'geometry' => '',
        'point' => '',
        'linestring' => '',
        'polygon' => '',
        'multipoint' => '',
        'multilinestring' => '',
        'multipolygon' => '',
        'geometrycollection' => ''
    ];

    /**
     * @param $var
     * @param null $default
     * @param bool $secure
     * @return null|string
     */
    public static function getVar(&$var, $default = null, $secure = false) {
        if(!isset($var)) {
            return $default;
        } else if(empty($var)) {
            return $default;
        } else {
            if($secure) {
                return htmlspecialchars($var);
            } else {
                return $var;
            }
        }
    }

    /**
     * @param $type
     * @return null
     */
    public static function getSQLDefaultLengthForType($type) {
        return (isset(self::$SQLMAP[$type])) ? self::$SQLMAP[$type] : null;
    }

    /**
     * @param $query
     * @param $values
     * @return string
     */
    public static function getQueryWithValues($query, $values) {
        return strtr($query, array_map(function($v) {return '`' . $v . '`';}, $values));
    }

    /**
     * @param $needle
     * @param $haystack
     * @param $name
     * @return bool
     */
    public static function searchInAssociativeArray($needle, $haystack, $name) {
        foreach($haystack as $line) {
            if($line[$name] === $needle) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $path
     * @return bool
     */
    public static function delete($path) {
        if (is_dir($path) === true) {
            $files = array_diff(scandir($path), array('.', '..'));

            foreach ($files as $file) {
                self::delete(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        } else if (is_file($path) === true) {
            return unlink($path);
        }

        return false;
    }

    /**
     * @param $password
     * @return string
     */
    public static function cryptPassword($password) {
        return md5(BEFEW_SECRET_TOKEN . $password);
    }
}