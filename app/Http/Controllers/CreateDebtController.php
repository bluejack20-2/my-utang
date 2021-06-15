<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateDebtController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $data = collect($request->all())
            ->forget('_token')
            ->merge([
                'creditor_id' => $request->user()->id,
                'is_paid' => false
            ])
            ->all();

        Debt::create($data);

        return redirect()
            ->route('dashboard')
            ->with('flash.banner', 'Debt created.')
            ->with('flash.bannerStyle', 'success');
    }
}
