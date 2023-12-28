<?php
// src/Controller/CustomerController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CustomerRepository;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customers", name="get_customers", methods={"GET"})
     */
    public function getCustomers(CustomerRepository $customerRepository): JsonResponse
    {
        $customers = $customerRepository->findAll();

        $data = [];
        foreach ($customers as $customer) {
            $data[] = [
                $customer->getFirstName().' '.$customer->getLastName(),
                'email' => $customer->getEmail(),
                'country' => $customer->getCountry(),
            ];
        }

        return $this->json($data);
    }

    /**
     * @Route("/customers/{customerId}", name="get_customer", methods={"GET"})
     */
    public function getCustomer($customerId, CustomerRepository $customerRepository): JsonResponse
    {
        $customer = $customerRepository->find($customerId);

        if (!$customer) {
            throw $this->createNotFoundException('Customer not found');
        }

        $data = [
            'fullName' => $customer->getFirstName().' '.$customer->getLastName(),
            'email' => $customer->getEmail(),
            // 'username' => $customer->getUsername(),
            // 'gender' => $customer->getGender(),
            'country' => $customer->getCountry(),
            // 'city' => $customer->getCity(),
            // 'phone' => $customer->getPhone(),
        ];

        return $this->json($data);
    }
}

