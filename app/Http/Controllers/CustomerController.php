<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Models\User;
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

    public function show(User $customer): Response|ResponseFactory
    {
        if ($customer->role !== UserRole::CUSTOMER->value) {
            abort(404, 'Customer not found');
        }

        $customer->load('orders')->limit(10);

        return inertia('Customer/Show', [
            'customer' => $customer,
        ]);
    }
}
