<?php

use Behat\Behat\Context\Context;
use Symfony\Bundle\FrameworkBundle\Console\Application ;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Context to test Symfony commands.
 */
class CommandContext implements Context
{
    /**
     * @var Application
     */
    private $application;

    /**
     * @var CommandTester
     */
    private $tester;

    /**
     * @var Exception
     */
    private $commandException;

    /**
     * @param Kernel $kernel
     * @param array $commandDefinitions
     */
    public function __construct(Kernel $kernel, array $commandDefinitions = [])
    {
        $this->application = new Application($kernel);

        foreach ($commandDefinitions as $commandDefinition) {
            $this->addCommandDefinition($commandDefinition);
        }
    }

    /**
     * @param array $definition
     */
    protected function addCommandDefinition(array $definition)
    {
        $command = new $definition['className'](...$definition['arguments']);
        $this->application->add($command);
    }

    protected function getCommand($name)
    {
        return $this->application->find($name);
    }

    /**
     * @When /^I run "([^"]*)" command$/
     */
    public function iRunCommand($name)
    {
        $command = $this->getCommand($name);
        $this->tester = new CommandTester($command);

        try {
            $this->commandException = null;
            $this->tester->execute(array('command' => $command->getName()));
        } catch (Exception $e) {
            $this->commandException = $e;
        }
    }

    /**
     * @When /^I run "([^"]*)" interactive command with input "([^"]*)"$/
     *
     * @param $name
     * @param $input
     */
    public function iRunInteractiveCommandWithInput($name, $input)
    {
        $input = explode('|', $input);
        $input = implode("\n", $input) . "\n";

        $command = $this->getCommand($name);

        $helper = $command->getHelper('question');
        $helper->setInputStream($this->getInputStream($input));

        $this->tester = new CommandTester($command);

        try {
            $this->commandException = null;
            $this->tester->execute(array('command' => $command->getName()), ['interactive' => true]);
        } catch (Exception $e) {
            $this->commandException = $e;
        }
    }

    /**
     * @Then /^I should see "([^"]*)" in the command output$/
     */
    public function iShouldSeeInTheCommandOutput($regexp)
    {
        if (!preg_match('/' . $regexp . '/', $this->tester->getDisplay())) {
            throw new UnexpectedValueException(
                sprintf('Pattern %s was not found in the console output %s', $regexp, $this->tester->getDisplay())
            );
        }
    }

    /**
     * @param $input
     * @return resource
     */
    protected function getInputStream($input)
    {
        $stream = fopen('php://memory', 'r+', false);
        fputs($stream, $input);
        rewind($stream);

        return $stream;
    }

    /**
     * @Then /^An exception should be thrown in the command with message "([^"]*)"$/
     */
    public function anExceptionShouldBeThrownInTheCommandWithMessage($regexp)
    {
        if (!$this->commandException instanceof Exception) {
            throw new UnexpectedValueException('No exception was thrown');
        }

        if (!preg_match('/' . $regexp . '/', $this->commandException->getMessage())) {
            throw new UnexpectedValueException(
                'Exception message %s does not contain %s',
                $this->commandException->getMessage(),
                $regexp
            );
        }
    }
}
