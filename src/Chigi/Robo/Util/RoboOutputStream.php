<?php

namespace Chigi\Robo\Util;

/**
 * The Output Stream for Robo Output Util.
 *
 * @author Richard Lea <chigix@zoho.com>
 */
class RoboOutputStream extends \Chigi\Component\IO\OutputStream {

    protected function writeString($string) {
        \Robo\Runner::getPrinter()->write($string);
    }

    public function close() {
        
    }

    public function flush() {
        
    }

}
