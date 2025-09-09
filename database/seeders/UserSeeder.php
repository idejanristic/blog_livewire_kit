<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(attributes: [
            'name' => env(key: 'ADMIN_NAME', default: 'Admin'),
            'email' => env(key: 'ADMIN_EMAIL', default: 'dejanr77@yahoo.com'),
            'password' => bcrypt(env(key: 'ADMIN_PASSWORD', default: '12345678')),
            'email_verified_at' => now()
        ]);

        User::factory(count: 29)->create();
    }
}
