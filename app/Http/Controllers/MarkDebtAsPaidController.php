<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MarkDebtAsPaidController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Debt $debt
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Debt $debt): RedirectResponse
    {
        $debt->update([
            'is_paid' => true,
            'paid_at' => Carbon::now()
        ]);

        return back()
            ->with('flash.banner', 'Debt paid.')
            ->with('flash.bannerStyle', 'success');
    }
}
