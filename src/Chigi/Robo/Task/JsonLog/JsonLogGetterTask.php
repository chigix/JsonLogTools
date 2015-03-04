<?php

namespace Chigi\Robo\Task\JsonLog;

use Chigi\Robo\Task\AbstractIOTask;

/**
 * Description of JsonLogGetterTask
 *
 * @author Richard Lea <chigix@zoho.com>
 */
class JsonLogGetterTask extends AbstractIOTask implements \Robo\Task\Shared\TaskInterface {

    /**
     *
     * @var string
     */
    private $key;

    public function __construct(\Chigi\Component\IO\InputStream $inputStream) {
        parent::__construct($inputStream);
    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function run() {
        while (true) {
            try {
                $line = $this->getInputStream()->readLine();
            } catch (\Chigi\Component\IO\EOFException $exc) {
                break;
            }
            $this->getOutputStream()->writeln(JsonLogUtils::getValueByKey($line, $this->key));
        }
    }

}
