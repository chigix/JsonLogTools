<?php

namespace Chigi\Robo\Task\JsonLog;

use Chigi\Robo\Task\AbstractIOTask;
use Robo\Task\Shared\TaskInterface;

/**
 * Description of JsonLogFilter
 *
 * @author Richard Lea <chigix@zoho.com>
 */
class JsonLogFilterTask extends AbstractIOTask implements TaskInterface {

    use \Robo\Output;

    /**
     *
     * @var array<JsonLogEntryRule> 
     */
    private $rules;

    function __construct(\Chigi\Component\IO\InputStream $inputStream) {
        parent::__construct($inputStream);
        $this->rules = array();
    }

    public function run() {
        while (true) {
            try {
                $line = $this->getInputStream()->readLine();
            } catch (\Chigi\Component\IO\EOFException $exc) {
                break;
            }
            if (count($this->rules) > 0) {
                foreach ($this->rules as $rule) {
                    /* @var $rule JsonLogEntryRule */
                    if (!$rule->match(json_decode($line, TRUE))) {
                        continue 2;
                    }
                }
            }
            $this->getOutputStream()->writeln(trim($line));
        }
    }

    /**
     * Add a Entry rule for this Filter.
     * @param JsonLogEntryRule $rule
     */
    public function addRule(JsonLogEntryRule $rule) {
        array_push($this->rules, $rule);
    }

}
