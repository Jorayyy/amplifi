<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Content;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create fake employees to fill out the leaderboard ranks
        User::create([
            'name' => 'Sarah Jenkins',
            'email' => 'sarah@company.com',
            'password' => Hash::make('password'),
            'department' => 'Sales',
            'points' => 150,
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john@company.com',
            'password' => Hash::make('password'),
            'department' => 'Engineering',
            'points' => 90,
        ]);

        User::create([
            'name' => 'Alex Rivera',
            'email' => 'alex@company.com',
            'password' => Hash::make('password'),
            'department' => 'HR',
            'points' => 40,
        ]);

        // 2. Create sample marketing campaigns for employees to share
        Content::create([
            'title' => 'Our New Enterprise AI Engine Launch',
            'instructions' => 'Share this on LinkedIn! Talk about how our new automated workflows can save corporate teams up to 20 hours a week.',
            'original_url' => 'https://laravel.com', // Will forward to the Laravel site during tests
            'points_per_click' => 50,
        ]);

        Content::create([
            'title' => 'Case Study: Scaling Retail E-Commerce Traffic by 200%',
            'instructions' => 'Great for sharing with target clients in retail or manufacturing. Highlights optimization structures.',
            'original_url' => 'https://tailwindcss.com',
            'points_per_click' => 30,
        ]);

        Content::create([
            'title' => 'We are Hiring Senior Backend Developers!',
            'instructions' => 'Help us find great engineering talent. Share our hiring board portal with your professional circles.',
            'original_url' => 'https://laravel.com',
            'points_per_click' => 20,
        ]);
    }
}
