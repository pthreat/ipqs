<?php

declare(strict_types=1);

namespace IPQS\Service\Phone\Command;

use IPQS\IPQS;
use IPQS\Service\Phone\Options\PhoneVerificationOptions;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;


class IPQSPhoneVerificationCommand extends Command
{
    private const string COMMAND_NAME = 'ipqs:phone:verify';
    private const string COMMAND_DESC = 'Verify a phone number';

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
                    name: 'phone',
                    mode: InputArgument::REQUIRED,
                    description: 'Phone number'
                ),
                new InputOption(
                    name:'countries',
                    shortcut: 'c',
                    mode: InputOption::VALUE_REQUIRED,
                    description: 'Comma delimited list of countries'
                ),
                new InputOption(
                    name:'strictness',
                    shortcut: 's',
                    mode: InputOption::VALUE_REQUIRED,
                    description: 'Strictness (integer)'
                )
            ])
        );
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $response = $this->ipqs->phone()->verify(
                value: $input->getArgument('phone'),
                options: new PhoneVerificationOptions(
                    countries: explode(',', (string)$input->getOption('countries')),
                    strictness: (int) $input->getOption('strictness')
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
