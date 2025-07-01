<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    public function test_coupon_is_not_expired()
    {
        $coupon = Coupon::create([
            'code' => 'SAVE20',
            'type' => 'percent',
            'value' => 20,
            'expires_at' => now()->addDays(3)
        ]);

        $this->assertFalse($coupon->isExpired());
    }

    public function test_discount_amount_calculates_correctly()
    {
        $coupon = Coupon::create([
            'code' => 'SAVE20',
            'type' => 'percent',
            'value' => 20,
            'expires_at' => now()->addDays(3)
        ]);

        $this->assertEquals(200, $coupon->discountAmount(1000));
    }
}
