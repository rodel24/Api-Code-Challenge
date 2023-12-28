<?php
// src/Service/CustomerService.php

namespace App\Service;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;

class CustomerService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCustomerById(int $customerId): ?Customer
    {
        return $this->entityManager->getRepository(Customer::class)->find($customerId);
    }

    // Other methods for customer-related business logic
}
