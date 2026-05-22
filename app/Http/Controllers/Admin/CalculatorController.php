<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('admin.calculator');
    }
}
