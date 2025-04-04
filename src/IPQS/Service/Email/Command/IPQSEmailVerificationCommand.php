<?php

declare(strict_types=1);

namespace IPQS\Service\Email\Command;

use IPQS\IPQS;
use IPQS\Service\Email\Options\EmailVerificationOptions;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class IPQSEmailVerificationCommand extends Command
{
    private const string COMMAND_NAME = 'ipqs:email:verify';
    private const string COMMAND_DESC = 'Verify an email address';

    public function __construct(
        private readonly IPQS $ipqs,
        string|null $name = null
    ) {
        parent::__construct($name ?? self::COMMAND_NAME);
        $this->setDescription(self::COMMAND_DESC);
    }

    public function configure(): void
    {
        $this->setDefinition(
            new InputDefinition([
                new InputArgument(
                    name: 'email',
                    mode: InputArgument::REQUIRED,
                    description: 'Email address'
                ),
                new InputOption(
                    name: 'fast-response',
                    shortcut: 'f',
                    mode: InputOption::VALUE_NONE,
                    description: 'Fast response'
                ),
                new InputOption(
                    name: 'reply-timeout',
                    shortcut: 'r',
                    mode: InputOption::VALUE_REQUIRED,
                    description: 'Reply timeout',
                    default: '7'
                ),
                new InputOption(
                    name: 'abuse-strictness',
                    shortcut: 'a',
                    mode: InputOption::VALUE_REQUIRED,
                    description: 'Abuse strictness'
                )
            ])
        );
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $response = $this->ipqs->email()->verify(
                value: $input->getArgument('email'),
                options: new EmailVerificationOptions(
                    fastResponse: (bool)$input->getOption('fast-response'),
                    replyTimeout: (int) $input->getOption('reply-timeout'),
                    abuseStrictness: (int) $input->getOption('abuse-strictness'),
                )
            );

            $output->writeln("<info>{$response->toJSON()}</info>");

            return self::SUCCESS;
        } catch (\Throwable $e) {
            var_dump($e);
            $output->writeln('<error>Failed to verify email</error>');

            return self::FAILURE;
        }
    }
}
