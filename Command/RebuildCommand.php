<?php

namespace Phobetor\RabbitMqSupervisorBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RebuildCommand extends AbstractRabbitMqSupervisorAwareCommand
{
    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('rabbitmq-supervisor:rebuild')
            ->setDescription('Stop supervisord, rebuild supervisor worker configuration for all RabbitMQ consumer and start supervisord again.')
            ->addOption('wait-for-supervisord', null, InputOption::VALUE_NONE, 'this option is ignored. waiting by default')
            ->addOption('no-wait-for-supervisord', null, InputOption::VALUE_NONE)
        ;
    }

    /**
     * Executes the current command.
     *
     * @return int 0 if everything went fine, or an exit code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->rabbitMqSupervisor->setWaitForSupervisord(!(bool) $input->getOption('no-wait-for-supervisord'));
        $this->rabbitMqSupervisor->rebuild();
        
        return 0;
    }
}
