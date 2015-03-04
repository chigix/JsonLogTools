<?php

namespace Chigi\Console;

/**
 * Description of newPHPClass
 *
 * @author Richard Lea <chigix@zoho.com>
 */
class Application extends \Symfony\Component\Console\Application {

    private $commandName;

    function __construct($name = 'UNKNOWN', $version = 'UNKNOWN', $command = null) {
        parent::__construct($name, $version);
        if (!is_null($command)) {
            $this->setCommand($command);
        }
    }

    protected function getCommandName(\Symfony\Component\Console\Input\InputInterface $input) {
        return $this->commandName;
    }

    public function setCommand(\Symfony\Component\Console\Command\Command $command) {
        $this->add($command);
        $this->commandName = $command->getName();
        return $this;
    }

    /**
     * Gets the InputDefinition related to this Application.
     *
     * @return InputDefinition The InputDefinition instance
     */
    public function getDefinition() {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();
        return $inputDefinition;
    }

}
