<?php

namespace Phobetor\RabbitMqSupervisorBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class KillCommand extends AbstractRabbitMqSupervisorAwareCommand
{
    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('rabbitmq-supervisor:kill')
            ->addArgument('signal', InputArgument::REQUIRED, 'kill -signal')
            ->setDescription('Send the given signal via kill to supervisord.')
        ;
    }

    /**
     * Executes the current command.
     *
     * @return int 0 if everything went fine, or an exit code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->rabbitMqSupervisor->kill($input->getArgument('signal'));
        
        return 0;
    }
}
