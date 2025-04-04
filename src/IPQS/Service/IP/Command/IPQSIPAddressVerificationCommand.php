<?php

declare(strict_types=1);

namespace IPQS\Service\IP\Command;

use IPQS\IPQS;
use IPQS\Service\IP\Options\IPVerificationOptions;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class IPQSIPAddressVerificationCommand extends Command
{
    private const string COMMAND_NAME = 'ipqs:ip:verify';
    private const string COMMAND_DESC = 'Verify an IP address';

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
                    name: 'ip',
                    mode: InputArgument::REQUIRED,
                    description: 'IP Address'
                ),
                new InputOption(
                    name: 'public-access-points',
                    shortcut: 'p',
                    mode: InputOption::VALUE_NONE,
                    description: 'Allow public access points'
                ),
                new InputOption(
                    name: 'strictness',
                    shortcut: 's',
                    mode: InputOption::VALUE_REQUIRED,
                    description: 'Strictness (integer)'
                ),
                new InputOption(
                    name: 'mobile',
                    shortcut: 'm',
                    mode: InputOption::VALUE_NONE,
                    description: 'Mobile'
                ),
                new InputOption(
                    name: 'lighter-penalties',
                    shortcut: 'i',
                    mode: InputOption::VALUE_NONE,
                    description: 'Lighter penalties'
                ),
                new InputOption(
                    name: 'user-agent',
                    shortcut: 'u',
                    mode: InputOption::VALUE_NONE,
                    description: 'User Agent'
                ),
                new InputOption(
                    name: 'user-language',
                    shortcut: 'l',
                    mode: InputOption::VALUE_NONE,
                    description: 'User Language'
                ),
            ])
        );
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $response = $this->ipqs->ip()->verify(
                value: $input->getArgument('ip'),
                options: new IPVerificationOptions(
                    strictness: (int) $input->getOption('strictness'),
                    allowPublicAccessPoints: (bool) $input->getOption('public-access-points'),
                    mobile: (bool) $input->getOption('mobile'),
                    lighterPenalties: (bool) $input->getOption('lighter-penalties'),
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
