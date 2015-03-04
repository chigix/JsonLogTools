<?php

namespace Chigi\Robo\Task\TextLog;

use Chigi\Robo\Task\AbstractIOTask;
use Robo\Task\Shared\TaskInterface;

/**
 * Description of LineUniqueTask
 *
 * @author Richard Lea <chigix@zoho.com>
 */
class LineUniqueTask extends AbstractIOTask implements TaskInterface {

    /**
     * The stack containing the md5 strings.
     * @var array<string>
     */
    private $uniqueStack;

    public function __construct(\Chigi\Component\IO\InputStream $inputStream) {
        parent::__construct($inputStream);
        $this->uniqueStack = array();
    }

    public function run() {
        while (true) {
            try {
                $line = trim($this->getInputStream()->readLine());
            } catch (\Chigi\Component\IO\EOFException $exc) {
                break;
            }
            if (!in_array(md5($line), $this->uniqueStack)) {
                $this->getOutputStream()->writeln($line);
                array_push($this->uniqueStack, md5($line));
            }
        }
    }

}
