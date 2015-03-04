<?php

namespace Chigi\Robo\Task\TextLog;

/**
 * Description of TextLog
 *
 * @author Richard Lea <chigix@zoho.com>
 */
trait TextLog {

    /**
     * 
     * @param \Chigi\Component\IO\InputStream $stream
     * @return \Chigi\Robo\Task\TextLog\LineUniqueTask
     */
    protected function taskUniqueLine(\Chigi\Component\IO\InputStream $stream) {
        return new LineUniqueTask($stream);
    }

}
