<?php

declare(strict_types=1);

namespace IPQS\Service\Device\Command;

use IPQS\IPQS;
use IPQS\Service\Device\Options\DeviceVerificationOptions;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class IPQSDeviceVerificationCommand extends Command
{
    private const string COMMAND_NAME = 'ipqs:device:verify';
    private const string COMMAND_DESC = 'Verify a device fingerprint';

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
                new InputArgument(
                    name: 'fingerprint',
                    mode: InputArgument::REQUIRED,
                    description: 'Device fingerprint'
                )
            ])
        );
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $response = $this->ipqs->device()->verify(
                value: $input->getArgument('ip'),
                options: new DeviceVerificationOptions(
                    fingerprint: (string) $input->getArgument('fingerprint'),
                )
            );

            $output->writeln("<info>{$response->toJSON()}</info>");

            return self::SUCCESS;
        } catch (\Throwable $e) {
            var_dump($e);
            $output->writeln('<error>Failed to verify device fingerprint</error>');

            return self::FAILURE;
        }
    }
}
