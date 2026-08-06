<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Use updateOrCreate so running seed multiple times won't trigger
        // a UniqueConstraintViolationException on the email column.
        User::updateOrCreate(
            ['email' => 'admin@isborku.dev'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );
    }
}
