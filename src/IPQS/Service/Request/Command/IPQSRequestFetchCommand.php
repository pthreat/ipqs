<?php

declare(strict_types=1);

namespace IPQS\Service\Request\Command;

use IPQS\IPQS;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IPQSRequestFetchCommand extends Command
{
    private const string COMMAND_NAME = 'ipqs:request:fetch';
    private const string COMMAND_DESC = 'Obtain IPQS data through a previously generated request id';

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
                    name: 'request-id',
                    mode: InputArgument::REQUIRED,
                    description: 'IPQS Request ID'
                ),
                new InputArgument(
                    name: 'type',
                    mode: InputArgument::OPTIONAL,
                    description: 'If type is not provided EACH one of the types available will be tested (NOT RECOMMENDED)'
                )
            ])
        );
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            if(null === $input->getArgument('type')){
                $output->writeln('<fg=yellow>Warning! Type not provided, falling back to auto-type determination</>');
            }

            $response = $this->ipqs->request()->fetchOne(
                requestId: $input->getArgument('request-id'),
                type: $input->getArgument('type')
            );

            dd($response);

            return self::SUCCESS;
        } catch (\Throwable $e) {
            var_dump($e);
            $output->writeln('<error>Failed to fetch request id</error>');

            return self::FAILURE;
        }
    }
}
