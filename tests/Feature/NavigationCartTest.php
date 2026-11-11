<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavigationCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_navigation_shows_cart_icon(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/user/home');

        $response
            ->assertOk()
            ->assertSee('class="cart-icon"', false);
    }
}
