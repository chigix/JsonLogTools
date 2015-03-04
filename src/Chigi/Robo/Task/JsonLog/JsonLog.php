<?php

namespace Chigi\Robo\Task\JsonLog;

use Chigi\Component\IO\InputStream;

/**
 * Description of JsonLog
 *
 * @author Richard Lea <chigix@zoho.com>
 */
trait JsonLog {

    /**
     * 
     * @param resource $stream The Input Stream with 
     * @return JsonLogFilterTask
     */
    protected function taskJsonLogFilter(InputStream $stream) {
        return new JsonLogFilterTask($stream);
    }

    /**
     * 
     * @param \Chigi\Component\IO\InputStream $stream
     * @return \Chigi\Robo\Task\JsonLog\JsonLogGetterTask
     */
    protected function taskJsonLogGetter(InputStream $stream) {
        return new JsonLogGetterTask($stream);
    }

}
