<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {

    // define public methods as commands
    public function LogReader(array $arg, $opt=["item"=>"null"]) {
        var_dump($arg);
        var_dump($opt);
    }

}
