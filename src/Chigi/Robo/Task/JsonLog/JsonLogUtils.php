<?php

namespace Chigi\Robo\Task\JsonLog;

/**
 * Description of JsonLogUtils
 *
 * @author Richard Lea <chigix@zoho.com>
 */
class JsonLogUtils {

    /**
     * Json Value Getter via specified key.<br>
     * Support Json In String, Array and Object format.
     * @param string|object|array $json
     * @param string $key
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws JsonKeyNotFoundException
     */
    public static function getValueByKey($json, $key) {
        $keys = explode(".", $key);
        if (is_string($json)) {
            $json = json_decode($json, TRUE);
            if ($json === FALSE) {
                throw new \InvalidArgumentException("Invalid Json String.");
            }
        }
        if (!is_array($json) && !is_object($json)) {
            throw new \InvalidArgumentException("Invalid Parameter Type as Json Provided.");
        }
        $tmp_value = $json;
        foreach ($keys as $key) {
            if (is_array($tmp_value) && isset($tmp_value[$key])) {
                $tmp_value = $tmp_value[$key];
            } elseif (is_object($tmp_value) && isset($tmp_value->$key)) {
                $tmp_value = $tmp_value->$key;
            } else {
                unset($tmp_value);
                break;
            }
        }
        if (isset($tmp_value)) {
            return $tmp_value;
        } else {
            throw new JsonKeyNotFoundException();
        }
    }

}
