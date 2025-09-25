<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Services\LoanCalculator;

class LoanController extends Controller
{
    public function schedule(LoanRequest $request, LoanCalculator $calculator)
    {
        $data = $request->validated();

        return response()->json(
            $calculator->calculate(
                $data['amount'],
                $data['rate'],
                $data['months'],
                $data['type']
            )
        );
    }
}