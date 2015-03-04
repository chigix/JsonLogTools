<?php

use Chigi\Robo\Task\JsonLog\JsonLogEntryRule;

require_once __DIR__ . '/../vendor/autoload.php';

class CommandConfig extends \Symfony\Component\Console\Command\Command {

    use \Chigi\Robo\Task\JsonLog\JsonLog;

    const OPERATOR_EQUALS = 0;
    const OPERATOR_REGEXP = 1;

    protected function configure() {
        $this->setName("JsonLogFilter");
        $this->addOption("logfile_path", null, \Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL, "What file do you want to read?");
        $this->addOption("filter", null, \Symfony\Component\Console\Input\InputOption::VALUE_IS_ARRAY | \Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL, "The filter rule.");
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output) {
        $task = null;
        if (is_null($logfile = $input->getOption("logfile_path"))) {
            $task = $this->taskJsonLogFilter(Chigi\Component\IO\StdInputStream::getInstance());
        } else {
            $task = $this->taskJsonLogFilter(fopen($logfile, "r"));
        }
        foreach ($input->getOption("filter") as $rule) {
            $matches = array();
            if (preg_match("#^\w+(\.\w+)* match (.+)$#", $rule, $matches)) {
                $value = end($matches);
                $key = substr($rule, 0, -strlen($value) - 7);
                $task->addRule(new JsonLogEntryRule($key, JsonLogEntryRule::OPERATOR_REGEXP, trim($value)));
            } elseif (($operator_pos = strpos($rule, "=")) > 0) {
                $key = substr($rule, 0, $operator_pos);
                $value = trim(substr($rule, $operator_pos + 1));
                $task->addRule(new JsonLogEntryRule($key, JsonLogEntryRule::OPERATOR_EQUALS, trim($value)));
            }
        }
        $task->run();
    }

}

$application = new \Chigi\Console\Application();
$application->setCommand(new CommandConfig())->run();
?>