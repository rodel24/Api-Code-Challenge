<?php
// src/Service/CustomerImporterService.php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Customer;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

class CustomerImporterService
{
    private $entityManager;
    private $httpClient;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->httpClient = HttpClient::create();
    }

    public function importCustomers(): void
    {
        $customerData = $this->fetchCustomerData();

        foreach ($customerData as $customer) {
            var_dump($customer[]);
        }
        die();
        

    }

    private function fetchCustomerData(): array
    {
        $url = 'https://randomuser.me/api/?nat=au&results=100';

        $response = $this->httpClient->request('GET', $url);

        if ($response->getStatusCode() === 200) {
            return $response->toArray();
        }

        return [];
    }
}
