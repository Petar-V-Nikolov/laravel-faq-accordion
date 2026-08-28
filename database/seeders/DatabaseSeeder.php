<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::query()->firstOrCreate(
            ['email' => 'faq@example.com'],
            [
                'name' => 'FAQ Demo',
                'password' => Hash::make('password'),
            ]
        );

        $items = [
            [
                'question' => 'What is Laravel FAQ Accordion?',
                'answer' => 'A small Laravel 13 teaching kit: a public FAQ accordion on the home page, plus session login so signed-in users can add, edit, and delete items. It is not a helpdesk, knowledge base, or CMS.',
                'sort_order' => 1,
            ],
            [
                'question' => 'How do I run this project locally?',
                'answer' => 'Clone the repo, copy .env.example to .env, run composer install, php artisan key:generate, then php artisan migrate --seed. SQLite is the default. Serve with php artisan serve.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Who can add or edit FAQ items?',
                'answer' => 'Guests can only read published items. Any authenticated user can create, update, or delete FAQ rows. There are no roles or per-item ownership checks in this kit.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Is this a CMS or Filament admin?',
                'answer' => 'No. There is no Filament, no GraphQL, and no CMS package. Management is a few Blade forms behind session auth. Unpublished items stay off the public accordion.',
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            Faq::query()->firstOrCreate(
                ['question' => $item['question']],
                [
                    'user_id' => $user->id,
                    'answer' => $item['answer'],
                    'sort_order' => $item['sort_order'],
                    'published' => true,
                ]
            );
        }
    }
}
