<?php

namespace Phobetor\RabbitMqSupervisorBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RestartCommand extends AbstractRabbitMqSupervisorAwareCommand
{
    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('rabbitmq-supervisor:restart')
            ->setDescription('Stop and start supervisord to force all processes to restart.')
            ->addOption('wait-for-supervisord', null, InputOption::VALUE_NONE)
        ;
    }

    /**
     * Executes the current command.
     *
     * @return int 0 if everything went fine, or an exit code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->rabbitMqSupervisor->setWaitForSupervisord((bool) $input->getOption('wait-for-supervisord'));
        $this->rabbitMqSupervisor->restart();
        
        return 0;
    }
}
