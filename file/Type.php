<?php /** MicroType */

namespace Micro\File;

/**
 * Class Type
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/lugnsk/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package Micro
 * @subpackage File
 * @version 1.0
 * @since 1.0
 */
class Type
{
    /**
     * Return concrete object type
     *
     * @access public
     *
     * @param mixed $var object to scan
     *
     * @return string
     * @static
     */
    public static function getType($var)
    {
        $type = gettype($var);
        switch ($type) {
            case 'object':
                return get_class($var);
                break;

            case 'double':
                return is_float($var) ? 'float' : 'double';
                break;

            default:
                return strtolower($type);
        }
    }

    /**
     * Get public vars into object
     *
     * @access public
     *
     * @param mixed $object
     *
     * @return array
     * @static
     */
    public static function getVars($object)
    {
        return get_object_vars($object);
    }

    /**
     * Array walk recursive
     *
     * @access public
     *
     * @param array $data array to walk
     * @param callable $function callable function
     *
     * @return array|mixed
     * @static
     */
    public static function arrayWalkRecursive(array $data, callable $function)
    {
        if (!is_array($data)) {
            return call_user_func($function, $data);
        }

        foreach ($data as $k => &$item) {
            $item = self::arrayWalkRecursive($data[$k], $function);
        }

        return $data;
    }

    /**
     * Get SubArray from array by keys
     *
     * @access public
     *
     * @param array $array
     * @param array $keys
     *
     * @return array
     * @static
     */
    public static function getSubArrayFromArrayByKeys(array $array, array $keys)
    {
        $result = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $array)) {
                $result[$key] = $array[$key];
            }
        }

        return $result;
    }
}
