<?php

namespace Chigi\Robo\Task;

use Chigi\Component\IO\InputStream;
use Chigi\Component\IO\OutputStream;
use Chigi\Robo\Util\RoboOutputStream;

/**
 * Description of AbstractIOTask
 *
 * @author Richard Lea <chigix@zoho.com>
 */
abstract class AbstractIOTask {

    /**
     *
     * @var InputStream
     */
    private $inputStream;

    /**
     *
     * @var OutputStream
     */
    private $outputStream;

    function __construct(InputStream $inputStream) {
        $this->inputStream = $inputStream;
        $this->outputStream = new RoboOutputStream();
    }

    /**
     * 
     * @return InputStream
     */
    protected function getInputStream() {
        return $this->inputStream;
    }

    /**
     * 
     * @return OutputStream
     */
    protected function getOutputStream() {
        return $this->outputStream;
    }

    public function setOutputStream(OutputStream $outputStream) {
        $this->outputStream = $outputStream;
    }

}
