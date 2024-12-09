<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Inertia\Response;
use Inertia\ResponseFactory;

class CustomerController extends Controller
{
    public function index(CustomerService $customerService): Response|ResponseFactory
    {
        return inertia('Customer/Index', [
            'customers' => $customerService->getActiveCustomers(),
        ]);
    }
}
