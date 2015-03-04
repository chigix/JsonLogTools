<?php

namespace Chigi\Robo\Task\JsonLog;

/**
 * Description of JsonLogFilterRule
 *
 * @author Richard Lea <chigix@zoho.com>
 */
class JsonLogEntryRule {

    const OPERATOR_EQUALS = 0;
    const OPERATOR_REGEXP = 1;

    /**
     *
     * @var string
     */
    private $key;

    /**
     *
     * @var int
     */
    private $operator;

    /**
     *
     * @var int|float|string
     */
    private $value;

    function __construct($key, $operator, $value) {
        $this->key = $key;
        $this->operator = $operator;
        $this->setValue($value);
    }

    public function setValue($value) {
        $value = trim($value);
        if ($this->operator === self::OPERATOR_EQUALS && is_string($value)) {
            if (preg_match("#^\d+$#", $value)) {
                $this->value = intval($value);
            } elseif (preg_match("#^\d+\.\d+$#", $value)) {
                $this->value = floatval($value);
            } elseif (preg_match("#^\"(.*)\"$#", $value)) {
                $this->value = stripslashes(trim($value, "\""));
            } elseif (preg_match("#^'(.*)'$#", $value)) {
                $this->value = stripslashes(trim($value, "'"));
            } else {
                $this->value = $value;
            }
        } else {
            $this->value = $value;
        }
    }

    /**
     * Check the match for the target json
     * @param string|array|object $json
     * @return boolean true for match,or false for match fail.
     */
    public function match($json) {
        switch ($this->operator) {
            case self::OPERATOR_EQUALS:
                try {
                    if (JsonLogUtils::getValueByKey($json, $this->key) == $this->value) {
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                } catch (\InvalidArgumentException $exc) {
                    return FALSE;
                } catch (JsonKeyNotFoundException $exc) {
                    return FALSE;
                }
                break;
            case self::OPERATOR_REGEXP:
                try {
                    if (preg_match($this->value, JsonLogUtils::getValueByKey($json, $this->key))) {
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                } catch (\InvalidArgumentException $exc) {
                    return FALSE;
                } catch (JsonKeyNotFoundException $exc) {
                    return FALSE;
                }
                break;
            default:
                return FALSE;
        }
        return FALSE;
    }

}
