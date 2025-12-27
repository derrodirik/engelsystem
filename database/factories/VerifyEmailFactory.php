<?php

namespace Database\Factories;

use Engelsystem\Models\User\User;
use Engelsystem\Models\User\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\Factory;

class VerifyEmailFactory extends Factory
{

    /** @var string */
    protected $model = VerifyEmail::class; // phpcs:ignore

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'token' => bin2hex(random_bytes(16)),
        ];
    }
}
