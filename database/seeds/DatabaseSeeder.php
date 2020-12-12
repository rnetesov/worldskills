<?php

use App\Entities\Category;
use App\Entities\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['title' => '2D дизайн'],
            ['title' => '3D дизайн'],
            ['title' => 'эскиз'],
            ['title' => 'барокко'],
            ['title' => 'aвангард'],
            ['title' => 'классицизм'],
            ['title' => 'арт-деко'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        User::create([
            'login' => 'admin',
            'email' => 'admin@example.org',
            'password' => Hash::make('WSR'),
            'fullname' => 'администратор',
            'role' => User::ROLE_ADMIN,
        ]);

    }
}
