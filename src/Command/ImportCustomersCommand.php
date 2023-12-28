<?php

// src/Command/ImportCustomersCommand.php

namespace App\Command;

use App\Service\CustomerImporterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

class ImportCustomersCommand extends Command
{
    private $customerImporterService;
    private $httpClient;

    public function __construct(CustomerImporterService $customerImporterService)
    {
        $this->customerImporterService = $customerImporterService;
        parent::__construct();
        $this->httpClient = HttpClient::create();
    }

    protected function configure()
    {
        dump('Configuring ImportCustomersCommand...');
        $this
            ->setName('app:import-customers')
            ->setDescription('Import customers from the 3rd party data provider');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            // Import customers into the database
            $this->customerImporterService->importCustomers();

            $output->writeln('Customers imported successfully.');
        } catch (\Exception $e) {
            // Handle exceptions
            $output->writeln('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
