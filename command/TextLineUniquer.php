<?php

require_once __DIR__ . '/../vendor/autoload.php';

class CommandConfig extends Symfony\Component\Console\Command\Command {

    use \Chigi\Robo\Task\TextLog\TextLog;

    protected function configure() {
        $this->setName("JsonLogGetter");
        $this->addOption("textfile_path", null, \Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL, "What file do you want to read?");
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output) {
        $task = null;
        if (is_null($input->getOption("textfile_path"))) {
            $task = $this->taskUniqueLine(Chigi\Component\IO\StdInputStream::getInstance());
        } else {
            $task = $this->taskUniqueLine(new Chigi\Component\IO\FileInputStream());
        }
        $task->run();
    }

}

$application = new Chigi\Console\Application();
$application->setCommand(new CommandConfig())->run();
