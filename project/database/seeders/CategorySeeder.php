<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Фантастика', 'slug' => 'fiction'],
            ['name' => 'Классика',   'slug' => 'classic'],
            ['name' => 'Детективы',  'slug' => 'detective'],
            ['name' => 'Фэнтези',    'slug' => 'fantasy'],
            ['name' => 'Нон-фикшн',  'slug' => 'nonfiction'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}