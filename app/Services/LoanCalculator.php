<?php

namespace App\Services;

class LoanCalculator
{
    public function calculate(float $amount, float $rate, int $months, string $type): array
    {
        return $type === 'annuity'
            ? $this->calculateAnnuity($amount, $rate, $months)
            : $this->calculateDifferentiated($amount, $rate, $months);
    }

    private function calculateAnnuity(float $amount, float $rate, int $months): array
    {
        $monthlyRate = $rate / 12 / 100;
        $annuityCoeff = $monthlyRate * pow(1 + $monthlyRate, $months) / (pow(1 + $monthlyRate, $months) - 1);
        $payment = $amount * $annuityCoeff;

        $balance = $amount;
        $schedule = [];
        $total = 0;

        for ($i = 1; $i <= $months; $i++) {
            $interest = $balance * $monthlyRate;
            $principal = $payment - $interest;
            $balance -= $principal;
            $total += $payment;

            $schedule[] = [
                'month' => $i,
                'payment' => round($payment, 2),
                'balance' => max(round($balance, 2), 0)
            ];
        }

        return [
            'total_overpayment' => round($total - $amount, 2),
            'payments' => $schedule
        ];
    }

    private function calculateDifferentiated(float $amount, float $rate, int $months): array
    {
        $monthlyRate = $rate / 12 / 100;
        $principalPart = $amount / $months;

        $balance = $amount;
        $schedule = [];
        $total = 0;

        for ($i = 1; $i <= $months; $i++) {
            $interest = $balance * $monthlyRate;
            $payment = $principalPart + $interest;
            $balance -= $principalPart;
            $total += $payment;

            $schedule[] = [
                'month' => $i,
                'payment' => round($payment, 2),
                'balance' => max(round($balance, 2), 0)
            ];
        }

        return [
            'total_overpayment' => round($total - $amount, 2),
            'payments' => $schedule
        ];
    }
}