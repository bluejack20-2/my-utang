<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function __invoke(Request $request)
    {
        $myDebts = Debt::where('is_paid', '=', false)
            ->where('creditor_id', '=', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate();

        $unpaidDebts = Debt::where('is_paid', '=', false)
            ->where('debtor_id', '=', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate();

        return view('dashboard', compact('myDebts', 'unpaidDebts'));
    }
}
