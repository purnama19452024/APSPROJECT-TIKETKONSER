<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ConcertController extends Controller
{
    public function index(): View
    {
        $concerts = Concert::active()->upcoming()->paginate(9);

        return view('concerts.index', compact('concerts'));
    }

    public function show(Concert $concert): View
    {
        return view('concerts.show', compact('concert'));
    }

    public function upcoming(): JsonResponse
    {
        $concerts = Concert::active()->upcoming()->take(3)->get();

        return response()->json($concerts);
    }
}
