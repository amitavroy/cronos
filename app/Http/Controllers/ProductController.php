<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index()
    {
        return inertia('Product/Index');
    }
}
