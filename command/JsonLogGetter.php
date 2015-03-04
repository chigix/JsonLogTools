<?php

require_once __DIR__ . '/../vendor/autoload.php';

class CommandConfig extends Symfony\Component\Console\Command\Command {

    use \Chigi\Robo\Task\JsonLog\JsonLog;

    protected function configure() {
        $this->setName("JsonLogGetter");
        $this->addOption("logfile_path", null, \Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL, "What file do you want to read?");
        $this->addOption("key", null, \Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL, "The key to get value.");
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output) {
        $task = null;
        if (is_null($input->getOption("logfile_path"))) {
            $task = $this->taskJsonLogGetter(Chigi\Component\IO\StdInputStream::getInstance());
        } else {
            $task = $this->taskJsonLogGetter(new Chigi\Component\IO\FileInputStream());
        }
        if (is_null($input->getOption("key"))) {
            return;
        } else {
            $task->setKey($input->getOption("key"));
            $task->run();
        }
    }

}

$application = new Chigi\Console\Application();
$application->setCommand(new CommandConfig())->run();
