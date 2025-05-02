<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\Command;

use Chamilo\CoreBundle\Framework\Container;
use Database;
use Doctrine\ORM\EntityManager;
use Notification;
<<<<<<< HEAD
=======
use Symfony\Component\Console\Attribute\AsCommand;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

<<<<<<< HEAD
class SendNotificationsCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:send-notifications';

=======
#[AsCommand(
    name: 'app:send-notifications',
    description: 'Send notifications',
)]
class SendNotificationsCommand extends Command
{
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    public function __construct(
        private readonly EntityManager $em
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
<<<<<<< HEAD
            ->setDescription('Send notifications')
=======
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
            ->addOption('debug', null, InputOption::VALUE_NONE, 'Enable debug mode')
            ->setHelp('This command sends notifications using the Notification class.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Database::setManager($this->em);

        $container = $this->getApplication()->getKernel()->getContainer();
        Container::setContainer($container);

        $io = new SymfonyStyle($input, $output);
        $debug = $input->getOption('debug');

        if ($debug) {
            error_log('Debug mode activated');
            $io->note('Debug mode activated');
        }

        $notification = new Notification();
        $notification->send();

        if ($debug) {
            error_log('Notifications have been sent.');
            $io->success('Notifications have been sent successfully.');
        }

        return Command::SUCCESS;
    }
}
