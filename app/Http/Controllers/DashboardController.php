<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class DashboardController extends Controller
{
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard.index');
    }

    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard.create');
    }

    public function edit(int $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard.edit', [
            'id' => $id
        ]);
    }
}
