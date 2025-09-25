<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoanCalculatorTest extends TestCase
{
    public function testLoanScheduleEndpoint()
    {
        $response = $this->postJson('/api/loan/schedule', [
            'amount' => 100000,
            'rate' => 12,
            'months' => 6,
            'type' => 'annuity'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'total_overpayment',
                'payments' => [
                    ['month', 'payment', 'balance']
                ]
            ]);
    }
}